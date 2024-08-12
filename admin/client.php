<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Client</a></li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-user"></i> Clients Table</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="alert alert-info">
                    <?php include('modal_add_client.php'); ?>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                           <th>Department</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM client ORDER BY client_id DESC";
                        $result = $connection->query($query);

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['client_id'];
                        ?>
                        <tr>
                            <!-- <td><?php echo htmlspecialchars($row['school_id']); ?></td> -->
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                             <td><span class="label-success label label-default"><?php echo date("M d, Y H:i:s", strtotime($row['date'])); ?></span></td>
                            <td class="center">
                                <a class="btn btn-info" href="edit_client.php?client_id=<?php echo $id; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <a class="btn btn-danger" href="#delete<?php echo $id; ?>" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a>
                                <?php include('modal_delete_client.php'); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
