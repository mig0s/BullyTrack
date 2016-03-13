<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='shortcut icon' href='favicon.ico'/>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>".$websiteName."</title>
<link href='".$template."' rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='models/site-templates/bootstrap.min.css' />
<script src='models/jquery-2.1.4.min.js' type='text/javascript'></script>
<script src='models/funcs.js' type='text/javascript'></script>
</head>
<body>
<a href='#content' class='scrollToTop'></a>
<div id='wrapper' class='container'>
	<br>
	<div class='row head'>
		<div class='col-md-2 logodiv'>
			<img class='logo' src='tmcacademy.jpg' />
		</div>
		<div class='col-md-8'>
			<h1>bullytrack.ga CMR</h1>
		</div>
		<div class='col-md-2'>
			<br /><p class='text-right'><small>&copy; <abbr title='Mikhail Gospodarikov'>mig0s</abbr></small></p>
		</div>
	</div>
	<div id='jcontent' class='row'>
		<div id='main' class='col-md-12'>
			<div class='jumbotron'>
			<h2>Login:</h2>
				<div id='regbox'>
					<form name='login' action='".$_SERVER['PHP_SELF']."' method='post' class='form-horizontal'>
					<div class='form-group'>
						<div class='col-sm-4'>
							<input type='text' name='username' class='form-control' placeholder='username'><br/>
							<input type='password' name='password' class='form-control' placeholder='password'>
						    <div class='checkbox'>
						        <label>
									<input type='checkbox' name='remember_me' value='1' />Remember Me?
								</label>
							</div>
							<input type='submit' value='Login' class='btn btn-default' />
						</div>
						<div class='col-sm-6'>123<br /> 1234</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div id='bottom'></div>
	</div>
</div>
</body>
</html>