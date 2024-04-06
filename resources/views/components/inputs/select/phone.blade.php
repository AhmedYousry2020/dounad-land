@props(['selected' => ''])

<select {{ $attributes }} class="form-select" name="{{$name}}" id="{{$name}}" required>
    @foreach($mobilephones as $phone)
    <option class="badge rounded-pill bg-white" value="{{$phone['id']}}" @if((old($name) && $color['name']==old($name)) || $selected==$color['name']) selected @endif>{{$color['name']}}</option>
    @endforeach

</select>
@error($name)
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror