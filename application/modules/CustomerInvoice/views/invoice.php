<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Invoice</title>

<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/css/style.css' />
<script type='text/javascript' src='<?=base_url();?>assets/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='<?=base_url();?>assets/js/example.js'></script>
</head>

<body>
<?php 
$sqlhdr=$this->db->query("select * from tbl_ordered_invoice_hdr where ordered_invoiceid='".$_GET['id']."'");
$fetch_list=$sqlhdr->row();
?>
<div id="page-wrap">
<div class="header">
<div class="header-l">
<p>Invoice No.  <strong><?php echo $fetch_list->ordered_invoiceid; ?></strong></p>
<p>Ref. No. : <strong>_</strong></p>
</div>


<div class="header-c">
<br />
<p><strong>Sharma Plastic Heels</strong></p>
<h1>INVOICE</h1>
<p>Party : <strong><?php 

if($fetch_list->customer_id!='0'){	
$itemQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list->customer_id)
           -> get('tbl_contact_m');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->first_name;
 }else{

$compQuery = $this -> db
           -> select('*')
           -> where('id',$fetch_list->store_id)
           -> get('tbl_location');
		  $compRow = $compQuery->row();

echo $compRow->location_name;		   
 }
 
?></strong></p>
</div>

<div class="header-r">
<p>Date <strong><?php echo $fetch_list->invoice_date; ?></strong></p>
</div>
</div>


<table id="items">
<tbody>

<tr id="bg" class="tr-t tr-b">
<td class="td-rl"><strong><center>SI.No.</center></strong></td>
<td class="td-rl"><strong><center>Description of Goods</center></strong></td>
<td style="50px"><strong><center>Quantity</center></strong></td>
<td class="td-rl"><strong><center>Rate</center></strong></td>
<td class="td-rl"><strong><center>Per</center></strong></td>
<td class="td-rl"><strong><center>Amount</center></strong></td>
</tr>

<?php 
$i=1;
$alltotalqty=0;
$alltotalprice=0;
$sqlorder=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='".$_GET['id']."'");				
	foreach($sqlorder->result() as $fetch_list){	

			$alltotalqty +=$fetch_list->total_qty; 
			$alltotalprice +=$fetch_list->total_price;
?>
<tr>
<td valign="top" class="td-rl"><center><?php echo $i; ?></center></td>
<td colspan="-2" class="td-rl">
<strong>
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?>
</strong>
<?php 
 $sizeval=$fetch_list->size_val;
 $qtyyval=$fetch_list->qty_val;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(',', $qtyyval);
?>
<?php for($k=1;$k<$sizecount;$k++){ 
		$ki=$k-1;
?>
<p style="padding:0 0 0 20px;">
Size-<?php echo $sizearr[$k]; ?> (<?php echo $qtyarr[$ki]; ?> Pairs)
</p>
<?php } ?>
</td>
<td><center><strong><?php echo $fetch_list->total_qty; ?> pair</strong></center></td>
<td class="td-rl" style="text-align:right"><?php 
$numberfPrice=$fetch_list->total_price;
echo number_format($numberfPrice, 2, '.', ','); ?></td>
<td class="td-rl"><center>Pair</center></td>
<td class="td-rl"><center><strong><?php 

$number=$fetch_list->total_price;

echo $english_format_number = number_format($number, 2, '.', ',');
 ?></strong></center></td>
</tr>
<?php $i++; } ?>

<tr class="tr-t">
<td class="td-rl">&nbsp;</td>
<td colspan="1" align="right" class="td-rl"><strong>Total</strong></td>
<td><strong><center><?php 

$numberfQ=$alltotalqty;
echo number_format($numberfQ, 0, '.', ',');
 ?> pair</center></strong> </td>
<td class="td-rl">&nbsp;</td>
<td class="td-rl">&nbsp;</td>
<td class="td-rl"><strong><center><?php 
$numberfP=$alltotalprice;
echo number_format($numberfP, 2, '.', ',');
 ?></center></strong></td>
</tr>
</tbody>
</table>

<div id="terms" style="margin:0 0 0 0px;">
<div id="terms-left">
Amount Chargeable (in Words)<br />
<strong>Rs. Sixty One Thousand Six Hundred Thirty Five Only</strong><br /><br />


Declaration<br />
We declare that this invoice shows the<br />
actual price of the goods described and
</div><!--terms-left close-->


<div id="terms-right">
E. & O.E<br /><br />
<strong>for Sharma Plastic Heels</strong><br />
<br />
Authorised Signatory
</div><!--terms-left close-->

<div class="clear"></div>
<p><br /><center><u>This is a computer Generated Invoice</u></center></p>
</div>

</div>

</body>

</html>