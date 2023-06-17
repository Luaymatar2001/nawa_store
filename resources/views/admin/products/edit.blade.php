@extends('layouts.admin')
@section('content')
@section('title' , 'Index category')

<div class="container">
    {{-- mb:margin button / fs:font size --}}
    <h2 class="mb-4 fs-3">Edit Products</h2>
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                                        swal({
                                            icon: "success",
                                            text: "Edit product has been completed successfully!"
                                        })
                                    });
    </script>
    @else
    <script>
        swal("Faild to Edit product row", {
                                        className: "red-bg",
                                    });
    </script>
    @endif
    @endif
    <form action="{{route('products.update' , $products->id)}}" method="post">
        {{-- if show error 404 no expire token then not have csrf token--}}
        @csrf
        {{--commit : Form method spoofing --}}
        {{-- <input type="hidden" name="_method" value="put"> --}}
        {{-- == --}}
        @method('put')

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" value="{{$products->name}}" name="name"
                placeholder="Name">
            <label for="name">Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{$products->slug}}" id="slug" name="slug"
                placeholder="Slug">
            <label for="slug">slug</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="description" value="{{$products->description}}"
                name="description" placeholder="Description">
            <label for="description">description</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="short_description" value="{{$products->short_description}}"
                name="short_description" placeholder="short description">
            <label for="short_description">short description</label>
        </div>
        {{-- ---------- --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="price" name="price" value="{{$products->price}}"
                placeholder="Price">
            <label for="price">price</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="compare_price" name="compare_price"
                value="{{$products->compare_price}}" placeholder="compare price">
            <label for="compare_price">compare price</label>
        </div>
        {{-- image --}}
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="image" name="image" placeholder="image">
            <label for="compare_price">image</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="status"
                name="status">
                <option value="draft" @if($products->status == 'draft') selected @endif>draft</option>
                <option value="active" @if($products->status == 'active') selected @endif>active</option>
                <option value="archived" @if($products->status == 'archived') selected @endif>archived</option>
            </select>
            <label for="status">status</label>
        </div>
        {{-- Category--}}

        <div class="form-floating mb-3">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="category_id"
                name="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($category->id == $products->category_id ) selected
                    @endif>{{$category->name}}</option>

                @endforeach

            </select>
            <label for="category">category</label>
        </div>
        <button type="submit" class="btn btn-primary">save</button>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
@endsection