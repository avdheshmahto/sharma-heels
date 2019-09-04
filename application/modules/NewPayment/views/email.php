<?php
$invoiceQuery=$this->db->query("select *from tbl_sales_order_hdr where salesid='$id'");
$getInvoice=$invoiceQuery->row();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Invoice</title>

<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/payment_invoice_css/css/style.css' />
</head>

<body>

<div id="page-wrap">
<div id="top">
<div id="top-left">
<img src="<?=base_url();?>assets/images/logo-to.png" width="150" height="114" alt="" />
</div>

<div id="top-right">
<h1>Tech Vyas Solutions Pvt Ltd</h1>
<p>
B-6 Shankar Garden<br />
Vikaspuri<br />
New Delhi 110018<br />
India
</p>
</div>
</div><!--identity close-->

<div id="payment">
<h2>PAYMENT RECEIPT</h2>
<div id="payment-left">
<table id="meta">
<tr>
<td class="meta-head">Payment Date</td>
<td><?=$payment_date;?></td>
</tr>
<tr>

<td class="meta-head">Payment Mode</td>
<td><?=$payment_mode;?></td>
</tr>
</table>
</div>

<div id="payment-right">
<div id="amount">
<h4>Amount Received</h4>
<h3>Rs <?=$amount;?></h3>
</div>

</div>
</div><!--payment close-->

<div id="payment">
<h4>Received From</h4>
<?php
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$contact_id'");
$getContact=$contactQuery->row();
?>
<p>
<?=$getContact->first_name;?><br />
 <?php  
  $newout= array();
echo  $outtext=  $getContact->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?>

</p>
</div><!--payment close-->





<div style="clear:both"></div>



<table id="items">

<tr>
<th>Invoice Number</th>
<th>Invoice Date</th>
<th>Invoice Amount</th>
<th>Payment Amount</th>
</tr>

<tr class="item-row">
<td class="item-name"><?=$id;?></td>
<td class="description"><?=$getInvoice->invoice_date;?></td>
<td>Rs <?=$getInvoice->grand_total;?></td>
<td><strong>Rs <?=$amount;?></strong></td>
</tr>
</table>


</div>
</body>
</html>