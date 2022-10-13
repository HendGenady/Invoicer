@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> {{$product->name}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <b>Product details:</b><br>
                        Name<span style="color:red" >*</span> :  
                        <input type="text" name='name' class="form-control" placeholder="AA001" value="{{$product->name}}" required>

                        Price<span style="color:red" >*</span> : 
                        <input type="text" name='price' class="form-control" value="{{$product->price}}" required>

                        <input type="submit" class="btn btn-primary" value="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

