<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;
    }
    @media (min-width: 576px)
    .modal-dialog {
        max-width: 1100px !important;
        margin: 1.75rem auto;
    }

</style>
<form class="form-horizontal" action="<?php echo base_url('finance'); ?>" method="post">
<div class="row mt-2 mb-1">
    <div class="col-md-2">
        <input type="number" placeholder="Order N. Ending Range" name="order_number_starting" value="<?php if(!empty($filter['order_number_starting'])) echo $filter['order_number_starting'];?>" class="js-example-basic-single-one form-control">
    </div>
	 <div class="col-md-2">
        <input type="number" placeholder="Order N. Starting Range" name="order_number_ending" value="<?php if(!empty($filter['order_number_ending'])) echo $filter['order_number_ending'];?>" class="js-example-basic-single-one form-control">
    </div>
    <div class="col-md-1">
        <select name="status" class="js-example-basic-single-one form-control">
            <option value="">Order Status</option>
            <option value="Pending" <?php if(!empty($filter['status']) && $filter['status'] == 'Pending') echo 'selected';?> > Pending </option>
            <option value="Given" <?php if(!empty($filter['status']) && $filter['status'] == 'Given') echo 'selected';?> > Given </option>
            <option value="Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Publish') echo 'selected';?> > Publish </option>
            <option value="Not_Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Not_Publish') echo 'selected';?> > Not_Publish </option>
            <option value="Cancel" <?php if(!empty($filter['status']) && $filter['status'] == 'Cancel') echo 'selected';?> > Cancel </option>
        </select>
    </div>
	<div class="col-md-2">
        <select name="payment_status" class="js-example-basic-single-one form-control">
            <option value="">Payment Status</option>
            <option value="Received" <?php if(!empty($filter['payment_status']) && $filter['payment_status'] == 'Received') echo 'selected';?> > Received </option>
            <option value="Not_Received" <?php if(!empty($filter['payment_status']) && $filter['payment_status'] == 'Not_Received') echo 'selected';?> > Not_Received </option>
            <option value="Partially_Received" <?php if(!empty($filter['payment_status']) && $filter['payment_status'] == 'Partially_Received') echo 'selected';?> > Partially_Received </option>
        </select>
    </div>
	<div class="col-md-2">
        <select name="added_by" class="js-example-basic-single-one form-control">
            <option value="">Added By</option>
            <option value="65" <?php if(!empty($filter['added_by']) && $filter['added_by'] == '65') echo 'selected';?> > Siddharth Vira </option>
            <option value="31" <?php if(!empty($filter['added_by']) && $filter['added_by'] == '31') echo 'selected';?> > Sahil Khandelwal</option>
            <option value="32" <?php if(!empty($filter['added_by']) && $filter['added_by'] == '32') echo 'selected';?> > Nikhil Jain </option>
<option value="59" <?php if(!empty($filter['added_by']) && $filter['added_by'] == '59') echo 'selected';?> > Manali Mulay </option>
<option value="60" <?php if(!empty($filter['added_by']) && $filter['added_by'] == '60') echo 'selected';?> > Dushyant Singh </option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="client_name" class="js-example-basic-single-one form-control">
            <option value="">Client Name</option>
                <?php foreach($clients as $client){ ?>
                    <option value="<?php echo $client['id']; ?>" <?php if(!empty($filter['client_name']) && $filter['client_name'] == $client['id']) echo 'selected';?> > <?php echo $client['name']; ?> </option>
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

<form class="form-horizontal" action="<?php echo base_url('bulk_update_invoices'); ?>" method="post">
	<div class="col-md-2">
		<label>Invoice Numbers</label>
		<textarea name="invoice_numbers" class="form-control"></textarea>
    </div>
<div class="row mt-2 mb-1">
    <div class="col-md-1">
        <div class="text-center">
            <button type="submit" class="btn btn-secondary form-control">Received</button>
        </div>
    </div>
</div>

</form>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 88%;">
            <button style="margin-top: 30px;" type="button" class="btn btn-primary blkasgn" data-toggle="modal" data-target="#exampleModal12" data-whatever="@getbootstrap">Bulk Update</button>
		
    </div>
</div>
Select All<input type="checkbox" id="selectAll"/>
<table class="table my_class" id="myTable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">O.N.</th>
            <th scope="col">Client Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">P.Status</th>
            <th scope="col">P. Date</th>
            <th scope="col">P. URL</th>
            <th scope="col">T.A.</th>
            <th scope="col">R.Amt.</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
            <th scope="col">A.Type</th>
            <th scope="col">A.ID</th>
			 <th scope="col">Invoice Number</th>
            <th scope="col">Added By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
        <tr ondblclick="window.location.href='<?php echo base_url('client-payment/'.$value['id']); ?>'" style="cursor:pointer; <?php if(!empty($value['client_amount_received_status']) && $value['client_amount_received_status'] == 'Received') echo 'background-color:#7cdf7c';?>">
            <td><input type="checkbox" name="id[]" amrc="<?php if(!empty($value) && $value['client_amount_received'] != 0){ echo $value['client_amount_received'];}else { echo $value['proposed_amount']+$value['content_amount'];}?>" class="muledit" order_dedline="" value="<?php echo $value['id']; ?>"></input> <?php echo $value['id']; ?></td>
            <td><?php echo $value['order_number']; ?></td>
            <td><?php echo $value['clients_name']; ?></td>
            <td><?php echo $value['order_date']; ?></td>
            <td style="<?php if($value['status'] == 'Publish'){ echo 'color:green'; }elseif($value['status'] == 'Not_Publish'){ echo 'color:Red'; }elseif($value['status'] == 'Given'){ echo 'color:orange'; }elseif($value['status'] == 'Pending'){ echo 'color:#baba0c'; }?>"><?php echo $value['status']; ?></td>
            <td><?php echo $value['publish_date']; ?></td>
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
            <td><?php echo '$'.($value['proposed_amount']+$value['content_amount']); ?></td>
            <td><?php if($value['client_amount_received'] != 0){ echo '$'.$value['client_amount_received'];} ?></td>
            <td><?php echo $value['client_amount_received_status']; ?></td>
            <td><?php echo $value['client_amount_received_date']; ?></td>
            <td><?php echo $value['client_account_type']; ?></td>
            <td><?php echo $value['client_account_id']; ?></td>
			<td><?php echo $value['invoice_no']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td>
                <a href="<?php echo base_url('client-payment/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
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
        <form action="<?php  echo base_url('bulk_client_payment_update');?>" method="post" class="pt-3 form-redirect">
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
