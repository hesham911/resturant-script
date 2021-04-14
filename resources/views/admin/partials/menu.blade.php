<ul>
    <li>
        <a @if(!request()->segment(1)) class="active" @endif href="{{ route('dashboard') }}">
            <span class="nav-link-icon">
                <i data-feather="pie-chart"></i>
            </span>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a @if(request()->segment(1) == 'orders') class="active"
           @endif href="{{ route('orders') }}">
            <span class="nav-link-icon">
                <i data-feather="shopping-cart"></i>
            </span>
            <span>Orders</span>
            <span class="badge badge-danger">2</span>
        </a>
    </li>
    <li>
        <a @if(request()->segment(1) == 'users') class="active"
           @endif href="{{ route('users') }}">
            <span class="nav-link-icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </span>
            <span>Clients</span>
        </a>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i data-feather="copy"></i>
            </span>
            <span>Pages</span>
        </a>
        <ul>
            {{-- <li>
                <a @if(request()->segment(1) == 'settings') class="active"
                   @endif href="{{ route('settings') }}">Settings</a>
            </li> --}}
            <li>
                <a @if(request()->segment(1) == 'blank-page') class="active"
                   @endif href="{{ route('blank-page') }}">Blank Page</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-map-marker fa-2x"></i>
            </span>
            <span>المناطق</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('zones'))? 'active' : '' }}" href="{{ route('zones') }}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('zones/create'))? 'active' : '' }}" href="{{ route('zones.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> الأقسام</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('categories'))? 'active' : '' }}" href="{{route('categories.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('categories/create'))? 'active' : '' }}" href="{{ route('categories.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
</ul>
