<p><b class="required-icon">R</b> denotes a required field.</p>

<?php 
$attributes = array(
    'id' => 'vendor_form',
    'class' => 'profile'
);
echo form_open($this->uri->uri_string(),$attributes); 
?>
<table class="plainVertical" border="0" cellpadding="0" cellspacing="0">
<tr>
    <th>Vendor ID</th>
    <td><?php echo $vendor->id_ven; ?></td>
</tr>
<tr>
    <th><b>R</b> Vendor Name</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'vendor_name_ven',
        'class' => 'required',
        'id' => 'vendor_name_ven',
        'value' => $vendor->vendor_name_ven
    );
    echo form_input($field_data);
    ?>
    </td>
</tr>
<tr>
    <th>Vendor Website</th>
    <td>
    <?php 
    $field_data = array(
        'name' => 'vendor_website_ven',
        'class' => '',
        'id' => 'vendor_website_ven',
        'value' => $vendor->vendor_website_ven
    );
    echo form_input($field_data);
    ?><i>e.g. www.somevendor.com</i>
    </td>
</tr>
<tr>
    <th>Date Modified</th>
    <td><?php echo $vendor->modify_date_ven; ?></td>
</tr>
<tr>
    <th>Date Created</th>
    <td><?php echo $vendor->create_date_ven; ?></td>
</tr>
<tr>
    <th>Modified By</th>
    <td><?php echo $vendor->modify_by_ven; ?></td>
</tr>
<tr>
    <th>Created By</th>
    <td><?php echo $vendor->create_by_ven; ?></td>
</tr>
<tr>
    <th>Menu Status</th>
    <td>
    <?php 
        $options = array(
            '0'  => 'Hide',
            '1'    => 'Show'
        );
        echo form_dropdown('is_active_ven', $options, $vendor->is_active_ven);
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
        echo form_dropdown('is_deleted_ven', $options, $vendor->is_deleted_ven);
    ?>
    </td>
</tr>
<tr>
    <th>&nbsp;</th>
    <td>
    <?php
    $attributes = 'class="button"';
    echo form_submit('update_vendor', 'Update Vendor',$attributes); 
    echo form_reset('reset', 'Reset',$attributes); 
    ?>
    <?php echo anchor('site/vendor_list/','Back to Vendor List','class = "button"'); ?>
    </td>
</tr>
</table>
<?php echo form_close(); ?>

<script>
$(document).ready(function() {
    $("#vendor_form").validate();
});
</script>
