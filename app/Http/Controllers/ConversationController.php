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
        //
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
