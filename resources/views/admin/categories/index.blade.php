@extends('layouts.layoutMaster')

@php
$breadcrumbs = [[['link' => route('admin.categories.index'), 'name' => __('category.Categories')]],['title' => __('Category.Manage Category')]];
@endphp
@section('title', __('category.Manage Categories'))
@section('content')

<x-ui.table tableClass="collaptable table table-striped table-hover">

    <x-slot name="title">{{ __('category.Manage Categories') }}</x-slot>
    <x-slot name="cardbody">{!! sprintf(' %s<span class="text-danger">(%s) </span> - %s', __('category.This page allow you to manage system categories') ,count($categories) , __('category.Maing Category')) !!}</span></x-slot>

    <x-slot name="button">
        <a class="btn btn-primary mb-1" href="{{ route('admin.categories.create') }}">
            <em data-feather='plus-circle'></em> {{ __('category.Add new catrogry') }}</a>
    </x-slot>

    <x-slot name="thead">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('category.category_name_' . FL) }}</th>
            <th scope="col">{{ __('category.category_name_' . SL) }}</th>
            <th scope="col">{{ __('category.is_active') }}</th>
            <th scope="col">{{ __('category.Action') }}</th>
        </tr>
    </x-slot>

    <x-slot name="tbody">

        @foreach ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->{'category_name_'.FL} }}</td>
          <td>{{ $category->{'category_name_'.SL} }}</td>
          <td>{!! isActive((bool) $category->is_active) !!}</td>
          <td>
            <x-inputs.btn.view :route="route('admin.categories.show',$category->id)" />

            <x-inputs.btn.edit :route="route('admin.categories.edit',$category->id)" />

            <x-inputs.btn.delete :route="route('admin.categories.destroy',$category->id)" />
          </td>
        </tr>
        @endforeach
        </tbody>
    </x-slot>

</x-ui.table>
<x-ui.SideDeletePopUp />

@endsection

