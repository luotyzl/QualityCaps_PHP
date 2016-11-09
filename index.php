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
<head>
    <meta charset="utf-8">

<link href="./libs/js/banner_jd.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./libs/js/jquery-2.1.1.min.js"></script>
<script src="./libs/js/banner_jd02.js" type="text/javascript"></script>
</head>
<body>
<div>
    <h1>Quality Caps</h1>
    <p class="lead">The best cap online shop in New Zealand</p>
    <div class="play_box">
        <div class="imgBox">
            <img alt="" src="./images/banner1.jpg" />
            <img alt="" src="./images/banner2.jpg" />
            <img alt="" src="./images/banner3.jpg" />
            <img alt="" src="./images/banner4.png" />
        </div>
    </div>
</div>
</body>
<?php
// footer HTML and JavaScript codes
include_once "layout_foot.php";
?>