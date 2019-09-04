
<?php
$this->load->view("header.php");
?>
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Regarpura</a></li> 
<li class="active"><strong>Purchase Order</strong></li>
<div class="pull-right">
<a href="#">
<!--<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0"><i class="fa fa-pencil"></i>Add Purchase Order</button>-->
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
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
		<th>Order No.</th>
	   <th>Customer Name / Store</th>
        <th>Order Date</th>
        <th>Total Qty</th>
		<th>Status</th>		
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php  

$brnhid=$this->session->userdata('brnh_id');

if($brnhid==5){
 		$i=1;
$sqlorder=$this->db->query("select * from tbl_order_hdr where store_id='1' ORDER BY order_id DESC");
}else if($brnhid==1){
$i=1;
$sqlorder=$this->db->query("select * from tbl_order_hdr where store_id='1' ORDER BY order_id DESC");

}else{
$i=1;
$sqlorder=$this->db->query("select * from tbl_order_hdr where status='NotResult'");

}

foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->order_id; ?>">
<th><?php
$nextyear=date("y");
 $ss=$fetch_list->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<th><?php
		
		//echo $fetch_list->customer_id;
		

		
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

echo $fetch_list->order_date;

$sqlinv=$this->db->query("select * from tbl_order_dtl where order_id='$fetch_list->order_id'");
			
			$sumqtys=0;
	foreach($sqlinv->result() as $fetch_invoiced){	
			
				$sumqtys +=$fetch_invoiced->total_qty;
				
			}

?>
</th>
<th><?php echo $sumqtys; ?></th>
<th><?php echo $fetch_list->invoice_status; ?></th>
<th class="bs-example">

<button class="btn btn-default modalEditcontact" href="#editcontact" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="viewInvoice('<?php echo $fetch_list->order_id;?>')"><i class="fa fa-eye"></i></button>			
 
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
<form class="form-horizontal"  id="f1" name="f1" role="form" method="post" action="invoiceUpdateFun" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
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
	function orderedqtyfun(d,r){
		
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;	
  
var sp=d.split("orderedqtyidd");

var asx= sp[1];

 var validationentettrqty=document.getElementById("checkorderedqtyidd"+asx).value;
			var twoqteeey=document.getElementById("orderedqtyidd"+asx).value;
						
	if(Number(twoqteeey)<=Number(validationentettrqty)){	
			document.getElementById("sv1").disabled = false;
	}else{		
			document.getElementById("sv1").disabled = true;
			document.getElementById("orderedqtyidd"+asx).focus();
	}

	  var countsizeidall=document.getElementById("countsizeid"+r).value; 				
				var sumtwoqty=0;
				var qtyselected = [];
		 for(var k=1; k<countsizeidall; k++){
		 var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;		 	
			var twoqty=document.getElementById("orderedqtyidd"+k+r).value;
			var validorredqty=document.getElementById("validorqtyid"+k+r).value;
			if(Number(twoqty)<=Number(validationenterqty)){				
				var sumorqty=Number(validorredqty)+Number(twoqty);				
					sumtwoqty +=Number(twoqty);	
					qtyselected.push(twoqty);	
			}else{
				var sumorqty=0;
				alert("Enter Qty Is Greate Then");									
				
			}
					 }
		
		var countsizeidallt=countsizeidall-1;
		var qtyselectedsd = [];
		for(var l=1;l<countsizeidallt; l++){
		var twdsoqty=document.getElementById("orderedqtyidd"+l+r).value;
		qtyselectedsd.push(twdsoqty);					
		}
		var sumtoallqty=Number(twdsoqty)+Number(sumorqty);		 			 
		var qtysetall=qtyselectedsd+','+sumorqty;
		document.getElementById("totalorid"+r).value=+sumtoallqty; 
		document.getElementById("orqtyid"+r).value=qtysetall; 
				
		var priceorid=document.getElementById("priceorid"+r).value; 		
		var multpri=Number(priceorid)*Number(sumtoallqty);
		document.getElementById("finalpriceorid"+r).value=multpri; 
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
						var validorredqty=document.getElementById("validorqtyid"+k+r).value;
						var sumorqty=Number(validorredqty)+Number(twoqty);	
						
						sumtwoqty +=Number(twoqty);		
						 qtyselected.push(twoqty);	
						document.getElementById("orderedqtyidd"+k+r).value=twoqty;
						document.getElementById("orderedqtyidd"+k+r).readOnly = true; 
					 }
					
					var countsizeidallt=countsizeidall-1;
					var qtyselectedsd = [];
					for(var l=1;l<countsizeidallt; l++){
					var twdsoqty=document.getElementById("orderedqtyidd"+l+r).value;
					qtyselectedsd.push(twdsoqty);					
					}
					var sumtoallqty=Number(twdsoqty)+Number(sumorqty);		 			 
					var qtysetall=qtyselectedsd+','+sumorqty;
					
					document.getElementById("totalorid"+r).value=+sumtoallqty; 
					
					document.getElementById("orqtyid"+r).value=qtysetall; 
					
					var priceorid=document.getElementById("priceorid"+r).value; 		
					var multpri=Number(priceorid)*Number(sumtoallqty);
					document.getElementById("finalpriceorid"+r).value=multpri; 
			
		}
 
 
 
 if(checkid==false)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("checkorderedqtyidd"+k+r).value;
						var validorredqty=document.getElementById("validorqtyid"+k+r).value;
						var sumorqty=Number(twoqty);
						qtyselected.push(twoqty);
						document.getElementById("orderedqtyidd"+k+r).readOnly = false; 
					 }
					
					var countsizeidallt=countsizeidall-1;
					var qtyselectedsd = [];
					for(var l=1;l<countsizeidallt; l++){
					var twdsoqty=document.getElementById("orderedqtyidd"+l+r).value;
					qtyselectedsd.push(twdsoqty);					
					}
					var ortoqty=document.getElementById("totalorid"+r).value;
					var sumtoallqtytwo=Number(ortoqty)-Number(sumorqty);		 			 
					var qtysetall=qtyselectedsd+','+validorredqty;	 
						 
					document.getElementById("totalorid"+r).value=+sumtoallqtytwo; 
					document.getElementById("orqtyid"+r).value=qtysetall; 
					
					var priceorid=document.getElementById("priceorid"+r).value; 		
					var multpri=Number(priceorid)*Number(sumtoallqtytwo);
					document.getElementById("finalpriceorid"+r).value=multpri; 
			
		}
 
}
</script>
<?php
$this->load->view("footer.php");
?>

