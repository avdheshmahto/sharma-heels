<style type="text/css">
	.readonlycol
			{
				border: none!important;
				background-color: #ffffff!important;

			}
</style>

<?php

$invid=array();
$sum=$this->db->query("select sum(grand_total) as inv_sum from tbl_gst_invoice_hdr");
$sum_amt=$sum->row();
$contactquery=$this->db->query("select * from tbl_gst_invoice_hdr where customer_name='$cid' and firm_id='$firmid' and c_firm_name='$c_firm_name'");
$i=1;
foreach($contactquery->result() as $hdrres)
	{
		$invid[$i]=$hdrres->gst_inv_id;
		$i++;
	}
		$val=0;
		$unpaidinv=array();
	
	?>
<style>
.fullpayment
	{
	background:#FF0000;
	
	}
.fullpayment:hover
	{
	background:#6600CC;
	}
th
	{
	text-align:center!important;
	}
</style>
<div id="table-responsive">
<input type="hidden" name="sum_amt" id="sum_amt" <?php if($sum_invoices==''){?> value="<?=$sum_amt->inv_sum;?>"  <?php } ?>/>
<table class="table table-striped table-bordered table-hover tableupdateanyvarible" id="gst_payment_table" >
<thead> 
<tr>
		<th>Date</th>
        <th>Invoice Number</th>
		<th>Invoice Amount</th>
		<th>Amount Due</th>
		<th>Payment</th>
</tr>
</thead>
<?php 
for($j=1;$j<$i;$j++)
	{
	
		$inv_hdr=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='$invid[$j]'");
		$inv_det=$inv_hdr->row();
		
$due=$this->db->query("select * from tbl_payment_gst_dtl_new where inv_no='".$inv_det->gst_inv_id."'");
$duesum=$this->db->query("select sum(payment) as amount from tbl_payment_gst_dtl_new where inv_no='".$inv_det->gst_inv_id."'");
$duesumres=$duesum->row();
$f=0;
$due_re=$due->result();	
		
foreach($due_re as $due_res)
	{
		
		
		if($due_res->payment_status!='')
		{
				
				$f=1;
				break;
		}
	}
if($f==0)
{			
	 	 $unpaidinv[$val]=$j;
	 //echo $unpaidinv[$val];
	 
?>


<tr class="gradeC record">
<!--<th><input type="text" name="unpaidinvrows" value="<?php //echo $unpaidinv[$val];?>" /></th>
--><th><input type="text" value="<?=$inv_det->inv_date?>" name="inv_date[]" readonly="true" class="form-control"/></th>
<th><input type="text" value="<?=$inv_det->invoice_no?>" readonly="true" name="invoice_number[]" class="form-control"/></th>
<input type="hidden" value="<?=$inv_det->gst_inv_id?>" readonly="true" name="invoice_no[]" class="form-control"/>

<th><input type="text" id="g_total" value="<?=$inv_det->grand_total?>" readonly="true" class="form-control" name="g_total[]"/></th>
<th><input type="text" id="amount_due<?=$j?>" value="<?php  echo ($inv_det->grand_total)-($duesumres->amount);?>" readonly="true" class="form-control" name="amount_due[]"/></th>
<th><input type="text" id="paymentsubmit<?=$j?>" class="form-control" name="paymentsubmit[]" onkeyup="amtdue('<?=$j?>');"/>
<input type="hidden" name="payment_status[]" id="payment_status<?=$j?>" />

<input type="button" class="btn btn-sm fullpayment" onclick="full_payment_function(amount_due<?=$j?>,<?=$j?>);" value="PAY FULL">
</div>
</th>
</tr>
<?php $val++; }}?>
<tr>
<?php $myarr=json_encode($unpaidinv,true);?>
<td><input type="hidden" name="rows" id="rows" value="<?=$j?>" /><input type="hidden" name="roows" id="roows" value="<?=$myarr?>" />
</td>
<td></td>
<th><input type="button" class="btn btn-sm" value="SAVE"  id="save"/>
<a class="btn btn-secondary btn-sm" href="<?=base_url("GstPayment/manage_gst_payment");?>">Cancel</a>
<td></td>
<td></td>
</th>
</tr>
<tr>
<th></th>
</tr>
</tbody>
</table>
</div>
<script>

function full_payment_function(val,id)
	{
		
		//alert("paymentsubmit"+id);
		//alert("paymentsubmit"+id+"="+val);
		var amtdue=document.getElementById("amount_due"+id).value;
		if(Number(amtdue)!=0)
		{
		document.getElementById("paymentsubmit"+id).focus();
		document.getElementById("paymentsubmit"+id).value=val.value;			
		}
		//document.getElementById("payment_status"+id).value="done";
	}
function amtdue(countvalue)
	{
	
		var payment=document.getElementById("paymentsubmit"+countvalue).value;
		var amtdue=document.getElementById("amount_due"+countvalue).value;
		
	}

$(document).ready(function(){
$("#save").click(function(){
	if($("#payment_mode").val()=='')
		{alert("Please enter payment mode");//$("#save").trigger("click");
		}
	else
	{
		if($("#save").attr("type")!="submit"){
		setTimeout(function(){
			$("#save").attr("type","submit").trigger("click");
		
		  }, 10);	
		  }
		 
  	}
	});
	});
	
/*function sumassign()
	{
		var sum=document.getElementById("sum_amt").value;
		alert(sum);
		document.getElementById("sum_invoices").value=sum;
	}*/
/*$("#save").on("click",function(){
.trigger("click");
});
*/
</script>