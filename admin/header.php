<?php
session_start(); // Ensure the session is started

include 'config.php'; // Include your database configuration
include 'include/database.php'; // Include database connection

// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $id_session = $_SESSION['user_id'];

    // Use mysqli to query the database
    $user_query = $connection->query("SELECT * FROM user WHERE user_id='$id_session'");
    if ($user_query && $user_query->num_rows > 0) {
        $row = $user_query->fetch_assoc();
    } else {
        // Handle the case where no user is found
        $row = null;
    }
} else {
    // Handle the case where user_id is not set
    $row = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/TVET.ico">
</head>

<body>
    <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
        <!-- topbar starts -->
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-inner">
                <button type="button" class="navbar-toggle pull-left animated flip">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                    <span>TVET IMS</span></a>

                <!-- user dropdown starts -->
                <div class="btn-group pull-right">
                    <?php if (!empty($row)) { ?>
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo htmlspecialchars($row['firstname']); ?></span>
                            <span class="caret"></span>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Guest</span>
                            <span class="caret"></span>
                        </button>
                    <?php } ?>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                    </ul>
                </div>
                <!-- user dropdown ends -->

                <!-- theme selector starts -->
                <!--
                <div class="btn-group pull-right theme-container animated tada">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-tint"></i><span
                            class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" id="themes">
                        <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                        <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                        <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                        <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                        <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                        <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                        <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                        <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                        <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                    </ul>
                </div>
                -->
                <!-- theme selector ends -->

                <div class="ch-container">
                    <div class="row">
                        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
                            <!-- left menu starts -->
                            <div class="col-sm-2 col-lg-2">
                                <div class="sidebar-nav">
                                    <div class="nav-canvas">
                                        <div class="nav-sm nav nav-stacked"></div>
                                        <ul class="nav nav-pills nav-stacked main-menu">
                                            <li class="nav-header">Main</li>
                                            <li><a class="ajax-link" href="home.php"><i class="glyphicon glyphicon-home"></i><span> Home</span></a></li>
                                            <li class="accordion">
                                                <a href="#"><i class="glyphicon glyphicon-th-list"></i><span> Masterfile</span></a>
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a class="ajax-link" href="item.php"><i class="glyphicon glyphicon-chevron-right"></i><span> Item</span></a></li>
                                                    <li><a class="ajax-link" href="client.php"><i class="glyphicon glyphicon-chevron-right"></i><span> Client</span></a></li>
                                                    <li><a class="ajax-link" href="user.php"><i class="glyphicon glyphicon-chevron-right"></i><span> Admin Account</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="accordion">
                                                <a href="#"><i class="glyphicon glyphicon-th-list"></i><span> Transaction</span></a>
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a class="ajax-link" href="release.php"><i class="glyphicon glyphicon-chevron-right"></i><span> Releasing</span></a></li>
                                                    <li><a class="ajax-link" href="return.php"><i class="glyphicon glyphicon-chevron-right"></i><span> Returning</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="accordion">
                                                <a href="#"><i class="glyphicon glyphicon-th-list"></i><span> Record</span></a>
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a class="ajax-link" href="list_of_item.php"><i class="glyphicon glyphicon-chevron-right"></i><span> List of Item</span></a></li>
                                                    <li><a class="ajax-link" href="list_of_client.php"><i class="glyphicon glyphicon-chevron-right"></i><span> List of Client</span></a></li>
                                                    <li><a class="ajax-link" href="list_of_transaction.php"><i class="glyphicon glyphicon-chevron-right"></i><span> List of Transaction</span></a></li>
                                                </ul>
                                            </li>
                                            <li><a class="ajax-link" href="history.php"><i class="glyphicon glyphicon-bookmark"></i><span> History Log</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <!-- left menu ends -->
                        <?php } // End of $no_visible_elements check ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- topbar ends -->
    <?php } // End of $no_visible_elements check ?>
</body>
</html>
