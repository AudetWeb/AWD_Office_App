
<pre>
<?php //print_r($expense_import_items); ?>
<?php //print_r($expense_items); ?>
</pre>

<?php 
$attributes = array(
    'id' => 'expense_items_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<div class="submitControl">
<?php
$attributes = 'class="button"';
echo form_submit('update_expense_grid', 'Save Expenses',$attributes); 
echo form_reset('reset', 'Reset',$attributes); 
?>
</div>
<table class="plainHorizontal alignTop" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
<tr>
<th>#</th>
<th>Date</th>
<th>Amount</th>
<th>Expense Code</th>
<th>Description</th>
<th>Payment Code</th>
<th>Vendor</th>
</tr>
<?php 
if($expense_items) {} // expense_items
$num = 0;
foreach ($expense_items as $row) { 
$num++;
?>
<tr>
<td><?php echo $num; ?></td>
<td>
<?php 
echo form_hidden('id_exp[]',$row['id_exp']);

$field_data = array(
    'name' => 'date_exp[]',
    'class' => 'datepicker short',
    'value' => $row['date_exp']
);
echo form_input($field_data);
?>
</td>
<td>
<?php 
$field_data = array(
    'name' => 'amount_exp[]',
    'class' => 'short',
    'value' => $row['amount_exp']
);
echo form_input($field_data);
?>
</td>
<td>
<?php 
    echo form_dropdown('expense_code_exp[]', $expense_code_menu, $row['expense_code_exp']);
?>
</td>
<td>
<?php 
$field_data = array(
    'name' => 'description_exp[]',
    'class' => 'short',
    'value' => $row['description_exp']
);
echo form_textarea($field_data);
?>
</td>
<td>
<?php 
    echo form_dropdown('payment_code_exp[]', $payment_code_menu, $row['payment_code_exp']);
?>
</td>
<td>
<?php 
    echo form_dropdown('vendor_exp[]', $vendor_menu, $row['vendor_exp']);
?>
</td>
</tr>
<?php } ?>
<tr>
<td colspan="5">
<?php
$attributes = 'class="button"';
echo form_submit('update_expense_grid', 'Save Expenses',$attributes); 
echo form_reset('reset', 'Reset',$attributes); 
?>
</td>
</tr>
</table>
<?php 
echo form_close(); 
?>
