@php
    $pageTitle = 'Quản lý ' . $controllerName;

    $link = route($controllerName);
    $icon = 'fa-arrow-circle-left';
    $title = 'Quay về';

    if($pageIndex == true){
        $link = route($controllerName . '/form');
        $icon = 'fa-plus-circle';
        $title = 'Thêm mới';
    }
    $pageButton = sprintf('
        <a href=" %s " class="btn btn-success"><i class="fa %s "></i> %s </a>
    ', $link, $icon, $title);
@endphp

<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
    <h3>{{ $pageTitle }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>
</div>