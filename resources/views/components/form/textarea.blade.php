{{-- put default value --}}
@props(['name' => '' , 'label' => '' , 'value' => '', 'id' => '' , 'type'=>'text'])

<div class="form-floating mb-3">
    <textarea class="form-control @error($name) is-invalid @enderror" id=" {{$id}}" style="height: 100px;"
        name="{{$name}}" placeholder="{{$name}}">
    {{old($name , $value)}}
    </textarea>
    <label for="{{$name}}">{{$label}}</label>
    <x-form.errors name="{{$name}}" />
</div>