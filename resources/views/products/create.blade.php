@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Add new customer</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf
                        <b>Product details:</b><br>
                        Name<span style="color:red" >*</span> :  <input type="text" name='product[name]' class="form-control" value="" required>

                        Price({{config('invoices.currency')}})<span style="color:red" >*</span> : <input type="number" name='product[price]' class="form-control" value="" required>
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

