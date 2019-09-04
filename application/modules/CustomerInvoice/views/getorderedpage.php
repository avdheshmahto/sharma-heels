<?php
	$getid=$id;
 $idarr=explode("^",$getid);
 $idd=$idarr[0];
 $typeid=$idarr[1];

?>
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<h5>View Orders</h5>
<tr>
		 <th>Ordered No.</th>
	   <th>Customer Name / Store</th>
        <th>Order Date</th>
        <th>Total Qty</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
if($typeid=='loc'){
			
			$sqlorder=$this->db->query("select * from tbl_order_hdr where invoice_status='A' and store_id='$idd'");
				
	}
	if($typeid=='custmr'){
	
			$sqlorder=$this->db->query("select * from tbl_order_hdr where invoice_status='A' and customer_id='$idd'");
		
		}	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->order_id; ?>">
<th><?php echo $fetch_list->order_id; ?></th>
<th><?php
		
	if($fetch_list->customer_id!=''){	
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
?></th>
<th>
<?php 
 $orderdtl = $this -> db
           -> select('*')
           -> where('order_id',$fetch_list->order_id)
           -> get('tbl_order_dtl');
		  $orderdtl_list = $orderdtl->row();


echo $fetch_list->order_date;

?>
</th>
<th><?=$orderdtl_list->total_qty;?></th>
<th class="bs-example">

<button class="btn btn-default modalEditcontact" href="#editcontact" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="invoiceedit('<?php echo $fetch_list->order_id;?>')"><i class="icon-pencil"></i></button>			
 
</th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
<tbody>
<tr class="gradeA">
<div class="pull-right">
<a href="manageInvoice"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</tr>
</tbody>
</form>
</div>