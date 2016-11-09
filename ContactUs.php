<?php
// core configuration
include_once "config/core.php";

// utilities
include_once "libs/php/utils.php";

// make it work in PHP 5.4
include_once "libs/php/pw-hashing/passwordLib.php";

// set page title
$page_title = "Login";

// include login checker
include_once "login_checker.php";

// include classes
include_once "config/database.php";
include_once "objects/category.php";
include_once 'objects/user.php';
include_once 'objects/cart_item.php';

// initialize utility class
$utils = new Utils();

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$category = new Category($db);
$user = new User($db);
$cart_item = new CartItem($db);

// default to false
$access_denied=false;

// include page header HTML
include_once "layout_head.php";

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if an email was verified
if($action=='email_verified'){
	echo "<div class='alert alert-success'>";
		echo "<strong>Your email was verified. Thank you!</strong> Please login.";
	echo "</div>";
}
?>
<?php
// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
	echo "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">Please login.</div>";
}

// tell the user to login
else if($action=='please_login'){
	echo "<div class='alert alert-info'>";
		echo "<strong>Please login to access that page.</strong>";
	echo "</div>";
}

// tell the user if access denied
if($access_denied){
	echo "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">";
		echo "Access Denied.<br /><br />";
		echo "Your username or password maybe incorrect";
	echo "</div>";
}
?>

<div>
    <div class="col-md-5">
        <address>
            One Microsoft Way<br />
            Redmond, WA 98052-6399<br />
            <abbr title="Phone">P:</abbr>
            425.555.0100
        </address>
        <address>
            <i class="icon-envelope"></i><strong>Support:</strong> <a href="mailto:Support@example.com">Support@example.com</a><br />
            <i class="icon-envelope"></i><strong>Marketing:</strong> <a href="mailto:Marketing@example.com">Marketing@example.com</a>
        </address>
    </div>
    <div class="col-md-7">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12765.708672430546!2d174.7067383!3d-36.880128!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xac4fd7893e9a560f!2sUnitec+Institute+of+Technology!5e0!3m2!1szh-CN!2snz!4v1474113139379" width=100% height="450" frameborder="0" style="border: 0" allowfullscreen></iframe>

    </div>
</div>

<?php
// footer HTML and JavaScript codes
include_once "layout_foot.php";
?>