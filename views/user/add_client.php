<form action="<?php if(!empty($client_info)){ echo base_url('do-update-client/'.$client_info['id']);}else{echo base_url('do-add-client');}?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Full Name" name="name" id="name" value="<?php if(!empty($client_info)){ echo $client_info['name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Mobile Number</label>
				<input type="number" class="form-control" placeholder="phone" name="phone" id="phone" value="<?php if(!empty($client_info)){ echo $client_info['phone'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Email Id<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Email" name="email" id="email" value="<?php if(!empty($client_info)){ echo $client_info['email'];}?>"> 
			</div>
		</div> 
		
		 <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>FB ID </label>
				<input type="text" class="form-control" placeholder="FB ID" name="fb_id" id="fb_id" value="<?php if(!empty($client_info)){ echo $client_info['fb_id'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Niche </label>
				<input type="text" class="form-control" placeholder="Niche" name="site_name" id="site_name" value="<?php if(!empty($client_info)){ echo $client_info['site_name'];}?>"> 
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Contacted From </label>
				<input type="text" class="form-control" placeholder="Contacted From" name="contacted_id" id="contacted_id" value="<?php if(!empty($client_info)){ echo $client_info['contacted_id'];}?>"> 
			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Source </label>
				<input type="text" class="form-control" placeholder="Source" name="source" id="source" value="<?php if(!empty($client_info)){ echo $client_info['source'];}?>"> 
			</div>
		</div>
		
		
	</div>
	<hr>
	
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>