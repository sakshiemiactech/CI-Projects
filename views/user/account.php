<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;

}

</style>
<div class="row" style="display:none">
    <div class="card text-white bg-primary mb-3 col-md-3" style="max-width: 11rem;height: 177px;">
      <div class="card-header bg-primary">Received Amount</div>
      <div class="card-body">
        <h5 class="card-title">$525</h5>
        <p class="card-text">received from clients.</p>
      </div>
    </div>
    <div class="card text-white bg-primary mb-3 col-md-3" style="max-width: 11rem;height: 177px;">
      <div class="card-header bg-primary">Received Amount</div>
      <div class="card-body">
        <h5 class="card-title">$525</h5>
        <p class="card-text">received from clients.</p>
      </div>
    </div>
</div>
<form class="form-horizontal" action="<?php echo base_url('finance'); ?>" method="post">
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
            <option value="">Order Status</option>
            <option value="Pending" <?php if(!empty($filter['status']) && $filter['status'] == 'Pending') echo 'selected';?> > Pending </option>
            <option value="Given" <?php if(!empty($filter['status']) && $filter['status'] == 'Given') echo 'selected';?> > Given </option>
            <option value="Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Publish') echo 'selected';?> > Publish </option>
            <option value="Not_Publish" <?php if(!empty($filter['status']) && $filter['status'] == 'Not_Publish') echo 'selected';?> > Not_Publish </option>
            <option value="Cancel" <?php if(!empty($filter['status']) && $filter['status'] == 'Cancel') echo 'selected';?> > Cancel </option>
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
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">O.N.</th>
            <th scope="col">Client Name</th>
            <th scope="col">Client Email</th>
            <th scope="col">Client Amt. Rec.</th>
            <th scope="col">Cl.Amt.Rec. Date</th>
            <th scope="col">Cl.Acc.Type</th>
            <th scope="col">Cl.Acc.ID</th>
            <th scope="col">Contacted From</th>
            <th scope="col">Order Date</th>
            <th scope="col">Website</th>
            <th scope="col">Proposed Amount</th>
            <th scope="col">Content Amount</th>
            <th scope="col">Web. Remark</th>
            <th scope="col">Assign Date</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Publish URL</th>
            <th scope="col">Vendor Name</th>
            <th scope="col">Vendor Email</th>
            <th scope="col">Site Cost</th>
            <th scope="col">Vendor Con. From</th>
            <th scope="col">Vendor Pay.Amt.</th>
            <th scope="col">Vendor Pay.Date</th>
            <th scope="col">Vendor Trans. ID</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
        
        <tr ondblclick="window.location.href='<?php echo base_url('edit-order/'.$value['id']); ?>'" style="cursor:pointer; <?php if(!empty($value['client_amount_received_status']) && $value['client_amount_received_status'] == 'Received') echo 'background-color:#7cdf7c';?>">
           <a href="<?php echo base_url('edit-order/'.$value['id']); ?>"> 
            <td><?php echo $value['order_number']; ?></td>
            <td><?php echo $value['clients_name']; ?></td>
            <td><?php echo $value['client_email']; ?></td>
            <td><?php echo $value['client_amount_received']; ?></td>
            <td><?php echo $value['client_amount_received_date']; ?></td>
            <td><?php echo $value['client_account_type']; ?></td>
            <td><?php echo $value['client_account_id']; ?></td>
            <td><?php echo $value['contacted_from']; ?></td>
            <td><?php echo $value['order_date']; ?></td>
            <td><?php echo $value['website']; ?></td>
            <td><?php echo $value['proposed_amount']; ?></td>
            <td><?php echo $value['content_amount']; ?></td>
            <td><?php echo $value['website_remark']; ?></td>
            <td><?php echo $value['assign_date']; ?></td>
            <td><?php echo $value['publish_date']; ?></td>
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
            <td><?php echo $value['vendor_name']; ?></td>
            <td><?php echo $value['vendor_email']; ?></td>
            <td><?php echo $value['site_cost']; ?></td>
            <td><?php echo $value['vendor_contacted_from']; ?></td>
            <td><?php echo $value['vendor_payment_amount']; ?></td>
            <td><?php echo $value['vendor_payment_date']; ?></td>
            <td><?php echo $value['vendor_transaction_id']; ?></td></a>
            <td>
                <a href="<?php echo base_url('edit-order/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                <?php if($this->session->role == 'Admin'){ ?>
                    <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_order'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                        <span class="ti-trash"></span>
                    </button>
                <?php } ?>
            </td>
        </tr>
        
        <?php }} ?>
    </tbody>
</table>
