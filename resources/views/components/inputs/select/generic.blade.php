@props(['options'=> [''],'model','selected'])
<div class="col-md mb-1">


{!! $label() !!}
{{ Form::select($name, count($options) > 0 ? $options : [], isset($selected) ? $selected : '' , $attributes->merge(['class' => 'form-select' . ($errors->has(str_replace('[]','',$name)) ? ' is-invalid' : null)])->getAttributes() + ['required' => false, 'id' => $id ?? $name]) }}

@error(str_replace('[]','',$name))
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div>
