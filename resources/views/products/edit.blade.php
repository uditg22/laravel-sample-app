@extends('layouts.products-app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Product Form -->
        <form action="{{ url('products/'.$product['id']) }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}

            <!-- Product Name -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="task-name" class="col-sm-3 control-label">Product Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="product-name" class="form-control" value="{{ $product['name'] }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Product Quantity in Stock -->
            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                <label for="task-name" class="col-sm-3 control-label">Product Quantity in Stock</label>

                <div class="col-sm-6">
                    <input type="number" name="quantity" id="product-quantity" class="form-control" value="{{ $product['quantity'] }}">

                    @if ($errors->has('quantity'))
                        <span class="help-block">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Product Price Per Item -->
            <div class="form-group{{ $errors->has('item_price') ? ' has-error' : '' }}">
                <label for="task-name" class="col-sm-3 control-label">Product Price per Item (In Dollar $)</label>

                <div class="col-sm-6">
                    <input type="number" name="item_price" id="product-price-per-item" class="form-control" value="{{ $product['item_price'] }}">

                    @if ($errors->has('item_price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('item_price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Add Product Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection