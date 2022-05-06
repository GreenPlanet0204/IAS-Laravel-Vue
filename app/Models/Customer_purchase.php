<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    protected $fillable = [
        'user_id', 'app_url', 'app_name', 'cat_tab', 'period_date', 'capacity', 'capacity_unit'
    ];
}
