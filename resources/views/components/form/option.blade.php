{{-- 
<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="{{$id}}" name="category_id">
@foreach ($options as $category)
<option value="{{$category->id}}" @if($category->id == old('{{$name}}' , $products->category_id))
    selected
    @endif>{{$category->name}}</option>

@endforeach

</select> --}}

@props(['id' => '' , 'name' => '' , 'options' => '' , 'title' =>'' , 'value' => ''])

<div class="form-floating mb-3">
    <select class="form-select form-select-lg mb-3 @error($name) is-invalid @enderror"
        aria-label=".form-select-lg example" id="{{$id}}" name="{{$name}}">
        @foreach ($options as $categories)
        <option value="{{$categories->id}}" @if($categories->id == old('{{$id}}' , $value))
            selected
            @endif>
            {{$categories->name}}
        </option>
        @endforeach

    </select>
    <label for="{{$title}}">{{$title}}</label>
    @error($name)
    <small id="passwordHelp" class="text-danger">
        {{ $message }}
    </small>
    @enderror
</div>