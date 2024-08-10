<form action="<?php  echo base_url('do-update-order/'.$order['id']);?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Order Number</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order)){ echo $order['order_number'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Vendor Name</label>
				<input type="text" class="f orm-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order)){ echo $order['vendor_name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Vendor Email</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order)){ echo $order['vendor_email'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Assign Date<span class="text-danger">*</span></label>
				<input type="text" class="form-control datepicker" placeholder="" name="assign_date" id="assign_date" value="<?php if(!empty($order)){ echo $order['assign_date'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Publis Date<span class="text-danger">*</span></label>
				<input type="text" class="form-control datepicker" placeholder="" name="publish_date" id="publish_date" value="<?php if(!empty($order)){ echo $order['publish_date'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Publish URL <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="publish_url" id="publish_url" value="<?php if(!empty($order)){ echo $order['publish_url'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
		    <label>Order Status <span class="text-danger">*</span></label>
            <select name="status" class="js-example-basic-single-one form-control">
                <option value="Pending" <?php if($order['status'] == 'Pending') echo 'selected';?> > Pending </option>
                <option value="Given" <?php if($order['status'] == 'Given') echo 'selected';?> > Given </option>
                <option value="Publish" <?php if($order['status'] == 'Publish') echo 'selected';?> > Publish </option>
                <option value="Not_Publish" <?php if($order['status'] == 'Not_Publish') echo 'selected';?> > Not_Publish </option>
                <option value="Cancel" <?php if($order['status'] == 'Cancel') echo 'selected';?> > Cancel </option>
                <option value="Replacement" <?php if($order['status'] == 'Replacement') echo 'selected';?> > Replacement </option>
                <option value="Need Update" <?php if($order['status'] == 'Need Update') echo 'selected';?> > Need Update </option>
                
            </select>
        </div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Indexed URL</label>
				<input type="text" class="form-control" placeholder="" name="indexed_url" id="indexed_url" value="<?php if(!empty($order)){ echo $order['indexed_url'];}?>"> 
			</div>
		</div>
        <div class="col-md-4 mb-4">
            <label for="comment">Remark:</label>
            <textarea name="vendor_website_ramark" class="form-control" rows="1"><?php if(!empty($order)){ echo $order['vendor_website_ramark'];}?></textarea>
        </div>
        <div class="col-md-2 mb-2">
            <label>Click Here </label>
        <button type="button" id="chngvndr">Change Vendor</button>
        </div>
		<?php if(!empty($order)){ ?>
    		<div class="col-md-2 mb-2 vndinf" style="display:none">
    			<div class="form-group">
    				<label>Person ID </label>
    				<input type="text" class="form-control" placeholder="" name="vendor_id" id=""> 	    
    				<label>Cost Price </label>
    				<input type="text" class="form-control" placeholder="" name="cost_price" id="">
					<label>Discount Price </label>
    				<input type="text" class="form-control" placeholder="" name="discount_price" id=""> 
    			</div>
    		</div>
    		
    	<?php } ?>
        
        
		
	
	<div class="text-center">
	    
		<button style="margin-top: 30px;" class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>


 
  