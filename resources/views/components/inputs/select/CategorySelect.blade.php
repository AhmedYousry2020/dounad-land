@props(['options'=> [],'selected' => 0, 'ignore' => 0])
<div class="col-md mb-1">
    {!! $label() !!}
    <select {!! $attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : null), 'name' => $name,'required' => true, 'id' => $id ?? $name]) !!} >
        <option value="0">{{ __('category.Main Category') }}</option>
        @foreach ($options as $category)
        <option @if($selected==$category['id']) selected @elseif($ignore==$category['id']) disabled @endif value="{{ $category['id'] }}">{{ $category['category_name_'. getLocale()] }}</option>
        @if (isset($category['childCategory']))
        @foreach ($category['childCategory'] as $childCategory)
        <x-inputs.select.subcategoryInput :child_category="$childCategory" shift="--" :selected="$selected" :ignore="$ignore" />
        @endforeach
        @endif
        @endforeach
    </select>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>