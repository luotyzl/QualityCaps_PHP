<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link href="/Content/banner_jd.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Scripts/jquery-2.1.1.min.js"></script>
    <script src="/Scripts/banner_jd02.js" type="text/javascript"></script>
</head>
<body>
<?php
//Retrieve the requested content page name and construct the file name
if (isset($_GET['content_page']))
{
    $page_name = $_GET['content_page'];
    $page_content = $page_name.'.php';
}
elseif (isset($_POST['content_page']))
{
    $page_name = $_POST['content_page'];
    $page_content = $page_name.'.php';
}
else
{$page_content = 'Index.php';}

//This must be below the setting of $page_content
include('MasterPage.php');
?>
<hgroup>
    <h2>Contact Us</h2>
</hgroup>
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
</body>
</html>