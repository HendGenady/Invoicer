@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="text-center col-md-12">
                                <img src="{{ config('invoices.logo') }}" width="100" height="100"><br/>
                            </div>
                            <div class="text-center offset-4 col-md-4">
                                <b> {{ $invoice->invoice_no }} </b> <br/>
                                <b> {{ $invoice->invoice_date }} </b> <br/>
                            </div> <br/>

                            <div class="col-md-6 float-left" style="margin-top:20px">
                                <b>Customer details:</b>
                                <br>
                                <b> To: </b> {{ $invoice->customer->name }} <br/>
                                <b> phone </b> {{ $invoice->customer->phone }} </b> <br/>
                                <b> Address </b> {{ $invoice->customer->address }} </b> <br/>
                            </div>

                            <br>

                            <div class="col-md-12" style="margin-top:20px">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Product </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price </th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key=>$product)
                                            <tr id='addr0'>
                                                <td> {{ $loop->iteration }} </td>
                                                <td> {{ $product->name }} </td>
                                                <td> {{ $invoice->invoiceProduct->where('product_id',$product->id)->first()->quantity }} </td>
                                                <td> {{ $product->price }} </td>
                                                <td> {{ number_format($product->price * $invoice->invoiceProduct->where('product_id',$product->id)->first()->quantity, 2) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="d-flex justify-content-end col-md-12">
                                <!-- <div class="float-right col-md-4"> -->
                                <div class="col-md-4">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                            <tr>
                                                <th class="text-center" width="50%">Sub Total</th>
                                                <td class="text-center"> {{ (int)$invoice->invoiceProduct->where('product_id',$product->id)->first()->total_amount }} </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax</th>
                                                <td class="text-center">{{ $invoice->tax }}%</td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax Amount</th>
                                                <td class="text-center">{{ ($invoice->tax * (int)$invoice->invoiceProduct->where('product_id',$product->id)->first()->total_amount)/100}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td class="text-center">{{ (int)$invoice->invoiceProduct->where('product_id',$product->id)->first()->total_amount + 
                                                    ($invoice->tax * (int)$invoice->invoiceProduct->where('product_id',$product->id)->first()->total_amount)/100}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                {{config('invoices.footer_text')}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
