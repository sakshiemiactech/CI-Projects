<form action="<?php if(!empty($order_info)){ echo base_url('do-update-vendor-payment/'.$order_info['id']);}?>" method="post" class="form-redirect pt-3">
	<div class="row">
	    <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Order Number</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order_info)){ echo $order_info['order_number'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Vendor Name</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order_info)){ echo $order_info['vendor_name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Website</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order_info)){ echo $order_info['website'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Vendor Email</label>
				<input type="text" class="form-control" placeholder="" name="" id="" disabled value="<?php if(!empty($order_info)){ echo $order_info['vendor_email'];}?>"> 
			</div>
		</div>
        <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Amount Paid</label>
				<input type="text" class="form-control" placeholder="" name="vendor_payment_amount" id="vendor_payment_amount" value="<?php if(!empty($order_info) && $order_info['vendor_payment_amount'] != 0){ echo $order_info['vendor_payment_amount'];}else{ echo $order_info['site_cost'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Actual Paid</label>
				<input type="text" class="form-control" placeholder="" name="actual_paid_amount" id="actual_paid_amount" value="<?php if(!empty($order_info) && $order_info['actual_paid_amount'] != 0){ echo $order_info['actual_paid_amount'];}?>"> 
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Date<span class="text-danger">*</span></label>
				<input type="text" class="form-control datepicker" placeholder="" autocomplete="off" name="vendor_payment_date" id="vendor_payment_date" value="<?php if(!empty($order_info)){ echo $order_info['vendor_payment_date'];}?>"> 
			</div>
		</div> 
		<div class="col-md-2 mb-2">
			<div class="form-group" data-select2-id="572">
			    <label>Invoice Status <span class="text-danger">*</span></label>
        		<select name="vendor_invoice_status" class="js-example-basic-single-one form-control select2-hidden-accessible" data-select2-id="10" tabindex="-1" aria-hidden="true">
        		    <option value="Pending" <?php if(empty($order_info['vendor_invoice_status'])) echo 'selected';?> data-select2-id="12"> Pending </option>
        		    <option value="Ask" <?php if(!empty($order_info['vendor_invoice_status']) && $order_info['vendor_invoice_status'] == 'Ask') echo 'selected';?> data-select2-id="152"> Ask </option>
                    <option value="Recieved" <?php if(!empty($order_info['vendor_invoice_status']) && $order_info['vendor_invoice_status'] == 'Recieved') echo 'selected';?> data-select2-id="562"> Recieved </option>
                    <option value="Given" <?php if(!empty($order_info['vendor_invoice_status']) && $order_info['vendor_invoice_status'] == 'Given') echo 'selected';?> data-select2-id="564"> Given </option>
                    <option value="Paid" <?php if(!empty($order_info['vendor_invoice_status']) && $order_info['vendor_invoice_status'] == 'Paid') echo 'selected';?> data-select2-id="564"> Paid </option>
                </select>
            </div>
        </div>
		<div class="col-md-2 mb-2">
			<div class="form-group" data-select2-id="572">
			    <label>Account Type <span class="text-danger">*</span></label>
        		<select name="vendor_account_type" class="js-example-basic-single-one form-control select2-hidden-accessible" data-select2-id="10" tabindex="-1" aria-hidden="true">
        		    <option value="Emiac" <?php if(!empty($order_info['vendor_account_type']) && $order_info['vendor_account_type'] == 'Emiac') echo 'selected';?> data-select2-id="12"> Emiac </option>
        		    <option value="Paypal" <?php if(!empty($order_info['vendor_account_type']) && $order_info['vendor_account_type'] == 'Paypal') echo 'selected';?> data-select2-id="152"> Paypal </option>
                    <option value="Eminence" <?php if(!empty($order_info['vendor_account_type']) && $order_info['vendor_account_type'] == 'Eminence') echo 'selected';?> data-select2-id="562"> Eminence </option>
                    <option value="Other" <?php if(!empty($order_info['vendor_account_type']) && $order_info['vendor_account_type'] == 'Other') echo 'selected';?> data-select2-id="564"> Other </option>
                </select>
            </div>
        </div>
        <div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Paypal ID</label>
				<input type="text" class="form-control" placeholder="" name="paypal_id" id="paypal_id" value="<?php if(!empty($order_info)){ echo $order_info['paypal_id'];}?>"> 
			</div>
		</div>
		<div class="col-md-6 mb-4">
			<div class="form-group">
			    <label>Payment Status <span class="text-danger">*</span></label>
        		<select name="vendor_payment_status" class="js-example-basic-single-one form-control">
                    <option value="Paid" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Paid') echo 'selected';?> > Paid </option>
                    <option value="Unpaid" <?php if(!empty($order_info['vendor_payment_status']) && $order_info['vendor_payment_status'] == 'Unpaid') echo 'selected';?> > Unpaid </option>
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
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>