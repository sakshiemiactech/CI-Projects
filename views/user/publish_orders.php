<style type="text/css">
    .dataTables_scrollHeadInner.dataTable{
        width:0px !important;
    }
   table{
    width: 100% !important;

}

</style>
<table class="table" id="myTable1">
    <thead>
        <tr>
            <th scope="col">O.N.</th>
            <th scope="col">O.ID.</th>
            <th scope="col">Client Name</th>
            <th scope="col">Publish URL</th>
			<th scope="col">Client Niche</th>
            <th scope="col">Remark</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($orders)){foreach($orders as $key => $value){ ?>
        <tr>
            <td><?php echo $value['order_number']; ?></td>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['clients_name']; ?></td>
            <td><a href="<?php echo $value['publish_url']; ?>" target="_blank"><?php echo substr($value['publish_url'], 0, 2000); ?></a></td>
			<td><?php echo $value['cnishe']; ?></td>
            <td><?php echo $value['remark']; ?></td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
