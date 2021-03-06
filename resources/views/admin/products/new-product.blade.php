@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {!! !is_null( $product ) ? 'Update Product  <span class="product-header-title"> '. $product->title. '</span>' : ' New Product' !!}
                </div>
                <div class="card-body">

                    <form action="{{route('update-product')}}" action="post" class="row">
                        @csrf
                        @if ( !is_null( $product )  )
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        @endif

                        <div class="form-group col-md-12">
                            <label for="product_title">Product Title</label>
                            <input type="text" class="form-control" id="product_title" name="product_title"
                                   placeholder="Product Title" required
                                   value="{{ ( !is_null($product)) ? $product->title : '' }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control" neme="product_description" id="product_description" cols="30"
                                      rows="10"
                                      required>{{ ( !is_null($product)) ? $product->description : '' }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_category">Product Category</label>
                            <select class="form-control" name="product_category" id="product_category" required>
                                <option value="">Select a Category</option>
                                @foreach( $categories as $category)
                                    <option value="{{$category->id}}"
                                        {{ (! is_null($product) && ($product->category->id === $category->id)) ? 'selected' : '' }}
                                    >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="product_unit">Product unit</label>
                            <select class="form-control" name="product_unit" id="product_unit" required>
                                <option value="">Select a Unit</option>
                                @foreach( $units as $unit)
                                    <option value="{{$unit->id}}"
                                        {{ (! is_null($product) && ($product->hasUnit->id === $unit->id)) ? 'selected' : '' }}
                                    >{{$unit->formatted()}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="product_price">Product Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price"
                                   placeholder="Product Price" required
                                   value="{{ ( !is_null($product)) ? $product->price : '' }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="product_discount">Product Discount</label>
                            <input type="number" class="form-control" id="product_discount" name="product_discount"
                                   placeholder="Product Discount" required
                                   value="{{ ( !is_null($product)) ? $product->discount : '' }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="product_total">Product Total</label>
                            <input type="number" class="form-control" id="product_total" name="product_total"
                                   placeholder="Product Total" required
                                   value="{{ ( !is_null($product)) ? $product->total : '' }}">
                        </div>


                        {{--                        -------Option-----------}}

                        <div class="form-group col-md-12">
                            <table id="options-table" class="table table-striped">

                            </table>
                            <a class="btn btn-primary  add-option-btn" href="">Add Option</a>
                        </div>

                        {{--                        ------///-Option-----------}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>



    <div class="modal options-window" tabindex="-1" role="dialog" id="options-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row">

                    <div class="form-group col-md-6">
                        <label for="option_name">Option Name</label>
                        <input type="text" class="form-control" id="option_name" name="option_name"
                               placeholder="Option Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="option_value">Option Value</label>
                        <input type="text" class="form-control" id="option_value" name="option_value"
                               placeholder="Option Value" required>


                    </div>
                    <div class="col-md-6">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add-option-button">ADD OPTION</button>
                </div>


            </div>
        </div>
    </div>


@endsection



@section('scripts')

    <script>
        $(document).ready(function () {
            var $optionWindow = $('#options-window');
            var $addOptionBtn = $('.add-option-btn');
            var $optionsTable = $('#options-table');


            $addOptionBtn.on('click', function (e) {
                e.preventDefault();
                $optionWindow.modal('show');
            });


            $(document).on('click' , '.remove-option' , function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();

            })

            $(document).on('click', '.add-option-button', function (e) {
                e.preventDefault();
                var $optionName = $('#option_name');
                if ($optionName.val() === '') {
                    alert('Option Name is Required');
                    return false;
                }
                var $optionValue = $('#option_value');
                if ($optionValue.val() === '') {
                    alert('Option Value is Required');
                    return false;
                }


                var optionRow = '' +
                    '<tr>' +
                    ' <td> ' +
                    '' + $optionName.val() + '' +
                    '</td>' +
                    ' <td>'
                    + $optionValue.val() + '' +
                    '</td>  ' +
                    '<td>' +
                    '<a href="" class="remove-option" ><i class="fas fa-minus-circle"></i></a>'
                     '<input type="hidden" name="'+ $optionName.val()+'[]" value="'+$optionValue.val()+'">'
                    '</td>'
                    ' </tr>';


                $optionsTable.append(
                    optionRow
                );
                $('#option_value').val('');

            });


        });
    </script>

@endsection
