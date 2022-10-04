<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceProduct;

class InvoicesController extends Controller
{
    public function index()
    {

    }
    
    public function create()
    { 
        $customers=Customer::all();
        return view('invoices.create',compact('customers'));
    }

    public function store(Request $request){
        // $customer=Customer::create($request->customer);
        // $invoice=$customer->invoice()->create($request->invoice);
        $invoice=Invoice::create($request->invoice);
        foreach($request->product as $key => $prod)
        {
            $product=Product::firstOrCreate([
                'name' => $prod,
                'price' => $request->price[$key]
            ]);
            InvoiceProduct::firstOrCreate([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $request->qty[$key],
            ]);
        }
        return redirect()->route('home');
    }

    public function show($id)
    {
        $invoice=Invoice::find($id);
        $products=$invoice->product;
        return view('invoices.show',compact('invoice','products'));
    }

    public function download($id)
    {
        $invoice=Invoice::find($id);
        $pdf=\PDF::loadView('invoices.pdf',compact('invoice'));
        return $pdf->stream('invoice.pdf');
    }
}
