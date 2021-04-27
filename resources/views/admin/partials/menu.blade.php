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
                <i class="fa fa-address-book-o" aria-hidden="true"></i>
            </span>
            <span>البحث في العملاء</span>
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
                <i class="fa fa-map-marker fa-2x" ></i>
            </span>
            <span> المناطق</span>
        </a>
        <ul>
            <li>
                <a class="{{(request()->is('dashbord/zones'))? 'active' : '' }}" href="{{route('zones.index')}}">عرض كل</a>
            </li>
            <li>
                <a class="{{(request()->is('dashbord/zones/create'))? 'active' : '' }}" href="{{ route('zones.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <span class="nav-link-icon">
                <i class="fa fa-users"></i>
            </span>
            <span>التحكم المستخدمين</span>
        </a>
        <ul>
            <li>
                <a href="#">العملاء</a>
                <ul>
                    <li>
                        <a class="{{(request()->is('dashbord/clients'))? 'active' : '' }}" href="{{route('clients.index')}}">عرض الكل</a>
                    </li>
                    <li>
                        <a class="{{(request()->is('dashbord/clients/create'))? 'active' : '' }}" href="{{route('clients.create')}}">إضافة  جديدة</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">الموظفين</a>
                <ul>
                    <li>
                        <a class="{{(request()->is('dashbord/employees'))? 'active' : '' }}" href="{{route('employees.index')}}">عرض الكل</a>
                    </li>
                    <li>
                        <a class="{{(request()->is('dashbord/employees/create'))? 'active' : '' }}" href="{{route('employees.create')}}">إضافة  جديدة</a>
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
                <a class="{{(request()->is('dashbord/categories'))? 'active' : '' }}" href="{{route('categories.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('dashbord/categories/create'))? 'active' : '' }}" href="{{ route('categories.create') }}">إضافة جديد</a>
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
                <a class="{{(request()->is('dashbord/subcategories'))? 'active' : '' }}" href="{{route('subcategories.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('dashbord/subcategories/create'))? 'active' : '' }}" href="{{ route('subcategories.create') }}">إضافة جديد</a>
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
                <a class="{{(request()->is('dashbord/settings'))? 'active' : '' }}" href="{{route('settings.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('dashbord/settings/create'))? 'active' : '' }}" href="{{ route('settings.create') }}">إضافة جديد</a>
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
                <a class="{{(request()->is('dashbord/materials'))? 'active' : '' }}" href="{{route('materials.index')}}">عرض الكل</a>
            </li>
            <li>
                <a class="{{(request()->is('dashbord/materials/create'))? 'active' : '' }}" href="{{ route('materials.create') }}">إضافة جديد</a>
            </li>
        </ul>
    </li>
</ul>
