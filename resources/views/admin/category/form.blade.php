@php
    use App\Helpers\Template;
    $elementAttr = Config('zvn.template.form.element');
    $labeltAttr = Config('zvn.template.form.label');
    $formElements = [
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Name', $labeltAttr),
            'element' => Form::text('name', $item['name'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Status', $labeltAttr),
            'element' => Form::select('status', ['' => 'Chọn trạng thái', 'active' => 'Kích hoạt', 'inactive' => 'Chưa kích hoạt'], $item['status'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'IsHome', $labeltAttr),
            'element' => Form::select('is_home', ['yes' => 'Hiển thị', 'no' => 'Không hiển thị'], $item['is_home'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Display', $labeltAttr),
            'element' => Form::select('display', ['list' => 'Danh sách', 'grid' => 'Lưới'], $item['display'], $elementAttr)
        ],
        [
            'type' => 'input-submit',
            'element' => Form::hidden('id', $item['id']) . Form::submit('Save', ['class' => 'btn btn-success'])
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
                @include('admin.elements.x_title', ['title' => 'Form'])
                <div class="x_content">
                    <div class="row">

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
