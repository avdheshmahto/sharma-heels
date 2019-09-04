<?php
$query=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='$ucid'");
$inv_det=$query->row();
?>
<h4 class="modal-title" align="center">USE CREDIT FOR <?=$inv_det->invoice_no?><span > </span></h4>

<div class="main-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div align="center" style="font-size:14px;padding: 0 0 0 508px;">
								<?php 
/*$duequery=$this->db->query("select *,sum(payment) as payment_sum from tbl_payment_gst_dtl_new where inv_no='$inv_det->gst_inv_id'");
*/


$duequery=$this->db->query("select SUM(d.payment) as payment_amt from tbl_payment_gst_dtl_new d,tbl_payment_gst_hdr_new h where h.payment_gst_id=d.payment_hdr_id AND d.inv_no ='$inv_det->gst_inv_id'");
		$duequeryres=$duequery->row();

$rows=$duequery->num_rows();
echo "Balance Due=";
if($rows>0)
{
$duequeryres=$duequery->row();

$balance=(($inv_det->grand_total)-($duequeryres->payment_amt));
echo $balance; } else { $balance=$inv_det->grand_total;echo $balance; }
?>
<input type="hidden" name="mybalance_due" id="mybalance_due" value="<?php echo $balance;?>">
							</div>						

<br />

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >

<thead>
<tr>
<th>Credit Note</th>
<th>Invoice_date</th>
<th>Credit Amount</th>
<th>Credit Available</th>
<th>Invoice_Amount_Paid</th>
</tr>
</thead>
<tbody>
<input type="hidden" name="customer_name" id="customer_name" class="form-control" value="<?=$inv_det->customer_name;?>" readonly=""/>
<input type="hidden" name="firmid" id="firmid" class="form-control" value="<?=$inv_det->firm_id;?>" readonly=""/>
<input type="hidden" name="c_firm_name" id="customer_name" class="form-control" value="<?=$inv_det->c_firm_name;?>" readonly=""/>
<input type="hidden" name="payment_mode" id="payment_mode" class="form-control" value="<?="credit";?>" readonly=""/>
<input type="hidden" name="invoice" id="invoice" class="form-control" value="<?=$inv_det->gst_inv_id;?>" readonly=""/>
<input type="hidden" name="invoiceheader" id="invoiceheader" class="form-control" value="<?=$inv_det->invoice_no;?>" readonly=""/>
<input type="hidden" name="payment_date" id="payment_date" class="form-control" value="<?php echo date('d/m/y')?>" readonly=""/>
<input type="hidden" name="inv_amt" id="inv_amt" class="form-control" value="<?=$inv_det->grand_total;?>" readonly=""/>
<input type="hidden" name="inv_date" id="inv_date" class="form-control" value="<?=$inv_det->inv_date;?>" readonly=""/>



<?php $creditquery=$this->db->query("select * from tbl_payment_gst_customer_credits where firmid='$inv_det->firm_id' and c_firm_name='$inv_det->c_firm_name' and customer_name='$inv_det->customer_name'");
	$rows=$creditquery->num_rows();

foreach($creditquery->result() as $res){
?>
<tr class="gradeA">
<th>
<input type="text" name="credit_note" id="credit_note" class="form-control" value="<?=$res->payment_status?>" readonly=""/>
<input type="hidden" name="credit_gst_id[]" id="credit_gst_id" class="form-control" value="<?=$res->credit_gst_id?>" readonly=""/>
</th>
<th><input type="text" name="credit_date" id="credit_date" class="form-control" value="<?=$res->credit_date?>" readonly=""/></th>

<?php 
$duequery=$this->db->query("select sum(payment) as payment_sum from tbl_payment_gst_dtl_new where inv_no='$inv_det->gst_inv_id'");
$payrows=$duequery->num_rows();
if($payrows>0)
{
	$duequeryres=$duequery->row();

?>
<input type="hidden" name="amount_due" id="amount_due"  type="text" value="<?php echo (($inv_det->grand_total)-($duequeryres->payment_sum));?>" class="form-control" readonly="">
<?php } else {?>
<input type="hidden" name="amount_due" id="amount_due"  type="text" value="<?=$inv_det->grand_total;?>" class="form-control" readonly="">
<?php } ?>


<th><input name="credit_amount" id="credit_amount"  type="text" value="<?=$res->total_payment;?>" class="form-control"readonly=""></th>

<th><input name="credit_available[]" id="credit_available"  type="text" value="<?=$res->credit_amount?>" class="form-control" readonly=""></th>
<th><input type="text" name="invoice_amount_paid[]" id="invoice_amount_paid" class="form-control" /></th>

</tr>
<tr>
<?php }if($rows>0){ ?>
<th colspan="2"></th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn btn-sm" name="save" value="SAVE" align="right"/></th>
<th align="center" colspan="3"></th>
<?php }else{echo "<center><b>No Credits Available</b></center>";}?>
</tr>
</tbody>
</table>
<input type="hidden" name="rows" id="rows" class="form-control" value="<?=$rows;?>" readonly=""/>