@php
    use App\Helpers\Template;
    $elementAttr = Config('zvn.template.form.element');
    $labeltAttr = Config('zvn.template.form.label');
    $ckeditortAttr = Config('zvn.template.form.ckeditor');

    $formElements = [
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Name', $labeltAttr),
            'element' => Form::text('name', $item['name'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Content', $labeltAttr),
            'element' => Form::textarea('content', $item['content'], $ckeditortAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Status', $labeltAttr),
            'element' => Form::select('status', ['' => 'Chọn trạng thái', 'active' => 'Kích hoạt', 'inactive' => 'Chưa kích hoạt'], $item['status'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Category', $labeltAttr),
            'element' => Form::select('category_id', $listCategory, $item['category_id'], $elementAttr)
        ],
        [
            'type' => 'normal',
            'label' => Form::label('name', 'Type', $labeltAttr),
            'element' => Form::select('type', ['featured' => 'Nổi bật', 'normal' => 'Không nổi bật'], $item['type'], $elementAttr)
        ],
        [
            'type' => 'thumb',
            'label' => Form::label('name', 'Thumb', $labeltAttr),
            'element' => Form::file('thumb', $elementAttr),
            'link' => (!empty($item['thumb'])) ? 'images/' . $controllerName . '/' . $item['thumb'] : null
        ],
        [
            'type' => 'input-submit',
            'element' =>  Form::hidden('id', $item['id']) . Form::hidden('thumb_current', $item['thumb']).Form::submit('Save', ['class' => 'btn btn-success']),
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
                                @elseif ($formItem['type'] == 'thumb')
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
