
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
table{
    width: 100% !important;

}
.sps{
        margin-bottom: 10px;
}
.butwid{
      width: 70%;
}
</style>
<?php if($this->session->role!='Vendor'){ ?>
<div class="row mt-4 mb-1">
    <div class="text-center" style="margin-left: 85%;">
        <a href="<?php echo base_url('add-vendor'); ?>" class="btn btn-info form-control sps butwid">Add Vendor</a>
    
        <a href="<?php echo base_url('add-site'); ?>" class="btn btn-info form-control butwid">Add Site</a>
    </div>
</div>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Sr.Num.</th>
            <th scope="col">Website</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($blog)){foreach($blog as $key => $value){ ?>
        <tr style="<?php if($value['web_category']=='Community') echo 'color:red'; ?>">
            <td scope="row"><?php echo $key+1; ?></td>
            <td><?php echo $value['website']; ?></td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
<?php } ?>



