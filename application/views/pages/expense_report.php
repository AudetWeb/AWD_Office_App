<div class="linksPanel">
<p class="counts">Total Number of Expenses: <b><?php echo $expense_count; ?></b></p>
<p class="links">
<?php //echo anchor('site/create_new_expense',"Create New Expense"); ?>
</p>
</div>
<table class="plainHorizontal alignRight borderRight">
<tr>
<th>Expense Code</th>
<th>Total</th>
<th>Jan</th>
<th>Feb</th>
<th>Mar</th>
<th>Apr</th>
<th>May</th>
<th>Jun</th>
<th>Jul</th>
<th>Aug</th>
<th>Sep</th>
<th>Oct</th>
<th>Nov</th>
<th>Dec</th>
<th>Q1</th>
<th>Q2</th>
<th>Q3</th>
<th>Q4</th>
</tr>
<?php 
$year_total = 0;
$jan_total = 0;
$feb_total = 0;
$mar_total = 0;
$apr_total = 0;
$may_total = 0;
$jun_total = 0;
$jul_total = 0;
$aug_total = 0;
$sep_total = 0;
$oct_total = 0;
$nov_total = 0;
$dec_total = 0;
$q1_total = 0;
$q2_total = 0;
$q3_total = 0;
$q4_total = 0;
?>
<?php foreach($expense as $row) {?>
<tr> 
<td class="alignLeft"><?php echo $expense_code_menu[$row->expense_code_exp]; ?></td>
<td><b><?php echo $row->total; $year_total += $row->total; ?></b></td>
<td><?php echo $row->jan; $jan_total += $row->jan; ?></td>
<td><?php echo $row->feb; $feb_total += $row->feb; ?></td>
<td><?php echo $row->mar; $mar_total += $row->mar; ?></td>
<td><?php echo $row->apr; $apr_total += $row->apr; ?></td>
<td><?php echo $row->may; $may_total += $row->may; ?></td>
<td><?php echo $row->jun; $jun_total += $row->jun; ?></td>
<td><?php echo $row->jul; $jul_total += $row->jul; ?></td>
<td><?php echo $row->aug; $aug_total += $row->aug; ?></td>
<td><?php echo $row->sep; $sep_total += $row->sep; ?></td>
<td><?php echo $row->oct; $oct_total += $row->oct; ?></td>
<td><?php echo $row->nov; $nov_total += $row->nov; ?></td>
<td><?php echo $row->dec; $dec_total += $row->dec; ?></td>
<td class="leftBorderBlack"><?php echo $row->q1; $q1_total += $row->q1; ?></td>
<td><?php echo $row->q2; $q2_total += $row->q2; ?></td>
<td><?php echo $row->q3; $q3_total += $row->q3; ?></td>
<td><?php echo $row->q4; $q4_total += $row->q4; ?></td>
</tr>
<?php } ?>
<tr class="topBorderBlack">
<td class="alignRight"><b>Grant Totals</b></td>
<td><?php echo sprintf("%.2f",$year_total); ?></td>
<td><?php echo sprintf("%.2f",$jan_total); ?></td>
<td><?php echo sprintf("%.2f",$feb_total); ?></td>
<td><?php echo sprintf("%.2f",$mar_total); ?></td>
<td><?php echo sprintf("%.2f",$apr_total); ?></td>
<td><?php echo sprintf("%.2f",$may_total); ?></td>
<td><?php echo sprintf("%.2f",$jun_total); ?></td>
<td><?php echo sprintf("%.2f",$jul_total); ?></td>
<td><?php echo sprintf("%.2f",$aug_total); ?></td>
<td><?php echo sprintf("%.2f",$sep_total); ?></td>
<td><?php echo sprintf("%.2f",$oct_total); ?></td>
<td><?php echo sprintf("%.2f",$nov_total); ?></td>
<td><?php echo sprintf("%.2f",$dec_total); ?></td>
<td class="leftBorderBlack"><?php echo sprintf("%.2f",$q1_total); ?></td>
<td><?php echo sprintf("%.2f",$q2_total); ?></td>
<td><?php echo sprintf("%.2f",$q3_total); ?></td>
<td><?php echo sprintf("%.2f",$q4_total); ?></td>
</tr>
</table>
