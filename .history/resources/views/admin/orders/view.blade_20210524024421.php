@extends('layouts.app')
@section('title')
    {{__('orders.titles.show')}}
@endsection
@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3> {{__('orders.titles.index')}} </h3>
            @include('admin.partials.breadcrumb',[
                'parent' => [
                    'name' => __('orders.titles.show'),
                ]
            ])
        </div>
        <div class="mt-2 mt-md-0">
            <a href="#" class="btn btn-primary" id="printOrder">{{__('orders.titles.print')}}</a>
        </div>
    </div>
    <div class="row col-md-6" id="check-printing" style="background-color: #fff;color:#000;">
        <div>
            <h5>مطعم سين</h5>
            <h6>الهاتف : 0213546645</h6>
            <h6> رقم الفاتورة : {{$order->id}}</h6>
            <h6>  نوع الطلب : {{$order->typee}}</h6>
            @if ($order->type == 0)
                <h6>  رقم الطاولة : {{$order->table_id}}</h6>
            @endif
            @if ($order->type == 1)
                <h6>  رقم الهاتف : {{$order->client_phone}}</h6>
                <h6>  الشارع : {{$order->client_zone}}</h6>
                <h6>  اسم العميل : {{$order->client->name}}</h6>
            @endif
            <h6> التاريخ : {{date("Y/m/d")}} - {{date("h:i:s a")}}</h6>
        </div>
        <table id="user-list" class="table table-lg">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('orders.view.product')}}</th>
                    <th>{{__('orders.view.quantity')}}</th>
                    <th>{{__('orders.view.price')}}</th>
                    <th>{{__('orders.view.total_product')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $key=>$product)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->price * $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h6>  خدمات اضافية : {{0}} {{__('app.settings.currency')}}</h6>
            <h5> اجمالي الفاتورة : {{$order->total_price}} {{__('app.settings.currency')}}</h5>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // print reset
        $('#printOrder').on('click',function()
        {
            var node = document.getElementById('check-printing');
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    console.log(dataUrl);
                    //document.body.appendChild(img);
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                });
            /**/
            // save
            /* domtoimage.toJpeg(document.getElementById('check-printing'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();
            }); */
        });
    </script>
@endsection
