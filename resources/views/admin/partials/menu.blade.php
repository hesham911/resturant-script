<ul>
    {{-- <li>
        <a @if(!request()->segment(1)) class="active" @endif href="{{ route('dashboard') }}">
            <span class="nav-link-icon">
                <i data-feather="pie-chart"></i>
            </span>
            <span>Dashboard</span>
        </a>
    </li> --}}

    {{-- <li>
        <a href="#">
            <span class="nav-link-icon">
                <i data-feather="shopping-cart"></i>
            </span>
            <span>{{__('orders.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('orders'))? 'active' : '' }}"
                    href="{{ route('orders.index') }}">{{__('app.menu.show_all')}}</a>
            </li>
            <li>
                <a class="{{(request()->is('orders/create'))? 'active' : '' }}"
                    href="{{ route('orders.create') }}">{{__('app.menu.add_new')}}</a>
            </li>
        </ul>
    </li> --}}

    {{-- <li>
        <a @if(request()->segment(1) == 'users') class="active"
           @endif href="{{ route('users') }}">
            <span class="nav-link-icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </span>
            <span>Clients</span>
        </a>
    </li> --}}
    <li>
        {{-- <a href="#">
            <span class="nav-link-icon">
                <i data-feather="copy"></i>
            </span>
            <span>Pages</span>
        </a> --}}
        <ul>
            {{-- <li>
                <a @if(request()->segment(1) == 'settings') class="active"
                   @endif href="{{ route('settings') }}">Settings</a>
            </li> --}}
            {{-- <li>
                <a @if(request()->segment(1) == 'blank-page') class="active"
                   @endif href="{{ route('blank-page') }}">Blank Page</a>
            </li> --}}
        </ul>
    </li> 
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-map-marker fa-2x"></i>
            </span>
            <span>التحكم في المناطق</span>
        </a>
        <ul>
            <li>
                <a href="#">المناطق</a>
                <ul>
                    <li>
                        <a href="{{route('zones.index')}}">كل المناطق</a>
                    </li>
                    <li>
                        <a href="{{route('zones.create')}}">إضافة منطقة جديدة</a>
                    </li>
                </ul>
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
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('subcategories.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('subcategories'))? 'active' : '' }}" href="{{route('subcategories.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('subcategories/create'))? 'active' : '' }}" href="{{ route('subcategories.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('settings.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('settings'))? 'active' : '' }}" href="{{route('settings.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('settings/create'))? 'active' : '' }}" href="{{ route('settings.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('materials.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('materials'))? 'active' : '' }}" href="{{route('materials.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('materials/create'))? 'active' : '' }}" href="{{ route('materials.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('supplies.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('supplies'))? 'active' : '' }}" href="{{route('supplies.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('supplies/create'))? 'active' : '' }}" href="{{ route('supplies.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('stocks.warehousestock')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('warehousestock'))? 'active' : '' }}" href="{{route('warehousestock.index')}}">عرض الكل</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('productmanufactures.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('productmanufactures'))? 'active' : '' }}" href="{{route('productmanufactures.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('productmanufactures/create'))? 'active' : '' }}" href="{{ route('productmanufactures.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-clipboard" ></i>
            </span>
            <span> {{__('kitchenrequests.titles.index')}}</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('kitchenrequests'))? 'active' : '' }}" href="{{route('kitchenrequests.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('kitchenrequests/create'))? 'active' : '' }}" href="{{ route('kitchenrequests.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
</ul>
