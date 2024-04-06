@props(['route'])
<a {{ $attributes }} class="dropdown-item text-primary" href="{{ $route ?? 'javascript:void(0)' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="تعديل">
    <i class="fa-regular fa-pen-to-square me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>