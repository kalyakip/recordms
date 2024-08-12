<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Items Table</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-th-list"></i> Items Table</h2>

                <div class="box-icon">
                    <!---    <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                    -->
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- Start content here -->

                <div class="alert alert-info">
                    <?php include ('modal_add_item.php'); ?>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Client Name</th>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Serialnumber</th>
                            <th>Type</th>
                            <th>Qty</th>
                        
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('include/database.php'); // Database connection file

                        // Fetch items from the database
        $result = $connection->query("SELECT clnt.firstname,clnt.lastname,itm.item_id,itm.item_name,itm.item_brand,itm.item_serialnumber,itm.item_type,itm.date,itm.quantity FROM item AS itm LEFT JOIN `client` AS clnt ON clnt.client_id= itm.client_id ORDER BY itm.date DESC");

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['item_id'];
                            // $item_qty = $row['item_qty'];

                            // Fetch pending release details
                            $stmt = $connection->prepare("SELECT * FROM release_details WHERE item_id = ? AND release_status = 'pending'");
                            $stmt->bind_param('i', $id);
                            $stmt->execute();
                            $borrow_details = $stmt->get_result();
                            $count = $borrow_details->num_rows;

                            // Calculate total quantity available
                            // $total = $item_qty - $count;
                        ?>
                        <tr>
                        <td><?php echo htmlspecialchars($row['item_id']); ?></td>
    <td><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
    <td><?php echo htmlspecialchars($row['item_brand']); ?></td>
    <td><?php echo htmlspecialchars($row['item_serialnumber']); ?></td>
    <td><?php echo htmlspecialchars($row['item_type']); ?></td>
    <td><?php echo htmlspecialchars($row['date']); ?></td>
    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                           
                            <!-- <td><span class="label-primary label label-default"><?php echo htmlspecialchars($row['item_price']) . '.00'; ?> PHP</span></td> -->
                            <td><span class="label-success label label-default"><?php echo date("M d, Y H:i:s", strtotime($row['date'])); ?></span></td>
                            <td class="center">
                                <!--<a class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>-->
                                <a class="btn btn-info" href="edit_item.php?item_id=<?php echo urlencode($id); ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <a class="btn btn-danger" href="#delete<?php echo urlencode($id); ?>" data-toggle="modal" data-target="#delete<?php echo urlencode($id); ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a>
                                <?php include('modal_delete_item.php'); ?>
                            </td>
                        </tr>
                        <?php 
                            $stmt->close();
                        } 
                        ?>
                    </tbody>
                </table>

                <!-- end content here -->
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>
