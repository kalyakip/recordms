<?php include('header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Releasing</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Releasing</h2>

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
			
<form method="POST" action="release_query.php">
                <!-- Start content here -->
                <div class="control-group">
                    <label class="control-label" for="selectError">Client Name</label>
                    <div class="controls">
                        <select name="client_id" id="selectError" data-rel="chosen" required>
				<?php
				$result =  mysql_query("select * from client")or die(mysql_error()); 
				while ($row=mysql_fetch_array($result)){ ?>
                            <option value="<?php echo $row['client_id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
				<?php } ?>
                        </select>
                    </div>
                </div>
				<br />
				<br />
				<br />
                <div class="control-group">
                </div>
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					<thead>
					<tr>
						<th>Item Name</th>
						<th>Brand</th>
						<th>Type</th>
						<th>Qty</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>
							<?php
							$result= mysql_query("select * from item order by item_id DESC ") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
							$id=$row['item_id'];
							$item_qty=$row['item_qty'];
							
									$borrow_details = mysql_query("select * from release_details where item_id = '$id' and release_status = 'pending'");
									$row11 = mysql_fetch_array($borrow_details);
									$count = mysql_num_rows($borrow_details);
									
									$total =  $item_qty  -  $count; 
							?>
					<tr class="del<?php echo $id ?>">
							<input type="hidden" name="item_id" value="<?php echo $id; ?>">
						<td><?php echo $row['item_name']; ?></td>
						<td><?php echo $row['item_brand']; ?></td>
						<td><?php echo $row['item_type']; ?></td>
						<td><?php echo  /*$row['item_qty'];*/ $total;  ?></td>
						<td class="center">
								<label>
									<input id="" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>" >
								</label>
						</td>
					</tr>
							<?php } ?>
					</tbody>
					</table>
                    <div class="controls">
						<button type="submit" class="btn btn-primary" style="float:right; margin-top:-100px;"><i class="glyphicon glyphicon-check"></i> Borrow</button>
                    </div>
</form>



				
                <!-- end content here -->
            </div>
        </div>
    </div>
</div><!--/row-->		
<script>		
$(".uniform_on").change(function(){
    var max= 3;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('3 Items allowed per borrow');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
})
</script>		


<?php include('footer.php'); ?>
