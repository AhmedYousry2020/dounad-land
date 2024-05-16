@extends('layouts.layoutMaster')

@php
$breadcrumbs = [[['link' => route('admin.items.index'), 'name' => __('item.Items')]],['title' => __('Item.Manage Item')]];
@endphp
@section('title', __('item.Manage Items'))
@section('content')

<x-ui.table tableClass="collaptable table table-striped table-hover">

    <x-slot name="title">{{ __('item.Manage Items') }}</x-slot>
    <x-slot name="cardbody">{!! sprintf(' %s<span class="text-danger">(%s) </span> - %s', __('category.This page allow you to manage system items') ,count($items) , __('item.Maing Item')) !!}</span></x-slot>

    <x-slot name="button">
        <a class="btn btn-primary mb-1" href="{{ route('admin.items.create') }}">
            <em data-feather='plus-circle'></em> {{ __('item.Add new item') }}</a>
    </x-slot>

    <x-slot name="thead">
        <tr>
            <th scope="col">#</th>

            <th scope="col">{{ __('item.Image') }}</th>
            <th scope="col">{{ __('item.category') }}</th>
            <th scope="col">{{ __('item.item_name_' . FL) }}</th>
            <th scope="col">{{ __('item.item_name_' . SL) }}</th>
            <th scope="col">{{ __('category.is_active') }}</th>
            <th scope="col">{{ __('category.Action') }}</th>
        </tr>
    </x-slot>

    <x-slot name="tbody">

        @foreach ($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td><img src="{{ URL::asset('public/storage/uploads/itemImages/' . $item->item_image) }}" alt="products" class="img-responsive"></td>
          <td>{{ $item->category->{'category_name_'.FL} }}</td>
          <td>{{ $item->{'item_name_'.FL} }}</td>
          <td>{{ $item->{'item_name_'.SL} }}</td>
          <td>{!! isActive((bool) $item->is_active) !!}</td>
          <td>
            <x-inputs.btn.view :route="route('admin.items.show',$item->id)" />

            <x-inputs.btn.edit :route="route('admin.items.edit',$item->id)" />

            <x-inputs.btn.delete :route="route('admin.items.destroy',$item->id)" />
          </td>
        </tr>
        @endforeach
        </tbody>
    </x-slot>

</x-ui.table>
<x-ui.SideDeletePopUp />

@endsection

