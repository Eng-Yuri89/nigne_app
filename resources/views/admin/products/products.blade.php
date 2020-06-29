@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Products <a class="btn btn-primary" href="{{route('new-product')}}">  <i class="fas fa-plus-circle"></i></a></div>

                <div class="card-body">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="alert alert-primary" role="alert">
                                    <h5>{{$product->title}}</h5>
                                    <p>Category: {{ $product->category->name }}</p>
                                    <p>Price: {{$currency_code}}{{$product->price}}</p>
                                    {!! ( count( $product->images) > 0 ) ? '<img  class="img-thumbnail card-img" src="'. $product->images[0]->url .'"/>' : ''!!}

                                    <a class="btn btn-success mt-3" href="{{route('update-product' , ['id'=> $product->id])}}">Update Product</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$products ->links()}}
                </div>
            </div>
        </div>
    </div>


    @if (Session::has('message'))
        <div class="toast" data-autohide="false">
            <div class="toast-header">
                <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                     preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                    <rect fill="#007aff" width="100%" height="100%"/>
                </svg>
                <strong class="mr-auto">Product</strong>
                <small class="text-muted">11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">{{Session::get('message')}}

            </div>
        </div>
    @endif

@endsection




{{--   -------------IF SEECION $ SCRIPT ________________--}}



@section('scripts')


    @if (Session::has('message'))
        <script>
            $(document).ready(function ($) {
                $('.toast').toast('show');
            });
        </script>
    @endif



@endsection
