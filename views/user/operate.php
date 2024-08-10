<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;

}
.buttons-copy,.buttons-excel,.buttons-pdf{
    display:none !important;
}

</style>

<form class="form-horizontal" action="<?php echo base_url('operates'); ?>" method="post">
    <div class="row mt-2 mb-1">
        <div class="col-md-2">
            <select name="status" class="js-example-basic-single-one form-control">
                <option value="">Order Status</option>
                <option value="Pending" <?php if(!empty($filter['status']) && $filter['status'] == 'Pending') echo 'selected';?> > Pending </option>
                <option value="Given" <?php if(!empty($filter['status']) && $filter['status'] == 'Given') echo 'selected';?> > Given </option>
                <option value="Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Publish') echo 'selected';?> > Publish </option>
<option value="Replacement" <?php if(!empty($filter['status']) && $filter['status'] == 'Replacement') echo 'selected';?> > Replacement </option>
                <option value="Not_Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Not_Publish') echo 'selected';?> > Not_Publish </option>
                <option value="Cancel" <?php if(!empty($filter['status']) && $filter['status'] == 'Cancel') echo 'selected';?> > Cancel </option>
</option>
                <option value="Need Update" <?php if(!empty($filter['status']) && $filter['status'] == 'Need Update') echo 'selected';?> > Need Update </option>
				<option value="All" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'All') echo 'selected';?> > All </option>
        </select>
            </select>
        </div>
        <div class="col-md-2">
            <select name="vendor_name" class="js-example-basic-single-one form-control">
                <option value="">Vendor Name</option>
                <?php foreach($vendors as $vendor){ ?>
                    <option value="<?php echo $vendor['name']; ?>" <?php if(!empty($filter['vendor_name']) && $filter['vendor_name'] == $vendor['name']) echo 'selected';?> > <?php echo $vendor['name']; ?> </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            <select name="order_date" class="js-example-basic-single-one form-control">
                <option value="">Order Date</option>
                <?php foreach($orders as $order_date){ ?>
                    <option value="<?php echo $order_date['order_date']; ?>" <?php if(!empty($filter['order_date']) && $filter['order_date'] == $order_date['order_date']) echo 'selected';?> > <?php echo $order_date['order_date']; ?> </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-2">
            <select name="assign_date" class="js-example-basic-single-one form-control">
                <option value="">Assign Date</option>
                <?php foreach($orders as $assign_date){ if(!empty($assign_date['assign_date'])){?>
                    <option value="<?php echo $assign_date['assign_date']; ?>" <?php if(!empty($filter['assign_date']) && $filter['assign_date'] == $assign_date['assign_date']) echo 'selected';?> > <?php echo $assign_date['assign_date']; ?> </option>
                <?php }} ?>
            </select>
        </div>
        
        <div class="col-md-2">
            <select name="publish_date" class="js-example-basic-single-one form-control">
                <option value="">Publish Date</option>
                <?php foreach($orders as $publish_date){ if(!empty($publish_date['publish_date'])){?>
                    <option value="<?php echo $publish_date['publish_date']; ?>" <?php if(!empty($filter['publish_date']) && $filter['publish_date'] == $publish_date['publish_date']) echo 'selected';?> > <?php echo $publish_date['publish_date']; ?> </option>
                <?php }} ?>
            </select>
        </div>
        
        
        
        <div class="col-md-1">
            <div class="text-center">
                <button type="submit" class="btn btn-secondary form-control">Filter</button>
            </div>
        </div>
    </div>
</form>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 88%;">
            <button style="margin-top: 30px;" type="button" class="btn btn-primary blkasgned" data-toggle="modal" data-target="#exampleModalblassign" data-whatever="@getbootstrap">Bulk Update</button>
    </div>
</div>
<table class="table" id="myTable">
    
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">O.N.</th>
            <th scope="col">Client Name</th>
            <th scope="col">Order Status</th>
            <th scope="col">Order Date</th>
            <th scope="col">Website</th>
			<th scope="col">Website Type</th>
            <th scope="col">Assign Date</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Publish URL</th>
			<th scope="col">Indexed URL</th>
            <th scope="col">Vendor Name</th>
            <th scope="col">Vendor Email</th>
            <th scope="col">Vendor Contacted From</th>
            <th scope="col">S.Remark</th>
			<th scope="col">V.Remark</th>
            <th scope="col">Website Cost</th>
			<th scope="col">Discounted Cost</th>
            <th scope="col">Payment Status</th>
            <th scope="col">Bank Details</th>
            <th scope="col">Added By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
        <tr ondblclick="window.location.href='<?php echo base_url('update-order/'.$value['id']); ?>'" style="<?php if(!empty($value['client_amount_received_status']) && $value['client_amount_received_status'] == 'Received') echo 'background-color:#7cdf7c';?>">
            <td><input type="checkbox" name="id[]" data-status="<?php echo $value['status']; ?>" data-assigndate="<?php echo $value['assign_date']; ?>" data-publishdate="<?php echo $value['publish_date']; ?>" data-publishurl="<?php echo $value['publish_url']; ?>" data-vendormark="<?php echo $value['vendor_website_ramark']; ?>" class="muledit" order_dedline="" value="<?php echo $value['id']; ?>"></input> <?php echo $value['id']; ?></td>
            <td><a href="<?php echo base_url('update-order/'.$value['id']); ?>"><?php echo $value['order_number']; ?></a></td>
            <td><?php echo $value['clients_name']; ?></td>
            <td id="status<?php echo $value['id']; ?>" data-toggle="modal" data-target="#exampleModalQE" class="quickedit" data-id="<?php echo $value['id']; ?>"  data-status="<?php echo $value['status']; ?>" data-assigndate="<?php echo $value['assign_date']; ?>" data-publishdate="<?php echo $value['publish_date']; ?>" data-publishurl="<?php echo $value['publish_url']; ?>" style="<?php if($value['status'] == 'Publish'){ echo 'color:green'; }elseif($value['status'] == 'Not_Publish'){ echo 'color:Red'; }elseif($value['status'] == 'Given'){ echo 'color:orange'; }elseif($value['status'] == 'Pending'){ echo 'color:#baba0c'; }elseif($value['status'] == 'Cancel'){ echo 'color:red'; }?>"><?php echo $value['status']; ?></td>
            <td><?php echo $value['order_date']; ?></td>
            <td><?php echo $value['website']; ?></td>
			<td><?php echo $value['website_type']; ?></td>
            <td id="assign<?php echo $value['id']; ?>"><?php echo $value['assign_date']; ?></td>
            <td id="publish<?php echo $value['id']; ?>"><?php echo $value['publish_date']; ?></td>
            <td id="url<?php echo $value['id']; ?>"><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
			<td id="url<?php echo $value['id']; ?>"><a href="<?php echo $value['indexed_url']; ?>" target="_blank"><?php echo substr($value['indexed_url'], 0, 20); ?></a></td>
            <td><?php echo $value['vendor_name']; ?></td>
            <td><?php echo $value['vendor_email']; ?></td>
            <td><?php echo $value['vendor_contacted_from']; ?></td>
            <td id="remark<?php echo $value['id']; ?>"><?php echo $value['remark']; ?></td>
			<td id=""><?php echo $value['vendor_website_ramark']; ?></td>
            <td><?php echo '$'.$value['site_cost']; ?></td>
			<td><?php echo '$'.$value['discounted_amount']; ?></td>
            <td><?php echo $value['vendor_payment_status']; ?></td>
            <td><?php if(!empty($value['bank_name'])) echo 'Bank Name: '.$value['bank_name']; if(!empty($value['bank_ifsc'])) echo '<br> IFSC: '.$value['bank_ifsc'];if(!empty($value['account_number'])) echo '<br> ACC.NUM: '.$value['account_number']; if(!empty($value['paypal_id'])) echo '<br> PaypalID: '.$value['paypal_id']; if(!empty($value['skype_id'])) echo '<br> SkypeID: '.$value['skype_id']; if(!empty($value['upi_id'])) echo '<br> UPI : '.$value['upi_id']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td>
                <a href="<?php echo base_url('update-order/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Update Order">
                    <span class="ti-pencil"></span>
                </a>
                <?php if(!empty($value['content_doc'])){ ?>
                <a href="<?php echo base_url('imports/'.$value['content_doc']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Download Content Doc">
                    <span class="ti-download"></span>
                </a>
                <?php } ?>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>

<div class="modal fade" id="exampleModalQE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelvgvg" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelsad">Quick Updation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php  echo base_url('quick-update-order');?>" method="post" class="pt-3 quick_submit">
         <div class="row">
            <div class="col-md-4 mb-4 form-group">
    		    <label>Order Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="js-example-basic-single-one">
                    <option value="Pending"> Pending </option>
                    <option value="Given"> Given </option>
                    <option value="Publish"> Publish </option>
                    <option value="Not_Publish"> Not_Publish </option>
                    <option value="Cancel"> Cancel </option>
                    <option value="Replacement"> Replacement </option>
					<option value="Need Update"> Need Update </option>
                </select>
            </div>
            <div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Assign Date<span class="text-danger">*</span></label>
    				<input type="text" class="form-control datepicker" placeholder="" name="assign_date" id="assign_date"> 
    				<input type="hidden" class="form-control" placeholder="" name="update_id" id="update_id"> 
    			</div>
    		</div>
            <div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Publis Date<span class="text-danger">*</span></label>
    				<input type="text" class="form-control datepicker" placeholder="" name="publish_date" id="publish_date"> 
    			</div>
    		</div>
    		<div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Publish URL <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" placeholder="" name="publish_url" id="publish_url" value=""> 
    			</div>
    		</d
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="exampleModalblassign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Order Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php  echo base_url('bulk_assign_update');?>" method="post" class="pt-3 form-redirect">
         <div class="row blkedit">
            
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>