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
        <a href="<?php echo base_url('add-user'); ?>" class="btn btn-info form-control">Add User</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($users)){foreach($users as $key => $value){ ?>
        <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['role']; ?></td>
            <td>
                <a href="<?php echo base_url('add-user/'.$value['id']); ?>" class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                    <span class="ti-pencil"></span>
                </a>
                
                <button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('delete_user'); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                    <span class="ti-trash"></span>
                </button>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
