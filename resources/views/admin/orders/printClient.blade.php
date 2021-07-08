<!DOCTYPE html>
<html>
    <head lang="ar">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Print</title>
        <!-- print -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
        <!-- print -->
        <style>
            body {
                direction: rtl;
                font-family: Tahoma;
                font-size: 14px;
                background-color: #fff;
            }
            #check-printing
            {
                width: 75%;
                background-color: #fff;
            }
            p {
                margin-top: 5px;
                margin-bottom: 5px;
            }
            h4{
                font-weight: lighter;
            }
            .footer-fixed {
                right: 0;
                left: 0;
                bottom: 0;
                width: 100%;
                position: fixed;
                z-index: 1000;
                background-color: #e9e9e9;
                border-color: #ddd;
                color: #333;
                text-shadow: 0 1px 0 #eee;
                font-weight: 700;
                padding-bottom: 1px;
                border-width: 1px 0;
                border-style: solid;
            }
            .btn-back {
                background-color: #f6f6f6;
                border-color: #ddd;
                color: #333;
                text-shadow: 0 1px 0 #f3f3f3;
                z-index: 1500;
                font-size: 12.5px;
                display: inline-block;
                vertical-align: middle;
                border-radius: .3125em;
                font-weight: 700;
                line-height: 1.3;
                margin: .446em;
                text-align: center;
                cursor: pointer;
                overflow: hidden;
                padding: .7em 1em;
                user-select: none;
                border-width: 1px;
                border-style: solid;
            }
            @media print {
                @page { margin: 0; }
                body { margin: 0.5cm; }
                .no-print, .no-print *
                {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body onload="window.print()"> {{-- onload="window.print()" --}}
        <div id="check-printing">
            <img src="{{asset('assets/media/image/dark-logo.png')}}" style="margin: 2% 28%;"/>
            <h4 style="margin: 2%;">
                <span> رقم الفاتورة : {{$order->id}}</span><br>
                <span>  نوع الطلب : {{$order->typee}}</span><br>
                @if ($order->type == 0)
                    <span>  رقم الطاولة : {{$order->table_id}}</span><br>
                @endif
                @if ($order->type == 1)
                    <span>  اسم العميل : {{$order->client->user->name}}</span><br>
                    <span>  رقم الهاتف : 0{{$order->delivery_phone}}</span><br>
                    <span>  الشارع : {{$order->full_address}}</span><br>
                @endif
                <span> التاريخ : {{date("Y/m/d")}} - {{date("h:i:s a")}}</span><br>
            </h4>
            <h4 style="margin-right: 2%;text-align: center;">
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
                                <td>{{ $key+1}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->price * $product->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </h4>
            <hr style="width: 240px;margin-left: 90%;border: 1px solid #979797;margin:3px;margin-top: 25px">
            <h4 style="margin-right: 2%;">

                {{--<span>  خدمات اضافية : {{0}} {{__('app.settings.currency')}}</span><br>--}}
                @if ($order->type == 1)
                    <span>   سعر الديلفيري : {{$order->delivery_price}} {{__('app.settings.currency')}}</span><br>
                @endif
            </h4>
            <h4 style="font-weight: bold;margin-right: 2%;"> اجمالي الفاتورة : {{$order->total_price}} {{__('app.settings.currency')}}</h4>
            <br>
        </div>
        <div class="footer-fixed no-print">
            <a class="btn-back no-print" onclick="window.history.back();">رجـــوع</a>
        </div>
    </body>
    <script>
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
    </script>
</html>
