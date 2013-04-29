<div class="linksPanel">
<p class="counts">Total Number of Payment Codes: <b><?php echo $payment_code_count; ?></b></p>
<p class="links">
<?php echo anchor('site/create_new_payment_code',"Create New Payment Code"); ?>
</p>
</div>
<table class="plainHorizontal">
<tr>
<th>ID</th>
<th>Payment Code</th>
<th>Description</th>
<th>&nbsp;</th>
<th class="small-text">Create Date</th>
<th class="small-text">Create By</th>
</tr>
<?php foreach($payment_code->result() as $row) {?>
<tr> 
<td><?php echo $row->id_pc; ?></td>
<td><?php echo $row->payment_code_pc; ?></td>
<td><?php echo $row->description_pc; ?></td>
<td><?php echo anchor('site/update_payment_code/'.$row->id_pc,'Edit','class = "button-block-small"'); ?></td>
<td class="small-text"><?php echo $row->create_date_pc; ?></td>
<td class="small-text"><?php echo $row->create_by_pc; ?></td>
</tr>
<?php } ?>
</table>
