<div class="linksPanel">
<p class="counts">Total Number of Vendors: <b><?php echo $vendor_count; ?></b></p>
<p class="links">
<?php echo anchor('site/create_new_vendor',"Create New Vendor"); ?>
</p>
</div>
<table class="plainHorizontal">
<tr>
<th>ID</th>
<th>Vendor Name</th>
<th>&nbsp;</th>
<th class="small-text">Create Date</th>
<th class="small-text">Create By</th>
</tr>
<?php foreach($vendor->result() as $row) {?>
<tr> 
<td><?php echo $row->id_ven; ?></td>
<td>
<?php if ($row->vendor_website_ven) { ?>
<a href="<?php echo prep_url($row->vendor_website_ven); ?>" target="_blank"><?php echo $row->vendor_name_ven; ?></a>
<?php } else { ?>
<?php echo $row->vendor_name_ven; ?>    
<?php } ?>
</td>
<td><?php echo anchor('site/update_vendor/'.$row->id_ven,'Edit','class = "button-block-small"'); ?></td>
<td class="small-text"><?php echo $row->create_date_ven; ?></td>
<td class="small-text"><?php echo $row->create_by_ven; ?></td>
</tr>
<?php } ?>
</table>
