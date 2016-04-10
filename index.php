<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	$remember_choice = trim($_POST["remember_me"]);
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->remember_me = $remember_choice;
					$loggedInUser->remember_me_sessid = generateHash(uniqid(rand(), true));
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					if($loggedInUser->remember_me == 0)
						{
						    $_SESSION["userCakeUser"] = $loggedInUser;
						}
						else if($loggedInUser->remember_me == 1)
						{
						    updateSessionObj();
						                            
						    $stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."sessions VALUES(?, ?, ?)");
						    $stmt->bind_param("iss", time(), serialize($loggedInUser), $loggedInUser->remember_me_sessid);
						    $stmt->execute();
						    $stmt->close();
						                            
						    setcookie("userCakeUser", $loggedInUser->remember_me_sessid, time()+parseLength($remember_me_length));
						}
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
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
	<br /><br /><br />
	<div class='row head'>
		<div class='col-md-3 logodiv'>
			<img class='logo' src='pic/banner.png' />
		</div>
		<div class='col-md-6'>
			<h1 style='text-align: center;'>Geylang Academy<br />Course Monitoring System</h1>
		</div>
		<div class='col-md-3 logodiv'>
			<img class='logo' src='pic/bbanner.png' />
		</div>
	</div>";
echo resultBlock($errors,$successes);
echo "
	<div id='content' class='row'>
		<div id='main' class='col-md-12'>
			<div class='jumbotron'>
				<div id='regbox'>
					<form name='login' action='".$_SERVER['PHP_SELF']."' method='post' class='form-horizontal'>
					<div class='form-group'>
						<div class='col-sm-4'>
							<h2>login</h2><br />
							<p><input type='text' name='username' class='form-control' placeholder='username'></p>
							<p><input type='password' name='password' class='form-control' placeholder='password'></p>
						    <p><div class='checkbox'>
						        <label>
									<input type='checkbox' name='remember_me' value='1' />Remember Me?
								</label>
							</div></p>
							<input type='submit' value='Login' class='btn btn-default' />
						</div>
						<div class='col-sm-8' style='text-align: right;'>
							<h2>guest access</h2><br />
							<p>login: guest</p>
							<p>password: 12345678</p>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>";

?>
