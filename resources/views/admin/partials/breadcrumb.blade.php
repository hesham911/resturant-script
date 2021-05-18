<nav aria-label="breadcrumb" class="d-flex align-items-start">
    <ol class="breadcrumb">
        <!-- settings::first()->name -->
        <li class="breadcrumb-item"><a href="{{url('/dashbord')}}">الرئيسية</a></li>
        @if(isset($upParent))
            {{-- <li class="breadcrumb-item"><a href="{{url('/'.$upParent['url'])}}">{{$upParent['name']}}</a></li> --}}
            <li class="breadcrumb-item"><a href="{{route($upParent['url'])}}">{{$upParent['name']}}</a></li>
        @endif
        @if(isset($parent))
            <li class="breadcrumb-item active" aria-current="page">{{$parent['name']}}</li>
            {{-- <li class="breadcrumb-item"><a href="{{url('/'.$parent['url'])}}">{{$parent['name']}}</a></li> --}}
        @endif
        {{--<li class="breadcrumb-item active" aria-current="page">{{$name}}</li>--}}
    </ol>
    {{-- @if(isset($name))
        <h3>{{$name}}</h3>
    @endif --}}
</nav>
