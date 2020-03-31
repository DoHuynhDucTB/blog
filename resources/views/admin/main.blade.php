@include('admin.elements.header')
<body class="nav-sm">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            @include('admin.elements.sidebar')
        </div>
        <!-- top navigation -->
            @include('admin.elements.top_nav')
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>    
        <!-- /page content -->
@include('admin.elements.footer')
