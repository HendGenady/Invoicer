<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','phone'];

    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice', 'customer_id', 'id');
    }
}
