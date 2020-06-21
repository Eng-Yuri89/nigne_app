@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Units</div>
                <div class="card-body">
                    <form action="{{route('units')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name"
                                   placeholder="Unit Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_code">Unit codec</label>
                            <input type="text" class="form-control" id="unit_code" name="unit_code"
                                   placeholder="Unit Code" required>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">save new unit</button>
                        </div>


                        <div class="col-md-6">
                        </div>
                    </form>
                    <div class="row">
                        @foreach($units as $unit)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <span>
                                        <form action="{{route('units')}}"method="post" style="position: relative">
                                              @csrf
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="unit_id" value="{{$unit->id}}">
                                            <button type="submit" class="delete_btn"><i class="far fa-trash-alt"></i></button>

                                        </form>

                                    </span>
                                    <p>{{$unit->unit_name}}, {{$unit->unit_code}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$units->links()}}
                </div>
            </div>
        </div>


    </div>


    <div class="toast" data-autohide="false">
        <div class="toast-header">
            <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                <rect fill="#007aff" width="100%" height="100%"/>
            </svg>
            <strong class="mr-auto">Bootstrap</strong>
            <small class="text-muted">11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            @if (Session::has('message'))
                {{Session::get('message')}}

            @endif
        </div>

    </div>

@endsection
@if (Session::has('message'))
@section('scripts')

    <script>
        $(document).ready(function ($) {
            $('.toast').toast('show');
        });
    </script>

@endsection

@endif


{{--@section('scripts')--}}

{{--    <script>--}}
{{--        jQuery(document).ready(function ($) {--}}
{{--            var $toast = $('.toast').toast({--}}
{{--                autohide:false--}}
{{--            });--}}
{{--            $('.toast').toast('show');--}}
{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}

