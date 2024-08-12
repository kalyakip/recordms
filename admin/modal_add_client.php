<?php
        include('include/database.php');
        // session_start();

        if (isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $type = $_POST['type'];
            $department = $_POST['department'];
            $contact = $_POST['contact'];

            // // Get user info from session
            // $user_id = $_SESSION['user_id']; // Ensure this session variable is set
            // $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
            // $stmt->bind_param("i", $user_id);
            // $stmt->execute();
            // $result = $stmt->get_result();
            // $row = $result->fetch_assoc();
            // $user = $row['firstname'] . " " . $row['lastname'];

            // Log the action
         

            // Insert new client
            $stmt = $connection->prepare("INSERT INTO `client`(firstname,middlename,lastname,department,DATE) VALUES (?,?,  ?, ?,?)");
            $stmt->bind_param("sssss", $firstname, $middlename, $lastname, $department,date('m/d/Y h:i:s a', time()));
            $stmt->execute();

            $stmt = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Add Client', ?)");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            // if( $stmt.affected_rows()==1){
            echo "<script>alert('Client successfully added!'); window.location='client.php'</script>";
            // }else{
            //   echo "<script>alert('Client Fail !'); window.location='client.php'</script>";
            // }
        }
        ?>
      
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-plus"></i> Add Client</button>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Client</h4>
      </div>
      <div class="modal-body">

        <form method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-left:60px;">
          <!-- <div class="form-group">
            <label for="school_id" class="col-sm-3 control-label">School ID</label>
            <div class="col-sm-7">
              <input type="number" name="school_id" class="form-control" id="school_id" placeholder="School ID....." required />
            </div>
          </div> -->
          <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Firstname</label>
            <div class="col-sm-7">
              <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Firstname....." required />
            </div>
          </div>
          <div class="form-group">
            <label for="middlename" class="col-sm-3 control-label">Middlename</label>
            <div class="col-sm-7">
              <input type="text" name="middlename" class="form-control" id="middlename" placeholder="MI / Middlename....." />
            </div>
            <span style="color:red;">optional</span>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">Lastname</label>
            <div class="col-sm-7">
              <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname....." required />
            </div>
          </div>
          <div class="form-group">
            <label for="department" class="col-sm-3 control-label">Department</label>
            <div class="col-sm-7">
              <input type="text" name="department" class="form-control" id="department" placeholder="Department....." required />
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="contact" class="col-sm-3 control-label">Contact</label>
            <div class="col-sm-7">
              <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact....." required />
            </div>
          </div> -->
          <!-- <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-7">
            <input type="type" name="type" class="form-control" id="type" placeholder="type....." required/>
            </div>
          </div> -->
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
