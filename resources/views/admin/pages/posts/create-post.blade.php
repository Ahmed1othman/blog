@extends('layouts.admin.master2')

@section('title')
    Create Post
@stop
@section('css')
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('content')
    <!-- Page Heading -->
@section('page-header')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main Page</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">Posts</a></li>
    <li class="breadcrumb-item active"> Create Post </li>
@stop
@include('admin.include.alerts')
<!-- Content Row -->
<div class="card ">
    <div class="card-header">
        Add New Post
    </div>
    <div class="card-body">
        <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data" autocomplete="off" >
            @csrf
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" >
            </div>
            <div class="mb-3">
                <label for="post_title" class="form-label">Category </label>
                <select class="form-control SlectBox" name="category_id" id="inlineFormSelectPref" required>
                    <option selected disabled>Choose...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Post Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="post_body"></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input class="form-control" type="file" id="photo" name="photo">
            </div>

            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>
</div>

@endsection

@section('js')
    <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>

@endsection
