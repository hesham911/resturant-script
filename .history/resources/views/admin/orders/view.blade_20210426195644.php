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
        <div class="col-md-12">
            <div class="card">
                    <div class="table-responsive">
                        <table id="user-list" class="table table-lg">
                            <thead>
                                <tr>
                                    <th>{{__('app.tables.num')}}</th>
                                    <th>{{__('orders.client_id')}}</th>
                                    <th>{{__('orders.subcategory_id')}}</th>
                                    <th>{{__('orders.table_id')}}</th>
                                    <th>{{__('orders.order_type')}}</th>
                                    <th>{{__('orders.order_status')}}</th>
                                    <th>{{__('orders.total_price')}}</th>
                                    <th class="text-right">{{__('app.tables.control')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count() > 0)
                                    @foreach($orders as $order )
                                        
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
