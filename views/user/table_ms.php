
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

<form class="form-horizontal" action="<?php echo base_url('ms'); ?>" method="post">
<div class="row mt-2 mb-1">
    <div class="col-md-1">
        <label for="exampleInputEmail1">Fr. C. Price</label>
        <input type="text" name="start_price" class="form-control" placeholder="From Price" value="<?php if(!empty($start_price))echo $start_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To C. Price</label>
        <input type="text" name="end_price" class="form-control" placeholder="To Price" value="<?php if(!empty($end_price))echo $end_price;?>">
    </div>
    <?php /*<div class="col-md-1">
        <label for="exampleInputEmail1">Fr. S. Price</label>
        <input type="text" name="start_selling_price" class="form-control" placeholder="From Price" value="<?php if(!empty($start_selling_price))echo $start_selling_price;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To S. Price</label>
        <input type="text" name="end_selling_price" class="form-control" placeholder="To Price" value="<?php if(!empty($end_selling_price))echo $end_selling_price;?>">
    </div> */ ?>
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
    <?php /* 
    <div class="col-md-1">
        <label for="exampleInputEmail1">Cont. ID</label>
        <input type="text" name="contact_from_id" class="form-control" id=""  placeholder="Con. ID" value="<?php if(!empty($contact_from_id))echo $contact_from_id;?>">
    </div>*/ ?>
</div>
<div class="row mt-3 mb-1">
    <div class="col-md-2">
        <select name="per_name" class="js-example-basic-single-one form-control">
            <option value="">Select Name</option>
                <?php foreach($names as $name){ ?>
                    <option value="<?php echo $name['vendor_name']; ?>" <?php if(!empty($per_name) && $name['vendor_name'] == $per_name) echo 'selected';?> > <?php echo $name['vendor_name']; ?> </option>
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
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Website</th>
             <th scope="col">Cost Price</th>
            <th scope="col">Niche</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">Ahref DR</th>
            <th scope="col">Ahref Traffic</th>
            <th scope="col">Semrush Traffic</th>
            <th scope="col">Vendor Name</th>
            <th scope="col">Vendor Email</th>
            <th scope="col">Follow</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr style="cursor:pointer">
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['sitename']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td><?php echo $value['category']; ?></td>
            <td><?php echo $value['da']; ?></td>
            <td><?php echo $value['pa']; ?></td>
            <td><?php echo $value['ahref_dr']; ?></td>
            <td><?php echo $value['ahref_traffic']; ?></td>
            <td><?php echo $value['semrush']; ?></td>
            <td><?php echo $value['vendor_name']; ?></td>
            <td><?php echo $value['vendor_email']; ?></td>
            <td><?php echo $value['backlink']; ?></td>
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




