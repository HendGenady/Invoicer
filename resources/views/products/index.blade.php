@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Products </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('products.create')}}" class="btn btn-primary">Add new Product</a>
                    <br/> <br/>
                    
                    <table class="table">
                        <tr>
                            <th> Name </th>
                            <th> Price({{config('invoices.currency')}}) </th>
                        </tr>
                        @forelse($products as $product)
                            <tr>
                                <td> {!! $product->name !!} </td>
                                <td> {{ $product->price }} </td>
                                <td> 
                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-info">Edit</a> 
                                    <form action="{{route('products.destroy',$product->id)}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button> 
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr colspan='2'> 
                                <td> No Products found. <td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

