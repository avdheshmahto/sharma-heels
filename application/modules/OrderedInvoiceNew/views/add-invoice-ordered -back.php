<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="insertorder" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">National</a></li> 
<li class="active"><strong>Add Invoice</strong></li>
<div class="pull-right">
<a href="manageInvoiceNat"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</ol>

<?php
            if($this->session->flashdata('flashmsg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flashmsg');?></strong> 
</div>	
<?php }?>
	
			<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
	<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th class="customerclass">Customer Name / Store</th>
<th class="customerclass">
<select name="customer_id" id="customer_id"  class="form-control ui fluid search dropdown email" onchange="locandstore()">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id.'^custmr'; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php 
			} 
						$sqlloc=$this->db->query("select * from tbl_location");
						foreach ($sqlloc->result() as $fetchloc){						
					?>					
    <option value="<?php echo $fetchloc->id.'^loc'; ?>"><?php echo $fetchloc->location_name; ?></option>

    <?php } ?>
	</select>
</th>
</tr>
</tbody>
</table>

</div>
<div id="ordereddataid">			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<h1></h1>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
		<th>Ordered No.</th>
	   <th>Customer Name / Store</th>
        <th>Invoice Date</th>
		<th>Pending Qty</th>
        <th>Completed Qty</th>		
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
$sqlorder=$this->db->query("select * from tbl_ordered_invoice_hdr where status='A' ORDER BY ordered_invoiceid DESC");
	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid; ?>">
<th><?php 
$ss=$fetch_list->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
echo $numbercase = sprintf('%04d',$var);
 ?></th>
<th><?php
		
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
?></th>
<th>
<?php 

echo $fetch_list->invoice_date;

$sqlinv=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$fetch_list->ordered_invoiceid'");
			
			$sumqtys=0;
	foreach($sqlinv->result() as $fetch_invoiced){	
			
				$sumqtys +=$fetch_invoiced->total_qty;
				
			}

?>
</th>
<th><?php 
$sqlinvdd=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$fetch_list->ordered_invoiceid'");
			
	foreach($sqlinvdd->result() as $fetch_invoicedssd){	
							
					$sizecount=sizeof(explode(' | ',$fetch_invoicedssd->size_val));
					$pending=$fetch_invoicedssd->qty_val;
					$orededqty=$fetch_invoicedssd->ordered_qty_val;
			if($fetch_invoicedssd->ordered_qty_val==$fetch_invoicedssd->qty_val){
					
			}else{
					$orqtyarrrt=0;
				for($ik=1;$ik<=$sizecount;$ik++){
						
						$orqtyarr=explode(',',$orededqty);
					 $orqtyarrrt +=$orqtyarr[$ik];
				}	
			}	
					
			}
		echo $orqtyarrrt;	

?></th>
<th><?php echo $sumqtys; ?></th>
<th class="bs-example">

<a href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/printInvoice?id=<?php echo $fetch_list->ordered_invoiceid; ?>" target="_blank"><button class="btn btn-default" data-a="#" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-print"></i></button></a>	

<button class="btn btn-default modalEditcontact" href="#editinvoiceordered" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="viewInvoice('<?php echo $fetch_list->ordered_invoiceid;?>')"><i class="fa fa-eye"></i></button>			

<button class="btn btn-default modalEditcontact" href="#editinvoiceordered" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="updateInvoice('<?php echo $fetch_list->ordered_invoiceid;?>')"><i class="icon-pencil"></i></button>			
 
</th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</form>
</div>
<div class="pull-right">
<a href="manageInvoiceNat"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
<form class="form-horizontal" role="form" method="post" action="invoiceInsert" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="diveditid">

        </div>
    </div>	 
</div>
</form>

<form class="form-horizontal"  id="f1" name="f1" role="form" method="post" action="invoiceUpdateFun" enctype="multipart/form-data">			
<div id="editinvoiceordered" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="divupdateid">

        </div>
    </div>	 
</div>
</form>
<script>
function updateInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "updateInvoiceOrdered?ID="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 

function viewInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "viewInvoiceOrdered?ID="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 

</script>
<script>
function locandstore(){
var contactid=document.getElementById("customer_id").value;
var pro=contactid;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getordered?id="+pro, false);
  xhttp.send();
  document.getElementById("ordereddataid").innerHTML = xhttp.responseText;
 } 
 
</script>
<script>
	function orderedqtyfun(d,r){
		
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;	

	  var countsizeidall=document.getElementById("countsizeid"+r).value; 		
				var sumtwoqty=0; 
				var qtyselected = [];
		 for(var k=1; k<countsizeidall; k++){
		 var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;
		 	
			var twoqty=document.getElementById("orderedqtyidd"+k+r).value;
			
			if(Number(twoqty)<=Number(validationenterqty)){

					sumtwoqty +=Number(twoqty);		
					qtyselected.push(twoqty);	

			}
			
					 }
		 	 
		document.getElementById("totalorid"+r).value=sumtwoqty; 
		document.getElementById("orqtyid"+r).value=qtyselected; 
		
		var priceorid=document.getElementById("priceorid"+r).value; 		
		var multpri=Number(priceorid)*Number(sumtwoqty);
		document.getElementById("finalpriceorid"+r).value=multpri; 
	}
</script>
<script>
function invoiceedit(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "updateInvoice?ID="+pro, false);
  xhttp.send();
  document.getElementById("diveditid").innerHTML = xhttp.responseText;
 } 

</script>	
<script>
function myCheckFunction(r) {
    	
var checkid = document.getElementById('myCheck'+r).checked;

		if(checkid==true)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("checkorderedqtyidd"+k+r).value;
						sumtwoqty +=Number(twoqty);		
						 qtyselected.push(twoqty);	
						document.getElementById("orderedqtyidd"+k+r).value=twoqty;
						document.getElementById("orderedqtyidd"+k+r).readOnly = true; 
					 }
						 
					document.getElementById("totalorid"+r).value=sumtwoqty; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					var priceorid=document.getElementById("priceorid"+r).value; 		
					var multpri=Number(priceorid)*Number(sumtwoqty);
					document.getElementById("finalpriceorid"+r).value=multpri; 
			
		}
 
 
 
 if(checkid==false)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("orderedqtyidd"+k+r).value=0;
						qtyselected.push(twoqty);
						document.getElementById("orderedqtyidd"+k+r).readOnly = false; 
					 }
						 
					document.getElementById("totalorid"+r).value=0; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					document.getElementById("finalpriceorid"+r).value=0; 
			
		}
 
}
</script>
<?php
$this->load->view("footer.php");
?>

