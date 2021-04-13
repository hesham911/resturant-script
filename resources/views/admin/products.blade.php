@extends('layouts.app')

@section('head')
    <!-- Range slider -->
    <link rel="stylesheet" href="{{ url('vendors/range-slider/css/ion.rangeSlider.min.css') }}" type="text/css">
@endsection

@section('content')

    <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Products</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">E-commerce</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
        <div class="mt-2 mt-md-0">
            <a href="#" class="btn btn-outline-primary" title="List"
               data-toggle="tooltip">
                <i class="fa fa-th-list"></i>
            </a>
            <a href="#" class="btn btn-outline-primary active ml-2" title="Grid"
               data-toggle="tooltip">
                <i class="fa fa-th-large"></i>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Filter Products</h6>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Keywords">
                                </div>
                                <p class="text-muted">Brands</p>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                        <label class="custom-control-label" for="customCheck1">Iphone</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Samsung</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3" checked>
                                        <label class="custom-control-label" for="customCheck3">Huawei</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4">General Mobile</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                                        <label class="custom-control-label" for="customCheck5">Xiaomi</label>
                                    </div>
                                </div>
                                <hr>
                                <p class="text-muted">Price</p>
                                <div class="form-group">
                                    <input type="text" id="rangeSlider-example">
                                </div>
                                <p class="text-muted">Rate</p>
                                <div class="list-inline mb-2">
                                    <a href="#">
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">(100)</div>
                                    </a>
                                </div>
                                <div class="list-inline mb-2">
                                    <a href="#">
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">(78)</div>
                                    </a>
                                </div>
                                <div class="list-inline mb-2">
                                    <a href="#">
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">(55)</div>
                                    </a>
                                </div>
                                <div class="list-inline mb-2">
                                    <a href="#">
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">(25)</div>
                                    </a>
                                </div>
                                <div class="list-inline mb-2">
                                    <a href="#">
                                        <div class="list-inline-item">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="list-inline-item">(17)</div>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart text-danger mr-2"></i>
                                            213
                                        </div>
                                        <span class="badge bg-warning-bright text-warning">%30 Off</span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Vase">
                                            <img src="{{ url('assets/media/image/products/product1.png') }}"
                                                 class="img-fluid rounded" alt="Vase">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Vase</h4>
                                        </a>
                                        <p>
                                            <del class="text-muted mr-1">$6.200</del>
                                            <span class="text-truncate">$5.190,90</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(47)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary add-to-card">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart-o mr-2"></i>
                                            57
                                        </div>
                                        <span class="badge bg-danger-bright text-danger">Out of Stock</span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Glasses">
                                            <img src="{{ url('assets/media/image/products/product2.png') }}"
                                                 class="img-fluid rounded" alt="Glasses">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Glasses</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$2.400,00</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(16)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary disabled">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart text-danger mr-2"></i>
                                            80
                                        </div>
                                        <span class="badge bg-success-bright text-success" title="New Product" data-toggle="tooltip">
                                            <i class="ti-star"></i>
                                        </span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Plate">
                                            <img src="{{ url('assets/media/image/products/product3.png') }}"
                                                 class="img-fluid rounded" alt="Plate">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Plate</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$180,90</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(23)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary add-to-card">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart-o mr-2"></i>
                                            57
                                        </div>
                                        <!-- <span class="badge badge-danger">Out of Stock</span> -->
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Armchair">
                                            <img src="{{ url('assets/media/image/products/product5.png') }}"
                                                 class="img-fluid rounded" alt="Armchair">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Armchair</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$2.400,00</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(16)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart text-danger mr-2"></i>
                                            80
                                        </div>
                                        <span class="badge bg-success-bright text-success" title="New Product" data-toggle="tooltip">
                                            <i class="ti-star"></i>
                                        </span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Flowerpot">
                                            <img src="{{ url('assets/media/image/products/product6.png') }}"
                                                 class="img-fluid rounded" alt="Flowerpot">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Flowerpot</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$180,90</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(23)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary add-to-card">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart text-danger mr-2"></i>
                                            213
                                        </div>
                                        <span class="badge bg-warning-bright text-warning">%30 Off</span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Wall Clock">
                                            <img src="{{ url('assets/media/image/products/product7.png') }}"
                                                 class="img-fluid rounded" alt="Wall Clock">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Wall Clock</h4>
                                        </a>
                                        <p>
                                            <del class="text-muted mr-1">$6.200</del>
                                            <span class="text-truncate">$5.190,90</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(47)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary add-to-card">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart-o mr-2"></i>
                                            57
                                        </div>
                                        <span class="badge bg-danger-bright text-danger">Out of Stock</span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Desk">
                                            <img src="{{ url('assets/media/image/products/product8.png') }}"
                                                 class="img-fluid rounded" alt="Desk">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Desk</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$2.400,00</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(16)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary disabled">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-heart text-danger mr-2"></i>
                                            80
                                        </div>
                                        <span class="badge bg-success-bright text-success" title="New Product" data-toggle="tooltip">
                                            <i class="ti-star"></i>
                                        </span>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" title="Night Light">
                                            <img src="{{ url('assets/media/image/products/product9.png') }}"
                                                 class="img-fluid rounded" alt="Night Light">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">
                                            <h4>Night Light</h4>
                                        </a>
                                        <p>
                                            <!-- <del class="text-muted mr-1">$24,95</del> -->
                                            <span class="text-truncate">$180,90</span>
                                        </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-half-o text-warning"></i>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fa fa-star-o"></i>
                                            </li>
                                            <li class="list-inline-item">(23)</li>
                                        </ul>
                                        <div class="mt-2">
                                            <button class="btn btn-primary add-to-card">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="..." class="mb-4">
                        <ul class="pagination pagination-rounded justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <!-- Range slider -->
    <script src="{{ url('vendors/range-slider/js/ion.rangeSlider.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/product-list.js') }}"></script>
@endsection
