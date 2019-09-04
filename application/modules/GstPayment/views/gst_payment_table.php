<?php
//$id=$_GET['id'];

$contactquery=$this->db->query("select * from tbl_contact_m ");
$cqres=$contactquery->row();
$qry=$this->db->query("select sum(total_billamt) as creditsum from tbl_payment_gst where invoice_id='$id'");
$qryres=$qry->row();
?>
<table class="table table-striped table-bordered table-hover tableupdateanyvarible" id="gst_payment_table" >
<thead>
 
<tr style="border-bottom:3px solid #000;">
<th>Total</th>
<th></th>
<th id="debit"></th>
<th id="credit"><input type="number" id="creditvalue" value="<?=$qryres->creditsum;?>" readonly="" style="border:0px;"></th>
<th></th>
<th id="close"></th>
</tr> 
<tr>
		<!--<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>-->
		<th>S No.</th>
        <th>Customer Name</th>
		<th>Debit</th>
		<th>Credit</th>
		<th>Balance</th>
</tr>
</thead>
<?php 
$gstpayment=$this->db->query("select * from tbl_payment_gst where invoice_id='$id'");
$i=1;
foreach($gstpayment->result() as $fetch_list)
{

?>


<tr class="gradeC record">

<th><?php echo $i;?></th>
<th><a href="view_payment?id=<?php if($fetch_list->customer_name==$cqres->contact_id) { echo $cqres->contact_id;?>" target="_blank" ><?php echo $cqres->first_name;}?></a></th>
<th></th>
<th><?=$fetch_list->total_billamt;?></th>
<th></th>
<th><?=$fetch_list->remarks;?></th>
</tr>
<?php $i++;}?>
<!-- /.modal -->

</tbody>
</table>
