@props(['child_category','shift', 'selected' => 0, 'ignore' => 0])
<option @if($selected == $child_category['id']) selected @elseif($ignore == $child_category['id']) disabled @endif  value="{{ $child_category['id'] }}">{{ sprintf('%s %s', $child_category['category_name_'. getLocale()], $shift ) }}</option>

@if (isset($child_category['childCategory']))
@foreach ($child_category['childCategory'] as $subCategory)
<x-inputs.select.subcategoryInput :child_category="$subCategory" :shift="$shift .= '--'" :ignore="$ignore"/>
@endforeach
@endif