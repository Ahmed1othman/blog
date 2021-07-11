@extends('layouts.admin.master2')

@section('title')
    Categories
@stop
@section('css')
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('content')
    <!-- Page Heading -->
@section('page-header')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main Page</a>
    </li>
    <li class="breadcrumb-item active"> Categories
    </li>
@stop

<!-- Content Row -->
@include('admin.include.alerts')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary d-inline">Categories Table</h6>
        <a class="btn btn-primary me-md-2 float-right modal-effect" data-effect="effect-scale"
           data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus-circle"></i> Add Category</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>Created at</th>
                    <th>Last update</th>
                    <th>Created by</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach($categories as $category)
                    @php
                        $i = $i+1;
                    @endphp
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        @if($category->state == 1)
                            <span class="badge bg-success text-light">{{$category->getActive()}}</span>

                        @else
                            <span class="badge bg-danger text-light">{{$category->getActive()}}</span>
                        @endif
                    </td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>{{$category->createdBy->name}}</td>
                    <td>
                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                           data-id="{{ $category->id }}" data-category_name="{{ $category->name }}"
                           data-toggle="modal" href="#exampleModal2"
                           data-category_state="{{$category->state}}"
                           title="Edit"><i class="las la-pen"></i>Edit</a>

                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                           data-id="{{ $category->id }}" data-category_name="{{ $category->name }}"
                           data-toggle="modal" href="#deleteModal" title="Delete">Delete<i
                                class="las la-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Category</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                              type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.categories.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">category name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <input type="hidden"  id="admin_id" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->


</div>
<!-- edit -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.categories.update')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="recipient-name" class="col-form-label">category:</label>
                        <input class="form-control" name="name" id="category_name" type="text">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="state" id="category_state">
                        <label class="form-check-label" for="category_state">
                            state
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">delete category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.categories.delete')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure to delete ?</p><br>
                        <input type="hidden" name="id" id="category_id" value="">
                        <input class="form-control" name="category_name" id="category_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- row closed -->
</div>

@endsection

@section('js')
    <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <!-- edit -->
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var category_name = button.data('category_name')
            var category_state =button.data('category_state')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #category_name').val(category_name);
            if (category_state == '1'){
                modal.find('.modal-body #category_state').attr('checked', 'checked');
            }
            modal.find('.modal-body #category_state').val(category_state);

        })

    </script>
    <!-- delete -->
    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var category_name = button.data('category_name');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #category_name').val(category_name);
        })

    </script>

@endsection
