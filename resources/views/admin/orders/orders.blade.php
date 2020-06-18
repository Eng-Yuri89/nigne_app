@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">City</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($orders as $order)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{$order->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
