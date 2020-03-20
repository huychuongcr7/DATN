<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-top: 58px; height: 50px">
        @foreach($items as $index => $item)
            <li class="breadcrumb-item {{ $index == count($items) - 1 ? 'active' : '' }}">
                @if(isset($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['text'] }}</a>
                @else
                    {{ $item['text'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>
