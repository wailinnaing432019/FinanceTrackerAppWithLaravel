<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'from_account_id',
        'to_account_id',
        'amount',
        'description',
        'date',
        'time',

    ];
    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }
     public function toAccount()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }
}