@props(['autoWith' => true, 'tableClass' => 'table table-hover'])

<div class="row {{ $autoWith ? 'td-auto-with' : null }}" id="table-striped">
    @isset($categories_tree)
    <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{__("Categories.categories")}}</h4>
          </div>
          <div class="card-body">
            <div id="jstree-basic">
                {{ $categories_tree ?? null  }}
            </div>
          </div>
        </div>
    </div>
    @endisset
    <div class="@isset($categories_tree)) col-8 @endisset">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title text-primary mt-50">
          {{ $title ?? null  }}
        </h3>
        {{ $button ?? null }}

      </div>
      @if(isset($cardbody))
      <div class="card-body">
        <p class="card-text text-dark mb-2">
          {{$cardbody}}
        </p>
      </div>
      @endif
      <div class="table-responsive">
        <table class="{{$tableClass}}">
          <thead class="table-light">
            {!! $thead ?? null !!}
          </thead>
          <tbody class="table-body">
            {!! $tbody ?? null !!}
          </tbody>
        </table>

      </div>
      <div class="d-flex align-self-center mx-0 row m-2 ">
        <div class="col-md-12">

          {!! $pagination ?? null !!}
        </div>
      </div>
    </div>
  </div>
</div>
