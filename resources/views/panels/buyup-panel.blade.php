
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
                    <a class="list-group-item list-group-item-action" href="{{ route('producto.edit', $produc->id) }} ">
                            
                            @if(!isset($produc->image)) <img class="image-prod rounded-circle" src="{{ asset('img/default-150x150.png') }}"> @else <img class="image-prod rounded-circle float-left" src="{{ $produc->image }}" alt="{{ $produc->name }}" /> @endif
                                <small class="badge badge-warning badge-pill float-right">
                                {{$simbol}} {{ $produc->price_out }}
                                </small>
                            
                            <hr>
                            {{ $produc->name }}
                            <span class="text-muted float-right">
                            {{$produc->category->name}}
                        </span>
                    </a>
                @endforeach
                </div>
    </div>
</div>
