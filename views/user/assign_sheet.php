
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
<form class="form-horizontal" action="<?php echo base_url('functions'); ?>" method="post" name="upload_excel" enctype="multipart/form-data">
    <div class="row mt-2 mb-5">

        <div class="col-md-2">

            <div class="">
                <a class="btn btn-success" href="<?php echo base_url('imports/tbl_sites_format.csv'); ?>">Sample CSV</a>
            </div>
        </div>
        <!-- File Button -->
        <div class="col-md-2" style="margin-left: -53px;margin-right: 28px;">

            <div class="">
                <input type="file" name="file" id="file" class="input-large" required="required">
            </div>
        </div>

        <!-- Button -->
        <div class="col-md-2">

            <div class="">
                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import CSV</button>
            </div>
        </div>
        <div class="col-md-2">
            <select class="form-control" id="sel1">
                <option disabled="">Select Range</option>
                <?php $end=50; for($i=1;$i<=$total_rows;){?>
                    <option value="<?php echo $i; ?>"><?php echo $i.'-'.$end;?></option>
                <?php $i = $i+50;$end = $end+50;} ?>
            </select>
        </div>
        <div class="col-md-2">
            <div class="">
                <button type="button" data-url="<?php echo base_url('moz_data'); ?>" class="btn btn-secondary turl">DA, IP Update</button>
            </div>
        </div>
        <div class="col-md-2">
            <h3 style="margin: 0px 0;"><span class="badge badge-info">Total Rows <?php echo $total_rows; ?></span></h3>
        </div>
    </div>
</form>
<form class="form-horizontal" action="<?php echo base_url('assign'); ?>" method="post">
<div class="row mt-2 mb-1">
    <div class="col-md-1">
        <label for="exampleInputEmail1">Fr. C. Price</label>
        <input type="text" name="start_price" class="form-control" placeholder="From Price" value="<?php if(!empty($start_price))echo $start_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To C. Price</label>
        <input type="text" name="end_price" class="form-control" placeholder="To Price" value="<?php if(!empty($end_price))echo $end_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">Fr. S. Price</label>
        <input type="text" name="start_selling_price" class="form-control" placeholder="From Price" value="<?php if(!empty($start_selling_price))echo $start_selling_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To S. Price</label>
        <input type="text" name="end_selling_price" class="form-control" placeholder="To Price" value="<?php if(!empty($end_selling_price))echo $end_selling_price;?>">
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
    
    <div class="col-md-1">
        <label for="exampleInputEmail1">Country</label>
        <input type="text" name="vendor_country" class="form-control" id=""  placeholder="Coun." value="<?php if(!empty($vendor_country))echo $vendor_country;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">Cont. ID</label>
        <input type="text" name="contact_from_id" class="form-control" id=""  placeholder="Con. ID" value="<?php if(!empty($contact_from_id))echo $contact_from_id;?>">
    </div>
</div>
<div class="row mt-3 mb-1">
    <div class="col-md-1">
        <select name="price_category[]" class="js-example-basic-single-one form-control" multiple="multiple">
            <option value="">Select price category</option>
            <?php print_r($price_category); ?>
            <?php foreach($price_category1 as $value){ ?>
                <option value="<?php echo $value['price_category']; ?>" <?php if(!empty($price_category) && in_array($value['price_category'],$price_category)) echo 'selected';?> > <?php echo $value['price_category']; ?> </option>
            <?php } ?>
            
        </select>
    </div>
    <div class="col-md-2">
        <select name="per_name" class="js-example-basic-single-one form-control">
            <option value="">Select Name</option>
                <?php foreach($names as $name){ ?>
                    <option value="<?php echo $name['person']; ?>" <?php if(!empty($per_name) && $name['person'] == $per_name) echo 'selected';?> > <?php echo $name['person']; ?> </option>
                <?php } ?>
        </select>
    </div>
    <?php /*<div class="col-md-2">
        <select name="per_category[]" class="js-example-basic-single-one form-control" multiple="multiple">
            <option value="">Select Niche</option>
                <?php foreach($category as $value){ ?>
                    <option value="<?php echo $value['niche']; ?>" <?php if(!empty($per_category) && in_array($value['niche'],$per_category)) echo 'selected';?> > <?php echo $value['niche']; ?> </option>
                <?php } ?>
        </select>
    </div>*/ ?>
     <div class="col-md-1">
        <div class="text-center">
            <input type="checkbox" name="niche_choice" value="Yes" <?php if(!empty($niche_choice)){ echo 'checked';} ?>>Single Niche
        </div>
    </div>
    <div class="col-md-2">
        <select name="per_category" class="js-example-basic-single-one form-control">
            <option value="">Select Niche</option>
                <?php foreach($category as $value){ ?>
                    <option value="<?php echo $value['niche']; ?>" <?php if(!empty($per_category) && $per_category == $value['niche']) echo 'selected';?> > <?php echo $value['niche']; ?> </option>
                <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="web_category" class="js-example-basic-single-one form-control">
            <option value="">Select Web Category</option>
            <option value="Real" <?php if(!empty($web_category) && $web_category == 'Real') echo 'selected';?>>Real</option>
            <option value="Pbn" <?php if(!empty($web_category) && $web_category == 'Pbn') echo 'selected';?>>PBN</option>
            <option value="Community" <?php if(!empty($web_category) && $web_category == 'Community') echo 'selected';?>>COMMUNITY</option>
        </select>
    </div>
    
    
    <div class="col-md-1">
        <div class="text-center">
            <button type="submit" class="btn btn-secondary form-control">Filter</button>
        </div>
    </div>
    <div class="col-md-1">
        <div class="">
            <a href="<?php echo base_url('assign'); ?>" class="btn btn-info form-control"><i class="ti-reload"></i></a>
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <a href="<?php echo base_url('assign/all'); ?>" class="btn btn-primary form-control">All</a>
        </div>
    </div>
</div>

</form>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Website</th>
            <th scope="col">Niche</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">Cost Price</th>
             <th scope="col">Selling Price</th>
             <th scope="col">Remark</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
            <th scope="col">Pr. Cat.</th>
            <th scope="col">Price With Content</th>
            <th scope="col">Discount</th>
            <th scope="col">Cas./Adu. CP</th>
            <th scope="col">Traffic</th>
            <th scope="col">Web Category</th>
            <th scope="col">Person</th>
            <th scope="col">Contact</th>
            <th scope="col">Contact From</th>
            <th scope="col">Follow</th>
            <th scope="col">Contected From ID</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Vendor's Country</th>
             <th scope="col">Sample URL</th>
            <th scope="col">Bank Details</th>
            <th scope="col">Added By</th>
            <th scope="col">Added Date</th>
            <th scope="col">IP</th>
            <th scope="col">Country</th>
            <th scope="col">Link Ins. Cost</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr onassignlclick="window.location.href='<?php echo base_url('add-site/'.$value['id']); ?>'" style="cursor:pointer; <?php if($value['web_category']=='Community') echo 'color:red'; ?>">
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['website']; ?></td>
            <td><?php echo $value['niche']; ?></td>
            <td><?php echo $value['da']; ?></td>
            <td><?php echo $value['pa']; ?></td>
            
           <td><?php if(!empty($value['price'])){echo '$ '.$value['price'];}else{ echo $value['price']; } ?></td>
            <td><?php if(!empty($value['sailing_price'])){echo '$ '.$value['sailing_price'];}else{ echo $value['sailing_price']; } ?></td>
            <td><?php echo wordwrap($value['remark'],20,"<br>\n"); ?></td>
             <td><?php echo $value['dr']; ?></td>
            <td><?php echo $value['spam_score']; ?></td>
            <td><?php echo $value['price_category']; ?></td>
            <td><?php if(!empty($value['sailing_price'])){echo '$ '.($value['sailing_price']+10);}else{ echo '$'.($value['sailing_price']+10); } ?></td>
            <td><?php if(!empty($value['discount'])){echo '$ '.$value['discount'];}else{ echo $value['discount']; } ?></td>
            <td><?php if(!empty($value['casino_adult'])){echo '$ '.$value['casino_adult'];} ?></td>
            <td><?php echo $value['traffic']; ?></td>
            <td><?php echo $value['web_category']; ?></td>
            <td><?php echo $value['vendor_name']; ?></td>
            <td><a target="_blank" href="<?php echo 'https://'.$value['vendor_email']; ?>"><?php echo substr($value['vendor_email'], 0, 40); ?><?php /*$link = substr($value['contact'],0,30);echo $value['vendor_email'];*/ ?></a></td>
            <td><?php echo $value['vendor_contact']; ?></td>
            <td><?php echo $value['follow']; ?></td>
            <!--<td><?php echo $value['alexa_country']; ?></td>
            <td><?php echo $value['alexa_country_rank']; ?></td>
            <td><?php echo $value['alexa_world']; ?></td>-->
            <td><?php echo $value['contact_from_id']; ?></td>
            <td><?php echo $value['phone_numbers']; ?></td>
            <td><?php echo $value['vendor_country']; ?></td>
            <td><a target="_blank" href="<?php echo $value['sample_url']; ?>"><?php echo substr($value['sample_url'], 0, 20); ?></a></td>
            <td><?php echo wordwrap($value['bank_details'],20,"<br>\n"); ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td><?php echo $value['timestamp']; ?></td>
            <td><?php echo $value['web_ip']; ?></td>
            <td><?php echo $value['web_country']; ?></td>
            <td><?php echo $value['link_insertion_cost']; ?></td>
            <td><?php echo $value['tat']; ?></td>
            <td><?php echo $value['social_media_posting']; ?></td>
            
            <td>
                <a href="<?php echo base_url('site-info/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">
                    <span class="ti-eye"></span>
                </a>
                
                <a href="<?php echo base_url('add-site/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                
                <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_sites'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                    <span class="ti-trash"></span>
                </button>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>




