<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Account.php');
$objj=new Account();
$CI =& get_instance();

$list='';

$list=$objj->contact_list();	

$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='".$_GET['id']."'");
$getContact=$contactQuery->row();


// due payment


?>
<div class="main-content">		
<div class="row">
<div class="col-lg-3">
<div class="panel">
<p><a class="btn btn-block btn-secondary" href="#">All Contacts</a></p>

<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="border-radius: 25px;">

<ul class="list-unstyled category-list" id="myUL">
<?php

  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>
<li <?php if($_GET['id']==$list[$i]['5']){?>class="active" <?php }?>><a href="<?=base_url();?>master/Account/contact_log?id=<?=$list[$i]['5'];?>"> <i class="fa fa-circle text-purple"></i> <?=$list[$i]['1'];?> </a></li>
<?php }?>
</ul>
</div>
</div>

<div class="col-lg-9">
<div class="tabs-container">
<ul class="nav nav-tabs">
<li class="active"><a aria-expanded="true" href="#overview" data-toggle="tab">Overview</a></li>

<li><a aria-expanded="false" href="#sales" data-toggle="tab">Invoice</a></li>
<!-- <li><a aria-expanded="false" href="#statement" data-toggle="tab">Ledger Entry</a></li> -->
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
<li>

<a href="#viewcontact" onclick="viewcustomerdetails('<?php echo $_GET['id'];?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'>View Contact</a></li>
<!--<li><a href="#" onClick="openpopup('add_contact',1200,500,'view',<?php echo $_GET['id'];?>)">View Conatct</a></li>-->

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
<?php 

$invQuery=$this->db->query("select sum(total_price) as suminv from tbl_ordered_invoice_dtl where customer_id='".$_GET['id']."'");
$resultget=$invQuery->result_array();

 ?>
<a href="#"><h4>₹<?php echo $resultget[0]['suminv']?></h4></a>
</div>
</div>

<div class="col-sm-4">
<div class="unused">
<p>RECEIVABLES AMOUNT</p>
<?php
 
 $paymentqry=$this->db->query("select sum(total_billamt) as sumreceivedamt from tbl_payment_cash where status!='invoice' and contact_id='".$_GET['id']."'");
 $resultpaymet=$paymentqry->result_array();
?>
<a href="#"><h4>₹<?php echo $resultpaymet[0]['sumreceivedamt'];?></h4></a>
</div>
</div>

<div class="col-sm-5">
<div class="unused">
<p>OUTSTANDING RECEIVABLES</p>
<a href="#"><h4>₹<?=$remaining_amt=$resultget[0]['suminv']-$resultpaymet[0]['sumreceivedamt'];?></h4></a>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="viewcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-content-view">

        </div>
    </div>	 
</div>
</form>
</div>
<div class="clearFix"></div>
<script>
function viewcustomerdetails(v){
var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "viewCustomerNat?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-content-view").innerHTML = xhttp.responseText;
}
</script>	
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
if($invoiceSum==''){
$softwareLog=$this->db->query("select *from tbl_software_log where contact_id='".$_GET['id']."' and (type!='StockPoint/Vendor added' and type!='StockPoint/Vendor Updated') order by id desc");	
}else{
$softwareLog=$this->db->query("select *from tbl_software_log where contact_id='".$_GET['id']."' and (type!='StockPoint/Vendor added' and type!='StockPoint/Vendor Updated') order by id desc");
}
foreach($softwareLog->result() as $getSoftware){

?>

<?php if($getSoftware->type=='Sales Order added' or $getSoftware->type=='Sales Order Updated'){ }else{ ?>
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
if($getSoftware->type=='Payments Received added')
{
?>
Payment of amount ₹<?=$getSoftware->total;?> received by <?php echo $this->session->userdata('user_name');?> <a href='#' style="color:#ec407a" onclick="openpopup('<?=base_url();?>Payment/invoicereport',1200,500,'id',<?=$getSoftware->contact_id;?>)">View</a>

<?php
} elseif($getSoftware->type=='Invoice added' || $getSoftware->type=='Invoice Updated' ){
?>
Invoice No. <?=$getSoftware->log_id?> of amount ₹ <?=$getSoftware->total;?> created by <?php echo $this->session->userdata('user_name');?> <!-- <a style="color:#ec407a" href='#' onClick="openpopup('<?=base_url();?>invoice/invoice/edit_invoice_order_1',1400,600,'view',<?=$getSoftware->log_id;?>)">View</a>  -->
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


<?php } }?>

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
<th>Invoice No.</th> 
<th>Builty No.</th>
<th>Amount</th> 
<th>Action</th> 
</tr> 
</thead> 
<tbody> 
<?php
$invoiceQuery=$this->db->query("select *from tbl_ordered_invoice_hdr where customer_id='".$_GET['id']."'");
foreach($invoiceQuery->result() as $getInvoice){

?>
<tr> 
<th scope="row"><?=$getInvoice->invoice_date;?></th> 
<th><?php 
$nextyear=date("y");
$ss=$getInvoice->ordered_invoiceid;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<td><?=$getInvoice->builty_no;?></td> 
<td>₹<?=$getInvoice->sub_tot;?></td> 
<td>
<button class="btn btn-sm" data-a="<?php echo $fetch_list->contact_id;?>" href='#viewinvoice' type="button" onclick="viewcustomer('<?php echo $getInvoice->ordered_invoiceid;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i>View</i></button>
</td> 
</tr>
<?php }?>
</tbody> 
</table>
</div>
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="viewinvoice" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-invoice-view">

        </div>
    </div>	 
</div>
</form>
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
<div class="tab-pane" id="statement" style="display: none;">
<div class="panel-body">
<table class="table table-hover dataTables-example1">
<thead> 
<tr> 
		<th>Date</th>
		<th>Firm name</th>
		<th>Remarks</th>
        <th>Debit Amount</th>
		<th>Credit Amount</th>   
		<th>Closing Balance</th>
        <th>Payment Mode</th>
		</tr> 
</thead> 
<tbody> 

<?php
	
$fetchq=$this->db->query("select * from tbl_payment_cash where  contact_id='".$_GET['id']."'");
if(!empty($fetchq)) {
foreach($fetchq->result() as $line) {
 
?>
<tr class="gradeC record">

<th><?php echo $line->date; ?></th>
<th></th>
<th><?php echo $line->remarks; ?></th>
<th></th>
<th><?php echo $line->total_billamt; ?></th>
<th><?php echo $line->remarks; ?></th>
<th><?=$line->payment_mode;?></th>
</tr>
<?php } } ?> 
</tbody> 
</table>
 
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function viewcustomer(v){
var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "viewinvoice?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-invoice-view").innerHTML = xhttp.responseText;
}
</script>	
<?php
$this->load->view("footer.php");
?>