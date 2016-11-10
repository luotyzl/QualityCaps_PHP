<?php
// core configuration
include_once "config/core.php";

// make it work in PHP 5.4
include_once "libs/php/pw-hashing/passwordLib.php";

// set page title
$page_title = "Register";

// include login checker
include_once "login_checker.php";

// include classes
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/category.php';
include_once 'objects/cart_item.php';

// utilities
include_once "libs/php/utils.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);
$category = new Category($db);
$cart_item = new CartItem($db);

// utilities
$utils = new Utils();

// include page header HTML
include_once "layout_head.php";

echo "<div class='col-md-12'>";
	// if form was posted
	if($_POST){

		$user->username=$_POST['username'];
		if($user->usernameExists()){
			echo "<div class='alert alert-danger'>";
				echo "The username you specified is already registered. Please try to <a href='{$home_url}login'>login.</a>";
			echo "</div>";
		}
		else{

			// set values to object properties
			$user->username=$_POST['username'];
			$user->contact_number=$_POST['contact_number'];
			$user->address=$_POST['address'];
			$user->password=$_POST['password'];
			$user->access_level='Customer';
			$user->status=0;

			// access code for email verification
			$access_code=$utils->getToken();
			$user->access_code=$access_code;

			// create the user
			if($user->create()){

				echo "<div class='alert alert-info'>";
					echo "Successfully registered.";
				echo "</div>";
				
			}
			else{
				echo "<div class='alert alert-danger'>";
					echo "Unable to register. Please try again.";
				echo "</div>";
			}
		}
	}

	// if the form wasn't submitted yet, show register form
	else{
	?>

	<form action='register.php' method='post' id='register'>

		<table class='table table-hover table-responsive table-bordered'>

			<tr>
				<td class='width-30-percent'>Username</td>
				<td><input type='text' name='username' class='form-control' required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : "";  ?>" /></td>
			</tr>

			<tr>
				<td>Contact Number</td>
				<td><input type='text' name='contact_number' class='form-control' required value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>" /></td>
			</tr>

			<tr>
				<td>Address</td>
				<td><textarea name='address' class='form-control' required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?></textarea></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><input type='email' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>" /></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type='password' name='password' class='form-control' required id='passwordInput'></td>
			</tr>

			<tr>
				<td>Confirm Password</td>
				<td>
					<input type='password' name='confirm_password' class='form-control' required id='confirmPasswordInput'>
					<p>
						<div class="" id="passwordStrength"></div>
					</p>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-plus"></span> Register
					</button>
				</td>
			</tr>

		</table>
	</form>

	<?php
	}

echo "</div>";

// include page footer HTML
include_once "layout_foot.php";
?>
