@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Country</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($shipments as $shipment)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{$shipment->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$shipments->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
