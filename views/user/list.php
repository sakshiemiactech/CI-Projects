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
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 88%;">
        <a href="<?php echo base_url('add-order'); ?>" class="btn btn-info form-control">Add Order</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">O.N.</th>
            <th scope="col">Client Name</th>
            <th scope="col">Client Email</th>
            <th scope="col">Order Date</th>
            <th scope="col">Status</th>
            <th scope="col">Contacted From</th>
            <th scope="col">Website</th>
            <th scope="col">P.A.</th>
            <th scope="col">C.A.</th>
            <th scope="col">T.A.</th>
            <th scope="col">A. Date</th>
            <th scope="col">P. Date</th>
            <th scope="col">P. URL</th>
            <th scope="col">Remark</th>
            <th scope="col">Anchor</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_link_sales=0;$total_content_sales=0; if(!empty($orders)){foreach($orders as $key => $value){  ?>
        <tr ondblclick="window.location.href='<?php echo base_url('add-order/'.$value['id']); ?>'" style="cursor:pointer; <?php if(!empty($value['client_amount_received_status']) && $value['client_amount_received_status'] == 'Received') echo 'background-color:#7cdf7c';?>">
            <td><a href="<?php echo base_url('add-order/'.$value['id']); ?>"><?php echo $value['order_number']; ?></a></td>
            <td><?php echo $value['clients_name']; ?></td>
            <td><?php echo $value['client_email']; ?></td>
            <td><?php echo $value['order_date']; ?></td>
            <td style="<?php if($value['status'] == 'Publish'){ echo 'color:green'; }elseif($value['status'] == 'Not_Publish'){ echo 'color:Red'; }elseif($value['status'] == 'Given'){ echo 'color:orange'; }elseif($value['status'] == 'Pending'){ echo 'color:#baba0c'; }?>"><?php echo $value['status']; ?></td>
            <td><?php echo $value['contacted_from']; ?></td>
            <td><?php echo $value['website']; ?></td>
            <td><?php $total_link_sales = $total_link_sales+$value['proposed_amount']; echo $value['proposed_amount']; ?></td>
            <td><?php $total_content_sales = $total_content_sales+$value['content_amount']; echo $value['content_amount']; ?></td>
            <td><?php echo $value['proposed_amount']+$value['content_amount']; ?></td>
            <td><?php echo $value['assign_date']; ?></td>
            <td><?php echo $value['publish_date']; ?></td>
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 20); ?></a></td>
            <td><?php echo $value['remark']; ?></td>
             <td><?php echo $value['website_remark']; ?></td>
            
            <td>
                <a href="<?php echo base_url('add-order/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
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
    <?php /*
    <tr>
            <td>TOTAL</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $total_link_sales; ?></td>
            <td><?php echo $total_content_sales; ?></td>
            <td><?php echo $total_link_sales+$total_content_sales; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    */ ?>
</table>
