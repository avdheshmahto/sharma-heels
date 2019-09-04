<?php
$this->load->view("header.php");
?>
	<!-- Main content -->
	<div class="main-content">
		<?php 
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='".$_GET['id']."'");
$contactFetch=$contactQuery->row();

?>
		<h1 class="page-title">(<?php echo $contactFetch->first_name." ".$contactFetch->middle_name." ".$contactFetch->last_name; ?> ) </h1>
		<!-- Breadcrumb -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title"></h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<thead>
<tr>
 		<th>Date</th>
        <th>Debit Amount</th>
		<th>Credit Amount</th>   
		<th>Closing Balance</th>
		<th>Remarks</th>
</tr>
</thead>
<tbody>
<?php

if($_GET['id']!='')
	{
    $queryy="select * from tbl_invoice_payment where  contact_id='".$_GET['id']."' order by id asc ";
	
		}
	$i=$start;
	$j=1;
	$total_billamt=0;
	$z=1;
	$fetchq=$this->db->query($queryy);
if(!empty($fetchq)) {
foreach($fetchq->result() as $line) {
 if($line->status=='invoice'){
    $c+=$line->receive_billing_mount; 
 
}
 $dd=$line->date;
?>
<tr class="gradeC record">
<th><?php echo $dd; ?></th>
<th><?php if($line->status=='invoice'){?><?php echo $line->receive_billing_mount; ?><?php } else{ echo "0"; }?></th>
<th><?php if($line->status=='payment'){?><input type="text" name="billamount[]2" id="billamount[]" value="<?php echo $line->receive_billing_mount;?>" readonly /> <a ><img style="display:none" src="<?php echo base_url();?>/assets/images/edit.png" alt="" border="0" class="icon" title="Delete" onclick="openpopup('invoice_correction',650,400,'id=','<?php echo $line->id;?>')" /></a><?php } else{ ?><input type="text" name="billamount[]" id="billamount <?php echo $z;?>" value="0" readonly /> <?php }?></th>
<th><?php if($line->status=='payment'){?><?php echo $c-=$line->receive_billing_mount;?><?php }else {?><?php echo $c; } ?></th>
<th>
<?php echo $line->remarks?>
</th>	
</tr>
<?php
$debit_total=$debit_total+$balance_total;
	$credit_totals=$credit_totals+$rem_amt12;
	$closing_bal=$closing_bal+$rem_amt;
	 $z++;     
 } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>