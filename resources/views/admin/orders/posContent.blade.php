@foreach ($products as $product)
    <div class="col-md-3 col-xs-12">
        <a href="#" class="product_adding" data-id="{{$product->id}}"
            data-name="{{$product->name}}" data-price="{{$product->price}}">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="text-center">{{$product->name}}</h5>
                        <p>
                            {{$product->price}} جنيه
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach

