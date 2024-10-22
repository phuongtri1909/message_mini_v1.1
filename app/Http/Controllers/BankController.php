<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BankController extends Controller
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
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        //
    }

    public function importBanks()
{
    // Call API để lấy dữ liệu
    $response = Http::get('https://api.vietqr.io/v2/banks');
    
    if ($response->successful()) {
        $banks = $response->json()['data'];

        foreach ($banks as $bankData) {
            // Tạo hoặc cập nhật ngân hàng
            Bank::updateOrCreate(
                ['code' => $bankData['code']], // Điều kiện tìm kiếm
                [
                    'name' => $bankData['name'],
                    'bin' => $bankData['bin'],
                    'short_name' => $bankData['shortName'],
                    'logo' => $bankData['logo'],
                    'transfer_supported' => $bankData['transferSupported'],
                    'lookup_supported' => $bankData['lookupSupported'],
                    'swift_code' => $bankData['swift_code']
                ]
            );
        }

        return response()->json(['message' => 'Import banks successful!']);
    } else {
        return response()->json(['message' => 'Failed to fetch banks data'], 500);
    }
}
}
