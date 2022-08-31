@extends('layouts.pdf')

@section('content')

    <div class="clearfix">
        @if(config('invoices.logo') != '')
            <div class="text-center">
                <img src="{{ config('invoices.logo') }}"><br/>
            </div>
        @endif
        <div class="text-center">
            <b> {{ $invoice->invoice_no }} </b> <br/>
            <b> {{ $invoice->invoice_date }} </b> <br/>
        </div> <br/>
    </div>

    <div class="clearfix mt-3">
        <div class="float-left">
            <b>Customer details:</b>
            <br>
            <b> To: </b> {{ $invoice->customer->name }} <br/>
            <b> phone </b> {{ $invoice->customer->phone }} </b> <br/>
            <b> Address </b> {{ $invoice->customer->address }} </b> <br/>
        </div>
    </div> <br/>

    <div class="clearfix mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center"> # </th>
                    <th> Product </th>
                    <th class="text-center"> Qty </th>
                    <th class="text-center"> Price </th>
                    <th class="text-center"> Total </th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->product as $key=>$product)
                    <tr id='addr0'>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $product->name }} </td>
                        <td> {{ $product->quantity }} </td>
                        <td> {{ $product->price }} </td>
                        <td> {{ number_format($product->price * $product->quantity, 2) }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="clearfix mt-3">
        <table class="table floar-right tbl-total">
            <tbody>
                <tr>
                    <th class="text-center" width="50%">Sub Total</th>
                    <td class="text-center"> {{ $invoice->total_amount }} </td>
                </tr>
                <tr>
                    <th class="text-center">Tax</th>
                    <td class="text-center">{{ $invoice->tax }}%</td>
                </tr>
                <tr>
                    <th class="text-center">Tax Amount</th>
                    <td class="text-center">{{ ($invoice->tax * $invoice->total_amount)/100}}</td>
                </tr>
                <tr>
                    <th class="text-center">Grand Total</th>
                    <td class="text-center">{{ $invoice->total_amount + ($invoice->tax * $invoice->total_amount)/100}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="clearfix mt-3">
        {{config('invoices.footer_text')}}
    </div>
@endsection
