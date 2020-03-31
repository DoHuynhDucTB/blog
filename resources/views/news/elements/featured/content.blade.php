@php
    use App\Helpers\Template;
    $name = $item['name'];
    $thumb = asset('images/article/' . $item['thumb']);
    $linkCategory = route('category/news', ['categoryId' => $item['category_id']]);
    $linkArticle = route('article/news', ['articleId' => $item['id']]);
    $created = Template::showDateTimeWeb($item['created']);
    $content = Template::showContentSmall($item['content'], $length);
@endphp

<div class="post_content">
    @if($showCategory)
        <div class="post_category cat_technology ">
            <a href="{{ $linkCategory }}">Category</a>
        </div>
    @endif
    <div class="post_title"><a
    href="{{ $linkArticle }}">{{ $name }}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div class="post_author_name"><a href="#">do huynh duc</a>
            </div>
        </div>
        {!! $created !!}
    </div>
    @if($length > 0)
    <div class="post_text">
        {!! $content !!}
    </div>
    @endif
</div>