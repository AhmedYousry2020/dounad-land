@props(['route'])
<a {{$attributes}} class="btn btn-icon round btn-sm btn-outline-success" href="{{ $route }}" data-bs-toggle="tooltip" data-bs-placement="right" title="{{__('View')}}">
    <i class="fa-regular fa-eye me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>