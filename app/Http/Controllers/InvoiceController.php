<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceProduct;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices=Invoice::all();
        $total=0;
        foreach($invoices as $invoice){
            foreach($invoice->invoiceProduct as $invoicePr)
                $total+=(float)$invoicePr->total_amount;
            
            $invoice->total=$total;
        }
        return view('invoices.index',compact('invoices'));
    }
    
    public function create(Request $request)
    { 
        $customer=Customer::find($request->customer_id);
        //VAT >> Value-Added Tax
        $tax=14.00; //for Egypt EG
        $products=Product::all();
        return view('invoices.create',compact('customer','tax','products'));
    }

    public function store(Request $request){
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
        $total=0;
        foreach(InvoiceProduct::where('invoice_id',$id)->cursor() as $invoicePr)
            $total+=(float)$invoicePr->total_amount;
        
        $invoice->total=$total;
        $products=$invoice->product;
        return view('invoices.show',compact('invoice','products'));
    }

    public function download($id)
    {
        $invoice=Invoice::find($id);
        $total=0;
        foreach(InvoiceProduct::where('invoice_id',$id)->cursor() as $invoicePr)
            $total+=(float)$invoicePr->total_amount;
        
        $invoice->total=$total;
        $pdf=\PDF::loadView('invoices.pdf',compact('invoice'));
        return $pdf->stream('invoice.pdf');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $invoice=Invoice::whereId($id)->delete();
    //     return redirect()->route('invoices.index')->with('status','Deleted Successfully');
    // }
}
