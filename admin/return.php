<?php include('header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Returning</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Returning</h2>

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
                <!-- Start your content here -->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>School ID</th>
        <th>Client Name</th>
        <th>Type</th>
        <th>Item Borrowed</th>
        <th>Date Borrowed</th>
        <th>Date Returned</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>								 
                                  <?php  $user_query=mysql_query("select * from tbl_release
								LEFT JOIN client ON tbl_release.client_id = client.client_id
								LEFT JOIN release_details ON tbl_release.release_id = release_details.release_id
								LEFT JOIN item on release_details.item_id =  item.item_id 
								ORDER BY tbl_release.release_id DESC
								  ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['release_id'];
									$item_id=$row['item_id'];
									$release_details_id=$row['release_details_id'];
				
									?>
    <tr class="del<?php echo $id ?>">
	
        <td><?php echo $row['school_id']; ?></td>
        <td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
        <td class="center"><?php echo $row['type']; ?></td>
        <td class="center"><?php echo $row['item_name']; ?></td>
		<td><?php echo date("M d, Y H:i:s",strtotime($row['date_borrow'])); ?></td>
		<td><?php echo ($row['date_return'] == "0000-00-00 00:00:00") ? "" : date("M d, Y H:i:s",strtotime($row['date_return'])); ?></td>
        <td class="center"><?php echo $row['release_status']; ?></td>
		<td>
			<a class="btn btn-primary"  id="<?php echo $release_details_id; ?>" href="#delete_book<?php echo $release_details_id;?>" data-toggle="modal" data-target="#delete_book<?php echo $release_details_id;?>" <?php echo (($row['release_status'] == 'returned' )) ? "disabled onclick='return false;'" : ""; ?>>
				<i class="glyphicon glyphicon-check icon-white"></i> Returned
			</a>
			<?php include('modal_return.php'); ?>
		</td>
		
    </tr>
									<?php  }  ?>
    </tbody>
    </table>
                <!-- end your content here -->
            </div>
        </div>
    </div>
</div><!--/row-->


<?php include('footer.php'); ?>
