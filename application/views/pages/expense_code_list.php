<div class="linksPanel">
<p class="counts">Total Number of Expense Codes: <b><?php echo $expense_code_count; ?></b></p>
<p class="links">
<?php echo anchor('site/create_new_expense_code',"Create New Expense Code"); ?>
</p>
</div>
<table class="plainHorizontal">
<tr>
<th>ID</th>
<th>Expense Code</th>
<!--<th>Description</th>-->
<th>&nbsp;</th>
<th class="small-text">Create Date</th>
<th class="small-text">Create By</th>
</tr>
<?php foreach($expense_code->result() as $row) {?>
<tr> 
<td><?php echo $row->id_ec; ?></td>
<td><?php echo $row->expense_code_ec; ?></td>
<!--<td><?php echo $row->description_ec; ?></td>-->
<td><?php echo anchor('site/update_expense_code/'.$row->id_ec,'Edit','class = "button-block-small"'); ?></td>
<td class="small-text"><?php echo $row->create_date_ec; ?></td>
<td class="small-text"><?php echo $row->create_by_ec; ?></td>
</tr>
<?php } ?>
</table>
