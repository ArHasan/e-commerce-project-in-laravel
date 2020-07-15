@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="container ">
            <div class="row justify-content-md-center">
                <div class="col-md-12 mt-5">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-center">
                            <h4 class="text-white"><b>Category List</b></h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>!</strong> {{session('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $key=> $value)
                                    <tr>
                                        <th scope="row">{{$category->firstItem() + $key}}</th>
                                        <td>{{ $value->category_name}}</td>
                                        <td>{{ $value->created_at->format('Y-M-d ')}}</td>
                                        <td>{{$value->updated_at  =='' ? 'N/A' : $value->updated_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            <a href="{{url('edit-category')}}/{{$value->id}}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{url('delete-category')}}/{{$value->id}}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>

                            </table>
                            {{ $category->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
