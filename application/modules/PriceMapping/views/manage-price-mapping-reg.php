<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="insertSalesOrder" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
	<div class="main-content">
		<div class="row">
<div class="col-sm-4">		
		<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Regarpura</a></li> 
<li class="active"><strong>Price Mapping</strong></li>
</ol>
</div>
<div class="col-sm-6 breadcrumb breadcrumb-2">
<?php
            if($this->session->flashdata('flashmsg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert" style="float:left; width:400px; text-align:center;margin:0 150px 0 0px; font-size:14px; color: #a94442;"><strong>Well done! &nbsp;<?php echo $this->session->flashdata('flashmsg');?></strong> 
</div>

<?php } ?>
</div>

<div class="col-sm-2 breadcrumb breadcrumb-2">
&nbsp;
</div>
</div> 
			<div class="row">
				<div class="col-lg-12">
					<div>
						
<div class="panel-body">
<div class="table-responsive---">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>	
		<th>S.No.</th>
	    <th>Customer Name</th>
        <th>Credit Limit</th>
		<th style="display:none">Location</th>
		<th>Action</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
 
  $query=$this->db->query("select * from tbl_contact_m where module_status='Ragarpura'");	       

  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
<th><?=$i;?></th>
<th>
<?php echo $fetch_list->first_name; ?></th>

<th><?php echo $fetch_list->credit_limit; ?></th>
<th style="display:none"><?php echo $fetch_list->module_status; ?></th>
<th style="width:24%">

<button onclick="return open_a_window('<?php echo $fetch_list->contact_id.'^'.$fetch_list->module_status;?>');" class="btn btn-sm" type="button">Mapping</button>

<button class="btn btn-sm modalEditContact" onclick="EditcontactPrice('<?php echo $fetch_list->contact_id.'^'.$fetch_list->module_status;?>')" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>Update Credit Limit</button>
</th>
<script language="javascript">

function open_a_window(v) 
{
   window.open("contact_product_price_mapping?id="+v); 

   return false;
}

</script>
</tr>
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="insertMapping" enctype="multipart/form-data">			
<div id="editItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="contentitem">

        </div>
    </div>	 
</div>
</form>
<form class="form-horizontal" role="form" method="post" action="updateCreditLimit" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="contentedit">

        </div>
    </div>	 
</div>
</form>
<script>
function contactPrice(v){

var xhttp = new XMLHttpRequest();
//alert(v);
 xhttp.open("GET", "PriceMap?ID="+v, false);
 xhttp.send();
 document.getElementById("contentitem").innerHTML = xhttp.responseText;
}

function EditcontactPrice(v){
//alert(v);
//var customerandloc=document.getElementById("customer_id").value;     

//var pro=v+'^'+customerandloc;
var xhttp = new XMLHttpRequest();
//alert(v);
 xhttp.open("GET", "EditCreditLimit?ID="+v, false);
 xhttp.send();
 document.getElementById("contentedit").innerHTML = xhttp.responseText;
}
	
	
function checkvalitate(v){
	var d=v.split("price");
	var Id=d[1];
	//alert(Id);
	var price=document.getElementById("price"+Id).value;
	var value=document.getElementById("price_range"+Id).value;
	var range=value.split("-");
	//alert(range);
	var minrange=range[0];
	var maxrange=range[1];
	//alert(maxrange);
	if(Number(price)<Number(minrange) || Number(price)>Number(maxrange)){
		//alert("hello");
		document.getElementsById("errorMsg").value='abc';
		//document.getElementById("Product_id"+Id).value=null;
	}else{
		document.getElementsById("errorMsg").style.display="";
	}
	
}
</script>	
<?php
$this->load->view("footer.php");
?>

