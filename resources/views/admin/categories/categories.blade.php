@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    {{--            -----------ADD TAG FORM------------------------}}
                    <form action="{{route('categories')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="tag">Tags Name</label>
                            <input type="text" class="form-control" id="name" name="name"
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
                        @foreach($categories as $category)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                   <span class="button-span">
                                       <span><a class="edit-category"
                                                data-categoryname="{{$category->name}}"
                                                data-categoryid="{{$category->id}}"><i
                                                   class="fas fa-edit"></i></a></span>
                                    <span><a class="delete-category"
                                             data-categoryname="{{$category->name}}"
                                             data-categoryid="{{$category->id}}"><i
                                                class="far fa-trash-alt"></i></a></span>

                                   </span>
                                    <p>{{$category->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{ ( ! is_null($showLinks) && $showLinks ) ? $categories->links() :''}}

                    <form action="{{route('search-categories')}}" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="category_search" name="category_search"
                                       placeholder="search category" required>
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



    {{--    @if (Session::has('message'))--}}
    {{--        <div class="toast" data-autohide="false">--}}
    {{--            <div class="toast-header">--}}
    {{--                <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"--}}
    {{--                     preserveAspectRatio="xMidYMid slice" focusable="false" role="img">--}}
    {{--                    <rect fill="#007aff" width="100%" height="100%"/>--}}
    {{--                </svg>--}}
    {{--                <strong class="mr-auto">Bootstrap</strong>--}}
    {{--                <small class="text-muted">11 mins ago</small>--}}
    {{--                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">--}}
    {{--                    --}}{{--                    <span aria-hidden="true">&times;</span>--}}
    {{--                </button>--}}
    {{--            </div>--}}
    {{--            <div class="toast-body">{{Session::get('message')}}--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endif--}}



    {{--        -----EDIT & DELETE-------BOOTSTRAB MODAL--}}

    <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
        <form action="{{route('categories')}}" method="post">
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
                            <label for="edit_category_name">Tag Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="category_name"
                                   placeholder="Category Name" required>


                            <input type="hidden" name="category_id" id="edit_category_id">
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
                <form action="{{route('categories')}}" method="post">
                    <div class="modal-body">
                        <p id="delete-message"></p>
                        @csrf

                        {{--                        <input type="hidden" name="_method" value="delete"/>--}}


                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="category_id" value="" id="category_id">
                        <input type="hidden" name="category_name" value="" id="category_name">
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
            var $deleteCategory = $('.delete-category');
            var $deleteWindow = $('#delete-window');


            var $categoryId = $('#category_id');
            var $categoryName = $('#category_name');
            var $deleteMassage = $('#delete-message');

            $deleteCategory.on('click', function (element) {
                element.preventDefault();
                var category_id = $(this).data('categoryid');
                var categoryName = $(this).data('categoryname');
                $categoryId.val(category_id);
                $categoryName.val(categoryName);
                $deleteMassage.text('Are you sure you want to delete ' + categoryName, " ?");
                $deleteWindow.modal('show');
            });
            // -----------------------------------------------
            var $editCategory = $('.edit-category');
            var $editWindow = $('#edit-window');

            var $edit_category_name = $('#edit_category_name');
            var $edit_category_id = $('#edit_category_id');


            $editCategory.on('click', function (element) {
                element.preventDefault();
                var categoryName = $(this).data('categoryname');
                var category_id = $(this).data('categoryid');

                $edit_category_name.val(categoryName);
                $edit_category_id.val(category_id);
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



