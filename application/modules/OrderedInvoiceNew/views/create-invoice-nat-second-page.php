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
		<th>Date</th>
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
				
	$idm=1;
		
$orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where invoice_status!='Completed' and cancel_status='A' and customer_id='$custid' and item_id='$proidss' ORDER BY item_id");						
	foreach($orddtlqryrer->result() as $dd){	
		
		$invoicedtlq=$this->db->query("Select * from tbl_ordered_invoice_dtl where status='A' and order_id='$dd->order_id' and item_id='$dd->item_id'");
		$fetchlistinv=$invoicedtlq->row();
		$qtyinvoice=$fetchlistinv->qty_val;
				
		$arr1 = array();
		foreach($invoicedtlq->result() as $inventqtyrow){
		     $arr =  $inventqtyrow->qty_val;
			 $arr1[] = explode(',',$arr);
		}
				
		$sumArray = array();
		if(sizeof($arr1) > 0){
         foreach ($arr1 as $k=>$subArray) {
            foreach ($subArray as $id=>$value) {
              $sumArray[$id]+=$value;
           }
          }
	   }

        $taxonandsoledata=$dd->category_type;
		$sizecountoftaxon=sizeof(explode(',', $dd->category_type));
		
		$sizevaltovalid=$dd->size_name;
		$qtyyvaltovalid=$dd->qty_name;
 		$sizecountvalid=sizeof(explode(' | ', $sizevaltovalid));
		$qtyarrvalid=explode(' | ', $qtyyvaltovalid);
		
		
		$sumqtyordvalid=0;
		for($j=1;$j<$sizecountvalid;$j++){ $jk=$j-1;
		 if($sumArray[$jk] ==""){
		  $sumArray[$jk] = 0;
		} 
  		$orderqtyyytos=$qtyarrvalid[$j]-$sumArray[$jk];
		$sumqtyordvalid +=$orderqtyyytos;
		}
		
		if($sumqtyordvalid<=0){
		
		}else{
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
	<th><?php echo $dd->order_date; ?></th>
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
<?php 
$sumqtyord=0;
for($j=1;$j<$sizecount;$j++){ $jk=$j-1;
 if($sumArray[$jk] ==""){
  $sumArray[$jk] = 0;
}
 
   $orderqtyyy=$qtyarr[$j]-$sumArray[$jk];
$sumqtyord +=$orderqtyyy;
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
<input type="hidden" name="" id="ordered_total_qty<?php  echo $idm; ?>" class="form-control" style="text-align:center" value="<?php echo $sumqtyord; ?>" readonly />
<th style="text-align:center;"><?php 
echo $sumqtyord; ?></th>
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
 
$stockpriceqry=$this->db->query("Select * from tbl_contact_product_price_mapping where status='A' and product_id='$dd->item_id' and contact_id='$custid' and location_name='$locname'");	
	$sump='';
foreach($stockpriceqry->result() as $fetchqprice){
	
	 $sump +=$fetchqprice->price;
	
	}
	//echo $sumcateprice;
	 $totpriss=$sump;	
	
	$totprice=$totpriss*$sumqtyord;
			
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
</tr>
<?php } ?>
<!--============================================================================================================================================================-->
<?php 

	$idm++;						
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