<div class="featured">
    <div class="featured_title">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="section_title">Nổi bật</div>
                        </div>
                        <div class="section_bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Title -->
    <div class="row">
        <div class="col-lg-8">
            @php
                $itemFirst = $featuredArticle[0];
            @endphp
            <!-- Post -->
            <div class="post_item post_v_large d-flex flex-column align-items-start justify-content-start">
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    @include('news.elements.featured.image', ['item' => $itemFirst])
                    @include('news.elements.featured.content', ['item' => $itemFirst, 'length' => 500, 'showCategory' => true])
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @php
                unset($featuredArticle[0]);
            @endphp
            @if(count($featuredArticle) > 0)
                @foreach ($featuredArticle as $key => $itemFeatured)
                    <div>
                        <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                            @include('news.elements.featured.image', ['item' => $itemFeatured])
                            @include('news.elements.featured.content', ['item' => $itemFeatured, 'length' => 0, 'showCategory' => true])
                        </div>
                    </div>
                @endforeach
            @endif    
        </div>
    </div>
</div>