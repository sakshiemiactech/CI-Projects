<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;

}

</style>

<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 88%;">
        <a href="<?php echo base_url('add-vendor'); ?>" class="btn btn-info form-control">Add Vendor</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contacted From</th>
           <!-- <th scope="col">Vendor's B.N.</th>-->
            <th scope="col">Bank Name</th>
            <th scope="col">Acc. Num.</th>
            <th scope="col">Ifsc Code</th>
            <th scope="col">Paypal ID</th>
            <th scope="col">Skype ID</th>
            <th scope="col">UPI ID</th>
            <th scope="col">Added By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($vendors)){foreach($vendors as $key => $value){ ?>
        <tr>
            <th scope="row"><?php echo $value['id'];; ?></th>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo wordwrap($value['email'], 40, '<br />\n',true); ?></td>
            <td><?php echo $value['contacted_from']; ?></td>
            
            <td><?php echo $value['bank_name']; ?></td>
            <td><?php echo $value['account_number']; ?></td>
            <td><?php echo $value['bank_ifsc']; ?></td>
            <td><?php echo $value['paypal_id']; ?></td>
            <td><?php echo $value['skype_id']; ?></td>
            <td><?php echo $value['upi_id']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td>
                <a href="<?php echo base_url('add-vendor/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                
                <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_vendor'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                    <span class="ti-trash"></span>
                </button>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>

