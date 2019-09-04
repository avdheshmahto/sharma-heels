<?php 
$vid=$_GET['vid'];
if($_GET['vid'] != ""){
    $EditQry=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='".$_GET['vid']."' AND status
 = 'A'");
   $editResult =  $EditQry->row();
 }
?>

<!-- Main content -->
	
			<div class="row">
				<div class="col-lg-12">						
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>*Firm</th>
        <th> <select  name="firmid" id="" class="form-control" disabled="">
            <option value="">----Select ----</option>
			<?php 
		$query1=$this->db->query("select * from tbl_master_data where param_id=25");
		$que=$query1->row();
			
			?>
			<option <?php if($editResult->firm_id==$que->serial_number){?> value="" selected="selected" <?php }?>><?=$que->keyvalue;?></option>
			
          </select>
        </th>
        <th>Date</th>
        <th style="width:140px;"><input type="text" name="currentdate_id" id="" class="form-control datepicker" width="215"  value="<?php echo $editResult->inv_date; ?>" readonly=""/></th>
        <th>Invoice No.</th>
        <th style="width:150px;" id="termidd"><input type="text" name="invoice_id" id="invoice_id" class="form-control" value="<?=$editResult->invoice_no;?>" readonly/></th>
</tr>
<th>
<input type="hidden" name="customer_id" value="<?php echo $ID; ?>" class="form-control" style="width:100px;"  />
<input type="hidden" name="location_name" id="location_name" value="<?php echo $locname; ?>" class="form-control" style="width:100px;"  />
</th>

<tr class="gradeA">
<th>*Customer Name</th>
<th>
<select  name="customer_id" id="customer_id" class="form-control" disabled="">
						<option value="">----Select ----</option>
<?php
$query=$this->db->query("select * from tbl_contact_m");
$qu=$query->row();
?>
<option <?php if($editResult->customer_name==$qu->contact_id){?> value="<?=$q->contact_id?>" selected="selected" <?php }?>><?=$qu->first_name?></option>


</select>
</th>				
<th>
	<th>C Firm Name</th>
	<th>
					
				<?php $arr=explode('^', $editResult->c_firm_name);	?>
				<input type="text" value="<?php echo $arr[1];?>" class="form-control" readonly="true">
			
</th>
<th style="width:100px" colspan="2">&nbsp;</th>

</tr>

</tbody>
</table>
<h6></h6>	  
</div>
<div class="table-responsive">						
<table class="table table-striped table-bordered table-hover" >
<thead>

	  <tr>
	   <th>S.no</th>
	   <th>Category</th>
       <th>Qty</th>
	   <th>Rate</th>
	   <th>GST Percent</th>
	   <th style="width:170px;">Amt</th>
	   <th>GST</th>		
	   </tr>

</thead>

<tbody id="getDataTable">

<?php  
$i=1;
$dtlquery=$this->db->query("select * from tbl_gst_invoice_dtl where inv_id='$vid'");
   
	foreach($dtlquery->result() as $dtl)
		{
		
?>
<tr class="gradeC record" data-row-id="">
<th><?=$i;?></th>
<th><?php $quprod=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$dtl->category_id."' AND status = 'A'");
$qres=$quprod->row();
echo $qres->prodcatg_name;?></th>
<th><?=$dtl->qty;?></th>
<th><?=$dtl->rate;?></th>
<th><?=$dtl->gstp;?></th>
<th><?=$dtl->amt;?></th>
<th><?=$dtl->gst;?></th>
</tr>
<?php $i++; } ?>
</tbody>
<tbody>
<tr> 
<th colspan="4">&nbsp;</th>
<th style="text-align:right;">Total</th>
<th>
<input type="text" class="form-control" name="total" id="total" style="text-align:center; border:none; background:#FFFFFF;" readonly="true"  value="<?=$editResult->total;?>"/></th>
<th>&nbsp;</th>
</tr>
<tr> 
<th colspan="4">&nbsp;</th>
<th style="text-align:right;">GST AMOUNT</th>
<th>
<input type="text" class="form-control" name="gstamt" id="gstamt" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->gst_amt;?>"></th>
<th>&nbsp;</th>
</tr>
<tr> 
<th colspan="4">&nbsp;</th>
<th style="text-align:right;">Grand Total</th>
<th>
<input type="text" class="form-control" name="grandtotal" id="grandtotal" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->grand_total;?>"></th>
<th>&nbsp;</th>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
