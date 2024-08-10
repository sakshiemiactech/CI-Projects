
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

<form class="form-horizontal" action="<?php echo base_url('db'); ?>" method="post" style="display:none">
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
        <input type="text" name="start_da" class="form-control" id="start_da"  placeholder="Fr. DA" value="<?php if(!empty($start_da))echo $start_da;?>">
    </div>
    <div class="col-md-1">
        <label for="exampleInputEmail1">To DA</label>
        <input type="text" name="end_da" class="form-control" id="end_da"  placeholder="To DA" value="<?php if(!empty($end_da))echo $end_da;?>">
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
    <div class="col-md-1">
        <div class="text-center">
            <input type="checkbox" name="agency" value="Yes" <?php if(isset($agency) && $agency == 'no_agency' ){ echo '';}else{ echo 'checked'; } ?>>Agency
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
            <input type="checkbox" name="duplicate" value="Yes" <?php if(!empty($duplicate)){ echo 'checked';} ?>>Show Duplicate
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-secondary form-control">Filter</button>
        </div>
    </div>
    <div class="col-md-1">
        <div class="">
            <a href="<?php echo base_url('db'); ?>" class="btn btn-info form-control"><i class="ti-reload"></i></a>
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <a href="<?php echo base_url('db/all'); ?>" class="btn btn-primary form-control">All</a>
        </div>
    </div>
</div>

</form>
<label>INSTRUCTIONS</label></br>
<label>1. For DA, Cost Price and Traffic Range search like da from 30 to 50 then put 30,50@ </label></br>
<label>2. For single Niche search like Health then put Health@ </label></br>
<label>3. For searching without community and agency type no in the web category  </label>
<textarea rows="1" cols="20"></textarea>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div>
       
<table class="table table-striped aid_table1 exmtbl" id="aid_table1">
    <thead>
        <tr>
           
            <th scope="col">Website</th>
            <th scope="col">Niche</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">Web Category</th>
            <th scope="col">Age</th>
            <th scope="col">Price</th>
            <th scope="col">note</th>
            <th scope="col">Vendor</th>
            <th scope="col">Contact</th>
            <th scope="col">Contact From</th>
            <th scope="col">Follow</th>
             <th scope="col">Spam Score</th>
             <th scope="col">Sample URl</th>
             <th scope="col">Link Price</th>
            <th scope="col">Min Words</th>
            <th scope="col">Traffic2</th>
            <th scope="col">Ahref Traffic</th>
            <th scope="col">Related Price</th>
            <th scope="col">links</th> 
            <th scope="col">Site Description</th>
            <th scope="col">Casino CBD</th>
             <th scope="col">TAT</th>
            <th scope="col">RD</th>
            <th scope="col">AR</th>
            <th scope="col">DR</th>
            <th scope="col">CF</th>
            <th scope="col">TF</th>
            <th scope="col">Indexed</th>
           
            
           
        </tr>
    </thead>
    <tbody>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
            
             
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
       <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td><td>Good</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>25</td><td></td>
             
            
            
            <td>12455</td>
            <td>Do-Follow</td>
             <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
            <td>Admin</td>
            <td></td>
            <td>YES</td>
            <td>YES</td>
            <td>Real</td>
            <td>104.28.28.123</td><td>5</td><td>5</td>
            <td>United States</td>
            <td></td>
           <td></td>
        </tr>
        
    </tbody>
</table>




