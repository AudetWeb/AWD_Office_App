<p><b class="required-icon">R</b> denotes a required field.</p>

<?php 
$attributes = array(
    'id' => 'payment_code_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<table class="plainVertical" border="0" cellpadding="0" cellspacing="0">
<tr>
    <th>Payment Code ID</th>
    <td><?php echo $payment_code->id_pc; ?></td>
</tr>
<tr>
    <th><b>R</b> Payment Code</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'payment_code_pc',
        'class' => 'required',
        'id' => 'payment_code_pc',
        'value' => $payment_code->payment_code_pc
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
        'name' => 'description_pc',
        'class' => '',
        'id' => 'description_pc',
        'value' => $payment_code->description_pc
    );
    echo form_textarea($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Date Modified</th>
    <td><?php echo $payment_code->modify_date_pc; ?></td>
</tr>
<tr>
    <th>Date Created</th>
    <td><?php echo $payment_code->create_date_pc; ?></td>
</tr>
<tr>
    <th>Modified By</th>
    <td><?php echo $payment_code->modify_by_pc; ?></td>
</tr>
<tr>
    <th>Created By</th>
    <td><?php echo $payment_code->create_by_pc; ?></td>
</tr>
<tr>
    <th>Menu Status</th>
    <td>
    <?php 
        $options = array(
            '0'  => 'Hide',
            '1'    => 'Show'
        );
        echo form_dropdown('is_active_pc', $options, $payment_code->is_active_pc);
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
        echo form_dropdown('is_deleted_pc', $options, $payment_code->is_deleted_pc);
    ?>
    </td>
</tr>
<tr>
    <th>&nbsp;</th>
    <td>
    <?php
    $attributes = 'class="button"';
    echo form_submit('update_payment_code', 'Update Payment Code',$attributes); 
    echo form_reset('reset', 'Reset',$attributes); 
    ?>
    <?php echo anchor('site/payment_code_list/','Back to Payment Code List','class = "button"'); ?>
    </td>
</tr>
</table>
<?php echo form_close(); ?>

<script>
$(document).ready(function() {
    $("#payment_code_form").validate();
});
</script>
