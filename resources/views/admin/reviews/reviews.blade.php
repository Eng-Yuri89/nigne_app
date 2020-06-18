@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Country</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($reviews as $review)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{$review->customer->formattedName() }}</p>
                                    <p>Product:{{$review->product->title}}</p>
                                    <p>{{$review->review}}</p>
                                    <p>Stars:{{$review->stars}}</p>
                                    <p>Review:{{$review->review}}</p>
                                    <p>Date:{{$review->humanFormatDate()}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$reviews->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
