@props(['route'])
<a {{$attributes}} class="dropdown-item text-success" href="{{ $route ?? 'javascript:void(0);' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="مشاهدة">
    <i class="fa-regular fa-eye me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>