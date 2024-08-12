<?php require('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-2 col-sm-2 col-xs-5" style="margin-left:25px;">
        <a data-toggle="tooltip" title="Total of Users" class="well top-block" href="user.php">
            <i class="glyphicon glyphicon-user blue"></i>
            <?php
            // Database connection
            require('include/database.php'); // Assuming database.php connects using mysqli

            // Query and fetch total users
            $result = $connection->query("SELECT * FROM user");
            $num_rows = $result->num_rows;
            ?>
            <div>Total Users</div>
            <div><?php echo $num_rows; ?></div>
        </a>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-5" style="margin-left:25px;">
        <a data-toggle="tooltip" title="Total of Items" class="well top-block" href="item.php">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>
            <?php
            // Query and fetch total items
            $result = $connection->query("SELECT * FROM item");
            $num_rows2 = $result->num_rows;
            ?>
            <div>Total Items</div>
            <div><?php echo $num_rows2; ?></div>
        </a>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-5" style="margin-left:25px;">
        <a data-toggle="tooltip" title="Total of Releasing" class="well top-block" href="#">
            <i class="glyphicon glyphicon-th-list red"></i>
            <?php
            // Query and fetch total releasing
            $result = $connection->query("SELECT * FROM release_details WHERE release_status = 'pending'");
            $num_rows3 = $result->num_rows;
            ?>
            <div>Total Inventory</div>
            <div><?php echo $num_rows3; ?></div>
        </a>
    </div>
	
    <div class="col-md-2 col-sm-2 col-xs-5" style="margin-left:25px;">
        <a data-toggle="tooltip" title="Total of Returning" class="well top-block" href="#">
            <i class="glyphicon glyphicon-th-list blue"></i>
            <?php
            // Query and fetch total returning
            $result = $connection->query("SELECT * FROM release_details WHERE release_status = 'returned'");
            $num_rows3 = $result->num_rows;
            ?>
            <div>Recently Added</div>
            <div><?php echo $num_rows3; ?></div>
        </a>
    </div>
</div>

<?php require('footer.php'); ?>
