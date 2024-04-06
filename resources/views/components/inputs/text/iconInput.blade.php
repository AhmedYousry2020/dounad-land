@props(['type' => 'text','model','value','divClass' => '','iconType' => 'regular'])
<div class="col-md mb-1">

  {!! $hasLabel() !!}

  <div class="{{ $divClass }} input-group input-group-merge {{ $errors->has($name) ? ' is-invalid' : null }}">
    <span class="input-group-text"><i class="fa-{{$iconType}} fa-{{$icon}}"></i></span>
    {!! Form::$type($name, $value ?? request()->$name, $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : null)])->getAttributes() + ['required' => true,'id' => $id ?? $name]) !!}
  </div>
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
