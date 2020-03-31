<div class="col-lg-3">
    <div class="sidebar">
        <!-- Latest Posts -->
        @include('news.elements.latestPost', ['items' => $lastestArticle ])
        <!-- Advertisement -->
        <!-- Extra -->
        @include('news.elements.advertisement', ['itemsAdvertisement' => [] ])
        <!-- Most Viewed -->
        @include('news.elements.mostView', ['itemsMostView' => [] ])
        <!-- Tags -->
        @include('news.elements.tag', ['itemsTag' => [] ])
    </div>
</div>