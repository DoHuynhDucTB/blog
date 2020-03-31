<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.elements.x_title', ['title' => 'Phân trang']);
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                        <span class="label label-success label-pagination">Tổng số phần tử: {{ $items->total() }}</span>
                        <span class="label label-info label-pagination">Tổng số trang: {{ $items->lastPage() }}</span>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation example">
                            @if ($items->lastPage() > 1)
                                <ul class="pagination zvn-pagination">
                                    <li class="{{ ($items->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a href="{{ $items->url(1) }}">Trước</a>
                                    </li>
                                    @for ($i = 1; $i <= $items->lastPage(); $i++)
                                        <li class="{{ ($items->currentPage() == $i) ? ' active' : '' }}">
                                            <a href="{{ $items->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="{{ ($items->currentPage() == $items->lastPage()) ? ' disabled' : '' }}">
                                        <a href="{{ $items->url($items->currentPage()+1) }}" >Sau</a>
                                    </li>
                                </ul>
                            @endif
                        </nav>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

