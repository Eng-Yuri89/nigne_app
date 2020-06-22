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

{{--                    ---------DELETE BUTTONS TRASH_____________--}}
                    <div class="row">
                        @foreach($units as $unit)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                   <span class="button-span">
                                        <span><a class="edit-unit"><i class="fas fa-edit"></i></a></span>

                                    <span><a class="delete-unit"

                                             data-unitname="{{$unit->unit_name}}"
                                             data-unitcode="{{$unit->unit_code}}"
                                             data-unitid="{{$unit->id}}"><i class="far fa-trash-alt"></i></a></span>
                                   </span>
                                    <p>{{$unit->unit_name}}, {{$unit->unit_code}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>


{{--                    ________________________--}}
                    {{$units->links()}}
                </div>
            </div>
        </div>


    </div>




{{--        ------------SPAN DELETE EDIT Boutton--}}
    <span>
        <form action="{{route('units')}}" method="post">
              @csrf
            <input type="hidden" name="_method" value="delete"/>
            <input type="hidden" name="unit_id" value="{{$unit->id}}">


        </form>

    </span>

{{--        ------------BOOTSTRAB MODAL--}}
    <div class="modal edit-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{--    ---------------------------delte  MODAL------------}}
    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('units')}}" method="post">
                    <div class="modal-body">
                        <p id="delete-message"></p>
                    @csrf
                    <input type="hidden" name="_method" value="delete"/>
                    <input type="hidden" name="unit_id" value="" id="unit_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--        -------END BOOTSTRAP MODAL --------------}}



    @if (Session::has('message'))
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
                {{Session::get('message')}}

                @endif
            </div>

        </div>

@endsection




{{--   -------------IF SEECION $ SCRIPT ________________--}}



@section('scripts')

    <script>
        $(document).ready(function () {
            var $deleteUnit = $('.delete-unit');
            var $deleteWindow = $('#delete-window');
            var $unitId = $('#unit_id');
            var $deleteMassage =$('#delete-message')

            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var unit_id = $(this).data('unitid');
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                $unitId.val(unit_id);
                $deleteMassage.text('Are you sure you want to delete' + unitName +'with code' + unitCode +"?");
                $deleteWindow.modal('show');
            });
        });
    </script>


    @if (Session::has('message'))
        <script>
            $(document).ready(function ($) {
                $('.toast').toast('show');
            });
        </script>
    @endif
@endsection




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

