<form action="<?php echo base_url('do-updation-orders/'.$order_info['id']);?>" method="post" class="form-redirect pt-3">
	<div class="row">
	    <h3 class="col-md-12 mb-12">Order Details</h3>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Order Number <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="order_number" id="order_number" value="<?php if(!empty($order_info)){ echo $order_info['order_number'];}elseif(!empty($last_id)){ echo $last_id['order_number']+1;}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
		    <label>Client Name <span class="text-danger">*</span></label>
            <select name="client_name" class="js-example-basic-single-one form-control client_name" data-url="<?php echo base_url('client-email/'); ?>">
                <option value="">Client Name</option>
                <?php foreach($clients as $value){ ?>
                    <option value="<?php echo $value['id']; ?>" <?php if(!empty($order_info) && in_array($value['id'],$order_info)) echo 'selected';?> > <?php echo $value['name']; ?> </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Client Email ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control client_email" readonly placeholder="" name="client_email" id="client_email" value="<?php if(!empty($order_info)){ echo $order_info['client_email'];}?>"> 
			</div>
		</div>
        <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Contacted From <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="contacted_from" id="contacted_from" value="<?php if(!empty($order_info)){ echo $order_info['contacted_from'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Date<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="order_date" id="order_date" value="<?php if(!empty($order_info)){ echo $order_info['order_date'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Remark</label>
				<textarea class="form-control" placeholder="" name="remark" id="remark"> <?php if(!empty($order_info)){ echo $order_info['remark'];}?> </textarea>
			</div>
		</div>
		<div class="main_divs col-md-12 mb-12">
		    <div class="append_divs col-md-12 mb-12 row">
		        <div class="col-md-3 mb-3">
        			<div class="form-group">
        				<label>Website <span class="text-danger">*</span></label>
        				<select name="<?php if(empty($order_info)){ echo 'website[]';}else{ echo 'website';}?>" class="js-example-basic-single-one form-control">
                            <option value="">Website</option>
                            <?php foreach($websites as $site){ ?>
                                <option value="<?php echo $site['website']; ?>" <?php if(!empty($order_info) && in_array($site['website'],$order_info)) echo 'selected';?>> <?php echo $site['website']; ?> </option>
                            <?php } ?>
                        </select>
        			</div>
        		</div>
        		<div class="col-md-3 mb-3">
        			<div class="form-group">
        				<label>Proposed Amount <span class="text-danger">*</span></label>
        				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'proposed_amount[]';}else{ echo 'proposed_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['proposed_amount'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-3 mb-3">
        			<div class="form-group">
        				<label>Content Amount </label>
        				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'content_amount[]';}else{ echo 'content_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['content_amount'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-3 mb-3">
        			<div class="form-group">
        				<label>Anchor</label>
				        <textarea class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'website_remark[]';}else{ echo 'website_remark';}?>" id="website_remark"> <?php if(!empty($order_info)){ echo $order_info['website_remark'];}?> </textarea>
        			</div>
        		</div>
        		<h2 class="col-md-12 mb-12">Client Details</h2>
        		<div class="col-md-4 mb-4">
        			<div class="form-group">
        				<label>Amount Received</label>
        				<input type="text" class="form-control" placeholder="" name="client_amount_received" id="client_amount_received" value="<?php if(!empty($order_info) && $order_info['client_amount_received'] != 0){ echo $order_info['client_amount_received'];}else { echo $order_info['proposed_amount']+$order_info['content_amount'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-4 mb-4">
        			<div class="form-group">
        				<label>Date<span class="text-danger">*</span></label>
        				<input type="text" class="form-control datepicker" placeholder="" name="client_amount_received_date" id="client_amount_received_date" value="<?php if(!empty($order_info)){ echo $order_info['client_amount_received_date'];}?>"> 
        			</div>
        		</div> 
        		<div class="col-md-4 mb-4">
        			<div class="form-group">
        			    <label>Received Status <span class="text-danger">*</span></label>
                		<select name="client_amount_received_status" class="js-example-basic-single-one form-control">
                            <option value="Received" <?php if(!empty($order_info['client_amount_received_status']) && $order_info['client_amount_received_status'] == 'Received') echo 'selected';?> > Received </option>
                            <option value="Partially_Received" <?php if(!empty($order_info['client_amount_received_status']) && $order_info['client_amount_received_status'] == 'Partially_Received') echo 'selected';?> > Partially_Received </option>
                            <option value="Not_Received" <?php if(!empty($order_info['client_amount_received_status']) && $order_info['client_amount_received_status'] == 'Not_Received') echo 'selected';?> > Not_Received </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
        			<div class="form-group">
        			    <label>Account Type <span class="text-danger">*</span></label>
                		<select name="client_account_type" class="js-example-basic-single-one form-control">
                		    <option value="Paypal" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'Paypal') echo 'selected';?> > Paypal </option>
                            <option value="Eminence" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'Eminence') echo 'selected';?> > Eminence </option>
                            <option value="Emiac" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'Emiac') echo 'selected';?> > Emiac </option>
                            <option value="Other" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'Other') echo 'selected';?> > Other </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
        			<div class="form-group">
        				<label>Account Name</label>
        				<input type="text" class="form-control" placeholder="" name="client_account_id" id="client_account_id" value="<?php if(!empty($order_info['client_account_id'])){ echo $order_info['client_account_id'];}?>"> 
        			</div>
        		</div>
        		<h2 class="col-md-12 mb-12">Vendor Details</h2>
        		<div class="col-md-6 mb-4">
        			<div class="form-group">
        				<label>Amount Paid</label>
        				<input type="text" class="form-control" placeholder="" name="vendor_payment_amount" id="vendor_payment_amount" value="<?php if(!empty($order_info) && $order_info['vendor_payment_amount'] != 0){ echo $order_info['vendor_payment_amount'];}else{ echo $order_info['site_cost'];}?>"> 
        			</div>
        		</div>
        		<div class="col-md-6 mb-4">
        			<div class="form-group">
        				<label>Date<span class="text-danger">*</span></label>
        				<input type="text" class="form-control datepicker" placeholder="" name="vendor_payment_date" id="vendor_payment_date" value="<?php if(!empty($order_info)){ echo $order_info['vendor_payment_date'];}?>"> 
        			</div>
        		</div> 
        		<div class="col-md-6 mb-4">
        			<div class="form-group">
        			    <label>Payment Status <span class="text-danger">*</span></label>
                		<select name="vendor_payment_status" class="js-example-basic-single-one form-control">
                            <option value="Hold" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Hold') echo 'selected';?> > Hold </option>
                            <option value="Paid" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Paid') echo 'selected';?> > Paid </option>
                            <option value="Partially_Paid" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Partially_Paid') echo 'selected';?> > Partially_Paid </option>
                            <option value="Ready" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Ready') echo 'selected';?> > Ready </option>
                            <option value="Cancel" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Cancel') echo 'selected';?> > Cancel </option>
                        </select>
                    </div>
                </div>
        <div class="col-md-6 mb-4">
			<div class="form-group">
				<label>Transaction ID</label>
				<input type="text" class="form-control" placeholder="" name="vendor_transaction_id" id="vendor_transaction_id" value="<?php if(!empty($order_info['vendor_transaction_id'])){ echo $order_info['vendor_transaction_id'];}?>"> 
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
        <div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Website <span class="text-danger">*</span></label>
				<select name="website[]" class="form-control">
                    <option value="">Website</option>
                    <?php foreach($websites as $site){ ?>
                        <option value="<?php echo $site['website']; ?>" > <?php echo $site['website']; ?> </option>
                    <?php } ?>
                </select>
			</div>
		</div>
		<div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Proposed Amount <span class="text-danger">*</span></label>
				<input type="number" class="form-control" placeholder="" name="proposed_amount[]" id="bank_name" value="<?php if(!empty($site_info)){ echo $site_info['person'];}?>"> 
			</div>
		</div>
		<div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Content Amount </label>
				<input type="number" class="form-control" placeholder="" name="<?php if(empty($order_info)){ echo 'content_amount[]';}else{ echo 'content_amount';}?>" id="" value="<?php if(!empty($order_info)){ echo $order_info['content_amount'];}?>"> 
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

 
  