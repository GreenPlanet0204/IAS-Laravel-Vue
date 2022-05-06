<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    protected $fillable = [
        'user_id', 'app_id', 'transaction_id', 'transaction_status', 'transaction_price', 'payee_email', 'payee_id', 'payer_email', 'payer_id'
    ];
}
