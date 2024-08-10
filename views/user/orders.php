<style type="text/css">
   .dataTables_scrollHeadInner.dataTable{
   width:0px !important;
   }
   table{
   width: 100% !important;
   }
</style>
<form class="form-horizontal" action="<?php echo base_url('orders'); ?>" method="post">
   <div class="row mt-2 mb-1">
      <div class="col-md-2">
         <select name="contacted_from" class="js-example-basic-single-one form-control">
            <option value="">Contacted From</option>
            <?php foreach($cnfrom as $contacted_from){ ?>
            <option value="<?php echo $contacted_from['contacted_from']; ?>" <?php if(!empty($filter['contacted_from']) &&  $contacted_from['contacted_from']== $filter['contacted_from']) echo 'selected';?> > <?php echo $contacted_from['contacted_from']; ?> </option>
            <?php } ?>
         </select>
      </div>
      <div class="col-md-2">
         <select name="added_by" class="js-example-basic-single-one form-control">
            <option value="">Added By</option>
            <?php foreach($adby as $added_by){ ?>
            <option value="<?php echo $added_by['id']; ?>" <?php if(!empty($filter['added_by']) &&  $added_by['id']== $filter['added_by']) echo 'selected';?> > <?php echo $added_by['name']; ?> </option>
            <?php } ?>
         </select>
      </div>
      <div class="col-md-1">
         <select name="orderstatus" class="js-example-basic-single-one form-control">
            <option value="">Status</option>
            <option value="Pending" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Pending') echo 'selected';?> > Pending </option>
            <option value="Given" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Given') echo 'selected';?> > Given </option>
            <option value="Publish" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Publish') echo 'selected';?> > Publish </option>
            <option value="Not_Publish" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Not_Publish') echo 'selected';?> > Not_Publish </option>
            <option value="Cancel" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Cancel') echo 'selected';?> > Cancel </option>
            <option value="Need Update" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'Need Update') echo 'selected';?> > Need Update </option>
            <option value="All" <?php if(!empty($filter['orderstatus']) && $filter['orderstatus'] == 'All') echo 'selected';?> > All </option>
         </select>
      </div>
      <div class="col-md-2">
         <select name="oclient_name" class="js-example-basic-single-one form-control">
            <option value="">Client Name</option>
            <?php foreach($clients as $client){ ?>
            <option value="<?php echo $client['id']; ?>" <?php if(!empty($filter['oclient_name']) && $filter['oclient_name'] == $client['id']) echo 'selected';?> > <?php echo $client['name']; ?> </option>
            <?php } ?>
         </select>
      </div>
      <div class="col-md-2">
         <select name="indexStatus" class="js-example-basic-single-one form-control">
            <option value="">Indexex Status</option>
            <option value="Yes" <?php if(!empty($filter['indexStatus']) && $filter['indexStatus'] == 'Yes') echo 'selected';?> > Yes </option>
            <option value="No" <?php if(!empty($filter['indexStatus']) && $filter['indexStatus'] == 'No') echo 'selected';?> > No </option>
		  </select>
      </div>
      <div class="col-md-1 mb-1">
      <input type="text" autocomplete="off" class="form-control datepicker" placeholder="From Date" name="from_date" id="from_date" value="<?php if(!empty($filter)){ echo $filter['from_date'];}?>"> 
      </div> 
      <div class="col-md-1 mb-1">
      <input type="text" autocomplete="off" class="form-control datepicker" placeholder="To Date" name="to_date" id="to_date" value="<?php if(!empty($filter)){ echo $filter['to_date'];}?>"> 
      </div>
      <div class="col-md-1">
      <div class="text-center">
      <button type="submit" class="btn btn-secondary form-control">Filter</button>
      </div>
      </div>
   </div>
</form>
<form class="form-horizontal" action="<?php echo base_url('update_invoices'); ?>" method="post">
<div class="row mt-2 mb-1">
<div class="col-md-2">
<label>Select Order Numbers</label>
<select name="order_numbers[]" class="js-example-basic-single-one form-control" multiple="multiple" required>
<?php foreach($order_numbers as $onum){ ?>
<option value="<?php echo $onum['order_number'] ?>" > <?php echo $onum['order_number']; ?> </option>
<?php } ?>
</select>
</div>
<div class="col-md-2 mb-2">
<label>Invoice Number</label>
<input type="text" autocomplete="off" class="form-control" name="invoice_number" id="" required> 
</div> 
<div class="col-md-1" >
<div class="text-center" style="margin-top: 30px;">
<button type="submit" class="btn btn-secondary form-control">Submit</button>
</div>
</div>
</div>
</form>
<div class="row mt-4 mb-1">
   <div class="text-center" style="margin-left: 88%;">
      <a href="<?php echo base_url('add-order'); ?>" class="btn btn-info form-control">Add Order</a>
   </div>
</div>
<table class="table" id="myTable1">
   <thead>
      <tr>
         <th scope="col">O.N.</th>
         <th scope="col">O.ID.</th>
         <th scope="col">Client Name</th>
         <th scope="col">Client Email</th>
         <th scope="col">Order Date</th>
         <th scope="col">Status</th>
         <th scope="col">Contacted From</th>
         <th scope="col">Website</th>
         <th scope="col">P.A.</th>
         <th scope="col">C.A.</th>
         <th scope="col">T.A.</th>
         <th scope="col">S.C.</th>
         <th scope="col">A. Date</th>
         <th scope="col">P. Date</th>
         <th scope="col">P. URL</th>
         <th scope="col">Indexed URL</th>
         <th scope="col">Invoice Number</th>
         <th scope="col">Added By</th>
         <th scope="col">Remark</th>
         <th scope="col">Anchor</th>
         <th scope="col">Payment Remark</th>
         <th scope="col">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
      <tr ondblclick="window.location.href='<?php echo base_url('add-order/'.$value['id']); ?>'" style="cursor:pointer; <?php if(!empty($value['client_amount_received_status']) && $value['client_amount_received_status'] == 'Received') echo 'background-color:#7cdf7c';?>">
         <td><a href="<?php echo base_url('add-order/'.$value['id']); ?>"><?php echo $value['order_number']; ?></a></td>
         <td><?php echo $value['id']; ?></td>
         <td><?php echo $value['clients_name']; ?></td>
         <td><?php echo $value['client_email']; ?></td>
         <td><?php echo $value['order_date']; ?></td>
         <td style="<?php if($value['status'] == 'Publish'){ echo 'color:green'; }elseif($value['status'] == 'Not_Publish'){ echo 'color:Red'; }elseif($value['status'] == 'Given'){ echo 'color:orange'; }elseif($value['status'] == 'Pending'){ echo 'color:#baba0c'; }?>"><?php echo $value['status']; ?></td>
         <td><?php echo $value['contacted_from']; ?></td>
         <td><?php echo $value['website']; ?></td>
         <td><?php echo '$'.$value['proposed_amount']; ?></td>
         <td><?php echo '$'.$value['content_amount']; ?></td>
         <td><?php echo '$'.($value['proposed_amount']+$value['content_amount']); ?></td>
         <td><?php echo '$'.$value['site_cost']; ?></td>
         <td><?php echo $value['assign_date']; ?></td>
         <td><?php echo $value['publish_date']; ?></td>
         <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 2000); ?></a></td>
         <td><a href="<?php echo $value['indexed_url']; ?>" target="_blank"><?php echo substr($value['indexed_url'], 0, 2000); ?></a></td>
         <td><?php echo $value['invoice_no']; ?></td>
         <td><?php echo $value['user_name']; ?></td>
         <td><?php echo $value['remark']; ?></td>
         <td><?php echo $value['website_remark']; ?></td>
         <td><?php echo $value['payment_remark']; ?></td>
         <td>
            <a href="<?php echo base_url('add-order/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
            <span class="ti-pencil"></span>
            </a>
            <?php if($this->session->role == 'Admin'){ ?>
            <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_order'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
            <span class="ti-trash"></span>
            </button>
            <?php } ?>
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