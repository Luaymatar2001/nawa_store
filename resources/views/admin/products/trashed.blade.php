@extends('layouts.admin')
@section('content')
{{-- @section('title' , 'Index Products') --}}

<div class="container">
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                                            swal({
                                                icon: "success",
                                                text: "the process has been completed successfully!"
                                            })
                                        });
    </script>
    @else
    <script>
        swal("Faild to run the process", {
                                            className: "red-bg",
                                        });
    </script>
    @endif
    @endif
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

                        {{-- <a href="{{route("products.restore" , $product->id)}}" class="btn
                        btn-outline-info">restore</a> --}}
                        <form action="{{route("products.restore" , $product->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-info">restore</button>
                        </form>
                        <form action="{{route("products.forceDelete" , $product->id)}}" method="post">
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