<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable=['tax','invoice_no','invoice_date','customer_id'];

    public function product()
    {
        return $this->hasMany('App\Models\Product','invoice_id','id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','id','customer_id');
    }

    public function getTotalAmountAttribute()
    {
        $all=0;
        foreach($this->product as $one)
        {
            $all+=$one->price*$one->quantity;
        }
        return number_format($all,2);
    }
}
