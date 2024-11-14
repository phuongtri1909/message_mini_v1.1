<?php

namespace App\Http\Controllers;
use App\Models\ConversationUser; 
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        // Lấy danh sách thành viên của nhóm chat
        $members = $conversation->users()->get();

        // Trả về view với dữ liệu nhóm chat và danh sách thành viên
        return view('components.window_chat', compact('conversation', 'members'));
    }

    public function getMembers(Request $request, $conversationId)
    {
       $conversation = Conversation::findOrFail($conversationId);
    $perPage = $request->input('per_page', 5); // Số lượng thành viên mỗi trang
    $page = $request->input('page', 1); // Trang hiện tại

    $members = $conversation->users()->withPivot('role')
        ->paginate($perPage, ['*'], 'page', $page);

    // Thêm thông tin về vai trò vào danh sách thành viên
    $members->getCollection()->transform(function ($member) {
        $member->role = $member->pivot->role;
        return $member;
    });

    // Lấy vai trò của người dùng hiện tại
    $currentUserRole = auth()->user()->conversations()->where('conversation_id', $conversationId)->first()->pivot->role;

    return response()->json([
        'members' => $members->items(),
        'currentUserRole' => $currentUserRole,
        'nextPage' => $members->currentPage() + 1,
        'hasMorePages' => $members->hasMorePages()
    ]);
    }
    public function removeMember(Request $request, $conversationId)
{
    $conversation = Conversation::findOrFail($conversationId);
    $user = auth()->user();

    // Kiểm tra xem người dùng hiện tại có phải là trưởng nhóm không
    if ($conversation->users()->where('user_id', $user->id)->wherePivot('role', 'gold')->exists()) {
        $memberId = $request->input('member_id');

        // Kiểm tra xem thành viên có còn trong nhóm hay không
        if ($conversation->users()->where('user_id', $memberId)->exists()) {
            $conversation->users()->detach($memberId);
            return response()->json(['status' => 'success', 'message' => 'Thành viên đã được xóa khỏi nhóm.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Thành viên không còn trong nhóm.'], 404);
        }
    } else {
        return response()->json(['status' => 'error', 'message' => 'Bạn không có quyền xóa thành viên.'], 403);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
    public function createGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra avatar
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ]);
    
        // Tạo nhóm mới
        $group = new Conversation();
        $group->name = $request->name;
        $group->is_group = 1; // Đánh dấu là nhóm
        $group->created_by = auth()->id(); // Gán người tạo
        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar')->store('public/uploads/images/groups');
            $group->avatar = $filePath;
        }
        $group->save();
    
        // Thêm người dùng vào nhóm
        foreach ($request->members as $memberId) {
            ConversationUser::create([
                'conversation_id' => $group->id,
                'user_id' => $memberId,
                'invited_by' => auth()->id(),
                'role' => 'member', // Gán vai trò là thành viên
            ]);
        }
    
        // Thêm người tạo vào nhóm với vai trò trưởng nhóm (gold)
        ConversationUser::create([
            'conversation_id' => $group->id,
            'user_id' => auth()->id(),
            'invited_by' => auth()->id(),
            'role' => 'gold', // Gán vai trò là trưởng nhóm (gold)
        ]);
    
        return response()->json(['success' => true, 'message' => 'Nhóm đã được tạo thành công.', 'group_id' => $group->id]);
    }

}
