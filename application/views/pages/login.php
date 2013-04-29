<p>Please enter your <b>User ID</b> and <b>Password</b>.</p>

<div class="loginPanel">
<?php echo form_open('site/login'); ?>
<?php echo form_input('theUserID'); ?><p>User ID<span>*</span></p>
<?php echo form_error('theUserID'); ?>
<?php echo form_password('thePassword'); ?><p>Password<span>*</span></p>
<?php echo form_error('thePassword'); ?>
<?php echo form_submit('login','Sign In'); ?>
<?php echo form_close(); ?>
</div>
