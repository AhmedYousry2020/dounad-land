@props(['route'])
<a {{$attributes}}  class="btn btn-icon round btn-sm btn-outline-info" href="{{ $route }}" data-bs-toggle="tooltip" data-bs-placement="right" title="{{__('addresses')}}">
    <em data-feather="info"></em>
    <span>{{ $slot ?? null }}</span>
</a>
