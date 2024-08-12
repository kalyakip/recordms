<?php
include('header.php');
include('include/database.php'); // Include the database connection file
include('session.php'); // Include the session management file

$ID = intval($_GET['user_id']); // Sanitize user_id

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch current user info
    $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $id_session);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_row = $result->fetch_assoc();
    $user = $user_row['firstname'] . " " . $user_row['lastname'];

    // Insert into history
    $stmt = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Edit User Details', ?)");
    $stmt->bind_param("s", $user);
    $stmt->execute();

    // Update user details
    $stmt = $connection->prepare("UPDATE user SET firstname=?, middlename=?, lastname=?, username=?, password=? WHERE user_id = ?");
    $stmt->bind_param("sssssi", $firstname, $middlename, $lastname, $username, $password, $ID);
    $stmt->execute();

    echo "<script>alert('Successfully Updated User Info!'); window.location='user.php'</script>";
}

// Fetch user details
$stmt = $connection->prepare("SELECT * FROM user WHERE user_id = ?");
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div>
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Edit User</a></li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th-list"></i> Edit User Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- Start content here -->
                <div class="alert alert-info">
                    <a href="user.php"><button class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Back</button></a>
                </div>

                <form method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-left:250px;">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Firstname</label>
                        <div class="col-sm-4">
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" class="form-control" id="inputEmail3" placeholder="Firstname....." required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Middlename</label>
                        <div class="col-sm-4">
                            <input type="text" name="middlename" value="<?php echo htmlspecialchars($row['middlename']); ?>" class="form-control" id="inputEmail3" placeholder="MI / Middlename....." />
                        </div>
                        <span style="color:red;">optional</span>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Lastname</label>
                        <div class="col-sm-4">
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" class="form-control" id="inputPassword3" placeholder="Lastname....." required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" class="form-control" id="inputPassword3" placeholder="Username....." required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" class="form-control" id="inputPassword3" placeholder="Password....." required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-7">
                            <button type="submit" name="update" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Submit</button>
                        </div>
                    </div>
                </form>
                <!-- End content here -->
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>
