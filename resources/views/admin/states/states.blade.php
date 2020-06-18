@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Country</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($states as $state)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <p>{{$state->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$states->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
