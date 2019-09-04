<?php 
$upid=$_GET['catid'];
echo $upid;
$Qry=$this->db->query("select * from tbl_gst_invoice_dtl where inv_id='$upid'");
 	$dispQry=$Qry->result();
?>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000;" id="tableinvoice">
<table id="invoice2" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:3%;"><div align="center"><u>Sno.</u></div></td>
<td style="width:3%;"><div align="center"><u>Category</u></div></td>
<td style="width:3%;"><div align="center"><u>Qty</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rate</u></div></td>
<td style="width:3%;"><div align="center"><u>GST Percent</u></div></td>
<td style="width:11%;"><div align="center"><u>Amt</u></div></td>
<td style="width:3%;"><div align="center"><u>GST</u></div></td>

<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
<?php
$i=1;
foreach($dispQry as $disp)
	{
	$Query=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$disp->category_id'");
	$prodQuer=$Query->result();
	foreach($prodQuer as $prodQuery)
		{

?>
<tr>
<input type="hidden" name="upid_dtl" value="<?=$disp->inv_id?>" />

<td style="width:3%;"><div align="center"><?=$i;?></div>
</td>
<td style="width:3%;"><div align="center"><input type="text"  class="form-control" name="" value="<?php echo $prodQuery->prodcatg_name;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><div align="center"><input type="text"  class="form-control" name="" value="<?=$disp->qty;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><div align="center"><input type="text"  class="form-control" value="<?=$disp->rate;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><div align="center"><input type="text"  class="form-control" name="" value="<?=$disp->gstp;?>" readonly="readonly" /></div></td>
<td style="width:11%;"><div align="center"><input type="text" id="amtidd<?php $i; ?>"  class="form-control" value="<?=$disp->amt;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><div align="center"><input type="text" id="gstidd<?php $i; ?>"  class="form-control" value="<?=$disp->gst;?>" readonly="true"/></div></td>
<td style="width:3%"><button class="btn btn-default modalEditcontact" data-a="<?php echo $disp->p_id;?>" href='#addItem' type="button" onClick="EditInvoiceItem('<?php echo $disp->p_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
<button class="btn btn-default" type="button" onClick="deleteinvoicedtl('<?php echo $disp->p_id;?>');" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-trash"></i></button></td>
</tr>
<?php $i++;}} ?>
<tbody id="invoice"></tbody>
</table>
</div>