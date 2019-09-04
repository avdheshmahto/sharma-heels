<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Regarpura</a></li> 
<li class="active"><strong>Add Invoice</strong></li>
<div class="pull-right">
<a href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoice">
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0"><i class="fa fa-pencil"></i>Add Invoice</button>
</a>
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
	
<div id="ordereddataidss">			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<h1></h1>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
		<th>Invoice No.</th>
	   <th>Customer Name</th>
        <th>Date</th>
        <th>Total Qty</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>

<?php  
$i=1;

$sqlorder=$this->db->query("select * from tbl_ordered_invoice_hdr_reg where status='A' ORDER BY ordered_invoiceid_reg DESC");

	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid_reg; ?>">
<th><?php 
$nextyear=date("y");
$ss=$fetch_list->ordered_invoiceid_reg;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "RP"."/".$nextyear."/".$numbercase;
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

$sqlinv=$this->db->query("select * from tbl_ordered_invoice_dtl_reg where ordered_invoiceid_reg='$fetch_list->ordered_invoiceid_reg'");
			
			$sumqtys=0;
	foreach($sqlinv->result() as $fetch_invoiced){	
			
				$sumqtys +=$fetch_invoiced->total_qty;
				
			}

?>
</th>

<th><?php echo $sumqtys; ?></th>

<th class="bs-example">

<a href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/printInvoice?id=<?php echo $fetch_list->ordered_invoiceid_reg; ?>" target="_blank"><button class="btn btn-default" data-a="#" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-print"></i></button></a>	

<button class="btn btn-default modalEditcontact" href="#editinvoiceordered" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="viewInvoice('<?php echo $fetch_list->ordered_invoiceid_reg;?>')"><i class="fa fa-eye"></i></button>			
<!--
<button class="btn btn-default modalEditcontact" href="#editinvoiceordered" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="updateInvoice('<?php echo $fetch_list->ordered_invoiceid_reg;?>')"><i class="icon-pencil"></i></button>			
-->
</th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
<form class="form-horizontal" role="form" method="post" action="invoiceInsertReg" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="diveditid">

        </div>
    </div>	 
</div>
</form>

<form class="form-horizontal"  id="f1" name="f1" role="form" method="post" action="invoiceUpdateFunReg" enctype="multipart/form-data">			
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
  xhttp.open("GET", "updateInvoiceOrderedReg?ID="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 

function viewInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "viewInvoiceOrderedReg?ID="+pro, false);
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
  xhttp.open("GET", "updateInvoiceReg?ID="+pro, false);
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

