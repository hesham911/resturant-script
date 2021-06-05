@foreach ($products as $product)
    <div class="col-md-2 col-xs-6">
        <a href="#" class="product_adding" data-id="{{$product->id}}"
            data-name="{{$product->name}}" data-price="{{$product->price}}">
            <div class="card">
                <h5 class="text-center mt-1">{{$product->name}}</h5>
                    <p class="text-center">
                        {{$product->price}} جنيه
                    </p>
            </div>
        </a>
    </div>
@endforeach

