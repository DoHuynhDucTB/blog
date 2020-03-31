@php
    use App\Helpers\Template;
    $elementAttr = Config('zvn.template.form.element');
    $labeltAttr = Config('zvn.template.form.label');
    $formElements = [
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Username', $labeltAttr),
            'element' => Form::text('username', $item['username'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Fullname', $labeltAttr),
            'element' => Form::text('fullname', $item['fullname'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Password', $labeltAttr),
            'element' => Form::password('password', $elementAttr)
        ],
        [
            'type' => 'normal',
            'label'   => Form::label('password_confirmation', 'Password Confirmation ', $labeltAttr),
            'element' => Form::password('password_confirmation', $elementAttr),
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Email', $labeltAttr),
            'element' => Form::text('email', $item['email'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Status', $labeltAttr),
            'element' => Form::select('status', ['' => 'Chọn trạng thái', 'active' => 'Kích hoạt', 'inactive' => 'Chưa kích hoạt'], $item['status'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Level', $labeltAttr),
            'element' => Form::select('level', ['admin' => 'Quản trị viên', 'member' => 'Thành viên'], $item['level'], $elementAttr)
        ],
        [
            'type' => 'avatar',
            'label' => Form::label('name', 'Avatar', $labeltAttr),
            'element' => Form::file('avatar', $elementAttr),
            'link' => (!empty($item['avatar'])) ? 'images/' . $controllerName . '/' . $item['avatar'] : null
        ],
        [
            'type' => 'input-submit',
            'element' =>  Form::hidden('id', $item['id']) . Form::hidden('task', 'add-user') . Form::hidden('avatar_current', $item['avatar']).Form::submit('Save', ['class' => 'btn btn-success']),
        ]
    ];
@endphp

@extends('admin.main')

@section('content')
    @include('admin.elements.page_header', ['pageIndex' => false])
    @include('admin.elements.zvn_notify')
    @include('admin.elements.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.elements.x_title', ['title' => 'Form Add'])
                <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        {!! Form::open(['method' => 'POST', 
                                        'accept-charset' => 'UTF-8', 
                                        'url' => route("$controllerName/save"), 
                                        'enctype' => 'multipart/form-data', 
                                        'class'=>'form-horizontal form-label-left', 
                                        'id' => 'main-form']) 
                        !!}
                            @foreach ($formElements as $key => $formItem)
                                @if($formItem['type'] == 'normal')
                                    <div class="form-group">
                                        {!! $formItem['label'] !!}
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! $formItem['element'] !!}
                                        </div>
                                    </div>
                                @elseif ($formItem['type'] == 'avatar')
                                <div class="form-group">
                                    {!! $formItem['label'] !!}
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! $formItem['element'] !!}
                                    <p style="margin-top: 50px;"><img src="{{asset($formItem['link'])}}" alt="" class="zvn-thumb"></p>
                                    </div>
                                </div>
                                @elseif ($formItem['type'] == 'input-submit')
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            {!! $formItem['element'] !!}
                                        </div>
                                    </div>    
                                @endif    
                            @endforeach
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
