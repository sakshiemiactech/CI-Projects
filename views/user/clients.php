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
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 89%;">
        <a href="<?php echo base_url('add-client'); ?>" class="btn btn-info form-control">Add Client</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Client ID</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">FB ID</th>
            <th scope="col">Niche</th>
            <th scope="col">Contacted From</th>
            <th scope="col">Source</th>
            <th scope="col">Added By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($clients)){foreach($clients as $key => $value){ ?>
        <tr>
            <th scope="row"><?php echo $value['id']; ?></th>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['fb_id']; ?></td>
            <td><?php echo $value['site_name']; ?></td>
            <td><?php echo $value['contacted_id']; ?></td>
            <td><?php echo $value['source']; ?></td>
            <td><?php echo $value['user_name']; ?></td>
            <td>
                <a href="<?php echo base_url('add-client/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                
                <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_client'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                    <span class="ti-trash"></span>
                </button>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>

