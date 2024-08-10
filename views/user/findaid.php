
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
td{
        padding-left: 20px;
}
</style>

<table class="table" id="myTable1">
    <thead>
        <tr>
           
            <th scope="col">Website</th>
            <th scope="col">Guideline</th>
            <th scope="col">Niche</th>
            <th scope="col">Site Category</th>
            <th scope="col">Main Category</th>
            <th scope="col">DA</th>
            <th scope="col">PA</th>
            <th scope="col">DR</th>
            <th scope="col">Spam</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Selling Price</th>
             <th scope="col">Ahref Traffic</th>
             <th scope="col">Follow</th>
             <th scope="col">Semrush Tr.</th>
            <th scope="col">SimilarWeb Tr.</th>
            <th scope="col">1st</th>
            <th scope="col">2nd</th>
            <th scope="col">3rd</th>
            <th scope="col">4th</th> 
            <th scope="col">5th</th>
             <th scope="col">Link Ins. Cost</th>
            <th scope="col">TAT</th>
            <th scope="col">Social Media Posting</th>
            <th scope="col">Web Category</th>
            <th scope="col">Casino CP</th>
            <th scope="col">CBD Price</th>
            <th scope="col">Adult</th>
            <th scope="col">Country</th>
            <th scope="col">Sample URL</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
		<?php if(!empty($websites)){foreach($websites as $key => $value){ ?>
			<tr>
				<td><?php echo $value['website']; ?></td>
				<td><?php echo $value['remark']; ?></td>
				<td><?php echo $value['niche']; ?></td>
				<td><?php echo $value['site_category']; ?></td>
				<td><?php echo $value['main_category']; ?></td>
				<td><?php echo $value['da']; ?></td>
				<td><?php echo $value['pa']; ?></td>
				 <td><?php echo $value['dr']; ?></td>
				<td><?php echo $value['spam_score']; ?></td>
				<td><?php echo $value['price']; ?></td>
				<td><?php echo $value['sailing_price']; ?></td>
				<td><?php echo $value['traffic']; ?></td>
				 <td><?php echo $value['follow']; ?></td>
				 <td><?php echo $value['semrush_traffic']; ?></td>
				<td><?php echo $value['similarweb_traffic']; ?></td>
				<td><?php echo $value['1st']; ?></td>
				<td><?php echo $value['2nd']; ?></td>
				 <td><?php echo $value['3rd']; ?></td>
				<td><?php echo $value['4th']; ?></td>
				<td><?php echo $value['5th']; ?></td>
				<td><?php echo $value['link_insertion_cost']; ?></td>
				<td><?php echo $value['tat']; ?></td>
				<td><?php echo $value['social_media_posting']; ?></td>
				<td><?php echo $value['web_category']; ?></td>
				<td><?php echo $value['casino_adult']; ?></td>
				<td><?php echo $value['cbd_price']; ?></td>
				<td><?php echo $value['adult']; ?></td>
				<td><?php echo $value['web_country']; ?></td>
				<td><?php echo $value['sample_url']; ?></td>
			   <td><?php echo $value['site_update_date']; ?></td>
			</tr>
       <?php }} ?>
        
    </tbody>
</table>




