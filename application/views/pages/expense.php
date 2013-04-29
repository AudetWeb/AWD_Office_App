<p><b class="required-icon">R</b> denotes a required field.</p>

<?php 
$attributes = array(
    'id' => 'expense_form',
    'class' => 'profile'
);
echo form_open_multipart($this->uri->uri_string(),$attributes); 
?>
<table class="plainVertical" border="0" cellpadding="0" cellspacing="0">
<tr>
    <th>Expense ID</th>
    <td><?php echo $expense->id_exp; ?></td>
</tr>
<tr>
    <th><b>R</b> Date</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'date_exp',
        'class' => 'required datepicker',
        'id' => 'date_exp',
        'value' => $expense->date_exp
    );
    echo form_input($field_data);
    ?>
    </td>
</tr>
<tr>
    <th><b>R</b> Amount</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'amount_exp',
        'class' => 'required',
        'id' => 'amount_exp',
        'value' => $expense->amount_exp
    );
    echo form_input($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Description </th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'description_exp',
        'class' => '',
        'id' => 'description_exp',
        'value' => $expense->description_exp
    );
    echo form_textarea($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Vendor</th>
    <td>
    <?php 
        echo form_dropdown('vendor_exp', $vendor_menu, $expense->vendor_exp);
    ?>
    </td>
</tr>
<tr>
    <th>Expense Code</th>
    <td>
    <?php 
        echo form_dropdown('expense_code_exp', $expense_code_menu, $expense->expense_code_exp);
    ?>
    </td>
</tr>
<tr>
    <th>Payment Code</th>
    <td>
    <?php 
        echo form_dropdown('payment_code_exp', $payment_code_menu, $expense->payment_code_exp);
    ?>
    </td>
</tr>
<tr>
    <th>Payment Detail</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'payment_detail_exp',
        'id' => 'payment_detail_exp',
        'value' => $expense->payment_detail_exp
    );
    echo form_input($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Invoice</th>
    <td>
    <p><a href="<?php echo base_url(UPLOAD_PATH . '/' . $expense->invoice_exp); ?>" target="_blank"><?php echo $expense->invoice_exp; ?></a></p>
    <?php 
    $field_data = array(
        'name' => 'userfile'
    );
    echo form_upload($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Date Modified</th>
    <td><?php echo $expense->modify_date_exp; ?></td>
</tr>
<tr>
    <th>Date Created</th>
    <td><?php echo $expense->create_date_exp; ?></td>
</tr>
<tr>
    <th>Modified By</th>
    <td><?php echo $expense->modify_by_exp; ?></td>
</tr>
<tr>
    <th>Created By</th>
    <td><?php echo $expense->create_by_exp; ?></td>
</tr>
<tr>
    <th>Menu Status</th>
    <td>
    <?php 
        $options = array(
            '0'  => 'Hide',
            '1'    => 'Show'
        );
        echo form_dropdown('is_active_exp', $options, $expense->is_active_exp);
    ?>
    </td>
</tr>
<tr>
    <th>Record Status</th>
    <td>
    <?php 
        $options = array(
            '0'  => 'Active',
            '1'    => 'Deleted'
        );
        echo form_dropdown('is_deleted_exp', $options, $expense->is_deleted_exp);
    ?>
    </td>
</tr>
<tr>
    <th>&nbsp;</th>
    <td>
    <?php
    $attributes = 'class="button"';
    echo form_submit('update_expense', 'Update Expense',$attributes); 
    echo form_reset('reset', 'Reset',$attributes); 
    ?>
    <?php echo anchor('site/expense_list/','Back to Expense List','class = "button"'); ?>
    </td>
</tr>
<?php if ($upload_msg) { ?>
<tr>
<td colspan="2">
<?php     
echo '<h2 class="error">Upload Error Message</h2>';
echo "<p>$upload_rc</p>";
?>
</td>
</tr>
<?php }?>
</table>
<?php echo form_close(); ?>

<pre><?php echo $upload_msg; ?></pre>

<script>
$(document).ready(function() {
    $("#expense_form").validate();
});
</script>
