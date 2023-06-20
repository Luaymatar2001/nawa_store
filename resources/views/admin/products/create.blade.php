@extends('layouts.admin')
@section('content')
@section('title' , 'Create Products')
{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}
<div class="container">
    {{-- mb:margin button / fs:font size --}}
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                                        swal({
                                            icon: "success",
                                            text: "Adding a new product has been completed successfully!"
                                        })
                                    });
    </script>
    @else
    <script>
        swal("Faild to add new product row", {
                                        className: "red-bg",
                                    });
    </script>
    @endif
    @endif
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        {{-- if show error 404 no expire token then not have csrf token--}}
        @csrf
        {{--commit : Form method spoofing --}}
        {{-- <input type="hidden" name="_method" value="put"> --}}
        {{-- == --}}
        {{-- @method('put') --}}

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"
                id=" name" name="name" placeholder="Name">
            <label for="name">Name</label>
            @error('name')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>



        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}"
                id="slug" name="slug" placeholder="Slug">
            <label for="slug">slug</label>
            @error('slug')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror"
                value="{{old('description')}}" id="description" name="description" placeholder="Description">
            <label for="description">description</label>
            @error('description')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('short_description') is-invalid @enderror"
                value="{{old('short_description')}}" id="short_description" name="short_description"
                placeholder="short description">
            <label for="short_description">short description</label>
            @error('short_description')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        {{-- ---------- --}}
        <div class="form-floating mb-3">
            <input type="text" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror"
                id="price" name="price" placeholder="Price">
            <label for="price">price</label>
            @error('price')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" value="{{old('compare_price')}}"
                class="form-control @error('compare_price') is-invalid @enderror" id="compare_price"
                name="compare_price" placeholder="compare price">
            <label for="compare_price">compare price</label>
            @error('compare_price')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        {{-- image --}}
        <div class="form-floating mb-3">
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                placeholder="image">
            <label for="compare_price">image</label>
            @error('image')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-select form-select-lg mb-3 @error('status') is-invalid @enderror"
                aria-label=".form-select-lg example" id="status" name="status">
                <option value="draft" selected>draft</option>
                <option value="active">active</option>
                <option value="archived">archived</option>
            </select>
            <label for="status">status</label>
            @error('status')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        {{-- Category--}}

        <div class="form-floating mb-3">
            <select class="form-select form-select-lg mb-3 @error('category_id') is-invalid @enderror"
                aria-label=".form-select-lg example" id="categoryId" name="category_id">
                @foreach ($category as $categories)
                <option value="{{$categories->id}}" selected>{{$categories->name}}</option>
                @endforeach

            </select>
            <label for="category">category</label>
            @error('category_id')
            <small id="passwordHelp" class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">save</button>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
@endsection