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
<form class="form-horizontal" action="<?php echo base_url('vendor_payment'); ?>" method="post">
<div class="row mt-2 mb-1">
    <div class="col-md-2">
        <select name="order_number" class="js-example-basic-single-one form-control">
            <option value="">Order Number</option>
                <?php foreach($orderss as $order_number){ ?>
                    <option value="<?php echo $order_number['order_number']; ?>" <?php if(!empty($filter['order_number']) &&  $order_number['order_number']== $filter['order_number']) echo 'selected';?> > <?php echo $order_number['order_number']; ?> </option>
                <?php } ?>
        </select>
    </div>
   
    <div class="col-md-2">
        <select name="status" class="js-example-basic-single-one form-control">
            <option value="">Client Payment Status</option>
            <option value="Received" <?php if(!empty($filter['status']) && $filter['status'] == 'Received') echo 'selected';?> > Received </option>
            <option value="Not_Received" <?php if(!empty($filter['status']) && $filter['status'] == 'Not_Received') echo 'selected';?> > Not Received </option>
        </select>
    </div>
    
    <div class="col-md-2">
        <select name="vendor_payment_status" class="js-example-basic-single-one form-control">
            <option value="">Payment Status</option>
            <option value="Paid" <?php if(!empty($filter['vendor_payment_status']) && $filter['vendor_payment_status'] == 'Paid') echo 'selected';?> > Paid </option>
            <option value="Unpaid" <?php if(!empty($filter['vendor_payment_status']) && $filter['vendor_payment_status'] == 'Unpaid') echo 'selected';?> > Unpaid </option>
            <option value="UnpaidC" <?php if(!empty($filter['vendor_payment_status']) && $filter['vendor_payment_status'] == 'UnpaidC') echo 'selected';?> > Unpaid Without Cancel </option>
            <option value="Cancel" <?php if(!empty($filter['vendor_payment_status']) && $filter['vendor_payment_status'] == 'Cancel') echo 'selected';?> > Cancel </option>
        </select>
    </div>
	<div class="col-md-2">
		<label>Search by Client</label>
        <select name="client_name[]" class="js-example-basic-single-one form-control" multiple="multiple">
                <?php foreach($clients as $client){ ?>
                    <option value="<?php echo $client['id']; ?>" <?php if(!empty($filter['client_name']) && in_array($client['id'],$filter['client_name'])) echo 'selected';?> > <?php echo $client['name']; ?> </option>
                <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
		<label>Search by Vendor</label>
        <select name="vendor_name[]" class="js-example-basic-single-one form-control" multiple="multiple">
                <?php foreach($vendors as $vendor){ ?>
                    <option value="<?php echo $vendor['name']; ?>" <?php if(!empty($filter['vendor_name']) && in_array($vendor['name'],$filter['vendor_name'])) echo 'selected';?> > <?php echo $vendor['name']; ?> </option>
                <?php } ?>
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
            <button style="margin-top: 30px;" type="button" class="btn btn-primary vendorpupdate" data-toggle="modal" data-target="#exampleModal12" data-whatever="@getbootstrap">Bulk Update</button>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">O.N.</th>
            <th scope="col">Client Name</th>
			
            <th scope="col">Vendor Name</th>
            <th scope="col">Vendor Email</th>
            <th scope="col">Site Cost</th>
            <th scope="col">Publish URL</th>
            <th scope="col">Publish Date</th>
            <th scope="col">P. Amount</th>
			<th scope="col">Client Payment</th>
            <th scope="col">Vendor Payment</th>
            <th scope="col">P. Date</th>
            <th scope="col">Added By</th>
            <th scope="col">Invoice Status</th>
            <th scope="col">Trans. ID</th>
            <th scope="col">Paypal ID</th>
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
        <tr ondblclick="window.location.href='<?php echo base_url('do-vendor-payment/'.$value['id']); ?>'" style="cursor:pointer; <?php if(!empty($value['vendor_payment_status']) && $value['vendor_payment_status'] == 'Paid') echo 'background-color:#f7f63775';?>">
            <td><input type="checkbox" name="id[]" amrc="<?php if(!empty($value) && $value['site_cost'] != 0){ echo $value['site_cost'];}?>" class="muledit" order_dedline="" value="<?php echo $value['id']; ?>"></input> <?php echo $value['id']; ?></td>
            <td><a href="<?php echo base_url('do-vendor-payment/'.$value['id']); ?>"><?php echo $value['order_number']; ?></a></td>
            <td><?php echo $value['clients_name']; ?></td>

            <td  style="color:blue" data-toggle="modal" data-target="#exampleModalQE" class="quickeditpayment" data-id="<?php echo $value['id']; ?>" data-cp="<?php echo $value['site_cost']; ?>" data-pstatus="<?php echo $value['vendor_payment_status']; ?>" data-pdate="<?php echo $value['vendor_payment_date']; ?>" data-istatus="<?php echo $value['vendor_invoice_status']; ?>" data-ap="<?php echo $value['actual_paid_amount']; ?>" data-tid="<?php echo $value['vendor_transaction_id']; ?>"><?php echo $value['vendor_name']; ?></td>
            <td><?php echo $value['vendor_email']; ?></td>
            <td><?php echo '$'.$value['site_cost']; ?></td>
           
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
            <td><?php echo $value['publish_date']; ?></td>
            <td id="ap<?php echo $value['id']; ?>"><?php echo $value['actual_paid_amount']; ?></td>
			<td><?php echo $value['client_amount_received_status']; ?></td>
            <td id="pstatus<?php echo $value['id']; ?>" style="<?php if($value['vendor_payment_status'] == 'Cancel'){ echo 'color:red';} ?>"><?php echo $value['vendor_payment_status']; ?></td>
            <td id="pdate<?php echo $value['id']; ?>"><?php echo $value['vendor_payment_date']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td id="istatus<?php echo $value['id']; ?>"><?php echo $value['vendor_invoice_status']; ?></td>
            <td id="tid<?php echo $value['id']; ?>"><?php echo $value['vendor_transaction_id']; ?></td>
            <td><?php echo $value['paypal_id']; ?></td>
            <td>
                <a href="<?php echo base_url('do-vendor-payment/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>


<div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Client Payment Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php  echo base_url('bulk_vendor_payment_update');?>" method="post" class="pt-3 form-redirect">
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
        <form action="<?php  echo base_url('quick-update-payment');?>" method="post" class="pt-3 quick_submit">
        <div class="row">
            <div class="col-md-2 mb-2">
    			<div class="form-group">
    				<label>O. ID<span class="text-danger">*</span></label>
    				<input type="text" class="form-control" placeholder="" name="order_id" id="order_id" readonly> 
    				
    			</div>
    		</div>
    		<div class="col-md-2 mb-2">
    			<div class="form-group">
    				<label>Cost Price<span class="text-danger">*</span></label>
    				<input type="text" class="form-control" placeholder="" id="cost_price" disabled> 
    				
    			</div>
    		</div>
    		<div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Actual Paid<span class="text-danger">*</span></label>
    				<input type="text" class="form-control" placeholder="" name="actual_paid_amount" id="actual_paid_amount"> 
    			</div>
    		</div>
            <div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Date<span class="text-danger">*</span></label>
    				<input type="text" class="form-control datepicker" placeholder="" name="vendor_payment_date" id="vendor_payment_date"> 
    			</div>
    		</div>
            <div class="col-md-4 mb-4 form-group">
    		    <label>Invoice Status <span class="text-danger">*</span></label>
                <select name="vendor_invoice_status" id="vendor_invoice_status" class="js-example-basic-single-one">
                    <option value="Pending"> Pending </option>
                    <option value="Ask"> Ask </option>
                    <option value="Recieved"> Recieved </option>
                    <option value="Given"> Given </option>
                    <option value="Paid"> Paid </option>
                </select>
            </div>
            <div class="col-md-4 mb-4 form-group">
    		    <label>Payment Status <span class="text-danger">*</span></label>
                <select name="vendor_payment_status" id="vendor_payment_status" class="js-example-basic-single-one">
                    <option value="Hold"> Hold </option>
                    <option value="Partially_Paid"> Partially_Paid </option>
                    <option value="Paid"> Paid </option>
                    <option value="Ready"> Ready </option>
                    <option value="Cancel"> Cancel </option>
                    
                </select>
            </div>
           
    		<div class="col-md-4 mb-4">
    			<div class="form-group">
    				<label>Transaction ID <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" placeholder="" name="vendor_transaction_id" id="vendor_transaction_id"> 
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
