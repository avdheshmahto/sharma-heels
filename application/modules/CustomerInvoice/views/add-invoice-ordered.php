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
<a href="manageInvoice"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
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
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</tbody>
</table>

</div>
<div id="ordereddataid">			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover" >
<thead>
<h5>View Orders</h5>
<tr>
	   <th>Ordered No.</th>
	   <th>Customer Name / Store</th>
        <th>Order Date</th>
        <th>Total Qty</th>
		
</tr>
</thead>
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

