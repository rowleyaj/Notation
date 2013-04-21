<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Notation</title>
	<link rel="stylesheet" href="/assets/admin/css/bootstrap.css">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="span4 offset4 well well-white">
			<legend>Notation</legend>
			{{Form::open(array('url' => 'login'))}}
			{{Form::email('email', null, array('class' => 'span4', 'placeholder' => 'Email Address'))}}
			{{Form::password('password', array('class' => 'span4', 'placeholder' => 'password'))}}
			{{Form::submit('Login', array('class' => 'btn btn-success btn-block'))}}
			{{Form::close()}}
			</div>
		</div>
	</div>

</body>
</html>