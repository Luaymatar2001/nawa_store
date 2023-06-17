@extends('layouts.admin')
@section('content')
@section('title' , 'Index Products')

<div class="container">
    <a href="<?=  route('products.create');  ?>" class="btn btn-sm btn-primary"> + Create Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>slug</th>
                <th>description</th>
                <th>short description</th>
                <th>price</th>
                <th>compare price</th>
                <th>image</th>
                <th>status</th>
                <th>category</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)

            <tr>
                <td>{{$product->id }}</td>
                <td> {{$product->name }}</td>
                <td>{{$product->slug }} </td>
                <td>{{$product->description }} </td>
                <td>{{$product->short_description }} </td>
                <td>{{$product->price }} </td>
                <td>{{$product->compare_price }} </td>
                <td> {{$product->image }}</td>
                <td> {{$product->status }}</td>
                <td>{{$product->category_name}} </td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
@endsection