<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">List of Client</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-th-list"></i> List of Client</h2>

                <div class="box-icon">
                 <!---   <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a> -->
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- Start content here -->
                
                <div class="alert alert-info">
                    <form method="post" enctype="multipart/form-data" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="search_term" class="form-control" id="exampleInputEmail2" placeholder="Search name.....">
                        </div>
                        <button type="submit" name="search" class="btn btn-default">Search</button>
                    </form>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Department</th>
                            <th>Contact</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('include/database.php'); // Include database connection

                        // Handle search if search term is provided
                        $search_term = isset($_POST['search_term']) ? $_POST['search_term'] : '';
                        $search_query = $search_term ? " WHERE firstname LIKE '%$search_term%' OR lastname LIKE '%$search_term%'" : '';

                        // Fetch clients from the database
                        $query = "SELECT * FROM client" . $search_query . " ORDER BY client_id DESC";
                        $result = $connection->query($query);

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['client_id'];
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <!-- <td><span class="label-primary label label-default"><?php echo htmlspecialchars($row['contact']); ?></span></td> -->
                            <td><span class="label-success label label-default"><?php echo date("M d, Y H:i:s", strtotime($row['date'])); ?></span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <!-- end content here -->
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>
