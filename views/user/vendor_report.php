
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
.dataTables_scrollHeadInner, .table{
    width:100% !important;
}

</style>

<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Vendor Name</th>
            <th scope="col">Contacted From</th>
            <th scope="col">Total Orders Amount</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Total Orders</th>
            <th scope="col">Sales Person</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr style="cursor:pointer">
            <form action="<?php echo base_url('vendor-order-list'); ?>" method="post">
                <td scope="row"><?php echo $key+1; ?></td>
                <td><?php echo $value['cname']; ?><input type="hidden" value="<?php echo $value['vemail']; ?>" name="vendor_email"></td>
                <td><?php echo $value['cid']; ?><input type="hidden" value="<?php echo $value['contacted_from']; ?>" name="contacted_from"></td>
                <td><?php echo $value['total_sold']; ?></td>
                <td><?php if(!empty($venr[$value['vemail']])){ echo $venr[$value['vemail']];} ?></td>
                <td><?php echo $value['total']; ?></td>
                 <td><?php echo $value['user_name']; ?></td>
                <td>
                    <button type="submit" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">
                        <span class="ti-eye"></span>
                    </button>
                </td>
            </form>    
        </tr>
        <?php }} ?>
    </tbody>
</table>




