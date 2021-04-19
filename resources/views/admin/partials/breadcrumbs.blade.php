<nav aria-label="breadcrumb">

    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="{{url('/')}}">{{settings::first()->name}}</a></li>

        @if(isset($upParent))

        <li class="breadcrumb-item"><a href="{{url('/'.$upParent['url'])}}">{{$upParent['name']}}</a></li>

        @endif

        @if(isset($parent))

            <li class="breadcrumb-item"><a href="{{url('/'.$parent['url'])}}">{{$parent['name']}}</a></li>

        @endif

        {{--<li class="breadcrumb-item active" aria-current="page">{{$name}}</li>--}}

    </ol>

    @if(isset($name))

    <h3>{{$name}}</h3>

    @endif

</nav>