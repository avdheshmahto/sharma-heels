<?php
$this->load->view("header.php");

 $contactid=$_GET['contact_id'];
 
 $total_bill=0;
 $queryy1="select * from tbl_invoice_payment where status='Purchaseorder' and contact_id='$contactid' and comp_id = '".$this->session->userdata('comp_id')."'";
$result1=$this->db->query($queryy1);
foreach($result1->result() as $line1){
$total_bill=$total_bill+$line1->receive_billing_mount;
} 
 
$total_billww=0;
 $queryy1="select * from tbl_invoice_payment where status='Purchaseorder' and contact_id='$contactid' and comp_id = '".$this->session->userdata('comp_id')."'";
$result1=$this->db->query($queryy1);
foreach($result1->result() as $line1){
$total_billww=$total_billww+$line1->receive_billing_mount;
}


$queryy123="select * from tbl_invoice_payment where status='payment' and contact_id='$contactid' and comp_id = '".$this->session->userdata('comp_id')."'";
$result123=$this->db->query($queryy123);
foreach(@$result123->result() as $line123){
$receive_bill_amount=$receive_bill_amount+$line123->receive_billing_mount;
}
 $total_billdue=$total_bill-$receive_bill_amount;
 ?>
 <form method="post" action="<?=base_url();?>NewPayment/insert_payment" id="click">
<table class="table table-striped table-bordered table-hover" >
<thead>
<tr>
 		<th>Total Billing Amount</th>
        <th>Receive Amount</th>
		<th>Received Amount</th>   
        <th>Date</th>   
        <th>Due Amount</th> 
         <th>Payment Mode</th>   
		
</tr>
</thead>
<tbody>
<input type="hidden" name="po" value="purchase order" />
<input type="hidden" name="contactname" value="<?php echo $contactid;?>" />
<tr class="gradeC record">
<th><?php echo $total_bill; ?></th>
<th><input type="number" step="any" id="rec_amt_id" name="receive_amount" class="form-control" onkeyup="rmnamnt();" value="" required /></th>
<th><?php echo $receive_bill_amount; ?></th>
<th><input type="date" name="datename" id="dateid" class="form-control" value="" required/></th>	
<th><?php echo $total_billdue;?></th>
<th><select name="payment_mode" id="payment_mode_id" class="form-control" required>
<option value="">--Select--</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">cheque</option>

</select></th>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
<td><input type="button" class="btn btn-primary" onclick="myFunction()" name="save1" value="Record Payment"></td>
<td colspan="3">&nbsp;</td>
<script>
function myFunction() {
	
	var rec_amt_id=document.getElementById("rec_amt_id").value;
	var dateid=document.getElementById("dateid").value;
	var payment_mode_id=document.getElementById("payment_mode_id").value;
	if(rec_amt_id==''){
		alert("Please Enter Receive Amount");
	}else if(dateid==''){
		alert("Please Select Date");
	}else if(payment_mode_id==''){
		alert("Please Select Payment Mode");
	}else{			
    document.getElementById("click").submit();
	}
}
</script>
</tr>
</tbody>
</table>
</form>
<?php
$this->load->view("footer.php");
?>