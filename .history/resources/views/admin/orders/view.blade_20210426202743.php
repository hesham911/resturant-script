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
            <a href="#" class="btn btn-primary">{{__('orders.titles.create')}}</a>
        </div>
    </div>
    <div class="row">
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
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        // print reset
        /* var node = document.getElementById('formModalPost');
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    console.log(dataUrl);
                    //document.body.appendChild(img);
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                }); */
            /**/
            /* domtoimage.toJpeg(document.getElementById('user-list'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();
            }); */
    </script>
@endsection
