<?php
include('header.php');
include('include/database.php'); // Include the database connection file
include('session.php'); // Include the session management file

$ID = intval($_GET['item_id']); // Sanitize item_id

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $item_id_id = $_POST['item_id_id'];
    $item_name = $_POST['item_name'];
    $item_brand = $_POST['item_brand'];
    $item_description = $_POST['item_description'];
    $item_qty = intval($_POST['item_qty']);
    $item_price = floatval($_POST['item_price']);
    $item_type = $_POST['item_type'];

    // Fetch current user info
    $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $id_session);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_row = $result->fetch_assoc();
    $user = $user_row['firstname'] . " " . $user_row['lastname'];

    // Insert into history
    $stmt = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Edit Item Details', ?)");
    $stmt->bind_param("s", $user);
    $stmt->execute();

    // Update item details
    $stmt = $connection->prepare("UPDATE item SET item_id_id=?, item_name=?, item_brand=?, item_description=?, item_qty=?, item_price=?, item_type=? WHERE item_id = ?");
    $stmt->bind_param("issssisi", $item_id_id, $item_name, $item_brand, $item_description, $item_qty, $item_price, $item_type, $ID);
    $stmt->execute();

    echo "<script>alert('Successfully Updated Item Info!'); window.location='item.php'</script>";
}

// Fetch item details
$stmt = $connection->prepare("SELECT * FROM item WHERE item_id = ?");
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div>
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Edit Item</a></li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th-list"></i> Edit Item Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- Start content here -->
                <div class="alert alert-info">
                    <a href="item.php"><button class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Back</button></a>
                </div>
                
                <form method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-left:175px;">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Item ID</label>
                        <div class="col-sm-3">
                            <input type="number" name="item_id_id" value="<?php echo htmlspecialchars($row['item_id_id']); ?>" class="form-control" id="inputEmail3" placeholder="Item ID.....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="item_name" value="<?php echo htmlspecialchars($row['item_name']); ?>" class="form-control" id="inputEmail3" placeholder="Name.....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Brand</label>
                        <div class="col-sm-4">
                            <input type="text" name="item_brand" value="<?php echo htmlspecialchars($row['item_brand']); ?>" class="form-control" id="inputPassword3" placeholder="Brand.....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="item_description" id="inputPassword3" placeholder="Description....."><?php echo htmlspecialchars($row['item_description']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Qty</label>
                        <div class="col-sm-2">
                            <input type="number" name="item_qty" value="<?php echo htmlspecialchars($row['item_qty']); ?>" class="form-control" id="inputPassword3" placeholder="Qty.....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-2">
                            <input type="number" step="0.01" name="item_price" value="<?php echo htmlspecialchars($row['item_price']); ?>" class="form-control" id="inputPassword3" placeholder="Price.....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-3">
                            <select name="item_type" class="form-control">
                                <option value="<?php echo htmlspecialchars($row['item_type']); ?>"><?php echo htmlspecialchars($row['item_type']); ?></option>
                                <option value="Consumable">Consumable</option>
                                <option value="Non-Consumable">Non-Consumable</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label"></label>
                        <div class="col-sm-7">
                            <button type="submit" name="update" class="btn btn-primary"><i class="glyphicon glyphicon-check"></i> Update</button>
                        </div>
                    </div>
                </form>
                <!-- End content here -->
            </div>
        </div>
    </div>
</div><!--/row-->

<?php include('footer.php'); ?>
