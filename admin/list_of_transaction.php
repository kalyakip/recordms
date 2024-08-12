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
                            <th>Item Name</th>
                            <th>Client Name</th>
                            <th>Date Transaction</th>
                            <th>Action</th>
                            <th>Admin Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('include/database.php'); // Include database connection

                        // Handle search if search term is provided
                        $search_term = isset($_POST['search_term']) ? $_POST['search_term'] : '';
                        $search_query = $search_term ? " AND (client.firstname LIKE '%$search_term%' OR client.lastname LIKE '%$search_term%')" : '';

                        // Fetch transaction history from the database
                        $query = "SELECT transaction_history.*, client.firstname, client.lastname, item.item_name 
                                  FROM transaction_history
                                  LEFT JOIN client ON transaction_history.client_id = client.client_id
                                  LEFT JOIN item ON transaction_history.item_id = item.item_id
                                  WHERE 1=1" . $search_query . " 
                                  ORDER BY transaction_history.transaction_history_id DESC";
                        $result = $connection->query($query);

                        while ($row = $result->fetch_assoc()) {
                            $transaction_id = $row['transaction_history_id'];
                            $client_name = htmlspecialchars($row['firstname'] . " " . $row['lastname']);
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo $client_name; ?></td>
                            <td><span class="label-success label label-default"><?php echo date("M d, Y H:i:s", strtotime($row['date_added'])); ?></span></td>
                            <td><span class="label-primary label label-default"><?php echo htmlspecialchars($row['action']); ?></span></td>
                            <td><?php echo htmlspecialchars($row['admin_name']); ?></td>
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
