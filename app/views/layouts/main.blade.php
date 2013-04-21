<!DOCTYPE html>
<html lang="en" ng-app="notation">
<head>
	<meta charset="utf-8">
	<title>Notation - {{$title}}</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body ng-controller="AppCtl">

	<header id="pageHeader">
		<nav class="container clearfix">
			<ul class="pull-left">
				<li><a href="/">Posts</a></li>
			</ul>
		</nav>
	</header>

	<div class="container relative">
		{{$content}}
	</div>
	<script type="text/javascript" src="/assets/js/components/AngularJS/angular.js"></script>
	<script type="text/javascript" src="/assets/js/components/angular-resource/angular-resource.js"></script>
	<script type="text/javascript" src="/assets/js/controllers.js"></script>
</body>
</html>