@props(['type' => 'text','model','value'])
<div class="col-md">
    {!! $hasLabel() !!}

    {!! Form::$type($name, $value ?? request()->$name, $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : null)])->getAttributes() + ['required' => true,'id' => $id ?? $name]) !!}

    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
