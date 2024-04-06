@props(['route'])
<button {{$attributes}} class="btn btn-icon round btn-sm btn-outline-danger" data-bs-toggle="offcanvas" data-bs-target="#deleteModal" aria-controls="deleteRecord" data-bs-placement="right" @if(isset($route)) data-href="{{ $route }}" @endif title="{{__('Delete')}}">
    <i class="fa-regular fa-trash-can me-50"></i>
    <span>{{ $slot ?? null }}</span>
</button>