@php
    use App\Helpers\Template;
@endphp

<div class="x_content">
    <div class="table-responsive">
       <table class="table table-striped jambo_table bulk_action">
          <thead>
             <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Name</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Hiển thị Home</th>
                <th class="column-title">Kiểu hiển thị</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>   
             </tr>
          </thead>
          <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key => $item)
                    @php
                        $index = $key + 1;
                        $class = ($index %2 == 0) ? "even" : "odd";
                        $id = $item['id'];
                        $name = $item['name'];
                        $status = $item['status'];
                        $created_by = $item['created_by'];
                        $created = $item['created'];
                        $modified_by = $item['modified_by'];
                        $modified = $item['modified'];
                        $createHistory = Template::showItemHistory($item['created_by'], $item['created']);
                        $modifiedHistory = Template::showItemHistory($item['modified_by'], $item['modified']);
                        $showItemStatus = Template::showItemStatus($controllerName, $item['id'], $item['status']);
                        $showCategoryHome = Template::showCategoryHome($controllerName, $item['id'], $item['is_home']);
                        $displayAdminCategory = Template::showItemSelect($controllerName, $item['id'], $item['display'], 'display');
                        $showButtonAction = Template::showButtonAction($controllerName, $id);
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td>
                            {{ $index }}
                        </td>
                        <td>
                        <p><strong>Name:</strong> {{ $name }} </p>
                        </td>
                        <td>
                            {!! $showItemStatus !!}                        
                        </td>
                        <td>
                            {!! $showCategoryHome !!}                        
                        </td>
                        <td>
                            {!! $displayAdminCategory !!}                        
                        </td>
                        <td>
                            {!! $createHistory !!}
                        </td>
                        <td>
                            {!! $modifiedHistory !!}
                        </td>
                        <td class="last">
                            {!! $showButtonAction !!}
                        </td>
                    </tr>
                @endforeach
            @else
                @include('admin.elements.list_empty', ['colspan' => 6])
            @endif
          </tbody>
       </table>
    </div>
 </div>