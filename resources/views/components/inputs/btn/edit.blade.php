@props(['route'])
<a {{$attributes}} class="btn btn-icon round btn-sm btn-outline-primary" href="{{ $route }}" data-bs-toggle="tooltip" data-bs-placement="right" title="{{__('Edit')}}">
    <i class="fa-regular fa-pen-to-square me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>