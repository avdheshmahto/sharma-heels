<?php
$this->load->view("header.php");
@extract($_POST);
$invoiceQuery=$this->db->query("select *from tbl_sales_order_hdr where salesid='".$_GET['id']."'");
$getInvoice=$invoiceQuery->row();
?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Account</a></li> 
				
				<li class="active"><strong><a href="#">Manage Payment</a></strong></li> 
			</ol>
		<?php }?>
<script>
function grater()
{
var countin=document.getElementById("countin").value;

var y;
for(y=1;y<=countin;y++)
{

var billamount_receive=document.getElementById("billamount_receive"+y).value;
billamount_receive=Number(billamount_receive);
var billamount=document.getElementById("billamount"+y).value;
billamount=Number(billamount);
var remaining=document.getElementById("remaining"+y).value;
remaining=Number(remaining);
var tg=document.getElementById("tg"+y).value;

if(billamount_receive>billamount && remaining=='')
{
alert("Given amount is grater in Invoice No.:- "+tg);
}
else if(remaining!='' && billamount_receive>remaining)
{
alert("Given amount is grater in Invoice No.:- "+tg);
}
}
}
</script>
<script>

function receivealert()
{

var tot_bill_rec=document.getElementById("total_billamt_receive").value;
tot_bill_rec=Number(tot_bill_rec);
var tot_bill_amt=document.getElementById("total_billamt").value;
tot_bill_amt=Number(tot_bill_amt);
var due_amnt=document.getElementById("due_amount").value;
due_amnt=Number(due_amnt);


if(tot_bill_rec>tot_bill_amt && due_amnt=='')
{
alert("given amount is grater");
}
else if(tot_bill_rec>due_amnt && due_amnt!='' )
{
alert("given amount is grater");
}

}

</script>
		
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title"><strong>Payment</strong></h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" >
<div class="form-group"> 
<label class="col-sm-2 control-label">*Customer Name:</label> 
<div class="col-sm-4"> 				
<select name="customerfname"    class='form-control'>
 
 <?php
 
 if($_GET['id']!='')
 {
	  $contQuery=$this->db->query("select * from tbl_contact_m where comp_id='".$this->session->userdata('comp_id')."' and contact_id='$getInvoice->vendor_id' and group_name='4' order by first_name");
	 
	 
 }
 else
 {
 $contQuery=$this->db->query("select * from tbl_contact_m where comp_id='".$this->session->userdata('comp_id')."' and group_name='4' order by first_name");
 ?>
 <option value=''>None - Please Select</option>
 <?php
 }
 
 foreach($contQuery->result() as $contRow)
{

  ?>
    <option value="<?php echo $contRow->contact_id; ?>" <?php if($contRow->contact_id==$customerfname){?> selected="selected" <?php }?>>
    <?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?></option>
    <?php } ?>
</select>
</div>
<label class="col-sm-2 control-label"><button type="submit" name="Show" class="btn btn-info" value="Show">Show</button></label>    
</div>
</form>
<div class="form-group"> 
<div class="well">
<div class="col-sm-12"></div>
</div> 
</div>
<?php 
@extract($_POST);
$due_amount=0;
$selectin1="select * from tbl_invoice_report where contact_id='$customerfname'";
$resultin1=$this->db->query($selectin1);
foreach($resultin1->result() as $rowin1){
$due_amount=$due_amount+$rowin1->remaining_amt;
$due_amount12=$due_amount12+$rowin1->billamount;
}

?>
<?php

 
if($_GET['id']!='')
{

$total_bill=0;
 $queryy1="select * from tbl_invoice_payment where status='invoice' and contact_id='$getInvoice->vendor_id' and comp_id = '".$this->session->userdata('comp_id')."'";
$result1=$this->db->query($queryy1);
foreach($result1->result() as $line1){
$total_bill=$total_bill+$line1->receive_billing_mount;
}


$queryy123="select * from tbl_invoice_payment where status='payment' and contact_id='$getInvoice->vendor_id' and comp_id = '".$this->session->userdata('comp_id')."'";
$result123=$this->db->query($queryy123);
foreach(@$result123->result() as $line123){
$receive_bill_amount=$receive_bill_amount+$line123->receive_billing_mount;
}

}
else

{
	

$total_bill=0;
 $queryy1="select * from tbl_invoice_payment where status='invoice' and contact_id='$customerfname' and comp_id = '".$this->session->userdata('comp_id')."'";
$result1=$this->db->query($queryy1);
foreach($result1->result() as $line1){
$total_bill=$total_bill+$line1->receive_billing_mount;
}


$queryy123="select * from tbl_invoice_payment where status='payment' and contact_id='$customerfname' and comp_id = '".$this->session->userdata('comp_id')."'";
$result123=$this->db->query($queryy123);
foreach(@$result123->result() as $line123){
$receive_bill_amount=$receive_bill_amount+$line123->receive_billing_mount;
}

}

 $total_billdue=$total_bill-$receive_bill_amount;
//$totaldue_amount=$total_billdue+$due_amount;

?>

<form action="insert_payment" method="post">
<div class="form-group-to"> 
<label class="col-sm-2 control-label">Total Billing Amount:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="total_billamt" name="total_billamt" class="form-control" value="<?php echo $total_bill; ?>" readonly />
</div> 
<input type="hidden" name="customerfname" value="<?php if($_GET['id']!=''){ echo $getInvoice->vendor_id; } else { echo $customerfname; }?>">
<label class="col-sm-2 control-label">Receive Amount:</label> 
<div class="col-sm-4" id="regid"> 
<input type="hidden" id="total_billamt_receive" name="total_billamt_receive" class="form-control" value="<?php if($total_billamt!=''){ echo $rowin1->total_billamt_receive;} ?>" onchange="receivealert()" />
<input type="number" step="any" id="rec12" name="rec_amount12" class="form-control" onkeyup="rmnamnt();" value="" required />
<input type="hidden" step="any" id="bal12" class="form-control" name="bal12" />
</div> 
</div>
<?php 
 //echo $contactid;
         $selectramt="select * from tbl_contact_m where contact_id='$contactid'";
	      $resultramt=$this->db->query($selectramt);
		  $rowramt=$resultramt->row();
	?>
<div class="form-group-to"> 
<label class="col-sm-2 control-label"><u><a href="#" onclick="openpopup('invoicereport',900,630,'id','<?php echo $customerfname;?>')" >Received Amount:</a></u></label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="rec" name="rec_amount" class="form-control" value="<?php if($receive_bill_amount!=''){ echo $receive_bill_amount;} ?>" readonly />
</div> 
<label class="col-sm-2 control-label">Date:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date" name="date123" class="form-control" value="" required/>
</div> 
</div>
<div class="form-group-to"> 
<label class="col-sm-2 control-label">Due Amount:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="due_amount" name="due_amount" class="form-control"  value="<?php if($total_billdue!=''){ echo $total_billdue;} ?>" readonly />
</div> 
<label class="col-sm-2 control-label">Payment Mode</label> 
<div class="col-sm-4" id="regid"> 
<select name="payment_mode" class="form-control" required>
<option value="">--Select--</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">cheque</option>

</select>
<input type="hidden" name="invId" value="<?php echo $_GET['id'];?>" />
<input type="hidden" name="date12">
</div> 
</div>
<script>function rmnamnt(){
var rec12=document.getElementById("rec12").value;
var due_amount=document.getElementById("due_amount").value;
document.getElementById("bal12").value="0.00";
rec12=Number(rec12);
due_amount=Number(due_amount);
if(rec12>due_amount){
document.getElementById("total_billamt_receive").value=due_amount;
document.getElementById("bal12").value=rec12-due_amount;
}else{document.getElementById("total_billamt_receive").value=rec12;}
} </script>
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!=''){
?>
<input type="submit" class="btn btn-primary" name="save" value="Record Payment">
<?php } ?>
<a href="" onclick="popupclose(this.value)"  title="Cancel" class="btn btn-primary"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary" name="save" value="Record Payment">
		</form>
     
       <?php } ?>

</div>
</div>

</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");

?>