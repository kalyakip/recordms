<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">List of Item</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-th-list"></i> List of Item</h2>

                <div class="box-icon">
                <!---    <a href="#" class="btn btn-setting btn-round btn-default"><i
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
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('include/database.php'); // Include database connection

                        // Handle search if search term is provided
                        $search_term = isset($_POST['search_term']) ? $_POST['search_term'] : '';
                        $search_query = $search_term ? " WHERE item_name LIKE '%$search_term%'" : '';

                        // Fetch items from the database
                        $query = "SELECT * FROM item" . $search_query . " ORDER BY item_id DESC";
                        $result = $connection->query($query);

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['item_id'];
                            $item_qty = $row['item_qty'];

                            // Calculate available quantity
                            $borrow_details_query = "SELECT * FROM release_details WHERE item_id = '$id' AND release_status = 'pending'";
                            $borrow_details_result = $connection->query($borrow_details_query);
                            $count = $borrow_details_result->num_rows;
                            $total = $item_qty - $count;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_brand']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_description']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_type']); ?></td>
                            <td><?php echo htmlspecialchars($total); ?></td>
                            <td><span class="label-primary label label-default"><?php echo htmlspecialchars($row['item_price']) . '.00 PHP'; ?></span></td>
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
