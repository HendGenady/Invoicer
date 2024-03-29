@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Customers </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Add new Customer</a>
                    <br/> <br/>
                    
                    <table class="table">
                        <tr>
                            <th> Name </th>
                            <th> Address </th>
                            <th> Phone </th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        @foreach($customers as $customer)
                            <tr>
                                <td> {!! $customer->name !!} </td>
                                <td> {{ $customer->address }} </td>
                                <td> {{ $customer->phone }}</td>
                                <td> 
                                    <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{route('customers.destroy',$customer->id)}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button> 
                                    </form>
                                </td>
                                <td> <a href="{{ route('invoices.create')}}?customer_id={{$customer->id}}" class="btn btn-sx btn-info">Add Invoice</a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

