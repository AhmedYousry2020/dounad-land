@props(['method' => 'POST', 'route','title','btnText'])

<x-forms.formCard :title="$title">

    {{ Form::open($attributes->getAttributes() + ['url' => $route,'method'=>$method , 'class' => 'row','onsubmit' => 'return false']) }}

    {{ $slot }}
    <div class="col-12 text-center mt-2">
        <x-inputs.btn.submit >{{ $btnText ?? 'اضافة'}}</x-inputs.btn.submit>
        <x-inputs.a.link route="back">عودة</x-inputs.a.link>
    </div>
    {!! Form::close() !!}

</x-forms.fromCard>