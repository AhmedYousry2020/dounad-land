@props(['route','params' => []])
<section id="collapsible">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title"><i class="fa-solid fa-magnifying-glass"></i> {{ $text ?? __('Search') }}</h3>
                    <a class="btn btn-sm btn-icon btn-outline-primary round waves-effect" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="collapse {{ request()->except('page') ? 'show' : NULL }}" id="collapseExample">
                        {!! Form::open(['route' => [$route,$params] ,'method'=>'GET' , 'onsubmit' => 'showLoader(5000)']) !!}
                        {{ $slot }}
                        <div class="col-12 text-center mt-2">
                            @if(request()->except('page'))
                            <x-inputs.a.link :route="$route" :params="$params">{{__('Clear Result')}}</x-inputs.a.link>
                            @endif
                            <x-inputs.btn.submit value="search" >{{__('Search')}}</x-inputs.btn.submit>
                            {{ $export ?? null }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>