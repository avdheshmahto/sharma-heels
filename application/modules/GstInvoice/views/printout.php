<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Sharma Enterprises</title>

<style>


ol{margin:0 0 0 0px; padding:0 0 0 14px;}
li{margin:0 0 0 0px; padding:0 0 0 0px;}

body { font: 14px/1.4 Georgia, serif; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
#page-wrap { width: 810px; margin: 0 auto; }
h1{text-align:center; margin:0px;}
h2{text-align:center;}
h3{text-align:center;}
h4{margin:0 0 0 0px; padding-top:0px;}

.header{margin:0 0 0 0px;}
.header-l{width:20%; float:left; text-align:left;}
.header-c{width:30%; float:left; text-align:center; margin:0 0 0 16%;}
.header-r{width:20%; float:right; text-align:right;}


#bg{background-color:#f0f0f0;}

.th-border{
    border: 1px solid black;
    padding: 3px;
    border-top: none;
    border-bottom: none;
}

.td-rl{
	border-right: 1px solid #000;
    border-left: 1px solid #000;
}

.td-l{
	 border-left: 1px solid #000;
}

.td-r{
	border-right: 1px solid #000;
    }


.tr-t{
	border-top: 1px solid #000;
}


.tr-b{
    border-bottom: 1px solid #000;
}

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding:3px; border:none; }

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin:0 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { font: 13px Helvetica, Sans-Serif; padding: 0 0 8px 0; margin: 0 0 8px 0; text-align:left; }
#terms textarea { width: 100%; text-align: center;}

#terms-left{ float:left; width:70%; text-align:left;}
#terms-right{ width:25%; float:right; text-align:right;}

.clear{clear:both;}


textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }



</style>
</head>

<body>
<?php 
 
  $query=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='".$_GET['id']."'");
  $fetch_list=$query->row();

 

function words_repues($num)
{ 
  $numberF=$num;
   $action34=explode(".",$numberF);
$balance10=$action34[0];
   $balance11=$action34[1];
   $no = $balance10;
   $point = $balance11;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    " " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   ucfirst($result . "Rupees " . $points . " Paise");
      $grandexplode=number_format((float)$num, 2, '.', '');
    $action23=explode(".",$grandexplode);
    $groundA=$action23[0];
    $groundV=$action23[1];  
  if($groundV >=1 ){
  $goundStr=ucfirst("Rupees And " . $points . " Paise".$result);
      
  }else{
      $goundStr=ucfirst("Rupees ".$result);
  } 
   return $goundStr;
  }

 ?>
<div id="page-wrap">
<table id="items">
<tbody>
<tr class="tr-t__ tr-b">
<td class="td-r-">&nbsp;</td>
<td colspan="3" align="center" class="td-r-"><strong style="padding:0 0 0 80px;">INVOICE/BILL OF SUPPLY</strong></td>
<td colspan="9"><strong style="padding-left:15px;">Ph.: 011-64624548</strong></td>
</tr>

<tr class="tr-t__ tr-b">
<td colspan="12" class="td-r">
<center>
<h1>SHARMA ENTERPRISES</h1>
<strong>
Manufacturing & Trading of : All Types of Heels/Sole & Raw Material of Footwear<br />
Plot No. G-48, Sector-2, DSIDC, Bawana, New Delhi-110039<br />
</strong>
</center></td>
</tr>

<tr class="tr-t__ tr-b">
<td colspan="12" class="td-r" style="padding:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tr-t__ tr-b">
<td width="9%" rowspan="2" valign="top"><strong>GSTIN</strong></td>
<td width="42%" rowspan="2" valign="top" class="td-r"><strong>:</strong> 07BTWPS9273H1ZM</td>
<td colspan="2" class="td-r"><strong>Serial No. of Invoice</strong></td>
<td width="28%"><?php echo $fetch_list->invoice_no; ?></td>
</tr>
<tr>
<td colspan="2" class="td-r"><strong>Date of Invoice</strong></td>
<td><?php echo $fetch_list->inv_date; ?></td>
</tr>
<tr class="tr-t__ tr-b">
<td  colspan="6"  class="td-r"><strong>DETAILS OF RECEIVER BILLED TO </strong></td>

</tr>
<tr class="tr-t__ tr-b">
<td><strong>Name</strong></td>
<td colspan="5" class="td-r"><strong>: </strong><?php 

$arr=explode('^', $fetch_list->c_firm_name); 

echo $arr[1];?></td>

</tr>
<?php

$contactquery=$this->db->query("select * from tbl_contact_m where contact_id='$arr[0]'");
$fetchcontact_list=$contactquery->row();
$cfirmname=$fetchcontact_list->firma_name;
$cfirmGSTIN=$fetchcontact_list->tin;
$rows=sizeof(explode(',', $cfirmname));
$cfirmaname=explode(',', $cfirmname);
$cfirmaGSTIN=explode(',', $cfirmGSTIN); 
$cfirmstate=explode(',', $fetchcontact_list->state); 

  for($j=0;$j<$rows;$j++){
    //echo $cfirmaname[$j];
    if($arr[1]==$cfirmaname[$j]){
        $GSTIN=$cfirmaGSTIN[$j];
        $stateid=$cfirmstate[$j];
    }
  }

$statequery=$this->db->query("select * from tbl_state_m where stateid='$stateid'");
$fetchstate_list=$statequery->row();
?>
<tr class="tr-t__ tr-b">
<td><strong>Address</strong></td>
<td colspan="5" class="td-r"><strong>: </strong><?php //echo $fetchcontact_list->address3;?></td>
</tr>

<tr class="tr-t__ tr-b">
<td><strong>State</strong></td>
<td colspan="5" class="td-r"><strong>: </strong><?php echo $fetchstate_list->stateName;?></td>
</tr>

<tr>
<td><strong>GSTIN</strong></td>
<td colspan="5" class="td-r"><strong>: </strong><?php echo $GSTIN;?></td>
</tr>
</table>

</td>
</tr>

<tr id="bg" class="tr-t tr-b">
<td width="5%" class="td-rl"><strong>S.No</strong></td>
<td width="31.2%" colspan="-2" class="td-rl"><strong>Description of Goods</strong></td>
<td width="10%"><strong>Qty</strong></td>
<td width="9%" class="td-rl"><strong>Rate</strong></td>
<td width="5%" class="td-rl"><strong>GST % </strong></td>
<td width="11%" colspan="5" class="td-rl"><strong>Amount</strong></td>
</tr>

<?php 
$i=1;
$querydtl=$this->db->query("select * from tbl_gst_invoice_dtl where inv_id='$fetch_list->gst_inv_id'");
foreach ($querydtl->result() as $data_list) {
  
?>
<tr class="tr-t tr-b">
<td width="5%" class="td-rl"><strong><?php echo $i;?></strong></td>
<td width="31.2%" colspan="-2" class="td-rl"><strong>
  <?php
$catename=$data_list->category_id;

   $quprod=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$data_list->category_id."' AND status = 'A'");
$qres=$quprod->row();
//echo $qres->prodcatg_name;

if($catename=='224'){
        $sole="Foot Wear Sole";
}else if($catename=='217'){
        $sole="Foot Wear Sole";
}else if($catename=='213'){
        $sole="Foot Wear Sole";
}else if($catename=='219'){
        $sole="Foot Wear Sole";
}else{
        $sole="Foot Wear Heels";
}

echo $sole;


?>
</strong></td>
<td width="10%"><strong><?php echo $data_list->qty;?></strong></td>
<td width="9%" class="td-rl"><strong><?php echo $data_list->rate;?></strong></td>
<td width="5%" class="td-rl"><strong><?php echo $data_list->gstp;?></strong></td>
<td width="11%" colspan="5" class="td-rl"><strong><?php echo $data_list->amt;?></strong></td>
</tr>
<?php $i++; } ?>

<tr>
<td class="td-rl">&nbsp;</td>
<td colspan="-2" class="td-rl">&nbsp;</td>
<td colspan="3" class="tr-t tr-b">Total</td>
<td colspan="5" class="td-rl tr-t tr-b"><?php echo $fetch_list->total;?></td>
</tr>

<tr>
<td class="td-rl">&nbsp;</td>
<td colspan="-2" class="td-rl">&nbsp;</td>
<td colspan="3" class="tr-t tr-b">GST Amount</td>
<td colspan="5" class="td-rl tr-t tr-b"><?php echo $fetch_list->gst_amt;?></td>
</tr>

<tr class="tr-t tr-b">
<td colspan="5" class="td-rl">Total Invoice (In figure): <span style="padding: 0 0 0 20px;"> </span></td>
<td colspan="5" class="td-rl"><?php echo  number_format($fetch_list->grand_total,2,'.',','); ?></td>
</tr>

<tr class="tr-t tr-b">
<td colspan="11" class="td-rl">Total Invoice (In word): <span style="padding: 0 0 0 20px;"><strong><?php echo  words_repues(number_format((float)$fetch_list->grand_total, 0, '.', ''));?></strong></span></td>
</tr>

<tr class="tr-t">
<td colspan="2" class="td-rl">
<strong>Terms & Conditions :</strong>
<ol>
<li>Goods once sold will not be taken back or exchanged.</li>
<li>Interest @ 18 % per annum will be charged on bills if the payment not made on due date.</li>
<li>All disputes are subject to Delhi Jurisdiction</li>
</ol></td>
<td valign="top" class="td-r-">
<br />
<br />
<br />
Date</td>
<td colspan="9" class="td-r">FOR<strong> SHARMA ENTERPRISES</strong>
  <br />
  <br />
  <br />
<p style="text-align:right; margin-top:0px; margin-right:22px;">Auth Sign</p></td>
</tr>
</tbody>
</table>
</div>
</body>
</html>