<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $appends =['total_amount'];

    public function product()
    {
        return $this->hasMany('App\Models\Product','id','product_id');
    }

    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice','id','invoice_id');
    }

    public function getTotalAmountAttribute()
    {
        // dd('ghj');
        $product=Product::find($this->product_id);
        return number_format($product->price*$this->quantity,2);
    }
}
