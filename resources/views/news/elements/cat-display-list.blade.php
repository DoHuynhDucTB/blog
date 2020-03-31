@if(count($itemCat['articles']) > 0)
    <div class="technology">
        <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
            <div>
                <div class="section_title">{{$itemCat['name']}}</div>
            </div>
            <div class="section_bar"></div>
        </div>
        <div class="technology_content">
            @foreach ($itemCat['articles'] as $key => $item)
                <div class="post_item post_h_large">
                    <div class="row">
                        <div class="col-lg-5">
                            @include('news.elements.featured.image', ['item' => $item])
                        </div>
                        <div class="col-lg-7">
                            @include('news.elements.featured.content', ['item' => $item, 'length' => 300, 'showCategory' => false])
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="">Xem
                    thêm</a></div>
            </div>
        </div>
    </div>
@endif