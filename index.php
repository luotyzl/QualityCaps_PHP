<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link href="/Content/banner_jd.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Scripts/jquery-2.1.1.min.js"></script>
<script src="/Scripts/banner_jd02.js" type="text/javascript"></script>
</head>
<body>
<div>
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

    <h1>Quality Caps</h1>
    <p class="lead">The best cap online shop in New Zealand</p>
    <div class="play_box">
        <div class="imgBox">
            <img alt="" src="/Images/banner1.jpg" />
            <img alt="" src="/Images/banner2.jpg" />
            <img alt="" src="/Images/banner3.jpg" />
            <img alt="" src="/Images/banner4.png" />
        </div>

        <span class="prev" title="Last"></span>
        <span class="next" title="Next"></span>

    </div>
    <p><button type="button" class="btn btn-primary btn-large" onclick="location.href = ">Start Shopping</button>
    </p>
</div>
</body>
</html>