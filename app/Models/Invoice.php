<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable=['tax','invoice_no','invoice_date','customer_id'];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','id','customer_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'invoice_products', 'invoice_id', 'product_id');
    }

    public function invoiceProduct()
    {
        return $this->hasMany('App\Models\InvoiceProduct', 'invoice_id', 'id');
    }
}
