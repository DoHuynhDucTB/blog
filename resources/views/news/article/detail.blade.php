@php
    use App\Helpers\Template;
    use App\Models\Category;
    $catagoryModel = new Category;
    $listCategory = $catagoryModel->listItems(null, ['task' => "news-list-items"]);
    $xhtmlMenu = '';
    $xhtmlMenuMobile = '';
    $createdArticle = Template::showDateTimeWeb($itemArticle['created']);

    if (count($listCategory) > 0){
        $liHome = sprintf('<li><a href="%s">%s</a></li>', route('home'), 'Home');
        $xhtmlMenu = '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">' . $liHome;
        $xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">' . $liHome;

        foreach ($listCategory as $key => $itemCate){   
            $linkCat = route('category/news', ['categoryId' => $itemCate['id']]);
            $nameCate = $itemCate['name'];
            $xhtmlMenu .= sprintf('<li><a href="%s">%s</a></li>', $linkCat, $nameCate);
            $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">%s</a></li>', $linkCat, $nameCate);
        }

        $xhtmlMenu .= '</ul></nav>';
        $xhtmlMenuMobile .= '</ul></nav>';
    }
@endphp

@extends('news.main')
@section('content')
<body>
    <div class="super_container">
        <!-- Header -->
        <header class="header">
            <!-- Header Content -->
            <div class="header_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                                <div class="logo_container">
                                    <a href="#">
                                        <div class="logo"><span>ZEND</span>VN</div>
                                    </a>
                                </div>
                                <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                                    <a href="#">
                                        <div class="background_image"
                                             style="background-image:url({{asset('news/images/zendvn-online.png')}});background-size: contain"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Navigation & Search -->
            <div class="header_nav_container" id="header">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                                <!-- Logo -->
                                <div class="logo_container">
                                    <a href="#">
                                        <div class="logo"><span>ZEND</span>VN</div>
                                    </a>
                                </div>
                                <!-- Navigation -->
                                {!!$xhtmlMenu!!}
                                <!-- Hamburger -->
                                <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                                                          aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Menu -->
        <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
            <div class="menu_close_container">
                <div class="menu_close">
                    <div></div>
                    <div></div>
                </div>
            </div>
            {!!$xhtmlMenuMobile!!}
            <div class="menu_subscribe"><a href="#">Subscribe</a></div>
            <div class="menu_extra">
                <div class="menu_social">
                    <ul>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="section-category">
            <div class="home">
                <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('news/images/footer.jpg') }}"
                    data-speed="0.8"></div>
                <div class="home_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_content">
                                <div class="home_title">{{ $itemArticle['name'] }}</div>
                                    <div class="breadcrumbs">
                                        <ul class="d-flex flex-row align-items-start justify-content-start">
                                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                            <li><a href="{{ route('category/news', ['categoryId' => $itemCategory['id']]) }}">{{ $itemCategory['name'] }}</a></li>
                                            <li>{{ $itemArticle['name'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_container container_category">
                <div class="featured_title">
                    <div class="container">
                        <div class="row">
                            <!-- Single Post -->
                            <div class="col-lg-9">
                                <div class="single_post">
                                    <div class="post_image">
                                        <img src="{{ asset('images/article/' . $itemArticle['thumb'])}}"
                                    alt="{{ $itemArticle['thumb'] }}" class="img-fluid w-100">
                                    </div>
                                    <div class="post_content">
                                        <div class="post_category cat_technology ">
                                        <a href="{{ route('category/news', ['categoryId' => $itemCategory['id']]) }}">{{ $itemCategory['name'] }}</a>
                                        </div>
                                        <div class="post_title">
                                            {{ $itemArticle['name'] }}
                                        </div>
                                        <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                            <div class="post_author d-flex flex-row align-items-center justify-content-start">
                                                <div class="post_author_name">
                                                    do huynh duc
                                                </div>
                                            </div>
                                            <div class="post_date">
                                                {!! $createdArticle !!}
                                            </div>
                                        </div>
                                        <div class="post_text">
                                            {!! $itemArticle['content'] !!}
                                        </div>
                                    </div>
                                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start zvn-title-category">
                                        <div>
                                            <div class="section_title">Bài viết liên quan</div>
                                        </div>
                                        <div class="section_bar"></div>
                                    </div>

                                    @if(count($itemCategory['articles']) > 0)
                                        @foreach ($itemCategory['articles'] as $key => $item)
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
                                    @endif

                                </div>
                            </div>
                            <!-- Sidebar -->
                            @include('news.elements.sidebar', ['lastestArticle' => $lastestArticle])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Content -->
@endsection