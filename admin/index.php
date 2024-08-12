<?php
$no_visible_elements = true;
?>

<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Record Management System</title>
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

<div class="row">
    <div class="col-md-12 center login-header">
        <h2>Welcome to TVET - Record Management System</h2>
    </div>
    <!--/span-->
</div><!--/row-->

<div class="row">
    <div class="well col-md-5 center login-box">
        <div class="alert alert-info">
            Please login with your Username and Password.
        </div>
        <form class="form-horizontal" method="post">
            <fieldset>
                <div style="margin-left:95px; width:350px;" class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="clearfix"></div><br>

                <div style="margin-left:95px; width:350px;" class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="clearfix"></div>
                
                <div class="clearfix"></div>

                <p class="center col-md-5">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </p>
            </fieldset>
        </form>

        <?php
        include('include/database.php');

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare and execute login query
            $stmt = $connection->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $result->num_rows;

            if ($count > 0) {
                // session_start();
                $_SESSION['id'] = $row['user_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $user = $firstname . " " . $lastname;

                // Record login in history
                $stmt = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Login', ?)");
                $stmt->bind_param('s', $user);
                $stmt->execute();

                echo "<script>alert('Successfully Logged In!'); window.location='home.php'</script>";
            } else {
                echo "<script>alert('Invalid Username or Password! Try again.'); window.location='index.php'</script>";
            }

            $stmt->close();
        }
        ?>

    </div>
    <!--/span-->
</div><!--/row-->

<?php require('footer.php'); ?>

</body>
</html>
