<?php 
include('header.php');

// Database connection
$mysqli = new mysqli('localhost', 'samuel', '1234567', 'rms');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">User</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Users Table</h2>

                <div class="box-icon">
                    <!--<a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>-->
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- Start content here -->
                <div class="alert alert-info">
                    <?php include('modal_add_user.php') ?>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Prepare the SQL statement
                        if ($stmt = $mysqli->prepare("SELECT * FROM user ORDER BY user_id DESC")) {
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                $id = $row['user_id'];
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><span class="label-primary label label-default"><?php echo htmlspecialchars($row['password']); ?></span></td>
                            <td><span class="label-success label label-default"><?php echo date("M d, Y H:i:s", strtotime($row['user_added'])); ?></span></td>
                            <td class="center">
                                <!--<a class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>-->
                                <a class="btn btn-info" href="edit_user.php?user_id=<?php echo $id; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <a class="btn btn-danger" href="#delete<?php echo $id; ?>" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a>
                                <?php include('modal_delete_user.php'); ?>
                            </td>
                        </tr>
                        <?php
                            }
                            $stmt->close();
                        } else {
                            die('Prepare failed: ' . $mysqli->error);
                        }
                        ?>
                    </tbody>
                </table>
                <!-- end content here -->
            </div>
        </div>
    </div>
</div><!--/row-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<?php 
// Ensure connection is closed after all operations
if ($mysqli->ping()) {
    $mysqli->close();
}
?>
