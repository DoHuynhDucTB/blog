@php
    use App\Helpers\Template;
    $elementAttr = Config('zvn.template.form.element');
    $labeltAttr = Config('zvn.template.form.label');
    $formElements = [
        [
            'type' => 'normal',
            'label'   => Form::label('password', 'Password', $labeltAttr),
            'element' => Form::password('password', $elementAttr),
        ],
        [
            'type' => 'normal',
            'label'   => Form::label('password_confirmation', 'Password Confirmation ', $labeltAttr),
            'element' => Form::password('password_confirmation', $elementAttr),
        ],
        [
            'type' => 'input-submit',
            'element' =>  Form::hidden('id', $item['id']) . Form::hidden('task', 'change-pass') . Form::hidden('avatar_current', $item['avatar']).Form::submit('Save', ['class' => 'btn btn-success']),
        ]
    ];
@endphp

<div class="col-md-6 col-sm-6 col-xs-6">
    <div class="x_panel">
        @include('admin.elements.x_title', ['title' => 'Form Change Pass'])
        <div class="x_content">
            {!! Form::open(['method' => 'POST', 
                            'accept-charset' => 'UTF-8', 
                            'url' => route("$controllerName/password"), 
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
