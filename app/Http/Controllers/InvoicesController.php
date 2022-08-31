<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {

    }
    
    public function create()
    { 
        return view('invoices.create');
    }

    public function store(Request $request){
        $customer=Customer::create($request->customer);
        $invoice=$customer->invoice()->create($request->invoice);
        // $invoice=Invoice::create($request->invoice + ['customer_id' => $customer->id]);
        foreach($request->product as $key => $prod)
        {
            $invoice->product()->create([
                'name' => $prod,
                'quantity' => $request->qty[$key],
                'price' => $request->price[$key]
            ]);
        }
        return 'Done    ';
    }

    public function show($id)
    {
        $invoice=Invoice::find($id);
        return view('invoices.show',compact('invoice'));
    }

    public function download($id)
    {
        $invoice=Invoice::find($id);
        $pdf=\PDF::loadView('invoices.pdf',compact('invoice'));
        return $pdf->stream('invoice.pdf');
    }
}
