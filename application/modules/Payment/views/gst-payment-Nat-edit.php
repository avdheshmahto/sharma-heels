<?php
$this->load->view("header.php");
?>
<?php
$contactquery=$this->db->query("select * from tbl_contact_m");
$cqres=$contactquery->result();


?>
<body>
	 <!-- Main content -->
	 <div class="main-content">
	 <a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">GST PAYMENT</a>

<form class="form-horizontal" id="insert_form_data" role="form" method="post" action="payment_gst">			
			
		
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
						
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>

<tr  class="gradeA">
 
<th>*Firm</th>
        <th> <select  name="firmid" id="firmid" class="form-control" required>
            <option value="">----Select ----</option>
			<?php 
		$query1=$this->db->query("select * from tbl_master_data where param_id=25");
		//$que=$query1->row();
			foreach($query1->result() as $que){
			?>
			<option value="<?=$que->serial_number; ?>"><?=$que->keyvalue;?></option>
			<?php } ?>
          </select>
        </th>
<th>*Customer Name:</th> 
<th style="width:160px;"><select name="customer_name" id="customer_name" required class="form-control" onChange="customer_name_id();">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>
</th>
<th>C.Firm Name</th>  
<th style="width:160px;">
<div id="c_firm_name_get">
						<select name="c_firm_name" id="c_firm_name" required class="form-control">
						<option value="">----Select----</option>
						</select>
</div>
</th>

</tr>

<tr  class="gradeA">

<th>*Date:</th> 

<th style="width:180px;"><input name="dates" id="dates"  type="text" value="<?=date("d/m/Y")?>" class="form-control datepicker" required> 
</th>


<th>*Payment Mode:</th>
<th><select name="payment_mode" id="payment_mode" class="form-control">
<option value="">----Select----</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">Cheque</option>
</select>
</th>
<th>Sum Amount</th>
<th><input name="sum_invoices" id="sum_invoices"  type="text" value="" class="form-control" onKeyUp="excess_amount();"/><input name="full_pay" id="full_pay"  type="hidden" value="" class="form-control"><input name="excess_amount_value" id="excess_amount_value"  type="hidden" value="" class="form-control"></th>
</tr>
<tr class="gradeA">
<th colspan="5"></th>
<th><input type="button" class="btn btn-sm" name="fullpayment" id="fullpayment" value="FULL PAYMENT"  onClick="full_payment_all();">
<input type="hidden" name="arr[]" id="arr">
</th>

</tr>
</tbody>
</table>
</div>
</div>
<div id="invoice_details">
</div>

</form>


</div>
</div>
</div>
</div>



<script>

function invoicedetail()
	{
		
				$.ajax({
				type:"POST",
				url:"<?php echo base_url('Payment/tbl_payment_gst_invoice_load');?>",
				data:$('#insert_form_data').serialize(),
				success:function(data){
				
										$( "#invoice_details" ).html(data);
				
					//document.getElementById("sum_invoices").value=document.getElementById("sum_amt").value;
					
							document.getElementById("arr").value=document.getElementById("roows").value;
										
															
									  }
				});
	}
function customer_name_id()
	{
		var customer_name=document.getElementById("customer_name").value;
		var c_firm_id=document.getElementById("c_firm_name").value;
		var datas="cid="+customer_name;
		//alert(data);
		$.ajax({
		type:"POST",
		url:"<?=base_url('Payment/c_firm_name_func')?>",
		data:datas,
		success:function(data){
				//alert(data);
				$( "#c_firm_name_get" ).html(data);
				}
			});
	}
	
function full_payment_all()
	{
		var obj=document.getElementById("arr").value;
		var val=JSON.parse(obj);
		var sum=0;
		for(i=0;i<val.length;i++)
		{
	 	document.getElementById("paymentsubmit"+val[i]).value=document.getElementById("amount_due"+val[i]).value;
	
		sum=sum+Number(document.getElementById("amount_due"+val[i]).value);
		}
		document.getElementById("sum_invoices").value=sum;
		document.getElementById("full_pay").value=sum;
			}
function assign_full_pay()
	{
		var obj=document.getElementById("arr").value;
		var val=JSON.parse(obj);
		var sum=0;
		for(i=0;i<val.length;i++)
		{
	 		sum=sum+Number(document.getElementById("amount_due"+val[i]).value);
		}
		//document.getElementById("sum_invoices").value=sum;
		document.getElementById("full_pay").value=sum;
			}


function excess_amount()
	{
				assign_full_pay();

				var sum_invoices=document.getElementById("sum_invoices").value;
				var full_pay=document.getElementById("full_pay").value;
				sum_invoices=Number(sum_invoices);
				full_pay=Number(full_pay);
							if(Number(sum_invoices)>Number(full_pay)){
					
							var obj=document.getElementById("arr").value;
							var val=JSON.parse(obj);
							var sum=0;

						for(i=0;i<val.length;i++)
							{
							document.getElementById("paymentsubmit"+val[i]).value=document.getElementById("amount_due"+val[i]).value;
							sum=sum+Number(document.getElementById("amount_due"+val[i]).value);
							}
							
							document.getElementById("excess_amount_value").value=(Number(sum_invoices)-(sum));

					}
				else
				
					{
							var obj=document.getElementById("arr").value;
							var val=JSON.parse(obj);
							var sum=0;

						for(i=0;i<val.length;i++)
							{
							document.getElementById("paymentsubmit"+val[i]).value="";
						
							sum=sum+Number(document.getElementById("amount_due"+val[i]).value);
							}
							document.getElementById("full_pay").value=sum;
							document.getElementById("excess_amount_value").value=0;
					}
		
	}
</script>	
<?php

$this->load->view("footer.php");
?>
