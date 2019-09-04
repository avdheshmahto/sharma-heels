<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Account.php');
$objj=new Account();
$CI =& get_instance();

$list='';

$list=$objj->contact_list_pay();	

$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='".$_GET['id']."'");
$getContact=$contactQuery->row();


// due payment


$selectin1="select * from tbl_invoice_payment where contact_id='".$_GET['id']."'";
 $resultin1=$this->db->query($selectin1);
 foreach($resultin1->result() as $rowin1)
 {
 
 
 
 if($rowin1->status=='Purchaseorder')
 {
   $invoiceSum=$invoiceSum+$rowin1->receive_billing_mount;
 }
 else
 {
  $paySum=$paySum+$rowin1->receive_billing_mount;
 
 }


 }


//


?>
<div class="main-content">		
<div class="row">
<div class="col-lg-3">
<div class="panel panel-default">
<p><a class="btn btn-block btn-secondary" href="#">All Contacts</a></p>



<ul class="list-unstyled category-list">
<?php

  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>
<li <?php if($_GET['id']==$list[$i]['5']){?>class="active" <?php }?>><a href="<?=base_url();?>master/Account/contact_log_pay?id=<?=$list[$i]['5'];?>"> <i class="fa fa-circle text-purple"></i> <?=$list[$i]['1'];?> </a></li>
<?php }?>
</ul>
</div>
</div>

<div class="col-lg-9">
<div class="tabs-container">
<ul class="nav nav-tabs">
<li class="active"><a aria-expanded="true" href="#overview" data-toggle="tab">Overview</a></li>
<li><a aria-expanded="false" href="#sales" data-toggle="tab">Purchase Order</a></li>
<li><a aria-expanded="false" href="#statement" data-toggle="tab">Ledger Entry</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="overview">
<div class="panel-body scrollbar" id="style-3">
<div class="force-overflow">
<div class="row">
<div class="col-sm-4">
<div class="card">
<div class="card-header">
<div class="card-photo">
<img  src="<?=base_url();?>assets/images/alex-dolgove.png" class="img-circle avatar avatar-shadow">
</div>

<div class="card-short-description">
<div class="pull-right dropdown">
<a data-toggle="dropdown" href="#/" aria-expanded="true" class="btn btn-lg btn-link"><i class="fa fa-ellipsis-v"></i></a>
<ul class="dropdown-menu dropdown-menu-right">
<li><a href="#"onClick="openpopup('add_contact',1200,500,'id',<?php echo $_GET['id'];?>)">Edit Contact</a></li>
<li><a href="#" onClick="openpopup('add_contact',1200,500,'view',<?php echo $_GET['id'];?>)">View Conatct</a></li>

</ul>
</div>
<h5><?=$getContact->first_name." ".$getContact->last_name?></h5>
</div>

<p><br> <?=$getContact->address1;?></p>
</div>

</div><!--card close-->
</div>

<div class="col-sm-8">
<div class="row">
<div class="col-sm-3">
<div class="unused">
<p>Total Amount</p>
<a href="#"><h4>₹<?=$invoiceSum?></h4></a>
</div>
</div>

<div class="col-sm-4">
<div class="unused">
<p>RECEIVABLES AMOUNT</p>
<a href="#"><h4>₹<?=$paySum;?></h4></a>
</div>
</div>

<div class="col-sm-5">
<div class="unused">
<p>OUTSTANDING RECEIVABLES</p>
<a href="#"><h4>₹<?=$remaining_amt=$invoiceSum-$paySum;?></h4></a>
</div>
</div>

</div>
<div class="clearFix"></div>

<div class="row">
<div class="col-sm-12">
<div id="timeline">
<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->

<!--due -->
<?php 
$softwareLog=$this->db->query("select *from tbl_software_log where contact_id='".$_GET['id']."' order by id desc");
foreach($softwareLog->result() as $getSoftware){
?>
<div class="row timeline-movement">
<div class="timeline-badge"></div>
<div class="col-sm-3  timeline-item">
<div class="row">
<div class="col-sm-11">
<div class="timeline-panel credits">
<ul class="timeline-panel-ul">
<li><span class="causale"><?=$getSoftware->maker_date;?> </span> </li>
<li><span class="causale"><?=$getSoftware->author_id;?> </span> </li>
</ul>
</div>
</div>
</div>
</div>

<div class="col-sm-9  timeline-item">
<div class="row">
<div class="col-sm-offset-1 col-sm-11">
<div class="timeline-panel debits">
<ul class="timeline-panel-ul">
<li><span class="causale"><strong><?=$getSoftware->type;?></strong></span></li>
<li><span class="causale">

<?php
if($getSoftware->type=='payment')
{
?>
Payment of amount ₹<?=$getSoftware->total;?> received by <?php echo $this->session->userdata('user_name');?> <a href='#' style="color:#ec407a" onclick="openpopup('<?=base_url();?>Payment/invoicereport',1200,500,'id',<?=$getSoftware->contact_id;?>)">View</a>

<?php
} elseif($getSoftware->type=='Sales Order added' || $getSoftware->type=='Sales Order Updated' ){
?>
Purchase Order No. <?=$getSoftware->log_id?> of amount ₹ <?=$getSoftware->total;?> created by <?php echo $this->session->userdata('user_name');?> <a style="color:#ec407a" href='#' onclick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1200,500,'view',<?=$getSoftware->log_id;?>)">View</a> 
<?php
}
elseif($getSoftware->type=='Payemnt Recorded
')
{
?>
Payment of amount ₹ <?=$getSoftware->total;?> received <?php echo $this->session->userdata('user_name');?> <a style="color:#ec407a" href='#' onclick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1200,500,'view',<?=$getSoftware->log_id;?>)">View</a> 
<?php } else {?>

<?php echo $getSoftware->type;?> by <?php echo $this->session->userdata('user_name');?> 
<?php
}
?>
</span> </li>
</ul>
</div>
</div>
</div>
</div>
</div><!--due -->


<?php }?>

</div><!--timeline close-->
</div>
</div>
</div>
</div>
</div><!--force-overflow close-->
</div><!--panel-body close-->
</div>

<div class="tab-pane" id="comments">
<div class="panel-body">
<p>Coming Soon</p>
</div>
</div>
<div class="tab-pane" id="sales">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover dataTables-example">
<thead> 
<tr> 
<th>Date</th> 
<th>PO.No.</th> 
<th>Amount</th> 
<th>Action</th> 
</tr> 
</thead> 
<tbody> 
<?php
$invoiceQuery=$this->db->query("select *from tbl_purchase_order_hdr where vendor_id='".$_GET['id']."'");
foreach($invoiceQuery->result() as $getInvoice){

?>
<tr> 
<th scope="row"><?=$getInvoice->invoice_date;?></th> 
<td><?=$getInvoice->purchaseorderid;?></td> 
<td>₹<?=$getInvoice->grand_total;?></td> 
<td><a style="color:#ec407a" onClick="openpopup('<?=base_url();?>purchaseorder/purchaseorder/edit_purchase_order',1400,600,'view',<?=$getInvoice->purchaseorderid;?>)" >View</a> </td> 
</tr>

<?php }?>

 
 
 
</tbody> 
</table>
</div>
</div>
</div>
<div class="tab-pane" id="mails">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover">
<thead> 
<tr> 
<th>To</th> 
<th>Description</th> 
<th>Type</th> 
</tr> 
</thead> 
<tbody> 
<tr> 
<th scope="row">collestbablu@gmail.com<br>
(04/07/2017)</th> 
<td>Invoice - INV-000003 from techvyas<br>
by collestbablu@gmail.com</td> 
<td>Invoice Notification</td> 
</tr>

 
 
 
</tbody> 
</table>
</div>
</div>
</div>
<div class="tab-pane" id="statement">
<div class="panel-body">
<table class="table table-hover dataTables-example1">
<thead> 
<tr> 
<th>Date</th>
<th>Particulars</th>
        <th>Debit Amount</th>
		<th>Credit Amount</th>   
		<th>Closing Balance</th>
		<th>Mode</th></tr> 
</thead> 
<tbody> 
<?php
$invoiceQuery=$this->db->query("select *from tbl_purchase_order_hdr where vendor_id='".$_GET['id']."'");
foreach($invoiceQuery->result() as $getInvoice){

?>
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
 if($line->status=='Purchaseorder'){
    $c+=$line->receive_billing_mount; 
 
}
 $dd=$line->date;
?>
<tr class="gradeC record">
<th><?php echo $dd; ?></th>
<th>
<?php  echo $line->status;?>(<?=$line->invoiceid;?>)
</th>	
<th><?php if($line->status=='Purchaseorder'){?><?php echo $line->receive_billing_mount; ?><?php } else{ echo "0"; }?></th>
<th><?php if($line->status=='payment'){?><input type="text" name="billamount[]2" id="billamount[]" value="<?php echo $line->receive_billing_mount;?>" readonly /> <a style="display:none" ><img src="<?php echo base_url();?>/assets/images/edit.png" alt="" border="0" class="icon" title="Delete" onclick="openpopup('invoice_correction',650,400,'id=','<?php echo $line->id;?>')" /></a><?php } else{ ?>0<?php }?></th>
<th><?php if($line->status=='payment'){?><?php echo $c-=$line->receive_billing_mount;?><?php }else {?><?php echo $c; } ?></th>
<th><?=$line->payment_mode;?></th>
</tr>
<?php
$debit_total=$debit_total+$balance_total;
	$credit_totals=$credit_totals+$rem_amt12;
	$closing_bal=$closing_bal+$rem_amt;
	 $z++;     
 } }}?>


 
</tbody> 

</table>


 
</div>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>