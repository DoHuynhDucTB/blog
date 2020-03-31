@if(count($itemCategory) > 0)
    @foreach($itemCategory as $key => $itemCat)
        @if($itemCat['display'] == 'list')
            @include('news.elements.cat-display-list')
        @endif
        @if($itemCat['display'] == 'grid')
            @include('news.elements.cat-display-grid')
        @endif
    @endforeach
@endif
