<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" align="center">View GST Payment</h4>
</div>
<div class="modal-body overflow">

<?php $gstpayhdr=$this->db->query("select * from tbl_payment_gst_hdr_new where payment_gst_id='$id'");
$gstpayhdrres=$gstpayhdr->row();
$cname=$this->db->query("select * from tbl_contact_m where contact_id='$cid'");
$cnameres=$cname->row();
?>

<div class="form-group"> 
<label class="col-sm-2 control-label">Customer Name:</label> 
<div class="col-sm-2" id="regid"> 
<input type="text" value="<?php echo $cnameres->first_name; ?>" class="form-control" readonly="true">
</div>
 
<label class="col-sm-2 control-label">Firm Name:</label> 
<div class="col-sm-2" id="regid"> 
<input type="text" value="<?php $query1=$this->db->query("select * from tbl_master_data where serial_number='$gstpayhdrres->firmid'");$query1res=$query1->row();
echo $query1res->keyvalue; ?>" class="form-control" readonly="true">
</div>
 
<label class="col-sm-2 control-label">C Firm Name:</label> 
<div class="col-sm-2" id="regid"> 
<input type="text" value="<?php $arr=explode('^',$gstpayhdrres->c_firm_name); echo $arr[1]; ?>" class="form-control" readonly="true">
</div>
</div>
<div class="form-group"> 
  
<label class="col-sm-2 control-label">Date:</label> 
<div class="col-sm-2"> 
<input type="text" id="price_range" class="form-control" value="<?=$gstpayhdrres->dates?>" readonly="true" />

</div>
<label class="col-sm-2 control-label">Payment Mode:</label> 
<div class="col-sm-2"> 
<input type="text" id="payment_mode" class="form-control" value="<?=$gstpayhdrres->payment_mode?>" readonly="true"/>
</div>  
</div>
<div class="table-responsive">
<table id="gst_payment_table" class="table table-striped table-bordered table-hover tableupdateanyvarible">
<thead> 
<tr>
		
		<th>Date</th>
        <th>Invoice Number</th>
		<th>Invoice Amount</th>
		<th>Amount Due</th>
		<th>Payment</th>
		
</tr>
</thead>
<tbody>
<?php 
$gstpayment=$this->db->query("select * from tbl_payment_gst_dtl_new where customer_name='$cid' and payment_hdr_id='$id'");
foreach($gstpayment->result() as $gstpaymentres)
	{
		$inv_no=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='$gstpaymentres->inv_no'");
		$inv_no_res=$inv_no->row();

?>


<tr>

<th><?=$gstpaymentres->inv_date;?></th>
<th><?=$inv_no_res->invoice_no;?></th>
<th><?=$gstpaymentres->inv_amt;?></th>
<th><?=$gstpaymentres->amount_due?></th>
<th><?=$gstpaymentres->payment;?></th>
</tr>
<?php }?>
</tbody>
</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>