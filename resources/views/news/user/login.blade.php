	@include('admin.user.auth.header')

	<body class="my-login-page">
		<section class="h-100">
			<div class="container h-100">
				<div class="row justify-content-md-center h-100">
					<div class="card-wrapper">
						<div class="brand">
							<img src="{{ asset('admin/auth/img/logo.png') }}">
						</div>
						<div class="card fat">
							<div class="card-body">
								<h4 class="card-title">Đăng nhập</h4>
									@include ('admin.elements.error')
									@include ('admin.elements.auth_notify')
									{!! Form::open([
										'method'  => 'POST',
										'url'     => route("$controllerName/postLogin"),
										'id'      => 'login-form'
									]) !!}
					
									<div class="form-group">
										{!! Form::label('email', 'Email') !!}
										{!! Form::text('email', null, ['class' => 'form-control', 'autofocus' => true]) !!}
									</div>
					
									<div class="form-group">
										{!! Form::label('password', 'Mật khẩu') !!}
										{!! Form::password('password', ['class' => 'form-control', 'data-eye' => true]) !!}
									</div>
					
									<div class="form-group no-margin">
										<button type="submit" class="btn btn-primary btn-block">
											Đăng nhập
										</button>
									</div>
								{!! Form::close() !!}
							</div>
						</div>
						<div class="footer">
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="h-100">

	@include('admin.user.auth.footer')
