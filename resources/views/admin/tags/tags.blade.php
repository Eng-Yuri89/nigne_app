@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    {{--            -----------ADD TAG FORM------------------------}}
                    <form action="{{route('tags')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="tag">Tags Name</label>
                            <input type="text" class="form-control" id="tag" name="tag"
                                   placeholder="Tags Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">save new tags</button>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </form>


                    {{--            -----------DELETE AND EDIT ICON----------------------}}
                    <div class="row">
                        @foreach($tags as $tag)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                   <span class="button-span">
                                       <span><a class="edit-tag"
                                                data-tagname="{{$tag->tag}}"
                                                data-tagid="{{$tag->id}}"><i class="fas fa-edit"></i></a></span>
                                    <span><a class="delete-tag"
                                             data-tagname="{{$tag->tag}}"
                                             data-tagid="{{$tag->id}}"><i class="far fa-trash-alt"></i></a></span>

                                   </span>
                                    <p>{{$tag->tag}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{ ( ! is_null($showLinks) && $showLinks ) ? $tags->links() :''}}

                    <form action="{{route('search-Tags')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="tag_search" name="tag_search"
                                       placeholder="sERACH TAg" required>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">SEARCH</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    {{--                    ---------------------------------}}







    {{--        -------sESSION mESSAGE BOOTSTRAP  --------------}}



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
                    {{--                    <span aria-hidden="true">&times;</span>--}}
                </button>
            </div>
            <div class="toast-body">{{Session::get('message')}}

            </div>
        </div>
    @endif



    {{--        -----EDIT & DELETE-------BOOTSTRAB MODAL--}}

    <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
        <form action="{{route('tags')}}" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        @csrf
                        <div class="form-group col-md-6">
                            <label for="edit_tag_name">Tag Name</label>
                            <input type="text" class="form-control" id="edit_tag_name" name="tag_name"
                                   placeholder="TAG Name" required>


                            <input type="hidden" name="tag_id" id="edit_tag_id">
                            <input type="hidden" name="_method" value="PUT">

                        </div>
                        <div class="col-md-6">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>


                </div>
            </div>
        </form>
    </div>


    {{--    ---------------------------delte  MODAL------------}}
    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form action="{{route('tags')}}" method="post">
                    <div class="modal-body">
                        <p id="delete-message"></p>
                        @csrf

                        {{--                        <input type="hidden" name="_method" value="delete"/>--}}


                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="tag_id" value="" id="tag_id">
                        <input type="hidden" name="tag_name" value="" id="tag_name">
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
            <div class="toast-body">{{Session::get('message')}}

            </div>
        </div>
    @endif

@endsection




{{--   -------------IF SEECION $ SCRIPT ________________--}}



@section('scripts')

    <script>
        $(document).ready(function () {
            var $deleteTag = $('.delete-tag');
            var $deleteWindow = $('#delete-window');


            var $tagId = $('#tag_id');
            var $tagName = $('#tag_name');
            var $deleteMassage = $('#delete-message');

            $deleteTag.on('click', function (element) {
                element.preventDefault();
                var tag_id = $(this).data('tagid');
                var tagName = $(this).data('tagname');
                $tagId.val(tag_id);
                $tagName.val(tagName);
                $deleteMassage.text('Are you sure you want to delete' + tagName, "?");
                $deleteWindow.modal('show');
            });
            // -----------------------------------------------
            var $editTag = $('.edit-tag');
            var $editWindow = $('#edit-window');

            var $edit_tag_name = $('#edit_tag_name');
            var $edit_tag_id = $('#edit_tag_id');


            $editTag.on('click', function (element) {
                element.preventDefault();
                var tagName = $(this).data('tagname');
                var tag_id = $(this).data('tagid');

                $edit_tag_name.val(tagName);
                $edit_tag_id.val(tag_id);
                $editWindow.modal('show');

            })

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



