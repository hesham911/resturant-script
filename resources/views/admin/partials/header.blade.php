<div class="header-container">
    <div class="header-left">
        <div class="navigation-toggler">
            <a href="#" data-action="navigation-toggler">
                <i data-feather="menu"></i>
            </a>
        </div>

        <div class="header-logo">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo">
            </a>
        </div>
    </div>
    <div class="header-body">
        <div class="header-body-left">
            <ul class="navbar-nav">
                @if (request()->is('dashbord/orders/create'))
                    <li class="nav-item dropdown d-none d-md-block">
                        <a href="{{url('/dashbord')}}" class="nav-link">
                            <i class="fa fa-dashcube" aria-hidden="true"></i>
                            لوحة التحكم
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown d-none d-md-block">
                        <a href="{{route('start.work.view')}}" role="button"
                           class="nav-link btn btn-secondary">
                            POS   <i data-feather="shopping-cart"></i>
                        </a>
                    </li>
                @endif
                @if (\Illuminate\Support\Facades\Auth::user()->userLog() == true)
                    <li class="nav-item dropdown d-none d-md-block">
                        <a href="{{route('end.work.view',['workperiod'=>\App\WorkPeriod::GetIdFromUser(Auth::id())->first()->id])}}" role="button"
                           class="nav-link btn btn-secondary">
                            إنهاء الشفت
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="header-body-right">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                        <i data-feather="search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown d-none d-md-block">
                    <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                        <i class="maximize" data-feather="maximize"></i>
                        <i class="minimize" data-feather="minimize"></i>
                    </a>
                </li>

                 <li class="nav-item dropdown">
                    <a href="#" class="nav-link {{auth()->user()->unreadNotifications->count() > 0 ? '}nav-link-notify': ''}}" title="Notifications" data-toggle="dropdown">
                        <i data-feather="bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div
                            class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">التنبيهات</h5>
                            <small class="opacity-7">التنبيهات الغير مقرؤة <span>{{auth()->user()->unreadNotifications->count()}}</span></small>
                        </div>
                        <div class="dropdown-scroll">
                            <ul class="list-group list-group-flush">
                                <li class="px-4 py-2 text-center small text-muted bg-light">إشعارات إنتهاء الصلاحية</li>
                                {{--start loop notif--}}
                                @if(auth()->user()->unreadNotifications->count() > 0 )
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                <span
                                                        class="avatar-title bg-info-bright text-info rounded-circle">
                                                    <i class="ti-lock"></i>
                                                </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        <span>اسم المنتج</span> <span>{{$notification->data->name}}</span>
                                                        <i title="Mark as read" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-circle-o font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small"><span>تاريخ إنتهاء الصلاحية</span> <span>{{$notification->data->expiry_date}}</span></span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                {{-- end loop notif--}}
                                {{--<li class="px-4 py-2 text-center small text-muted bg-light">إشعار بقاربة علي النفاذ</li>--}}
                                {{--start loop notif--}}
                                {{--<li class="px-4 py-3 list-group-item">--}}
                                    {{--<a href="#" class="d-flex align-items-center hide-show-toggler">--}}
                                        {{--<div class="flex-shrink-0">--}}
                                            {{--<figure class="avatar mr-3">--}}
                                                {{--<span class="avatar-title bg-secondary-bright text-secondary rounded-circle">--}}
                                                    {{--<i class="ti-file"></i>--}}
                                                {{--</span>--}}
                                            {{--</figure>--}}
                                        {{--</div>--}}
                                        {{--<div class="flex-grow-1">--}}
                                            {{--<p class="mb-0 line-height-20 d-flex justify-content-between">--}}
                                                {{--1 person sent a file--}}
                                                {{--<i title="Mark as unread" data-toggle="tooltip"--}}
                                                {{--class="hide-show-toggler-item fa fa-check font-size-11"></i>--}}
                                            {{--</p>--}}
                                            {{--<span class="text-muted small">Yesterday</span>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{-- end loop notif--}}
                            </ul>
                        </div>
                        <div class="px-4 py-3 text-right border-top">
                            <ul class="list-inline small">
                                <li class="list-inline-item mb-0">
                                    <a href="#">عرض كل التنبيهات</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

               {{--<li class="nav-item dropdown">--}}
                    {{--<a href="#" class="nav-link" title="Settings" data-sidebar-target="#settings">--}}
                        {{--<i data-feather="settings"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                        <span class="ml-2 d-sm-inline d-none">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        {{-- <div class="text-center py-4">
                            <figure class="avatar avatar-lg mb-3 border-0">
                                <img src="{{ url('assets/media/image/user/man_avatar3.jpg') }}"
                                    class="rounded-circle" alt="image">
                            </figure>
                            <h5 class="text-center">Bony Gidden</h5>
                            <div class="mb-3 small text-center text-muted">@bonygidden</div>
                            <a href="#" class="btn btn-outline-light btn-rounded">Manage Your Account</a>
                        </div> --}}
                        <div class="list-group">
                            {{-- <a href="{{ route('profile') }}" class="list-group-item">View Profile</a> --}}
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="list-group-item text-danger">{{ __('app.logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        {{-- <div class="p-4">
                            <div class="mb-4">
                                <h6 class="d-flex justify-content-between">
                                    Storage
                                    <span>%25</span>
                                </h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 40%;"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <hr class="mb-3">
                            <p class="small mb-0">
                                <a href="#">Privacy policy</a>
                            </p>
                        </div> --}}
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item header-toggler">
            <a href="#" class="nav-link">
                <i data-feather="arrow-down"></i>
            </a>
        </li>
    </ul>
</div>
