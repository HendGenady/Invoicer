@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Add new customer</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                        <b>Customer details:</b><br>
                        Name<span style="color:red" >*</span> :  <input type="text" name='customer[name]' class="form-control" placeholder="AA001" value="" required>

                        Phone<span style="color:red" >*</span> : <input type="text" name='customer[phone]' class="form-control" value="" required>

                        Address<span style="color:red" >*</span> : <input type="text" name='customer[address]' class="form-control" value="" required> <br/>

                        <input type="submit" class="btn btn-primary" value="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

