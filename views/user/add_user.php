<form action="<?php if(!empty($user_infor)){ echo base_url('do-update-user/'.$user_infor['id']);}else{echo base_url('do-add-user');}?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Full Name" name="name" id="name" value="<?php if(!empty($user_infor)){ echo $user_infor['name'];}?>"> 
			</div>
		</div>
		
		<div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Email Id<span class="text-danger">*</span></label>
				<input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php if(!empty($user_infor)){ echo $user_infor['email'];}?>"> 
			</div>
		</div> 
		<div class="col-md-3 mb-3">
			<div class="form-group">
				<label>Password <span class="text-danger">*</span></label>
				<input type="password"  class="form-control" placeholder="Password" name="password" id="password" value="<?php if(!empty($user_infor)){ echo $user_infor['password'];}?>">
			</div>
		</div>
		 
		<div class="col-md-3 mb-3">
			<div class="form-group">
			   <label>User Role <span class="text-danger">*</span></label>
				<select class="form-control" id="role" name="role">    
				    <option value="Admin" <?php if(!empty($user_infor) && $user_infor['role'] == 'Admin'){ echo 'selected';}?> >Admin</option>
					<option value="Salesperson" <?php if(!empty($user_infor) && $user_infor['role'] == 'Salesperson'){ echo 'selected';}?> >Salesperson</option>
					<option value="Operator" <?php if(!empty($user_infor) && $user_infor['role'] == 'Operator'){ echo 'selected';}?> >Operator</option>
					<option value="Vendor" <?php if(!empty($user_infor) && $user_infor['role'] == 'Vendor'){ echo 'selected';}?> >Vendor</option>
					<option value="Manage" <?php if(!empty($user_infor) && $user_infor['role'] == 'Manage'){ echo 'selected';}?> >Manage</option>
					<option value="Suspend" <?php if(!empty($user_infor) && $user_infor['role'] == 'Suspend'){ echo 'selected';}?> >Suspend</option>
				</select>
			</div>
		</div>
	</div>
	<hr>
	<?php /* ?>
	<div class="row">
	    <h4 class="text-center">PERMISSIONS</h4>
	    <div class="col-md-3 mb-3">
			<div class="form-group">
			      
            	 <ul class="list-inline mb-0">
            	     <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
            	        <input type="checkbox" class=""name="report" id="report">
                        <a href="#" class="nav-link dropdown-toggle arrow-none waves-effect nav-user text-center" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            Report
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                           <p><input type="checkbox" value="yes" class=""name="total_sale" id="total_sale">TOTAL SALE</p>
                           <p><input type="checkbox" value="yes" class=""name="payment_received" id="payment_received">PAYMENT RECEIVED</p>
                           <p><input type="checkbox" value="yes" class=""name="payment_not_received" id="payment_not_received">PAYMENT NOT RECEIVED</p>
                           <p><input type="checkbox" value="yes" class=""name="total_vendor_payment" id="total_vendor_payment">TOTAL VENDOR PAYMENT</p>
                           <p><input type="checkbox" value="yes" class=""name="vendor_payment_done" id="vendor_payment_done">VENDOR PAYMENT DONE</p>
                           <p><input type="checkbox" value="yes" class=""name="vendor_payment_remaining" id="vendor_payment_remaining">VENDOR PAYMENT REMAINING</p>
                           <p><input type="checkbox" value="yes" class=""name="profit_margin" id="profit_margin">PROFIT MARGIN</p>
                           <p><input type="checkbox" value="yes" class=""name="cancel_order" id="cancel_order">CANCEL ORDER</p>
                           <p><input type="checkbox" value="yes" class=""name="not_publish" id="not_publish">NOT PUBLISHED</p>
                           <p><input type="checkbox" value="yes" class=""name="given_order" id="given_order">GIVEN ORDER</p>
                        </div>
                    </li>
            	 </ul>
            </div>
        </div>
	</div>
	<?php */ ?>
	
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>