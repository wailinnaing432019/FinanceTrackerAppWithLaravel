<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'account_id',
        'note',
        'amount',
        'account_type',
        'opening_balance',
        'date',
        'time',

   ];
   /**
    * Get the user that owns the AccountDetail
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function account()
   {
       return $this->belongsTo(Account::class, 'account_id');
   }
}