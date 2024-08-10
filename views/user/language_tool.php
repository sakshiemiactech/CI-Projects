
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
td{
        padding-left: 20px;
}
</style>

<form class="form-horizontal" action="<?php echo base_url('functions'); ?>" method="post" name="upload_excel" enctype="multipart/form-data" style="display:none">
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

<label>INSTRUCTIONS</label></br>
<label>1. For DA, Cost Price and Traffic Range search like da from 30 to 50 then put 30,50@ </label></br>
<label>2. For single Niche search like Health then put Health@ </label></br>
<label>3. For searching without community and agency type no in the web category  </label></br>
<label>4. For Niche search in every website like Health then put Health*  </label>
<textarea rows="1" cols="20"></textarea>

<table class="table table-striped">
    <tbody>
        
            <tr>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
                <th scope="col">Language</th>
                <th scope="col">Total Sites</th>
            </tr>
            <?php foreach($languagewise as $key => $vals){ ?>
            <?php if($key == 0){ ?>
                <tr>
            <?php } ?>
             
					<td class="countryspecific"><a href="#"><?php echo $vals['language'];?></a></td>
                <td><?php echo $vals['ltotal'];?></td>
            
            <?php if(($key+1)%6==0){ ?>
            </tr>
            <?php } ?>
           <?php if(($key+1)%6==0){?>
                <tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-language-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div>
<table class="table table-striped language_table exmtbl" id="language_table">
    <thead>
        <tr>
           
            <th scope="col">Website</th>
            <th scope="col">Guideline</th>
            <th scope="col">Niche</th>
            <th scope="col">Site Category</th>
            <th scope="col">Language</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Selling Price</th>
             <th scope="col">Ahref Traffic</th>
             <th scope="col">Follow</th>
             <th scope="col">Semrush Tr.</th>
            <th scope="col">SimilarWeb Tr.</th>
            <th scope="col">1st</th>
            <th scope="col">2nd</th>
            <th scope="col">3rd</th>
            <th scope="col">4th</th> 
            <th scope="col">5th</th>
            <th scope="col">Person</th>
             <th scope="col">Link Ins. Cost</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
            <th scope="col">Web Category</th>
            <th scope="col">Casino CP</th>
            <th scope="col">CBD Price</th>
            <th scope="col">Adult</th>
            <th scope="col">Country</th>
            <th scope="col">Sample URL</th>
            <th scope="col">Date</th>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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
            <td>25</td>
             <td>522</td>
            <td>500</td>
            <td>650</td>
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









