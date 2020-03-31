@php
    use App\Helpers\Template;
@endphp

<div class="x_content">
    <div class="table-responsive">
       <table class="table table-striped jambo_table bulk_action">
          <thead>
             <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">UserName</th>
                <th class="column-title">Email</th>
                <th class="column-title">Level</th>
                <th class="column-title">Status</th>
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
                        $username = $item['username'];
                        $fullname = $item['fullname'];
                        $email = $item['email'];
                        $image = $item['avatar'];
                        $status = $item['status'];
                        $level = $item['level'];
                        $created_by = $item['created_by'];
                        $created = $item['created'];
                        $modified_by = $item['modified_by'];
                        $modified = $item['modified'];
                        $createHistory = Template::showItemHistory($item['created_by'], $item['created']);
                        $modifiedHistory = Template::showItemHistory($item['modified_by'], $item['modified']);
                        $showItemStatus = Template::showItemStatus($controllerName, $item['id'], $item['status']);
                        $showItemThumb = Template::showItemThumb($controllerName, $item['avatar'], $item['username']);
                        $showButtonAction = Template::showButtonAction($controllerName, $id);
                        $showItemLevel = Template::showItemSelect($controllerName, $item['id'], $item['level'], 'level');
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td>
                            {{ $index }}
                        </td>
                        <td width="20%">
                            <p><strong>UserName:</strong> {{ $username }} </p>
                            <p><strong>Fullname:</strong> {{ $fullname }} </p>
                            <p>{!! $showItemThumb !!}</p>
                        </td>
                        <td>
                            {{ $email }}                       
                        </td>
                        <td>
                            {!! $showItemLevel !!}                        
                        </td>
                        <td>
                            {!! $showItemStatus !!}                        
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