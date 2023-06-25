@extends('layouts.admin')
@section('content')
{{-- @section('title' , 'Index Products') --}}

<div class="container">
    <a href="<?=  route('products.create');  ?>" class="btn btn-sm btn-primary"> + Create Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>image</th>
                <th>category</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)

            <tr>
                <td>{{$product->id }}</td>
                <td> {{$product->name }}</td>
                <td>
                    @if ($product->image)
                    {{-- <b>{{asset('storage/'.$product->image)}}</b> --}}
                    <img src="{{asset('storage/'.$product->image)}}" width="80" alt="nothing image">
                    @else
                    <img src="http://via.placeholder.com/80x80" alt="nothing image">
                    @endif
                </td>

                <td> {{$product->status }}</td>
                {{-- <td>{{$product->category_name}} </td> --}}
                <td>
                    <div class="btn-group">
                        <a href="{{route("products.edit" , $product->id)}}" class="btn btn-outline-info">Edit</a>
                        <form action="{{route("products.destroy" , $product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>
<div class="row">
    {{$products->links()}}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
@endsection