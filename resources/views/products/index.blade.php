@extends('layouts.products-app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Product Form -->
        <form action="{{ url('products') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Product Name -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="task-name" class="col-sm-3 control-label">Product Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="product-name" class="form-control">

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
                    <input type="number" name="quantity" id="product-quantity" class="form-control">

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
                    <input type="number" name="item_price" id="product-price-per-item" class="form-control">

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
                        <i class="fa fa-plus"></i> Add Product
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Products -->
    @if (count($products) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Products
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Product Name</th>
                    <th>Product Quantity in Stock</th>
                    <th>Product Price Per Item</th>
                    <th>Datetime Submitted</th>
                    <th>Total Value Number</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    <?php $productsValueNumber = 0 ?>
                    @foreach ($products as $product)
                        <tr>
                            <!-- Product Name -->
                            <td class="table-text">
                                <div>{{ $product['name'] }}</div>
                            </td>

                            <!-- Product Quantity -->
                            <td class="table-text">
                                <div>{{ $product['quantity'] }}</div>
                            </td>

                            <!-- Product Price Per Item -->
                            <td class="table-text">
                                <div>{{ $product['item_price'] }} $</div>
                            </td>

                            <!-- Product Datetime submitted -->
                            <td class="table-text">
                                <div>{{ $product['creation_date'] }}</div>
                            </td>

                            <!-- Product Total Value Number -->
                            <td class="table-text">
                                <div>{{ $productValueNumber = $product['item_price']*$product['quantity'] }}</div>
                            </td>

                            <td>
                                <form action="{{ url('products/'.$product['id']) }}" method="GET">
                                    {!! csrf_field() !!}
                                    <button>Edit Product</button>
                                </form>
                            </td>
                            <?php $productsValueNumber = $productsValueNumber + $productValueNumber  ?>
                        </tr>
                    @endforeach

                    <tr>
                        <td>
                            Sum Total of Total Value numbers :
                        <td>
                        <td>
                            {{ $productsValueNumber }}
                        <td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection