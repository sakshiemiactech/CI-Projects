<div class="row pl-5 mt-4">
    <hr>
	<div class="col-md-4 mb-4">
		<p class="font-bold">Owner Name</p>
		<p><?php echo $site_info['person']; ?></p>
	</div>
	<div class="col-md-4 mb-4">
		<p class="font-bold">Website URL</p>
		<p><?php echo $site_info['website']; ?></p>
	</div>
	<div class="col-md-4 mb-4">
		<p class="font-bold">Category</p>
		<p><?php echo $site_info['niche']; ?></p>
	</div>
    <hr>
	<div class="col-md-4 mb-4">
		<p class="font-bold">Domain Authority</p>
		<p><?php echo $site_info['da']; ?></p>
	</div>
	<div class="col-md-4 mb-4">
		<p class="font-bold">Page Authority</p>
		<p><?php echo $site_info['pa']; ?></p>
	</div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Follow</p>
        <p><?php echo $site_info['follow']; ?></p>
    </div>
    <hr>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Price Category</p>
        <p><?php echo $site_info['price_category']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Price</p>
        <p><?php if(!empty($site_info['price']))echo ' $ '.$site_info['price']; ?></p>
    </div>
    
    
    <div class="col-md-4 mb-4">
        <p class="font-bold">Sailing Price</p>
        <p><?php if(!empty($site_info['sailing_price']))echo ' $ '.$site_info['sailing_price']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Discount</p>
        <p><?php if(!empty($site_info['discount']))echo ' $ '.$site_info['discount']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Contact</p>
        <p><?php echo $site_info['contact']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Contact From</p>
        <p><?php echo $site_info['contact_from']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Web Category</p>
        <p><?php echo $site_info['web_category']; ?></p>
    </div>
    <div class="col-md-4 mb-4">
        <p class="font-bold">Traffic</p>
        <p><?php echo $site_info['traffic']; ?></p>
    </div>
    <hr>
</div>