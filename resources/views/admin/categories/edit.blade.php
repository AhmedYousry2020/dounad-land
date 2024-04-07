@extends('layouts.layoutMaster')

@php
$breadcrumbs = [[['link' => 'javascript:void(0)', 'name' => __('catrgory.Categories')], [ 'name' =>__('category.All Categories')]],['title' => __('category.Manage Category')]];
@endphp
@section('title', __('category.Manage Category'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('content')


<x-forms.formCard class="col-12" title="{{ __('Category.Add new catrogry') }}">

    {!! Form::open(['route' => 'admin.categories.store','method'=>'POST' , 'onsubmit' => 'showLoader()', 'enctype' =>'multipart/form-data']) !!}

    <x-ui.divider>{{ __('category.Category information') }}</x-ui-divider>

        <div class="row mb-1">
            <x-inputs.text.IconInput  label="{{ __('category.Category Name')}} ({{ config('SystemLanguage.FL.name') }})" :name="'category_name_'. FL" placeholder="category.please enter category Name" />

            <x-inputs.text.IconInput  label="{{ __('category.Category Name')}} ({{ config('SystemLanguage.SL.name') }})" :name="'category_name_'. SL" placeholder="category.please enter category Name" />
        </div>

        <div class="row mb-1">
            <x-inputs.text.IconInput  label="{{ __('category.categoryDescription')}} ({{ config('SystemLanguage.FL.name') }})" :name="'category_description_' . FL" placeholder="category.please enter category_description" />

            <x-inputs.text.IconInput  label="{{ __('category.categoryDescription')}} ({{ config('SystemLanguage.SL.name') }})" :name="'category_description_' . SL" placeholder="category.please enter category_description" />
        </div>

        <div class="row">
            <div class="col-6 mt-1">
                <label class="form-label mr-1" for="is_active">{{__('general.Status')}}</label>
                <x-inputs.checkbox.checkbox name="is_active">general.is Active</x-inputs.checkbox.checkbox>
            </div>
        </div>


        <div class="col-12 text-center mt-4">
            <x-inputs.btn.submit>{{__('category.Add category')}}</x-inputs.btn.submit>
            <x-inputs.a.link route="admin.categories.index">{{__('general.back')}}</x-inputs.a.link>
        </div>

        {!! Form::close() !!}

</x-forms.formCard>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script>
    $(".select2").select2({
        tags: true,
    });
</script>
@endsection
