<form action="<?php if(!empty($order_info)){ echo base_url('do-update-payment/'.$order_info['id']);}?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Order Number </label>
				<input type="text" disabled class="form-control" placeholder="" name="order_number" id="order_number" readonly value="<?php if(!empty($order_info)){ echo $order_info['order_number'];}elseif(!empty($last_id)){ echo $last_id['id']+1;}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
		    <label>Client Name </label>
            <input type="text" disabled class="form-control" placeholder="" value="<?php if(!empty($order_info)){ echo $order_info['clients_name'];}?>"> 
        </div>
        <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Client Email ID</label>
				<input type="text" class="form-control client_email" disabled placeholder="" name="client_email" id="client_email" value="<?php if(!empty($order_info)){ echo $order_info['client_email'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Published URL</label>
				<input type="text" class="form-control client_email" disabled placeholder="" name="client_email" id="client_email" value="<?php if(!empty($order_info)){ echo $order_info['publish_url'];}?>"> 
			</div>
		</div>
        <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Amount Received</label>
				<input type="text" class="form-control" placeholder="" name="client_amount_received" id="client_amount_received" value="<?php if(!empty($order_info) && $order_info['client_amount_received'] != 0){ echo $order_info['client_amount_received'];}else { echo $order_info['proposed_amount']+$order_info['content_amount'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Actual Amount Received</label>
				<input type="text" class="form-control" placeholder="" name="actual_received_amount" id="actual_received_amount" value="<?php if(!empty($order_info) && $order_info['actual_received_amount'] != 0){ echo $order_info['actual_received_amount'];}?>"> 
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
                    <option value="shivam_upwork" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'shivam_upwork') echo 'selected';?> > Shivam Upwork </option>
                    <option value="divya_upwork" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'divya_upwork') echo 'selected';?> > Divya Upwork </option>
                    <option value="yogesh_upwork" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'yogesh_upwork') echo 'selected';?> > Yogesh Upwork </option>
                    <option value="company_upwork" <?php if(!empty($order_info['client_account_type']) && $order_info['client_account_type'] == 'company_upwork') echo 'selected';?> > Company Upwork </option>
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
		
		
		 
		
	</div>
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>