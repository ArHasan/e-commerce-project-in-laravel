@extends('layouts.app')

@section('content')

    <div class="container ">
        <div class="row justify-content-md-center">
            <div class="col-md-10 mt-5">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-center">
                    <h4 class="text-white"><b>SubCategory Deleted List {{-($scount)}}</b></h4>
                    </div>
                    <div class="card-body">
                        @if(session('restore'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>!</strong> {{session('restore')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session('pdelete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>!</strong> {{session('pdelete')}}
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
                                @forelse($categories as $key=> $value)
                                <tr>
                                    <th scope="row">{{$categories->firstItem() + $key}}</th>
                                    <td>{{ $value->subcategory_name}}</td>
                                    <td>{{ $value->created_at->format('Y-M-d ')}}</td>
                                    <td>{{$value->updated_at  =='' ? 'N/A' : $value->updated_at->diffForHumans()}}</td>
                                    <td>
                                    <a href="{{url('/restore-subcategory')}}/{{$value->id}}"class="btn btn-success">Restore</a>
                                    <a href="{{url('/pdeleted-subcategory')}}/{{$value->id}}"class="btn btn-danger">Permanent Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="30 "><strong>No Data</strong></td>
                                    </tr>
                                @endforelse
                            </tbody>
                          
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

