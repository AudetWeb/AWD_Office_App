
<?php
if( ! $expense_items) { 
$attributes = array(
    'id' => 'expense_list_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<table class="plainVertical" border="0" cellpadding="0" cellspacing="0">
<tr>
    <th>Expense List</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'expense_import_list',
        'class' => 'tall wide',
        'id' => 'expense_import_list',
        'value' => $expense_import_list
    );
    echo form_textarea($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>&nbsp;</th>
    <td>
    <?php
    $attributes = 'class="button"';
    echo form_submit('import_expense', 'Import Expense',$attributes); 
    echo form_reset('reset', 'Reset',$attributes); 
    ?>
    <?php echo anchor('site/expense_list/','Back to Expense List','class = "button"'); ?>
    </td>
</tr>
</table>
<?php 
echo form_close(); 
} // ! expense_items
?>

<pre>
<?php //print_r($expense_import_items); ?>
<?php //print_r($expense_items); ?>
</pre>

<?php 
if($expense_items) {
$attributes = array(
    'id' => 'expense_items_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<table class="plainHorizontal alignTop" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
<tr>
<th>Date</th>
<th>Amount</th>
<th>Expense Code</th>
<th>Description</th>
<th>Payment Code</th>
</tr>
<?php foreach ($expense_items as $row) { ?>
<tr>
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
    'class' => '',
    'value' => $row['description_exp']
);
echo form_textarea($field_data);
?>
</td>
<td>
<?php 
    echo form_dropdown('payment_code_exp[]', $payment_code_menu, $row['payment_code_exp']);
?>
</tr>
<?php } ?>
<tr>
<td colspan="5">
<?php
$attributes = 'class="button"';
echo form_submit('save_expense_items', 'Save Expenses',$attributes); 
echo form_reset('reset', 'Reset',$attributes); 
?>
</td>
</tr>
</table>
<?php 
echo form_close(); 
} // expense_items
?>
