@php
    use App\Helpers\Template;
@endphp

<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết gần đây</div>
    <div class="latest_posts">
        <!-- Latest Post -->
        @if(count($items) > 0)
            @foreach ($items as $item)
                @php
                    $name = $item['name'];
                    $thumb = asset('images/article/' . $item['thumb']);
                    $linkCategory = route('category/news', ['categoryId' => $item['category_id']]);
                    $linkArticle = route('article/news', ['articleId' => $item['id']]);
                    $created = Template::showDateTimeWeb($item['created']);
                    $content = Template::showContentSmall($item['content'], 500);
                @endphp
                <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                    <div>
                        <div class="latest_post_image"><img src="{{ $thumb }}" alt="{{ $name }}">
                        </div>
                    </div>
                    <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a href="{{ $linkCategory }}">Category</a></div>
                        <div class="latest_post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
                    <div class="latest_post_date">{!! $created !!}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>