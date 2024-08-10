
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
<?php /* print_r('sdlkjfsjdlf'.$this->session->role); if($this->session->role != 'Salesperson' && $this->session->role != 'Admin'){ ?>
<style>
.buttons-copy,.buttons-excel,.buttons-pdf{
    display:none !important;
}
</style>
<? } ?>
<?php if($this->session->user_email == 'priti@emiactech.com'){ ?>
<style>
    .dt-buttons, #aid_table_length{
        display:none !important;
    }
</style>
<?php } */?>

<label>INSTRUCTIONS</label></br>
<label>1. For DA, Cost Price and Traffic Range search like da from 30 to 50 then put 30,50@ </label></br>
<label>2. For single Niche search like Health then put Health@ </label></br>
<label>3. For searching without community and agency type no in the web category  </label></br>
<label>4. For Niche search in every website like Health then put Health*  </label>
<textarea rows="1" cols="20"></textarea>
<select class="web_type">
    <option>Filter By Website Type</option>
    <option value="Default*">Normal Sites</option>
    <option value="PR*">PR Sites</option>
	<option value="Language*">Language Sites</option>
</select>
<select class="datefilter">
    <option>Filter By Months</option>
    <option value="<?php echo date('Y-m-d', strtotime('-1 month')); ?>@">1 Month</option>
    <option value="<?php echo date('Y-m-d', strtotime('-2 month')); ?>@">2 Month</option>
    <option value="<?php echo date('Y-m-d', strtotime('-3 month')); ?>@">3 Month</option>
    <option value="<?php echo date('Y-m-d', strtotime('-4 month')); ?>@">4 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-5 month')); ?>@">5 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-6 month')); ?>@">6 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-7 month')); ?>@">7 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-8 month')); ?>@">8 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-9 month')); ?>@">9 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-10 month')); ?>@">10 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-11 month')); ?>@">11 Month</option>
	<option value="<?php echo date('Y-m-d', strtotime('-1 year')); ?>@">1 Year</option>
</select>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div>
<table class="table table-striped aid_table exmtbl" id="aid_table">
    <thead>
        <tr>
           
            <th scope="col">Website</th>
            <th scope="col">Guideline</th>
			<th scope="col">Pure Category</th>
            <th scope="col">Niche</th>
			<th scope="col">Category</th>
			<th scope="col">Web Type</th>
            <th scope="col">CP Update Date</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Selling Price</th>
             <th scope="col">Ahref Traffic</th>
             <th scope="col">Follow</th>
             <th scope="col">Semrush Tr.</th>"
            <th scope="col">India</th>
            <th scope="col">US</th>
            <th scope="col">UK</th>
            <th scope="col">Australia</th> 
            <th scope="col">S emrush Updation Date</th>
            <th scope="col">Person</th>
             <th scope="col">Link Ins. Cost</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
            <th scope="col">Web Category</th>
            <th scope="col">Casino CP</th>
            <th scope="col">CBD Price</th>
            <th scope="col">Adult</th>
            <th scope="col">Banner Price</th>
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
             <td></td><td></td>
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
             <td>522</td><td></td>
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
             <td></td><td></td>
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
            <td></td><td></td>
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
            <td></td><td></td>
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
             <td></td><td></td>
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
             <td></td><td></td>
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
             <td></td><td></td>
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
             <td></td><td></td>
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
            <td></td><td></td>
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




