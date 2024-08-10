<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;

}

</style>
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
            <th scope="col">Vendor Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">P.Status</th>
            <th scope="col">P. Date</th>
            <th scope="col">P. URL</th>
            <th scope="col">O.A.</th>
            <th scope="col">Site Cost.</th>
            <th scope="col">Vendor Payment Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr style="cursor:pointer; <?php if(!empty($value['vendor_payment_status']) && $value['vendor_payment_status'] == 'Paid') echo 'background-color:#ffff007a';?>">
            <td><?php echo $value['order_number']; ?></td>
            <td><?php echo $value['cname']; ?></td>
            <td><?php echo $value['order_date']; ?></td>
            <td style="<?php if($value['status'] == 'Publish'){ echo 'color:green'; }elseif($value['status'] == 'Not_Publish'){ echo 'color:Red'; }elseif($value['status'] == 'Given'){ echo 'color:orange'; }elseif($value['status'] == 'Pending'){ echo 'color:#baba0c'; }?>"><?php echo $value['status']; ?></td>
            <td><?php echo $value['publish_date']; ?></td>
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
            <td><?php echo '$'.($value['proposed_amount']); ?></td>
            <td><?php if($value['site_cost'] != 0){ echo '$'.$value['site_cost'];} ?></td>
            <td><?php echo '$'.$value['vendor_payment_amount']; ?></td>
            <td><?php echo $value['vendor_payment_status']; ?></td>
            <td><?php echo $value['vendor_payment_date']; ?></td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
