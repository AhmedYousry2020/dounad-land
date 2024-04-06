@props(['route','colorClass'])
<a {{$attributes}} class="dropdown-item text-{{ $colorClass ?? 'primary' }}" href="{{ $route ?? 'javascript:void(0);' }}">
    <i class="{{$icon ?? 'fa-regular fa-list'}} me-50"></i>
    <span>{{ $slot ?? null }}</span>
</a>