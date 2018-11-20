
<div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">
        <div class="float-left"> 
            <strong>
                <span class="fa fa-th"></span>
                <span>{{ trans('inventario.newaddproduc') }}</span>
            </strong>
        </div>
    </div>
    <div class="card-body">
            <div class="list-group"> 
                @foreach($product5 as  $produc)
                    <a class="list-group-item list-group-item-action clearfix" href="{{ route('producto.edit', $produc->id) }} ">
                            <div class="list-group-item-heading">
                            @if(!isset($produc->image)) <img class="image-prod rounded-circle" src="{{ asset('img/default-150x150.png') }}"> @else <img class="image-prod rounded-circle" src="{{ $produc->image }}" alt="{{ $produc->name }}" /> @endif
                                {{ $produc->name }}
                                <span class="badge badge-warning badge-pill text-white float-right">
                                {{$simbol}} {{ $produc->price_out }}
                                </span>
                            </div>
                            <span class="list-group-item-text float-right">
                            {{$produc->category->name}}
                        </span>
                    </a>
                @endforeach
                </div>
    </div>
</div>
