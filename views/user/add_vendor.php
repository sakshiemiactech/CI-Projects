<form action="<?php if(!empty($vendor_info)){ echo base_url('do-update-vendor/'.$vendor_info['id']);}else{echo base_url('do-add-vendor');}?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="name" id="name" value="<?php if(!empty($vendor_info)){ echo $vendor_info['name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Mobile Number<span class="text-danger">*</span></label>
				<input type="number" class="form-control" placeholder="" name="phone" id="phone" value="<?php if(!empty($vendor_info)){ echo $vendor_info['phone'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Email Id<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="email" id="email" value="<?php if(!empty($vendor_info)){ echo $vendor_info['email'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Contacted From <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="contacted_from" id="contacted_from" value="<?php if(!empty($vendor_info)){ echo $vendor_info['contacted_from'];}?>"> 
			</div>
		</div>
		 <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Vendor Bank Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="vendor_bank_name" id="vendor_bank_name" value="<?php if(!empty($vendor_info)){ echo $vendor_info['vendor_bank_name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Bank Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="bank_name" id="bank_name" value="<?php if(!empty($vendor_info)){ echo $vendor_info['bank_name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Account Number <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="account_number" id="account_number" value="<?php if(!empty($vendor_info)){ echo $vendor_info['account_number'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>IFSC Code <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="bank_ifsc" id="bank_ifsc" value="<?php if(!empty($vendor_info)){ echo $vendor_info['bank_ifsc'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Paypal ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="paypal_id" id="paypal_id" value="<?php if(!empty($vendor_info)){ echo $vendor_info['paypal_id'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Skype ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="skype_id" id="skype_id" value="<?php if(!empty($vendor_info)){ echo $vendor_info['skype_id'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>UPI ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="" name="upi_id" id="upi_id" value="<?php if(!empty($vendor_info)){ echo $vendor_info['upi_id'];}?>"> 
			</div>
		</div>
		
	</div>
	<hr>
	
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>