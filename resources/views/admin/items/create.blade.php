@extends('layouts.layoutMaster')

@php
$breadcrumbs = [[['link' => 'javascript:void(0)', 'name' => __('item.Categories')], [ 'name' =>__('category.All Categories')]],['title' => __('category.Manage Category')]];
@endphp
@section('title', __('item.Manage Items'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('content')


<x-forms.formCard class="col-12" title="{{ __('Category.Add new item') }}">

    {!! Form::open(['route' => 'dashboard.items.store','method'=>'POST' , 'onsubmit' => 'showLoader()', 'enctype' =>'multipart/form-data']) !!}

    <x-ui.divider>{{ __('item.Item information') }}</x-ui-divider>

        <div class="row mb-1">
            <x-inputs.text.IconInput  label="{{ __('item.Item Name')}} ({{ config('SystemLanguage.FL.name') }})" :name="'item_name_'. FL" placeholder="item.please enter item Name" />

            <x-inputs.text.IconInput  label="{{ __('item.Item Name')}} ({{ config('SystemLanguage.SL.name') }})" :name="'item_name_'. SL" placeholder="item.please enter item Name" />
        </div>

        <div class="row mb-1">
            <x-inputs.text.IconInput  label="{{ __('item.itemDescription')}} ({{ config('SystemLanguage.FL.name') }})" :name="'description_' . FL" placeholder="item.please enter item_description" />

            <x-inputs.text.IconInput  label="{{ __('item.itemDescription')}} ({{ config('SystemLanguage.SL.name') }})" :name="'description_' . SL" placeholder="category.please enter item_description" />
        </div>

        <div class="row mb-1">
          <x-inputs.select.generic name="category_id" class="form-select" id="meta" label="{{__('item.category')}}"  :options='$categories' :required="true"/>

          <x-inputs.text.IconInput  label="{{ __('item.itemSlug')}} " :name="'item_slug'" placeholder="category.please enter item_slug" />
        </div>
        <div class="row mb-1">
          <div class="col-md-12">
              <x-inputs.file.File label="{{ __('Item Image')}}" name="item_image" :placeholder="__('please Select item image')" />
          </div>
      </div>
        <div class="row">
            <div class="col-6 mt-1">
                <label class="form-label mr-1" for="is_active">{{__('general.Status')}}</label>
                <x-inputs.checkbox.checkbox name="is_active">{{__('general.is Active')}}</x-inputs.checkbox.checkbox>
            </div>
        </div>


        <div class="col-12 text-center mt-4">
            <x-inputs.btn.submit>{{__('category.Add Item')}}</x-inputs.btn.submit>
            <x-inputs.a.link route="dashboard.items.index">{{__('general.back')}}</x-inputs.a.link>
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
