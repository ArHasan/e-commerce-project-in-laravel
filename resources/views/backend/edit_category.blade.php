<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Add-Category</title>
</head>

<body>

    <div class="container ">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-5">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-center">
                        <h4>EditCategory</h4>
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

                        <form action="{{url('/update-category-post')}}" method="post">
                            @csrf
                        <input type="hidden" value="{{$category->id}}" name="category_id">
                          
                            <div class="form-group">
                                <label for="name">Name</label>
                            <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control @error('category_name') is-invalid @enderror"
                                    id="name" placeholder="Enter name">
                            </div>
                            @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
