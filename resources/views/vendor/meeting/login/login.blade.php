<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Meeting</title>

	<!-- <link rel="stylesheet" type="text/css" href="../resources/styles/bootstrap.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/login.css')}}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body class="aw-layout-simple-page">
	<div class="aw-layout-simple-page__container">

		<form  method="POST" action="{{ route('login') }}">
			@csrf
			<div class="aw-simple-panel">
				<!-- Aqui é a logo -->
				<div class="logo">
					<h1><a href="{{ route('/') }}">Meeting</a></h1>
				</div>
				

				<div class="aw-simple-panel__message">
					Por favor, faça o login.
				</div>

				<div class="aw-simple-panel__box">
					<div class="form-group has-feedback">
						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-lg" name="email" value="{{ old('email') }}" placeholder="Seu e-mail" required autocomplete="email" autofocus >
						<span class="glyphicon  glyphicon-envelope  form-control-feedback" aria-hidden="true"></span>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
	
					</div>

					<div class="form-group has-feedback">

						 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}  input-lg" name="password" required autocomplete="current-password" placeholder="Sua senha">
						 <span class="glyphicon  glyphicon-lock  form-control-feedback" aria-hidden="true"></span>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
						
					</div>
					<div class="form-group">
						<input class="btn  btn-primary  btn-lg  aw-btn-full-width" type="submit" value="Entrar">
					</div>

					<div class="form-group clearfix">
						<!-- <div class="checkbox  pull-left  aw-checkbox-no-margin">
							<input type="checkbox" id="lembrar" />
							<label for="lembrar">Lembre de mim</label>
						</div> -->

						<div class="pull-right">
							<a href="esqueceu-senha.html">Esqueceu a senha?</a>
						</div>
					</div>
				</div>

				<div class="aw-simple-panel__footer">Novo por aqui? <a href="{{route('register')}}">Cadastre-se</a>.</div>
			</div>
		</form>

	</div>

	<script src="../resources/javascripts/app.js"></script>
	<script src="../resources/javascripts/jquery.min.js"></script>
	<script src="../resources/javascripts/bootstrap.mim.js"></script>
</body>

</html>