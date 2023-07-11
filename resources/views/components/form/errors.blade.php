@props(['name' => ''])
@error($name)
<small id="passwordHelp" class="text-danger">
    {{ $message }}
</small>
@enderror