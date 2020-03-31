    @php
        use App\Helpers\Template;
        $showButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status']);
        $showAreaSearch = Template::showAreaSearch($controllerName, $params['search']);
    @endphp

    @extends('admin.main')

    @section('content')
        @include('admin.elements.page_header', ['pageIndex' => true])
        @include('admin.elements.zvn_notify')

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.elements.x_title', ['title' => 'Bộ lọc'])
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">
                                {!! $showButtonFilter !!}
                            </div>
                            <div class="col-md-6">
                                {!! $showAreaSearch !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--box-lists-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.elements.x_title', ['title' => 'Danh sách']);
                    @include('admin.category.list')
                </div>
            </div>
        </div>
        <!--end-box-lists-->
        <!--box-pagination-->
        @if (count($items) > 0)
            @include('admin.elements.pagination');
        @endif
        <!--end-box-pagination-->
    @endsection
