@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Dashboard </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add new invoice</a>

                    <br/> <br/>
                    <table class="table">
                        <tr>
                            <th> Invoice Nubmer </th>
                            <th> Invoice Date </th>
                            <th> Customer Name </th>
                            <th> Total </th>
                            <th> </th>
                        </tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td> {{ $invoice->invoice_no }} </td>
                                <td> {{ $invoice->invoice_date }} </td>
                                <td> {!! $invoice->customer->name !!}</td>
                                <td> {{ $invoice->total_amount }} </td>
                                <td> 
                                    <a href="{{route('invoices.show',$invoice->id)}}" class="btn btn-info"> more details </a> 
                                    <a href="{{route('invoices.download',$invoice->id)}}" class="btn btn-warning"> Download PDF </a> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

