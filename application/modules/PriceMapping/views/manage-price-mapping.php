<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
<form id="f1" name="f1" method="POST" action="insertSalesOrder" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
	<div class="main-content"> 
<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">MANAGE PRICEMAPPING</a>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('PriceMapping/managePriceMapping');?>" class="form-control input-sm">

						<option value="10">10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
						<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
						<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>All</option>
						</select>
						entries</label>
						<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -5px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
							<?php
							$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
							echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
							?> of <?=$dataConfig['total'];?> entries
						</div>
						</div>
	<div id="DataTables_Table_0_filter" class="dataTables_filter">
		<label>Search:
		<input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
		</label>
		</div>
</div>


</div>
</div>	
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover txtHint" id="userTbl">
<thead>
<tr>	
	    <th>Customer Name</th>
        <th>Credit Limit</th>
		<th>Action</th>
</tr>
</thead>

<tbody  id="getDataTable">

<?php  
$i=1;
 
  $query=$this->db->query("select * from tbl_contact_m where module_status='National' ORDER BY contact_id DESC limit $page,$per_page");	       

  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
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
<div class="row">
					       <div class="col-md-12 text-right">
					    	  <div class="col-md-6 text-left"> 
					    		<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
					    	  </div>
					    	  <div class="col-md-6"> 
					          <?php echo $pagination; ?>
					          </div>
					          </div>
					      </div>
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
<form class="form-horizontal" role="form" method="post" action="updateCreditLimitLoc" enctype="multipart/form-data">			
<div id="editcontactloc" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="contenteditloc">

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

function EditcontactPriceLoc(v){

var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "EditCreditLimitLoc?ID="+v, false);
 xhttp.send();
 document.getElementById("contenteditloc").innerHTML = xhttp.responseText;
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

