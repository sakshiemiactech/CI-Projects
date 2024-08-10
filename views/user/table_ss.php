
<!-- end page title end breadcrumb -->
<style type="text/css">
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none;
}

</style>

<?php /* ?><form class="form-horizontal" action="<?php echo base_url('ms'); ?>" method="post">
<div class="row mt-2 mb-1">
    <div class="col-md-1">
        <label for="exampleInputEmail1">Fr. C. Price</label>
        <input type="text" name="start_price" class="form-control" placeholder="From Price" value="<?php if(!empty($start_price))echo $start_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To C. Price</label>
        <input type="text" name="end_price" class="form-control" placeholder="To Price" value="<?php if(!empty($end_price))echo $end_price;?>">
    </div>
    
    <div class="col-md-2">
        <label for="exampleInputEmail1">From Traffic</label>
        <input type="text" name="from_traffic" class="form-control" placeholder="From Traffic" value="<?php if(!empty($from_traffic))echo $from_traffic;?>">
    </div>
    <div class="col-md-2">
        <label for="exampleInputEmail1">To Traffic</label>
        <input type="text" name="to_traffic" class="form-control" placeholder="To Traffic" value="<?php if(!empty($to_traffic))echo $to_traffic;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">From DA</label>
        <input type="text" name="start_da" class="form-control" id=""  placeholder="Fr. DA" value="<?php if(!empty($start_da))echo $start_da;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To DA</label>
        <input type="text" name="end_da" class="form-control" id=""  placeholder="To DA" value="<?php if(!empty($end_da))echo $end_da;?>">
    </div>
    
    <div class="col-md-2">
        <label for="exampleInputEmail1">Search</label>
        <input type="text" name="vendor_country" class="form-control" id=""  placeholder="Search" value="<?php if(!empty($vendor_country))echo $vendor_country;?>">
    </div>

    <div class="col-md-1">
        <label for="exampleInputEmail1">Cont. ID</label>
        <input type="text" name="contact_from_id" class="form-control" id=""  placeholder="Con. ID" value="<?php if(!empty($contact_from_id))echo $contact_from_id;?>">
    </div>
</div>
<div class="row mt-3 mb-1">
    <div class="col-md-2">
        <select name="per_category[]" class="js-example-basic-single-one form-control" multiple="multiple">
            <option value="">Select Niche</option>
                <?php foreach($category as $value){ ?>
                    <option value="<?php echo $value['niche']; ?>" <?php if(!empty($per_category) && in_array($value['niche'],$per_category)) echo 'selected';?> > <?php echo $value['niche']; ?> </option>
                <?php } ?>
        </select>
    </div>
     <div class="col-md-1">
        <div class="text-center">
            <input type="checkbox" name="niche_choice" value="Yes" <?php if(!empty($niche_choice)){ echo 'checked';} ?>>Single Niche
        </div>
    </div>
    <div class="col-md-2">
        <select name="per_category" class="js-example-basic-single-one form-control">
            <option value="">Select Niche</option>
                <?php foreach($category as $value){ ?>
                    <option value="<?php echo $value['category']; ?>" <?php if(!empty($per_category) && $per_category == $value['category']) echo 'selected';?> > <?php echo $value['category']; ?> </option>
                <?php } ?>
        </select>
    </div>
    
    
    <div class="col-md-1">
        <div class="text-center">
            <input type="checkbox" name="duplicate" value="Yes" <?php if(!empty($duplicate)){ echo 'checked';} ?>>Show Duplicate
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <button type="submit" class="btn btn-secondary form-control">Filter</button>
        </div>
    </div>
    <div class="col-md-1">
        <div class="">
            <a href="<?php echo base_url('ms'); ?>" class="btn btn-info form-control"><i class="ti-reload"></i></a>
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <a href="<?php echo base_url('ms'); ?>" class="btn btn-primary form-control">All</a>
        </div>
    </div>
</div>

</form>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div> 
<?php */ ?>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Website</th>
            <th scope="col">Niche</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Selling Price</th>
            <th scope="col">Traffic</th>
            <th scope="col">Follow</th>
            <th scope="col">Semrush Tr.</th>
            <th scope="col">SimilarWeb Tr.</th>
            <th scope="col">1st</th>
            <th scope="col">2nd</th>
            <th scope="col">3rd</th>
            <th scope="col">4th</th>
            <th scope="col">Person</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
            <th scope="col">IP</th>
            <th scope="col">Client Name</th>
            <th scope="col">Sent By</th>
            <th scope="col">Contacted From</th>
            <th scope="col">Date</th>
            
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr style="cursor:pointer">
            <td scope="row"><?php echo $key+1; ?></td>
            <td><?php echo $value['website']; ?></td>
            <td><?php echo $value['niche']; ?></td>
            <td><?php echo $value['da']; ?></td>
            <td><?php echo $value['pa']; ?></td>
            <td><?php echo $value['dr']; ?></td>
            <td><?php echo $value['spam_score']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td><?php echo $value['selling_price']; ?></td>
            <td><?php echo $value['traffic']; ?></td>
            <td><?php echo $value['follow']; ?></td>
            <td><?php echo $value['semrush_traffic']; ?></td>
            <td><?php echo $value['similarweb_traffic']; ?></td>
            <td><?php echo $value['first']; ?></td>
            <td><?php echo $value['second']; ?></td>
            <td><?php echo $value['third']; ?></td>
            <td><?php echo $value['four']; ?></td>
            <td><?php echo $value['vendor']; ?></td>
            <td><?php echo $value['tat']; ?></td>
            <td><?php echo $value['social_media']; ?></td>
            <td><?php echo $value['ip']; ?></td>
            <td><?php echo $value['client_name']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td><?php echo $value['communication_id']; ?></td>
            <td><?php echo date("d-m-Y",$value['timestamp']); ?></td>
        </tr>
        <?php }} ?>
    </tbody>
</table>




