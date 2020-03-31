@if (session('news_notify'))
    <div class="alert alert-danger">
        <h4><i class="fa fa-warning"></i> Cảnh báo </h4>
        <p> {{session('news_notify')}} </p>
    </div>
@endif