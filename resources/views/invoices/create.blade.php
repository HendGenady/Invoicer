@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create an Invoice</div>

                <form method="POST" action="{{ route('invoices.store') }}">
                @csrf

                    <div class="card-body">
                        <div class="container">
                            <div class="row clearfix">
                                <div class="text-center offset-4 col-md-4">
                                    Invoice No*: <input type="text" name='invoice[invoice_no]' class="form-control" required>

                                    Invoice date*: <input type="text" name='invoice[invoice_date]' value="{{date('Y-m-d H:i:s')}}" required>
                                </div>
                                <br> </br>

                                <div class='float-left col-md-6'>
                                    <b>Customer:</b> {{$customer->name }} 
                                    <input type="hidden" name='invoice[customer_id]' class="form-control" value="{{$customer->id}}">
                                </div>

                                <!-- <div class="text-center offset-4 col-md-4" style="margin-top:20px">
                                    <b>Customer details:</b>
                                    <br>
                                    Name*:  <input type="text" name='customer[name]' class="form-control" placeholder="AA001" value="" required>

                                    Phone: <input type="text" name='customer[phone]' class="form-control" value="" >

                                    Address: <input type="text" name='customer[address]' class="form-control" value="">
                                </div> -->

                                <br>

                                <div class="col-md-12" style="margin-top:20px">
                                    <table class="table table-bordered table-hover" id="tab_logic">
                                        <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Product </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price({{config('invoices.currency')}})</th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td>
                                                <select class="form-control" name="product[]">
                                                    @foreach($products as $product)
                                                        <option> </option>
                                                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                            <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="d-flex justify-content-between col-md-12">
                                    <button id="add_row" type="button" class="order-1 btn btn-primary">Add Row</button>
                                    <button id='delete_row' type="button" class="order-2 btn btn-info ">Delete Row</button>
                                </div>
                            </div>

                            <div class="row clearfix" style="margin-top:20px">
                                <div class="d-flex justify-content-end col-md-12">
                                    <!-- <div class="float-right col-md-4"> -->
                                    <div class="col-md-4">
                                        <table class="table table-bordered table-hover" id="tab_logic_total">
                                            <tbody>
                                            <tr>
                                                <th class="text-center" width="50%">Sub Total({{config('invoices.currency')}})</th>
                                                <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax</th>
                                                <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" value='{{$tax}}' class="form-control" name='invoice[tax]' id="tax" placeholder="0">
                                                    <div class="input-group-addon">%</div>
                                                </div></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax Amount({{config('invoices.currency')}})</th>
                                                <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total({{config('invoices.currency')}})</th>
                                                <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Save Invoice">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++; 
            });
            $("#delete_row").click(function(){
                if(i>1){
                $("#addr"+(i-1)).html('');
                i--;
                }
                calc();
            });
            
            $('#tab_logic tbody').on('keyup change',function(){
                calc();
            });
            $('#tax').on('keyup change',function(){
                calc_total();
            });
        });

        function calc()
        {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty*price);
                    
                    calc_total();
                }
            });
        }

        function calc_total()
        {
            total=0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum=total/100*$('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum+total).toFixed(2));
        }
    </script>
@stop
