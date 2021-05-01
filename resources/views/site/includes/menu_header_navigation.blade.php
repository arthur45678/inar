@if(isset($item['_children']))

    @if($firstParentElement == true)
        <li class="shrift-normal">

            <a  href="{{ $item['path'] }}"  id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item['title'] }}</a>
            @if($item['status'] == 1)
            <ul class="li-list">
                @foreach($item['_children'] as $item)
                    @include('site.includes.menu_header_navigation', ['firstParentElement' => false])
                @endforeach
            </ul>
             @else
                <ul>
                    @foreach($item['_children'] as $item)
                        @include('site.includes.menu_header_navigation', ['firstParentElement' => false])
                    @endforeach
                </ul>
                @endif
        </li>
    @else
        {{--<li class="shrift-normal">--}}
            {{--<a  href="{{ $item['path'] }}">{{ $item['title'] }}</a>--}}
            {{--<ul >--}}
                {{--@foreach($item['_children'] as $item)--}}
                    {{--@include('site.includes.menu_header_navigation')--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</li>--}}
        <li class="shrift-normal">

            <a  href="{{ $item['path'] }}"  id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item['title'] }}</a>
            @if($item['status'] == 1)
                <ul class="li-list">
                    @foreach($item['_children'] as $item)
                        @include('site.includes.menu_header_navigation', ['firstParentElement' => false])
                    @endforeach
                </ul>
            @else
                <ul>
                    @foreach($item['_children'] as $item)
                        @include('site.includes.menu_header_navigation', ['firstParentElement' => false])
                    @endforeach
                </ul>
            @endif
        </li>
    @endif
@else
    <li class="shrift-normal has-sub">
        <a  href="{{ $item['path'] }}">{{ $item['title'] }}</a>
    </li>
@endif

