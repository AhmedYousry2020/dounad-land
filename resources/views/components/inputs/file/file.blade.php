@props(['type' => 'file','name', 'label','multiple' => false])
<div class="col-md mb-1">

    <label for="{{$name}}" class="form-label">{{__($label)}}</label>
    <input class="form-control" name={{$name}} type="file" id="{{$name}}" multiple="{{$multiple}}" />
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>