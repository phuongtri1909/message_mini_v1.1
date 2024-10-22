<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'code', 'bin', 'short_name', 'logo', 'transfer_supported', 'lookup_supported', 'swift_code'
    ];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
