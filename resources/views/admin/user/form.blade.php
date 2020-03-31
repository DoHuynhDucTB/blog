@extends('admin.main')

@section('content')
    @include('admin.elements.page_header', ['pageIndex' => false])
    @include('admin.elements.zvn_notify')
    @include('admin.elements.error')

    @if($id !== null)
        <div class="row">
            @include('admin.user.form-edit')
            @include('admin.user.form-pass')
        </div>    
    @else
        @include('admin.user.form-add')
    @endif          
@endsection
