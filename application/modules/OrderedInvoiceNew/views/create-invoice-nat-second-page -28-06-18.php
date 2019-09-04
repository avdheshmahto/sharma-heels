<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th>Check</th>
	   	<th><div style="width:60px;">Item Name</div></th>
		<th>Description</th>
		<th>Category</th>
		<th>Order Id</th>
		<th>Size / Qty</th>
        <th>Total Qtys</th>
		<th>Price</th>
		<th>Total Prices</th>
</tr>
</thead>
<tbody>
<?php  
	$custandlocid=$_GET['id'];
	$ex=explode("^",$custandlocid);
	$custid =$ex[0];
	$locname=$ex[1];
	$invdate=$ex[2];
    $proidss=$ex[3];	
if($locname=='National'){
?>
<input type="hidden" name="invoice_date" value="<?php echo $invdate; ?>" />
<input type="hidden" name="Customer_id" value="<?php echo $custid; ?>" />
<?php }else{ ?>
<input type="hidden" name="invoice_date" value="<?php echo $invdate; ?>" />
<input type="hidden" name="store_id" value="<?php echo $custid; ?>" />
<?php } 		
		
if($custid!=''){
		
	$out = array();
    if($locname=='National'){		
			$ordhdrqry =$this->db->query("Select * from tbl_order_hdr where status='A' and customer_id='$custid'");  
	}else{
			$ordhdrqry =$this->db->query("Select * from tbl_order_hdr where status='A' and store_id='$custid'");    
	}	
	foreach($ordhdrqry->result() as $numq){
			array_push($out, $numq->order_id);
		}
		
		 $ordid=implode(',', $out);
		 
		 if($ordid!=''){
		
	$idm=1;
	$rowiddr=1;
	if($locname=='National'){		
		if($proidss!=''){
			$orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where invoice_status='A' and customer_id='$custid' and item_id='$proidss' ORDER BY item_id");		
		}else{
			$orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where invoice_status='A' and customer_id='$custid' ORDER BY item_id");		
		}	
	}else{	
		if($proidss!=''){
			$orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where invoice_status='A' and store_id='$custid' and item_id='$proidss' ORDER BY item_id");			
			}else{
			 $orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where invoice_status='A' and store_id='$custid' ORDER BY item_id");			
			}
	}
	

			
	foreach($orddtlqryrer->result() as $dd){	
		$invoicedtlq=$this->db->query("Select * from tbl_ordered_invoice_dtl where status='A' and order_id='$dd->order_id' and item_id='$dd->item_id'");
		$fetchlistinv=$invoicedtlq->row();
		$qtyinvoice=$fetchlistinv->qty_val;
			 
?>

		<tr>
		<th><input type="checkbox" id="myCheck<?php  echo $idm; ?>" style="width:25px;height:20px;" name="myCheck[]" onclick="myCheckFunction('<?php  echo $idm; ?>')"></th>
	<th><span style="font-size:14px; text-decoration:underline; color:#ec407a;">
	<input type="hidden" name="" id="item_id<?php  echo $idm; ?>" value="<?php echo $dd->item_id; ?>" />
	<input type="hidden" name="" id="taxonandsole_id<?php  echo $idm; ?>" value="<?php echo $dd->category_type; ?>" />
	<?php 	//echo $expititem[$i];
	$stockitemqry=$this->db->query("Select * from tbl_product_stock where status='A' and Product_id='$dd->item_id'");	
	$fetchqstock=$stockitemqry->row();
	echo $fetchqstock->productname;
	?></span>
	<input type="hidden" name="" id="productname<?php  echo $idm; ?>" value="<?php echo $fetchqstock->productname; ?>" />	
	<br />
	<?php  $taxoncount=sizeof(explode(',', $dd->category_type)); 
				$taxexp=explode(',', $dd->category_type);
		?>
				<?php		
			for($it=0;$it<$taxoncount;$it++){
		
			//echo  $taxid=$taxexp[$it];
			
			$taxonQuery=$this->db->query("select * from tbl_product_stock where Product_id='$taxid' group by Product_id");
			$taxonnamelist=$taxonQuery->row();
					
if($taxexp[$it]==''){

}else{

	 $invoicedtlqtott=$this->db->query("Select * from tbl_ordered_invoice_dtl where status='A' and order_id='$dd->order_id' and item_id='$taxexp[$it]' and sub_item_id='$dd->item_id'");
			 $fetchlistinvtott=$invoicedtlqtott->row();
			 
			$qtyinvoiceto=$fetchlistinvtott->qty_val;
			
			$totqtyvallto=$dd->checkboxtotalqty-$fetchlistinvtott->total_qty;
if($totqtyvallto=='0'){

}else{		
					
	?>
			<input type="hidden" name="" id="subrowidd<?php  echo $rowiddr; ?><?php  echo $it; ?>" value="<?php  echo $idm; ?>" />
			
		<p style="padding: 0px 0px 0px 66px; margin: 0em 0em 0em;"><?php //echo  $taxonnamelist->productname; ?></p>
	<?php } } $rowiddr++; } ?>
	
	</th>
	<th>
	<textarea style="height: 95px; background-color:#fff;" id="descidd<?php  echo $idm; ?>"></textarea>
	</th>	
	<th>
		<input type="hidden" name="" id="category_id<?php  echo $idm; ?>" value="<?php echo $dd->category_id; ?>" />
	<?php 
	$stockcateqry=$this->db->query("Select * from tbl_prodcatg_mst where status='A' and prodcatg_id='$dd->category_id'");	
	$fetchqcate=$stockcateqry->row();
	echo $fetchqcate->prodcatg_name;
	?>
		<input type="hidden" name="" id="categorynamess_id<?php  echo $idm; ?>" value="<?php echo $fetchqcate->prodcatg_name; ?>" />
	</th>
	
<th>
	<input type="hidden" name="" id="orderid<?php  echo $idm; ?>" value="<?php echo $dd->order_id; ?>" />
	
<?php 			
			$nextyear=date("y");
			$ss=$dd->order_id;
			$var = str_pad($ss,1,'0',STR_PAD_LEFT);
			$numbercase = sprintf('%04d',$var);
		echo $ordidst="NAT"."/".$nextyear."/".$numbercase;
//echo $dd->order_id; ?></th>
<th style="width:312px;">
<div class="table-responsive2" style="width:320px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<input type="hidden" name="" id="size_val<?php  echo $idm; ?>" value="<?php echo $dd->size_name; ?>" />
<input type="hidden" name="" id="ordered_qty_val<?php  echo $idm; ?>" value="<?php echo $dd->qty_name; ?>" />
<?php 
 $sizeval=$dd->size_name;
 $qtyyval=$dd->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
	$qtyarrinvoice=explode(',', $qtyinvoice);
?>
<input type="hidden" id="countsizeid<?php echo $idm;?>" value="<?php echo $sizecount; ?>" />
<tr>
<th style="width:200px;"><div class="qty-size"><strong>Size</strong></div></th>
<?php for($k=1;$k<$sizecount;$k++){ ?>
<th style="text-align:center;width: 10px;"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Ord Qty</strong></td>
<?php for($j=1;$j<$sizecount;$j++){ $jk=$j-1;

$orderqtyyy=$qtyarr[$j]-$qtyarrinvoice[$jk];

 ?>
<input type="hidden" value="<?php echo $orderqtyyy; ?>" id="checkorderedqtyidd<?php echo $j; ?><?php  echo $idm; ?>" class="form-control" />
<th style="text-align:center"><?php echo $orderqtyyy; ?></th>
<?php } ?>
</tr>

<tr class="gradeX">
<td><strong>Ent Qty</strong></td>

<?php 
$out = array();
for($j=1;$j<$sizecount;$j++){ 
array_push($out, 0);
?>
<th style="text-align:center"><input type="text" class="form-control" id="enteredqtyidd<?php echo $j; ?><?php  echo $idm; ?>" onkeyup="orderedqtyfun(this.id,'<?php  echo $idm; ?>')" style="width:65px; text-align:center; padding:0 0 0 0px; background-color:#FFFFFF;" name="" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" value="" /></th>

<?php } $qtyvl=implode(',', $out); ?>
<input type="hidden" id="orqtyid<?php echo $idm;?>" name="" value="<?php echo $qtyvl; ?>" />
</tr>

</tbody>
</table>
</div>
</th>

<th style="width:10px;">
<div style="width:100px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<input type="hidden" name="" id="ordered_total_qty<?php  echo $idm; ?>" class="form-control" style="text-align:center" value="<?php echo $dd->total_qty; ?>" readonly />
<th style="text-align:center;"><?php 
$totqty=$dd->total_qty-$fetchlistinv->total_qty;
echo $totqty; ?></th>
</tr>
<tr>
<th style="text-align:center">
<input type="text" name="" id="totalorid<?php echo $idm; ?>" class="form-control" style="text-align:center; background-color:#FFFFFF;" value="0" readonly />
</th>
<input type="hidden" name="" id="valnotnullid<?php echo $idm; ?>" class="form-control" style="text-align:center" value="" readonly />
</tr>
</tbody>
</table>
</div>
</div>
</th>
<?php
 
  $taxoncountcate=sizeof(explode(',', $dd->category_type)); 
				$taxexpcate=explode(',', $dd->category_type);
				$sumcateprice='';
			for($it=0;$it<$taxoncountcate;$it++){
		
			  $taxidcate=$taxexpcate[$it];
			
			$taxonQuerycate=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$taxidcate' and contact_id='$custid' and location_name='$locname'");
			$taxoncatelist=$taxonQuerycate->row();
					//echo $taxoncatelist->price;
					 $sumcateprice +=$taxoncatelist->price;
			}
 

$stockpriceqry=$this->db->query("Select * from tbl_contact_product_price_mapping where status='A' and product_id='$dd->item_id' and contact_id='$custid' and location_name='$locname'");	
	$sump='';
foreach($stockpriceqry->result() as $fetchqprice){
	
	 $sump +=$fetchqprice->price;
	
	}
	//echo $sumcateprice;
	 $totpriss=$sump+$sumcateprice;	
	
	$totprice=$totpriss*$dd->total_qty;
			
?>
<input type="hidden" name="" id="pricessid<?php echo $idm; ?>" class="form-control" style="text-align:center" value="<?php echo $totpriss; ?>" readonly />
<th style="text-align:center"><?php echo $totpriss; ?></th>
<th style="width:10px;">
<div style="width:100px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>&nbsp;</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<input type="hidden" name="" id="totpricessid<?php echo $idm; ?>" class="form-control" style="text-align:center" value="<?php echo $totprice; ?>" readonly />
<td style="text-align:center"><?php echo $totprice; ?></td>
</tr>
<tr class="gradeX">
<th style="text-align:center"><input type="hidden" name="" id="priceorid<?php echo $idm; ?>" class="form-control" value="<?php echo $totpriss; ?>" readonly="">
<input type="text" name="" id="finalpriceorid<?php echo $idm; ?>" class="form-control" value="" style="text-align:center; background-color:#FFFFFF;  padding:0 0 0 0px;" readonly=""></th>
<input type="hidden" id="resetvalid<?php echo $idm; ?>" class="form-control" value="false" />
</tr>
</tbody>
</table>
</div>
</div>
</th>
</tr>
<tr>
<th colspan="6">&nbsp;</th>
<th colspan="3">
<div class="pull-right">
<?php 
 $totqtyvallone=$dd->total_qty-$fetchlistinv->total_qty;
			 if($totqtyvallone=='0'){
				
				}else{
	?>					
<INPUT type="button" value="Add Item" tabindex="2" id="testidt<?php echo $idm; ?>" class="btn btn-sm" onclick="addRow('dataTable','<?php echo $idm; ?>')" />
<button class="btn btn-sm btn-secondary" href="#editcontact" type="button" id="clearid<?php echo $idm; ?>" data-toggle="modal" data-backdrop="static" onclick="clearFields('<?php echo $idm; ?>')" data-keyboard="false"><i>Reset</i></button>
<?php } ?>			
</div>
</th>

<?php 
for($to=0;$to<$taxoncount;$to++){
			
			 $taxexp[$to];
if($taxexp[$to]==''){

}else{

	 $invoicedtlqto=$this->db->query("Select * from tbl_ordered_invoice_dtl where status='A' and order_id='$dd->order_id' and item_id='$taxexp[$to]' and sub_item_id='$dd->item_id'");
			 $fetchlistinvto=$invoicedtlqto->row();
			 
			$qtyinvoiceto=$fetchlistinvto->qty_val;
			
			$totqtyvallto=$dd->checkboxtotalqty-$fetchlistinvto->total_qty;
if($totqtyvallto=='0'){

}else{			
 ?>
		<?php  //echo $to;
		//echo "<br/>";
		
		 ?>	
<tr>
	<th><input type="checkbox" id="myCheck<?php  echo $idm; ?><?php  echo $to; ?>" style="width:25px;height:20px;" name="myCheck[]" onclick="myCheckdoubleFunto('<?php  echo $idm; ?>','<?php  echo $to; ?>')"></th>
	<th><span style="font-size:14px; text-decoration:underline; color:#ec407a;">
	<input type="hidden" name="" id="subitem_idto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $dd->item_id; ?>" />
	<input type="hidden" name="" id="item_idto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $taxexp[$to]; ?>" />
	
	<?php 	//echo $expititem[$i];
			$taxidto=$taxexp[$to];			
			$taxonQueryto=$this->db->query("select * from tbl_product_stock where Product_id='$taxidto' group by Product_id");
			$taxonnamelistto=$taxonQueryto->row();
			//echo  $taxonnamelist->productname;
	?>
	<input type="hidden" name="" id="productnameto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $taxonnamelistto->productname; ?>" />
	
			<p style="padding: 0px 0px 0px 40px; margin: 0em 0em 0em;"><?php echo  $taxonnamelistto->productname; ?></p>
	</span>
		
	</th>
	<th>
	<textarea style="height:95px; background-color:#fff;" id="desciddto<?php  echo $idm; ?><?php  echo $to; ?>"></textarea>
	</th>	
		<input type="hidden" name="" id="checkeddvalidationidtoone<?php  echo $idm; ?><?php  echo $to; ?>" value="0" />
		<input type="hidden" name="" id="checkeddvalidationidtotwo<?php  echo $idm; ?><?php  echo $to; ?>" value="0" />
	<th>
		<input type="hidden" name="" id="category_idto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $dd->category_id; ?>" />
	<?php 
	$stockcateqryto=$this->db->query("Select * from tbl_prodcatg_mst where status='A' and prodcatg_id='$dd->category_id'");	
	$fetchqcateto=$stockcateqryto->row();
	echo $fetchqcateto->prodcatg_name;
	?>
		<input type="hidden" name="" id="categorynamess_idto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $fetchqcateto->prodcatg_name; ?>" />
	</th>
	
<th>
	<input type="hidden" name="" id="orderidto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $dd->order_id; ?>" />
	
<?php echo $ordidst="NAT"."/".$nextyear."/".$numbercase; ?>
<br/><br/><br/>
<input type="checkbox" style="width:25px;height:20px;" id="myChecktoo<?php  echo $idm; ?><?php  echo $to; ?>" name="myCheck[]" onclick="submyCheckFunctionto('<?php  echo $idm; ?>','<?php  echo $to; ?>')">
</th>
<th style="width:312px;">
<div class="table-responsive2" style="width:320px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<input type="hidden" name="" id="size_valto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $dd->size_name; ?>" />
<input type="hidden" name="" id="ordered_qty_valto<?php  echo $idm; ?><?php  echo $to; ?>" value="<?php echo $dd->qty_name; ?>" />
<?php 
 $sizevalto=$dd->size_name;
 $qtyyvalto=$dd->qty_name;

 $sizecountto=sizeof(explode(' | ', $sizevalto));

	$sizearrto=explode(' | ', $sizevalto);
	$qtyarrto=explode(' | ', $qtyyvalto);
?>
<input type="hidden" id="countsizeidto<?php echo $idm;?><?php  echo $to; ?>" value="<?php echo $sizecountto; ?>" />
<tr>
<th style="width:200px;"><div class="qty-size"><strong>Size</strong></div></th>
<?php for($k=1;$k<$sizecountto;$k++){ ?>
<th style="text-align:center;width: 10px;"><?php echo $sizearrto[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Ord Qty</strong></td>
<?php 

	 $qtyytotvalone=$dd->total_qty;	
	 $qtyytotvaltwo=$dd->checkboxtotalqty;	
if($qtyytotvalone==$qtyytotvaltwo){
       $mult='1';
}
if($qtyytotvalone<$qtyytotvaltwo){
	$mult='2';
}
		$exqtyinv=explode(',',$qtyinvoiceto);	
for($j=1;$j<$sizecountto;$j++){ $jk=$j-1;
			
	 $orderqtyduoble=$qtyarrto[$j]*$mult;
		
	$orderqtytot=$orderqtyduoble-$exqtyinv[$jk];

 ?>
<input type="hidden" value="<?php echo $orderqtytot; ?>" id="checkorderedqtyiddto<?php echo $j; ?><?php  echo $idm; ?><?php  echo $to; ?>" class="form-control" />
<th style="text-align:center"><?php echo $orderqtytot; ?></th>
<?php } ?>
</tr>

<tr class="gradeX">
<td><strong>Ent Qty</strong></td>
<?php 
$out = array();
for($j=1;$j<$sizecountto;$j++){ 
array_push($out, 0);
?>
<th style="text-align:center"><input type="text" class="form-control" id="enteredqtyiddto<?php echo $j; ?><?php  echo $idm; ?><?php  echo $to; ?>" onkeyup="taxonandsolefunus(this.id,'<?php  echo $idm; ?>','<?php  echo $to; ?>')" style="width:65px; text-align:center; padding:0 0 0 0px; background-color:#FFFFFF;" name="" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" value="" /></th>

<?php } $qtyvlto=implode(',', $out); ?>
<input type="hidden" id="orqtyidto<?php echo $idm;?><?php  echo $to; ?>" name="qty_val[]" value="<?php echo $qtyvlto; ?>" />
</tr>

</tbody>
</table>
</div>
</th>

<th style="width:10px;">
<div style="width:100px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<input type="hidden" name="" id="ordered_total_qtyto<?php  echo $idm; ?><?php  echo $to; ?>" class="form-control" style="text-align:center" value="<?php echo $dd->checkboxtotalqty; ?>" readonly />
<th style="text-align:center;"><?php 

$tottoqty=$dd->checkboxtotalqty-$fetchlistinvto->total_qty;
echo $tottoqty; ?></th>
</tr>
<tr>
<th style="text-align:center">
<input type="text" name="" id="totaloridto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" style="text-align:center; background-color:#FFFFFF;" value="0" readonly />
</th>
<input type="hidden" name="" id="valnotnullidto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" style="text-align:center" value="" readonly />
</tr>
</tbody>
</table>
</div>
</div>
</th>
<?php
			
			$taxonQuerycate=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$taxidto' and contact_id='$custid' and location_name='$locname'");
			$taxoncatelist=$taxonQuerycate->row();
					//echo $taxoncatelist->price;


	 $totpriss=$taxoncatelist->price;	
	
	$totprice=$totpriss*$dd->checkboxtotalqty;
			
?>
<input type="hidden" name="" id="pricessidto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" style="text-align:center" value="<?php echo $totpriss; ?>" readonly />
<th style="text-align:center"><?php echo $totpriss; ?></th>
<th style="width:10px;">
<div style="width:100px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>&nbsp;</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<input type="hidden" name="" id="totpricessidto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" style="text-align:center" value="<?php echo $totprice; ?>" readonly />
<td style="text-align:center"><?php echo $totprice; ?></td>
</tr>
<tr class="gradeX">
<th style="text-align:center"><input type="hidden" name="" id="priceoridto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" value="<?php echo $totpriss; ?>" readonly="">
<input type="text" name="" id="finalpriceoridto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" value="" style="text-align:center; background-color:#FFFFFF;  padding:0 0 0 0px;" readonly=""></th>
<input type="hidden" id="resetvalidto<?php echo $idm; ?><?php  echo $to; ?>" class="form-control" value="false" />
</tr>
</tbody>
</table>
</div>
</div>
</th>
</tr>
<tr>
<th colspan="6">&nbsp;</th>
<th colspan="3">
<div class="pull-right">		
<INPUT type="button" value="Add Item" tabindex="2" id="testidtto<?php echo $idm; ?><?php  echo $to; ?>" class="btn btn-sm" onclick="addRowTo('dataTable','<?php echo $idm; ?>','<?php  echo $to; ?>')" />
<button class="btn btn-sm btn-secondary" href="#editcontact" id="clearidto<?php echo $idm; ?><?php  echo $to; ?>" type="button" data-toggle="modal" data-backdrop="static" onclick="clearFields('<?php echo $idm; ?>','<?php  echo $to; ?>')" data-keyboard="false"><i>Reset</i></button>			
</div>
</th>
</tr>
<?php } } ?>
</tr>
<input type="hidden" class="form-control" id="saveactiveid<?php echo $idm; ?>" value="" />
<?php
	
	 $idm++;
	}
	
	}						
  }
}
?>
<input type="hidden" class="form-control" name="rowsrrrrr" id="rowsid" value="<?php echo $idm; ?>" />
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>