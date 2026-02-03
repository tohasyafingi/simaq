@props(['field', 'class' => 'text-danger'])

@error($field)
    <small class="{{ $class }}">{{ $message }}</small>
@enderror
