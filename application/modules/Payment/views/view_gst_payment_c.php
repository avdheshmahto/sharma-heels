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
	 <a class="page-title" style="padding: 0 0 0 380px;font-size: 20px;">PAYMENT RECIEVED</a>

<form class="form-horizontal" id="insert_form_data" role="form" method="post" action="payment_gst">			
			
		
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
						
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>

<tr  class="gradeA">
 
<th>*Customer Name:</th> 
<th style="width:160px;"><select name="customer_name" id="customer_name" required class="form-control" onChange="invoicedetail();">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>
</th>

<th>*Date:</th> 

<th style="width:180px;"><input name="dates" id="dates"  type="text" value="<?=date("d/m/Y")?>" class="form-control datepicker" required> 
</th>
<th>*Payment Mode</th>
<th><select name="payment_mode" id="payment_mode" class="form-control">
<option value="">----Select----</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">Cheque</option>
</select>
</th>
</tr>
</tbody>
</table>
</div>
</div>
<div id="invoice_details">
</div>

</form>


<!--<div id="invoice_details">
</div>
-->							
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
										//$.("#invoice_details").html(data);
									  	//alert(data);
										$( "#invoice_details" ).html(data);
									  }
				});
	}
/*$(document).ready("#Saveee").click(function(){
	alert("Hello jquery");
	$.ajax({	
			type:"POST",
			url:"<?php //echo base_url('Payment/tbl_payment_gst_insert');?>",
			data:$('#insert_form_data').serialize(),
			success:function(html){
				alert(html);
							
							$('#success_message').fadeIn().html("Record Added Successfully.");
							setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
					
								  }
												
					});
			
});
*/
</script>	
<?php

$this->load->view("footer.php");
?>
