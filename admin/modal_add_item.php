<?php 
        include('include/database.php');
        // session_start();

        if (isset($_POST['submit'])) {
            $item_name = $_POST['item_name'];
            $item_brand = $_POST['item_brand'];
            $item_serialnumber = $_POST['item_serialnumber'];
            $item_type = $_POST['item_type'];
            $item_client = $_POST['item_client'];
            // Insert new item
            $stmt = $connection->prepare("INSERT INTO item (client_id,item_name, item_brand, item_serialnumber, item_type, date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss",$item_client, $item_name, $item_brand, $item_serialnumber, $item_type,date('m/d/Y h:i:s a', time()));
            $stmt->execute();

  // Log the action
  $stmt = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Add Item', ?)");
  $stmt->bind_param("s", $user);
  $stmt->execute();

            echo "<script>alert('Item successfully added!'); window.location='item.php'</script>";
        }
        ?><!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-plus"></i> Add Item</button>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Item</h4>
      </div>
      <div class="modal-body">

        <form method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-left:60px;">
          <!-- <div class="form-group">
            <label for="item_id_id" class="col-sm-3 control-label">Item ID</label>
            <div class="col-sm-4">
              <input type="number" name="item_id_id" class="form-control" id="item_id_id" placeholder="Item ID....." required />
            </div>
          </div> -->
          <div class="form-group">
            <label for="item_name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
              <input type="text" name="item_name" class="form-control" id="item_name" placeholder="Name....." required />
            </div>
          </div>
          <div class="form-group">
            <label for="item_brand" class="col-sm-3 control-label">Brand</label>
            <div class="col-sm-7">
              <input type="text" name="item_brand" class="form-control" id="item_brand" placeholder="Brand....." required />
            </div>
          </div>
          <div class="form-group">
            <label for="item_serialnumber" class="col-sm-3 control-label">serialnumber</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="item_serialnumber" id="item_serialnumber" placeholder="serialnumber....." required></textarea>
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="item_price" class="col-sm-3 control-label">Price</label>
            <div class="col-sm-4">
              <input type="number" name="item_price" class="form-control" id="item_price" placeholder="Price....." required />
            </div>
          </div> -->
          <div class="form-group">
            <label for="item_type" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-7">
            <textarea class="form-control" name="item_type" id="item_type" placeholder="type" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="item_client" class="col-sm-3 control-label">Item Client</label>
            <div class="col-sm-4">           
<select name="item_client" id="item_client">
              
              <?php
                $query = "SELECT client_id, firstname, lastname FROM client";
                $result = $connection->query($query);                
                if ($result) {
                   while ($row = $result->fetch_assoc()) {
                        $client_id = htmlspecialchars($row['client_id']);
                        $full_name = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                        echo "<option value=\"$client_id\">$full_name</option>";
                    }
                } else {
                  echo '<option value="">Error Getting Clients</option>';
                }
              ?>              
            </select>
             </div>
          </div>
          <div class="form-group">
            <label for="submit" class="col-sm-3 control-label"></label>
            <div class="col-sm-7">
              <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Submit</button>
            </div>
          </div>
        </form>
        
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
