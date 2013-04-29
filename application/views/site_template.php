<?php
// Get the current page name from the server variables
$currentPage = substr(strrchr($_SERVER['SCRIPT_NAME'],'/'),1);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">
<base href="<?php echo base_url(); ?>">
<title><?php echo $titleTag; ?></title>
<link href="assets/css/AWD_reset.css" rel="stylesheet">
<link href="assets/css/AWD_layout.css" rel="stylesheet">
<link href="assets/css/AWD_elements.css" rel="stylesheet">
<link href="assets/css/AWD_tables.css" rel="stylesheet">
<link href="assets/css/AWD_forms.css" rel="stylesheet">
<link href="assets/css/AWD_navigation.css" rel="stylesheet">
<link href="assets/css/AWD_print.css" rel="stylesheet" media="print">

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet">

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
</head>

<body>
<div id="main-frame">
	<div id="header-panel" class="panelWidth">
		<div class="banner">Office.AudetWebHosting.net
        </div>

        <?php if ($this->validSession) { ?>
		<div class="navigation-line">
        <?php $curTag = ' class="current"'; ?>
        
        <ul class="nav">

        <?php if ( '' == uri_string() OR 'site' == uri_string() OR 'site/index' == uri_string() ) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/index','Home'); ?></li>

        <?php if ( 'site/logout' == uri_string() ) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/logout','Logout'); ?></li>
        
        <?php if (strpos(uri_string(),'site/expense_list') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/expense_list','Expenses'); ?></li>

        <?php if (strpos(uri_string(),'site/update_expense_grid') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/update_expense_grid','Expense Grid'); ?></li>

        <?php if (strpos(uri_string(),'site/import_expense') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/import_expense','Import Expenses'); ?></li>

        <?php if (strpos(uri_string(),'site/expense_report') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/expense_report','Expense Report'); ?></li>

        <li><b>Setup:</b></li>

        <?php if (strpos(uri_string(),'site/vendor_list') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/vendor_list','Vendors'); ?></li>
        
        <?php if (strpos(uri_string(),'site/expense_code_list') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/expense_code_list','Expense Codes'); ?></li>

        <?php if (strpos(uri_string(),'site/payment_code_list') !== FALSE) {$cTag = $curTag; } else { $cTag = ''; } ?>
        <li<?php echo $cTag; ?>><?php echo anchor('site/payment_code_list','Payment Codes'); ?></li>

        </ul>
        </div>
        <?php } ?>

	</div><!-- #header-panel -->

	<div id="content-panel" class="panelWidth">
        <?php if ($lhsContent) { ?>
		<div class="lhsPanel roundedCorners">
<?php echo $lhsContent; ?>
		</div>
        <?php } ?>
		<div class="content<?php if (isset($styleContent)) echo $styleContent; ?>">
		<h1 class="pageTitle"><?php echo $pageTitle; ?></h1>
<?php echo $mainContent; ?>
		</div>
		<div class="clearFix"><!-- --></div>
	</div><!-- #content-panel -->

	<div id="footer-panel" class="panelWidth">
		<div class="copyright">Copyright 2013 Audet Web Design. All rights reserved.</div>
		<div class="clearFix"><!-- --></div>
	</div><!-- #footer-panel -->
</div><!-- #main-frame -->
<script>
    $(document).ready(function() {
        $(".openCloseButton").click(function(){ $(this).nextAll().toggle(); });
        $(".openCloseButton").hover(function(){ $(this).toggleClass("hoverDeco"); });
        $(".openCloseButton").nextAll().hide();

        $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    });
</script>

</body>
</html>
