<p><b class="required-icon">R</b> denotes a required field.</p>

<?php 
$attributes = array(
    'id' => 'expense_code_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<table class="plainVertical" border="0" cellpadding="0" cellspacing="0">
<tr>
    <th>Expense Code ID</th>
    <td><?php echo $expense_code->id_ec; ?></td>
</tr>
<tr>
    <th><b>R</b> Expense Code</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'expense_code_ec',
        'class' => 'required',
        'id' => 'expense_code_ec',
        'value' => $expense_code->expense_code_ec
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
        'name' => 'description_ec',
        'class' => '',
        'id' => 'description_ec',
        'value' => $expense_code->description_ec
    );
    echo form_textarea($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Date Modified</th>
    <td><?php echo $expense_code->modify_date_ec; ?></td>
</tr>
<tr>
    <th>Date Created</th>
    <td><?php echo $expense_code->create_date_ec; ?></td>
</tr>
<tr>
    <th>Modified By</th>
    <td><?php echo $expense_code->modify_by_ec; ?></td>
</tr>
<tr>
    <th>Created By</th>
    <td><?php echo $expense_code->create_by_ec; ?></td>
</tr>
<tr>
    <th>Menu Status</th>
    <td>
    <?php 
        $options = array(
            '0'  => 'Hide',
            '1'    => 'Show'
        );
        echo form_dropdown('is_active_ec', $options, $expense_code->is_active_ec);
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
        echo form_dropdown('is_deleted_ec', $options, $expense_code->is_deleted_ec);
    ?>
    </td>
</tr>
<tr>
    <th>&nbsp;</th>
    <td>
    <?php
    $attributes = 'class="button"';
    echo form_submit('update_expense_code', 'Update Expense Code',$attributes); 
    echo form_reset('reset', 'Reset',$attributes); 
    ?>
    <?php echo anchor('site/expense_code_list/','Back to Expense Code List','class = "button"'); ?>
    </td>
</tr>
</table>
<?php echo form_close(); ?>

<script>
$(document).ready(function() {
    $("#expense_code_form").validate();
});
</script>
