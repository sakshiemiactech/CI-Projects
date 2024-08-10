<form action="<?php if(!empty($order_info)){ echo base_url('do-updation-order/'.$order_info['id']);}else{echo base_url('do-add-order');}?>" method="post" class="form-redirect-writer pt-3" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Order Number <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="order_number" id="order_number" value="<?php if(!empty($order_info)){ echo $order_info['order_number'];}elseif(!empty($last_id)){ echo $last_id['order_number']+1;}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
		    <div class="text-center" style="margin-left: 69%;">
                <a href="<?php echo base_url('add-client'); ?>" class="btn btn-info form-control">Add Client</a>
            </div>
            <select name="client_name" class="js-example-basic-single-one form-control client_name" data-url="<?php echo base_url('client-email/'); ?>">
                <option value="">Client Name</option>
                <?php foreach($clients as $value){ ?>
                    <option value="<?php echo $value['id']; ?>" <?php if(!empty($order_info) && $value['id'] == $order_info['client_name']) echo 'selected';?> > <?php echo $value['name']; ?> </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Client Email ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control client_email" readonly placeholder="" name="client_email" id="client_email" value="<?php if(!empty($order_info)){ echo $order_info['client_email'];}?>"> 
			</div>
		</div>
        <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Contacted From <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="contacted_from" id="contacted_from" value="<?php if(!empty($order_info)){ echo $order_info['contacted_from'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Date<span class="text-danger">*</span></label>
				<input type="text" autocomplete="off" class="form-control" placeholder="" name="order_date" id="order_date" value="<?php if(!empty($order_info)){ echo $order_info['order_date'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Remark</label>
				<textarea class="form-control" placeholder="" name="remark" id="remark"> <?php if(!empty($order_info)){ echo $order_info['remark'];}?> </textarea>
			</div>
		</div>
		 <div class="col-md-4 mb-4">
            <label for="comment">Payment Remark:</label>
            <textarea name="payment_remark" class="form-control"><?php if(!empty($order_info)){ echo $order_info['payment_remark'];}?></textarea>
        </div>
		<div class="main_divs col-md-12 mb-12">
		    <div class="append_divs col-md-12 mb-12 row">
		        <div class="col-md-2 mb-2">
        			<div class="form-group">
        				<label>Website <span class="text-danger">*</span></label>
						<select class='selUser firstoneselect' style='width: 200px;'>
 <option value='0'>- Search user -</option>
</select>
						
						<?php /* "text" autocomplete="off" class="form-control" placeholder="" name="<?php if(!empty($order_info)){ echo 'website';}else{  echo 'website[]';}?>" id="website1" value="<?php if(!empty($order_info)){ echo $order_info['website'];}?>"> 
						<select name="<?php if(empty($order_info)){ echo 'website[]';}else{ echo 'website';}?>" class="js-example-basic-single-one form-control website" id="website">
                            <option value="">Website</option>
                            
                            
                        </select> 
        				 <select name="<?php if(empty($order_info)){ echo 'website[]';}else{ echo 'website';}?>" class="js-example-basic-single-one form-control website" id="website">
                            <option value="">Website</option>
                            <?php foreach($websites as $site){ ?>
                                <option value="<?php echo $site['website']; ?>" <?php if(!empty($order_info) && $site['website']==$order_info['website']) echo 'selected';?>> <?php echo $site['website']; ?> </option>
                            <?php }  ?>
                        </select>
        			</div>
        		</div>
        		<div class="col-md-1 mb-1">
        			<div class="form-group">
        				<label>Type <span class="text-danger">*</span></label>
        				<select name="<?php if(empty($order_info)){ echo 'site_type[]';}else{ echo 'site_type';}?>" class="js-example-basic-single-one form-control">
                            <option value="">Select Type</option>
                            <option value="Normal" <?php if(!empty($order_info) && $order_info['site_type'] == 'Normal') echo 'selected';?>>Normal</option>
                            <option value="Casino" <?php if(!empty($order_info) && $order_info['site_type'] == 'Casino') echo 'selected';?>> Casino </option>
                            <option value="Adult" <?php if(!empty($order_info) && $order_info['site_type'] == 'Adult') echo 'selected';?>> Adult </option>
                            <option value="CBD" <?php if(!empty($order_info) && $order_info['site_type'] == 'CBD') echo 'selected';?>> CBD </option>
                        </select> */ ?>
                    </div>
        		</div>
        		<div class="col-md-2 mb-2">
        			<div class="form-group">
        				<label>Proposed Amount <span class="text-danger">*</span></label>
        				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'proposed_amount[]';}else{ echo 'proposed_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['proposed_amount'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-2 mb-2">
        			<div class="form-group">
        				<label>Content Amount </label>
        				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'content_amount[]';}else{ echo 'content_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['content_amount'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-2 mb-2">
        			<div class="form-group">
        				<label>Content DOC</label>
                        <input type="file" name="<?php if(empty($order_info)){ echo 'imports_file[]';}else{ echo 'imports_file';}?>">
        			</div>
        		</div>
        		<div class="col-md-2 mb-2">
        			<div class="form-group">
        				<label>Anchor</label>
				        <textarea class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'website_remark[]';}else{ echo 'website_remark';}?>" id="website_remark"> <?php if(!empty($order_info)){ echo $order_info['website_remark'];}?> </textarea>
        			</div>
        		</div>
        		
        		
		    </div>
		</div>
		
		 
		
	</div>
	<?php if(empty($order_info)){ ?>
	    <div class="text-center">
    		<button class="btn btn-primary add_web" type="button">Add More</button>
    	</div>
    <?php } ?>
	<hr>
	
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>

<div class="append_it col-md-12 mb-12" style="display:none">
    <div class="append_divs col-md-12 mb-12 row">
        <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Website <span class="text-danger">*</span></label>
				<select class='selUser' style='width: 200px;'>
 <option value='0'>- Search user -</option>
</select>
				
			</div>
		</div>
		<div class="col-md-1 mb-1">
        			<div class="form-group">
        				<label>Type <span class="text-danger">*</span></label>
        				<select name="<?php if(empty($order_info)){ echo 'site_type[]';}else{ echo 'site_type';}?>" class="form-control">
                            <option value="">Select Type</option>
                            <option value="Normal" <?php if(!empty($order_info) && $order_info['site_type'] == 'Normal') echo 'selected';?>>Normal</option>
                            <option value="Casino" <?php if(!empty($order_info) && $order_info['site_type'] == 'Casino') echo 'selected';?>> Casino </option>
                            <option value="Adult" <?php if(!empty($order_info) && $order_info['site_type'] == 'Adult') echo 'selected';?>> Adult </option>
                            <option value="CBD" <?php if(!empty($order_info) && $order_info['site_type'] == 'CBD') echo 'selected';?>> CBD </option>
                        </select>
                    </div>
        		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Proposed Amount <span class="text-danger">*</span></label>
				<input type="number" class="form-control" placeholder="" name="proposed_amount[]" id="bank_name" value="<?php if(!empty($site_info)){ echo $site_info['person'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Content Amount </label>
				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'content_amount[]';}else{ echo 'content_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['content_amount'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group ss">
				<label>Content DOC</label>
                <input type="file" name="imports_file[]">
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Anchor</label>
		        <textarea class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'website_remark[]';}else{ echo 'website_remark';}?>" id="website_remark"> <?php if(!empty($order_info)){ echo $order_info['website_remark'];}?> </textarea>
			</div>
		</div>
		<span class="demo-btn" style="margin-top: 25px;">
            <a href="#!" class="btn btn-danger btn-fab btn-sm fuse-ripple-ready delete_row"><i class="fa fa-trash-o" style="width: 18px;padding: 0px;font-size: 23px; text-align: center;text-decoration: none;border-radius: 50%;"></i></a>
        </span>
    </div>
</div>

 
