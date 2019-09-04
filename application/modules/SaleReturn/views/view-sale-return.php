<?php
$this->load->view("header.php");
$exdate=$_GET['id'];
$ex=explode('^', $exdate);
$id=$ex[0];
$name=$ex[1];
?>
<body onLoad="showww()">	
<?php 
if($name=='Customer'){
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$id'");
$getContact=$contactQuery->row();

}else{

$locQuery=$this->db->query("select *from tbl_location where id='$id'");
$getLoc=$locQuery->row();
}
?>
<div class="main-content">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">View Sale Return&nbsp;&nbsp;&nbsp;&nbsp;(<?php if($getContact->first_name!=''){ echo $getContact->first_name; }else{ echo $getLoc->location_name; } ?>)</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body panel-center">
<form class="form-horizontal" method="post">

<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="fdate" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="tdate" class="form-control" value="" /> 
</div> 
</div>
<div class="form-group panel-body-to"> 
<div class="col-sm-3">
</div>
<div class="col-sm-3">
</div>
<label class="col-sm-2 control-label"></label>
<label class="col-sm-2 control-label"><input type="submit" name="search" class="btn btn-sm" value="Search"></label> 
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" style="width:-webkit-fill-available !important;">
<thead> 
<tr> 
		<th>S No.</th>
		<th>Date</th>
        <th>Product Name</th>
		<th>Category Name</th> 
		<th>Size/Qty</th>
		<th>Total Qty</th> 
		<th>Price</th> 
		<th>Action</th> 
		</tr> 
</thead> 
 

<?php
	@extract($_POST);
	if($search!='')
	{
		if($name=='Customer'){

		$queryy="select * from tbl_sale_return_dtl where customer_id='$id'";

		}else{
		
		$queryy="select * from tbl_sale_return_dtl where store_id='$id'";
			
			}

				
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("-",$tdate);
			
			$fdate=explode("-",$fdate);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and return_date >='$fdate1' and return_date <='$todate1'";
		}
}else{
if($name=='Customer'){
$queryy="select * from tbl_sale_return_dtl where  customer_id='$id'";
}else{
$queryy="select * from tbl_sale_return_dtl where  store_id='$id'";
}
}

$result11=$this->db->query($queryy);
?>
<tbody>
<?php 
$i=1;
foreach($result11->result() as $line) {
?>
<tr class="gradeC record">

<th><?php echo $i; ?></th>
<th><?php echo $line->return_date;?></th>
<th><?php echo $line->productname;?></th>
<th><?php 
 $compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$line->category_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;
?></th>
<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

$countsize=sizeof(explode(' | ', $line->size_val));
$expsize=explode(' | ', $line->size_val);

for($i=1;$i<$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php
$expweight=explode(' ', $line->qty_val);
for($j=1;$j<$countsize;$j++){

 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php echo $line->total_qty; ?></th>
<th><?php echo $line->one_item_price; ?></th>
<th>
<button class="btn btn-default modalEditItem" data-a="<?php echo $line->sale_return_dtl_id;?>" href='#editItem' onClick="add_payment('<?php echo $line->sale_return_dtl_id;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
</th>
</tr>
<?php 
 
	 $i++; 

}  
?>
</tbody> 
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="update_invoice_payment" enctype="multipart/form-data">			
<div id="editItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contentitem" id="modal-contentitem">

        </div>
    </div>	 
</div>
</body>
</form>
<script>
//--------------------------add Tailor start----------------------------
function add_payment(v){
//alert(v);
var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "edit_payment?ID="+pro, false);
  xhttp.send();
  document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
 } 
//--------------------------add Tailor end----------------------------

</script>
<?php $this->load->view("footer.php");?>