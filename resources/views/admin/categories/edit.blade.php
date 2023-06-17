@extends('layouts.admin')
@section('content')
@section('title' , 'Edit category')

<body>
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                            swal({
                                icon: "success",
                                text: "Adding a new category has been completed successfully!"
                            })
                        });
    </script>
    @else
    <script>
        swal("Faild to add new category row", {
                            className: "red-bg",
                        });
    </script>
    @endif
    @endif
    <div class="container">
        {{-- mb:margin button / fs:font size --}}

        <form action="{{route('categories.update' , $category->id)}}" method="post">
            {{-- if show error 404 no expire token then not have csrf token--}}
            @csrf
            {{--commit : Form method spoofing --}}
            {{-- <input type="hidden" name="_method" value="put"> --}}
            {{-- == --}}
            @method('put')

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}"
                    placeholder="Name">
                <label for="name">category Name</label>
            </div>
            <button type="submit" class="btn btn-primary">save</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    @endsection