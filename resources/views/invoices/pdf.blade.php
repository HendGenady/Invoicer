@extends('layouts.pdf')

@section('content1')
    <center>
        <div>
            @if(config('invoices.footer_text') != '')
                <div>
                    <img width="10%" hight="10%" src="{{ public_path('/images/logo.png') }}"><br/> <br/>
                </div>
            @endif
            <div>
                <b> {{ $invoice->invoice_no }} </b> <br/>
                <b> {{ $invoice->invoice_date }} </b> <br/>
            </div> <br/>
        </div>
    </center>

    <div>
        <div>
            <b>Customer details:</b>
            <p> To: {{ $invoice->customer->name }} </p>
            <p> Phone: {{ $invoice->customer->phone }} </p>
            <p> Address: {{ $invoice->customer->address }} </p>
        </div>
    </div> <br/>

    <div>
        <table width="100%">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Product </th>
                    <th> Qty </th>
                    <th> Price({{config('invoices.currency')}}) </th>
                    <th> Total </th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->product as $key=>$product)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $product->name }} </td>
                        <td> {{ $invoice->invoiceProduct->where('product_id',$product->id)->first()->quantity }} </td>
                        <td> {{ $product->price }} </td>
                        <td> {{ number_format($invoice->invoiceProduct->where('product_id',$product->id)->first()->total_amount) }} </td>
                    </tr> <br/>
                @endforeach
            </tbody>
        </table>
    </div> <br/>

    <div>
        <table>
            <tbody>
                <tr>
                    <th width="50%">Sub Total({{config('invoices.currency')}})</th>
                    <td> {{ $invoice->total }} </td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>{{ $invoice->tax }}%</td>
                </tr>
                <tr>
                    <th>Tax Amount({{config('invoices.currency')}})</th>
                    <td>{{ ($invoice->tax * $invoice->total)/100}}</td>
                </tr>
                <tr>
                    <th>Grand Total({{config('invoices.currency')}})</th>
                    <td>{{ $invoice->total + ($invoice->tax * $invoice->total)/100}}</td>
                </tr>
            </tbody>
        </table>
    </div> <br/>

    <div>
        <center>{{config('invoices.footer_text')}} </center>
    </div>
@endsection
