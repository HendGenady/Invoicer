@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> {{$customer->name}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                        @csrf
                        @method('PUT')
                        <b>Customer details:</b><br>
                        Name<span style="color:red" >*</span> :  
                        <input type="text" name='name' class="form-control" placeholder="AA001" value="{{$customer->name}}" required>

                        Phone<span style="color:red" >*</span> : 
                        <input type="text" name='phone' class="form-control" value="{{$customer->phone}}" required>

                        Address<span style="color:red" >*</span> : 
                        <input type="text" name='address' class="form-control" value="{{$customer->address}}" required> <br/>

                        <input type="submit" class="btn btn-primary" value="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

