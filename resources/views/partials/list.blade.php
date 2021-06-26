<li><a href="/catalog/{{ $itemList['titleID'] }}">{{ $itemList['title'] }}</a></li>
@if (count($itemList['children']) > 0)
    <ul>
        @foreach($itemList['children'] as $itemList)
            @include('partials.list', $itemList)
        @endforeach
    </ul>
@endif
