<form action="<?php if(!empty($site_info)){ echo base_url('do-update-site/'.$site_info['id']);}else{echo base_url('do-add-site');}?>" method="post" class="form-redirect pt-3">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Vendor ID <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Vendor ID" name="person_id" id="person_id" value="<?php if(!empty($site_info)){ echo $site_info['person_id'];}elseif(!empty($vendor_id)){ echo $vendor_id['id'];}?>"> 
			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Website URL<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Website URL" name="website" id="website" value="<?php if(!empty($site_info)){ echo $site_info['website'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Niche <span class="text-danger">*</span></label>
				<input type="text"  class="form-control" placeholder="Category" name="niche" id="niche" value="<?php if(!empty($site_info)){ echo $site_info['niche'];}?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Site Category <span class="text-danger">*</span></label>
				<input type="text"  class="form-control" placeholder="Site Category" name="site_category" id="site_category" value="<?php if(!empty($site_info)){ echo $site_info['site_category'];}?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Main Category <span class="text-danger">*</span></label>
				<input type="text"  class="form-control" placeholder="Main Category" name="main_category" id="main_category" value="<?php if(!empty($site_info)){ echo $site_info['main_category'];}?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>DA <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Domain Authority" name="da" id="da" value="<?php if(!empty($site_info)){ echo $site_info['da'];}?>"> 
			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>PA <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Page Authority" name="pa" id="pa" value="<?php if(!empty($site_info)){ echo $site_info['pa'];}?>"> 
			</div>
		</div> 
		<div class="col-md-4 mb-4">
			<div class="form-group">
			   <label>Follow <span class="text-danger">*</span></label>
				<select class="form-control" id="follow" name="follow">    
					<option value="Do-follow" <?php if(!empty($site_info) && $site_info['follow'] == 'Do-follow'){ echo 'selected';}?> >Do-follow</option>
					<option value="No-follow" <?php if(!empty($site_info) && $site_info['follow'] == 'No-follow'){ echo 'selected';}?> >No-follow</option>
				</select>
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
			   <label>Price Category <span class="text-danger">*</span></label>
				<select class="form-control" id="price_category" name="price_category">    
					<option value="Paid" <?php if(!empty($site_info) && $site_info['price_category'] == 'Paid'){ echo 'selected';}?> >Paid</option>
					<option value="Free" <?php if(!empty($site_info) && $site_info['price_category'] == 'Free'){ echo 'selected';}?> >Free</option>
					<option value="Exchange" <?php if(!empty($site_info) && $site_info['price_category'] == 'Exchange'){ echo 'selected';}?> >Exchange</option>
				</select>
			</div>
		</div>
		
	   
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Traffic <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Traffic" name="traffic" id="traffic" value="<?php if(!empty($site_info)){ echo $site_info['traffic']; }?>">
			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
			   <label>Web Category <span class="text-danger">*</span></label>
				<select class="form-control" id="price_category" name="web_category">    
					<option value="Real" <?php if(!empty($site_info) && $site_info['web_category'] == 'Real'){ echo 'selected';}?> >Real</option>
					<option value="Pbn" <?php if(!empty($site_info) && $site_info['web_category'] == 'Pbn'){ echo 'selected';}?> >PBN</option>
					<option value="Community" <?php if(!empty($site_info) && $site_info['web_category'] == 'Community'){ echo 'selected';}?> >Community</option>
					<option value="Lost Sites" <?php if(!empty($site_info) && $site_info['web_category'] == 'Lost Sites'){ echo 'selected';}?> >Lost Sites</option>
					<option value="Agency" <?php if(!empty($site_info) && $site_info['web_category'] == 'Agency'){ echo 'selected';}?> >Agency</option>
<option value="Admin Agency" <?php if(!empty($site_info) && $site_info['web_category'] == 'Admin Agency'){ echo 'selected';}?> >Admin Agency</option>
<option value="Pure" <?php if(!empty($site_info) && $site_info['web_category'] == 'Pure'){ echo 'selected';}?> >Pure</option>
					<option value="Extra" <?php if(!empty($site_info) && $site_info['web_category'] == 'Extra'){ echo 'selected';}?> >Extra</option>
					<option value="Both" <?php if(!empty($site_info) && $site_info['web_category'] == 'Both'){ echo 'selected';}?> >Both</option>
<option value="magazine" <?php if(!empty($site_info) && $site_info['web_category'] == 'magazine'){ echo 'selected';}?> >magazine</option>
<option value="PR" <?php if(!empty($site_info) && $site_info['web_category'] == 'PR'){ echo 'selected';}?> >PR</option>
				<option value="SHANTEL" <?php if(!empty($site_info) && $site_info['web_category'] == 'SHANTEL'){ echo 'selected';}?> >SHANTEL</option>
				</select>

			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Cost Price <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Cost Price" id="price" name="price" value="<?php if(!empty($site_info)){ echo $site_info['price']; }?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Sailing Price<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Sailing Price" id="sailing_price" name="sailing_price" value="<?php if(!empty($site_info)){ echo $site_info['sailing_price']; }?>">
			</div>
		</div>
	   
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Discount <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Discount" name="discount" id="discount" value="<?php if(!empty($site_info)){ echo $site_info['discount']; }?>">
			</div>
		</div>
		
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Contact <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="DR" id="dr" name="dr" value="<?php if(!empty($site_info)){ echo $site_info['dr']; }?>">
			</div>
		</div>
	   
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Contact From <span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Spam Score" name="spam_score" id="spam_score" value="<?php if(!empty($site_info)){ echo $site_info['spam_score']; }?>">
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Casino CP<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Casino Cost Price" name="casino_adult" id="casino_adult" value="<?php if(!empty($site_info)){ echo $site_info['casino_adult']; }?>">
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="form-group">
				<label>Adult CP<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="Adult Cost Price" name="adult" id="adult" value="<?php if(!empty($site_info)){ echo $site_info['adult']; }?>">
			</div>
		</div>
	    <div class="col-md-4 mb-4">
			<div class="form-group">
				<label>CBD Price<span class="text-danger">*</span></label>
				<input type="text" class="form-control" placeholder="CBD Price" name="cbd_price" id="cbd_price" value="<?php if(!empty($site_info)){ echo $site_info['cbd_price']; }?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Link Insertion Cost<span class="text-danger"></span></label>
				<input type="text" class="form-control" placeholder="Link Insertion Cost" name="link_insertion_cost" id="link_insertion_cost" value="<?php if(!empty($site_info)){ echo $site_info['link_insertion_cost']; }?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>TAT <span class="text-danger"></span></label>
				<input type="text" class="form-control" placeholder="Turn Around Time" name="tat" id="tat" value="<?php if(!empty($site_info)){ echo $site_info['tat']; }?>">
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
			   <label>Social Media Posting <span class="text-danger">*</span></label>
				<select class="form-control" id="social_media_posting" name="social_media_posting">    
					<option value="Yes" <?php if(!empty($site_info) && $site_info['web_category'] == 'Yes'){ echo 'selected';}?> >Yes</option>
					<option value="No" <?php if(!empty($site_info) && $site_info['web_category'] == 'No'){ echo 'selected';}?> >No</option>
				</select>
			</div>
		</div>
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Social Media Posting Price <span class="text-danger"></span></label>
				<input type="text" class="form-control" placeholder="Social Media Posting Price" name="sompc" id="sompc" value="<?php if(!empty($site_info)){ echo $site_info['sompc']; }?>">
			</div>
		</div><div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Banner Price <span class="text-danger"></span></label>
				<input type="text" class="form-control" placeholder="Banner Price" name="banner_image_price" id="banner_image_price" value="<?php if(!empty($site_info)){ echo $site_info['banner_image_price']; }?>">
			</div>
		</div>
			<?php /* 
		<div class="col-md-4 mb-4">
			<div class="form-group">
				<label>Sample URL <span class="text-danger"></span></label>
				<input type="text" class="form-control" placeholder="Sample URL" name="sample_url" id="sample_url" value="<?php if(!empty($site_info)){ echo $site_info['sample_url']; }?>">
			</div>
		</div>
		<div class="col-md-6 mb-6">
			<div class="form-group">
				<label>Bank Detail <span class="text-danger"></span></label>
				<textarea row="7" class="form-control" placeholder="Bank Details" name="bank_details" id="bank_details"><?php if(!empty($site_info)){ echo $site_info['bank_details']; }?></textarea>
			</div>
		</div>
		*/ ?>
		 <div class="col-md-6 mb-6">
			<div class="form-group">
				<label>Remark <span class="text-danger">*</span></label>
				<textarea row="7" class="form-control" placeholder="Remark" name="remark" id="remark"><?php if(!empty($site_info)){ echo $site_info['remark']; }?></textarea>
			</div>
		</div>
	</div>
	<hr>
	
	<div class="text-center">
		<button class="btn btn-primary" type="submit">Save Form</button>
	</div>
</form>