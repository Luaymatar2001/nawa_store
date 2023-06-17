@extends('layouts.admin')
@section('content')
@section('title' , 'Index category')

@if (session()->has('status'))
@if (session('status'))
<script>
    $(document).ready(function() {
                                swal({
                                    icon: "success",
                                    text: "delete a category has been completed successfully!"
                                })
                            });
</script>
@else
<script>
    swal("Faild to delete a category row", {
                                className: "red-bg",
                            });
</script>
@endif
@endif
<div class="container">
     <a href="<?=  route('categories.create');  ?>" class="btn btn-sm btn-primary"> + Create categories</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)

            <tr>
                <td>{{$category->id }}</td>
                <td> {{$category->name }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route("categories.edit" , $category->id)}}" class="btn btn-outline-info">Edit</a>
                        <form action="{{route("categories.destroy" , $category->id)}}" method="post">
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