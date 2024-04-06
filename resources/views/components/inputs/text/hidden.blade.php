@props(['type' => 'hidden','model','value'])
<div class="col-md">
    {!! Form::$type($name, $value ?? request()->$name, $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : null)])->getAttributes() + ['required' => true,'id' => $id ?? $name]) !!}
</div>
