@props(['route'])
<a {{$attributes}} class="dropdown-item text-danger" data-bs-toggle="offcanvas" data-bs-target="#deleteModal" aria-controls="deleteRecord" data-href="{{ $route }}">
    <i class="fa-regular fa-trash-can me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>