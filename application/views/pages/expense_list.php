<div class="linksPanel">
<p class="counts">Total Number of Expenses: <b><?php echo $expense_count; ?></b></p>
<p class="links">
<?php echo anchor('site/create_new_expense',"Create New Expense"); ?>
</p>
</div>
<table class="plainHorizontal">
<tr>
<th>ID</th>
<th>Date</th>
<th>Amount</th>
<th>Description</th>
<th>Expense Code</th>
<th>Payment Code</th>
<th>Vendor Code</th>
<th>&nbsp;</th>
<th class="small-text">Create Date</th>
<th class="small-text">Create By</th>
</tr>
<?php foreach($expense->result() as $row) {?>
<tr> 
<td><?php echo $row->id_exp; ?></td>
<td><?php echo $row->date_exp; ?></td>
<td><?php echo $row->amount_exp; ?></td>
<td><?php echo $row->description_exp; ?></td>
<td><?php echo $expense_code_menu[$row->expense_code_exp]; ?></td>
<td><?php echo $payment_code_menu[$row->payment_code_exp]; ?></td>
<td><?php echo $vendor_menu[$row->vendor_exp]; ?></td>
<td><?php echo anchor('site/update_expense/'.$row->id_exp,'Edit','class = "button-block-small"'); ?></td>
<td class="small-text"><?php echo $row->create_date_exp; ?></td>
<td class="small-text"><?php echo $row->create_by_exp; ?></td>
</tr>
<?php } ?>
</table>
