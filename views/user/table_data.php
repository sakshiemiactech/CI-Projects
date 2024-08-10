
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
.buttons-copy,.buttons-excel,.buttons-pdf{
    display:none !important;
}
</style>
<?php if($this->session->role == 'Vendor'){ ?>
    <style>
        #example_paginate, .tabledit-edit-button, .tabledit-delete-button{
          display:none;  
        }
    </style>
<?php } ?>


<label>INSTRUCTIONS</label></br>
<label>1. For DA, Cost Price and Traffic Range search like da from 30 to 50 then put 30,50@ </label></br>
<label>2. For single Niche search like Health then put Health@ </label></br>
<label>3. For searching without community and agency type no in the web category  </label>
<?php if($this->session->role != 'Vendor'){?>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 90%;">
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control">Add</a>
    </div>
</div>
<?php } ?>
<table class="table table-striped example exmtbl" id="example">
    <thead>
        <tr>
            <th scope="col">Website</th>
			 <th scope="col">Pure Category</th>
            <th scope="col">Niche</th>
			<th scope="col">Category</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Selling Price</th>
             <th scope="col">Remark</th>
             <th scope="col">Semrush Tr.</th>
            <th scope="col">1st</th>
            <th scope="col">2nd</th>
            <th scope="col">3rd</th>
            <th scope="col">4th</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
             <th scope="col">Pr. Cat.</th>
            <th scope="col">Price With Content</th>
            <th scope="col">Discount</th>
            <th scope="col">Casino CP</th>
           <th scope="col">Traffic</th>
            <th scope="col">Web Category</th>
            <th scope="col">Person</th>
            <th scope="col">Contact</th>
            <th scope="col">Contact From</th>
             <th scope="col">Follow</th>
            <th scope="col">Cp Updated Date</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Data Updated Date</th>
            <th scope="col">IP</th>
            <th scope="col">Country</th>
            <th scope="col">Link Ins. Cost</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
             <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td><td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      			<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td><td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
           <td>
                <a href="#" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">
                    <span class="ti-eye"></span>
                </a>
                
                <a href="#" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                
                <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                    <span class="ti-trash"></span>
                </button>
            </td>
        </tr>
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td><td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td><td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td><td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td><td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td><td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td><td></td>
            <td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        <tr>
      		<td>www.alvinology.com</td>
            <td>Travel,Entertainment,Lifestyle,Food</td>
            <td>50</td>
            <td>45</td>
            <td>500</td>
            <td>650</td>
            <td></td>
             <td></td>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
            <td></td><td></td>
             <td></td>
            <td></td>
            <td>Paid</td>
            <td>650</td>
            <td>0</td>
            <td></td>
            <td>5000</td>
            <td>Real</td>
            <td>Alvin Lim</td>
            <td>alvin@alvinology.com</td>
            <td>Himarathori1@gmail.com</td>
            <td>Do-follow</td>
            <td></td>
            <td></td>
            <td>18/10/2019</td>
            <td>104.28.28.123</td>
            <td>United States</td>
            <td></td>
            <td></td>
            <td></td>
            
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
        
    </tbody>
</table>




