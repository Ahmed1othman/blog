@extends('layouts.admin.master2')

@section('title')
    Posts List
@stop
@section('css')
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('content')
    <!-- Page Heading -->
@section('page-header')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main Page</a>
    </li>
    <li class="breadcrumb-item active"> Posts List
    </li>
@stop

<!-- Content Row -->
@include('admin.include.alerts')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary d-inline">Posts Table</h6>
        <a class="btn btn-primary me-md-2 float-right m"  href="{{route('admin.posts.create')}}"><i class="fas fa-plus-circle"></i> Add Post</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
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
                @foreach($posts as $post)
                    @php
                        $i = $i+1;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$post->post_title}}</td>
                        <td>{{$post->category->name}}</td>
                        <td>
                            @if($post->state == 1)
                                <span class="badge bg-success text-light">{{$post->getActive()}}</span>

                            @else
                                <span class="badge bg-danger text-light">{{$post->getActive()}}</span>
                            @endif
                        </td>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>{{$post->createdBy->name}}</td>
                        <td>
                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                               data-id="{{ $post->id }}" data-category_name="{{ $post->name }}"
                               data-toggle="modal" href="#exampleModal2"
                               data-category_state="{{$post->state}}"
                               title="Edit"><i class="las la-pen"></i>Edit</a>

                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                               data-id="{{ $post->id }}" data-category_name="{{ $post->name }}"
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


@endsection

@section('js')
    <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>

@endsection
