<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

    ?>
	 <!-- Main content -->
	 <div class="main-content">
	 <a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">MANAGE PRODUCT</a>
<form class="form-horizontal" role="form" id="itemform" method="post" action="insert_item" enctype="multipart/form-data">	
	 <div id="addItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
	    <div id="modal-contentadditem">

        </div>
    </div>	 
</div>
</form>	

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<!-- /.panel-heading -->
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
<a class="btn btn-sm gr" data-a="0" href='#addItem' onclick="addProduct()" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Product</span>
</a>
</div>
</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entriesitem" class="form-control input-sm">

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
<form class="form-horizontal" method="post" action="update_item"  enctype="multipart/form-data">					
<div id="content">
<table class="table table-striped table-bordered txtHint" id="userTbl" >
<thead>
<tr>

        <th>Product Name</th>
		<th>Category</th>
		<th>StockPoint</th>
		<th>Usages Unit</th>
		<th>Price</th>
        <th style="width:200px!important;">Size/Weight</th>
		  <th>Image</th>
		 <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<?php  
$i=1;
$nquery=$this->db->query("select * from `tbl_product_stock` ORDER BY Product_id DESC limit $page,$per_page ");
  foreach($nquery->result() as $fetch_list)


  //foreach($result as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
<th style="display:none"><input type="checkbox"  /></th>
<th><?=$fetch_list->productname;?></th>
<th>
<?php 
 $compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list->category)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;
?>

 </th>
 <th>
<?php 
//echo $fetch_list->stockpid.'dsd';
 $stQuery = $this -> db
           -> select('*')
           -> where('stockpid',$fetch_list->stockpid)
           -> get('tbl_stockpoint_and_vendor');
		  $stRow = $stQuery->row();

echo $stRow->stockpointname;
?>

 </th>
<th><?php
$compQuery1 = $this -> db
           -> select('*')
           -> where('serial_number',$fetch_list->usageunit)
           -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
echo $keyvalue1->keyvalue;		  

?></th>
<th><?=$fetch_list->price_range;?></th>
<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

$countsize=sizeof(explode(' ', $fetch_list->size));
$expsize=explode(' ', $fetch_list->size);

for($i=0;$i<$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Weight</strong></td>
<?php
$expweight=explode(' ', $fetch_list->weight_name);
for($j=0;$j<$countsize;$j++){

 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php if($fetch_list->product_image!=''){?><img src="<?php echo base_url().'assets/image_data/'.$fetch_list->product_image;?>" height="38" width="50" /> <?php } else {?><img src="<?php echo base_url()?>assets/images/no_image.png" height="38" width="50" /><?php }?> </th>
<th class="bs-example">
<!--
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i;?>" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>-->

<button class="btn btn-default modalEditItem" data-a="<?php echo $fetch_list->Product_id;?>" href='#editItem' onclick="EditcontactPriceLoc('<?php echo $fetch_list->Product_id;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php 
$pri_col='Product_id';
$table_name='tbl_product_stock';

$pserial=$this->db->query("select * from tbl_product_serial where product_id='$fetch_list->Product_id'");
$pcount=$pserial->num_rows();

$ordrdtl=$this->db->query("select * from tbl_order_dtl where item_id='$fetch_list->Product_id'");
$ordrcount=$ordrdtl->num_rows();

$maping=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$fetch_list->Product_id'");
$mapingcount=$maping->num_rows();

$invdtl=$this->db->query("select * from tbl_ordered_invoice_dtl where item_id='$fetch_list->Product_id'");
$invcount=$invdtl->num_rows();

//echo $invcount;

$idddds = $pcount + $ordrcount + $mapingcount + $invcount;
//echo $idddds;

if($idddds=='0')
{
?>
<!--<button class="btn btn-default delbutton" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>			-->
<?php } ?>

</th>
</tr>
<div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">VIew Product</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Product Name:</label> 
<div class="col-sm-4"> 
<input name="item_name[]"  type="text" value="<?php echo $fetch_list->productname; ?>" readonly class="form-control" required> 
</div> 
<label class="col-sm-2 control-label">*Product Type:</label> 
<div class="col-sm-4"> 
<select name="Product_type" required class="form-control" disabled="disabled">
						<option value="">----Select ----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=24");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->serial_number;?>" <?php if($fetch_protype->serial_number==$fetch_list->Product_type){ ?> selected <?php }?>><?php echo $fetch_protype->keyvalue; ?></option>
					<?php } ?>

					</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Category:</label> 
<div class="col-sm-4"> 
<select name="category[]" class="form-control ui fluid search dropdown email1" disabled="disabled">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id!='121'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"<?php if($fetchgroup->prodcatg_id==$fetch_list->category){?>selected<?php }?>><?php echo $fetchgroup->prodcatg_name ; ?></option>

    <?php } ?></select>
</div> 
<label class="col-sm-2 control-label">*Usages Unit:</label> 
<div class="col-sm-4" > 
<select name="unit[]" class="form-control" disabled="disabled">
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
				<option value="<?php echo $fetchunit->serial_number;?>" <?php if($fetchunit->serial_number==$fetch_list->usageunit){ ?> selected <?php }?>><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Size:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="size[]"  value="<?php echo $fetch_list->size; ?>" class="form-control" required readonly="">
</div> 
<label class="col-sm-2 control-label">Minimum Reorder Level:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="min_re_order_level[]" value="<?php echo $fetch_list->min_re_order_level; ?>" readonly="" class="form-control">
</div> 
</div>
<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">*Color:</label> 
<div class="col-sm-4" id="regid"> 
<select name="color[]" class="form-control" disabled="disabled">
					<option value="">----Select color----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=23");
						foreach ($sqlunit->result() as $fetchunit){
						//$explode=explode(",",$branchFetch->color);
					?>
				<option value="<?php echo $fetchunit->serial_number;?>" <?php if($fetchunit->serial_number==$fetch_list->color){ ?> selected <?php } ?>><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div> 

<label class="col-sm-2 control-label">*Purchase Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any" name="unitprice_purchase[]" value="<?php echo $fetch_list->unitprice_purchase; ?>" readonly="" class="form-control" required>
</div> 

</div>
<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">*Sale Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any" name="unitprice_sale[]" value="<?php echo $fetch_list->unitprice_sale; ?>" readonly="" class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*HSN Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="hsn_code[]"  value="<?php echo $fetch_list->hsn_code; ?>" readonly="" class="form-control" required>
</div> 

</div>
<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">*GST Tax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="gst_tax[]" value="<?php echo $fetch_list->gst_tax; ?>" readonly="" class="form-control" required>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Weight</label> 
<div class="col-sm-4"> 
<input type="text" name="price_range[]" class="form-control" value="<?php echo $fetch_list->price_range; ?>"/>
</div> 
<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4" id="regid"> 
<input type="file" name="image_name[]" accept="image/*" onchange="loadFile(event)" /><?php if($fetch_list->product_image!=''){ ?> <img id="output" src="<?php echo base_url().'assets/image_data/'.$fetch_list->product_image; ?>"  height="38" width="50"/><?php } else { ?><img src="/sharma-heels-final/assets/images/no_image.png" height="38" width="50"><?php }?>
</div> 
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</div>

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
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>

</div>
<form class="form-horizontal" role="form" id="edititemform" method="post" action="update_item" enctype="multipart/form-data">			
<div id="editItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-contentitem">

        </div>
    </div>	 
</div>
</form>
 <script>
  $("#itemform").validate({
    rules: {
      item_name: "required",
      Product_type:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Item/insert_item');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#itemform').serialize(), // serializes the form's elements.
                success : function (data) {                 
				 $( ".txtHint" ).html(data); 				 
				  $("#addItem .close").click();
                  $('#itemform')[0].reset(); 				 	
					$('#success_message').fadeIn().html("Record Added Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
				       
                 ajex_contactListData();
               }
            });
          return false;
      }
  });

<!--========================================================================= Edit item function ==================================================================-->

 $("#edititemform").validate({
    rules: {
      item_name: "required",
      Product_type:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Item/update_item');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#edititemform').serialize(), // serializes the form's elements.
                success : function (data) {   
				       
				 $( ".txtHint" ).html(data); 				 
				  $("#editItem .close").click();
                  //$('#edititemform')[0].reset(); 				 	
					$('#success_message').fadeIn().html("Record Updated Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
				       
                 ajex_contactListData();
               }
            });
          return false;
      }
  });
  
 </script>

<script>
$(document).ready(function () {
    $("#entriesitem").change(function()
    {
      var value=$(this).val();
      url = "<?=base_url('/master/Item/manage_item?entries=');?>"+value;
      window.location.href = url;
    });
});
</script>
<!--<script>
function customerInsertFun(){                 

var item_name=document.getElementById("item_name").value;
var Product_type=document.getElementById("Product_type").value;
var category=document.getElementById("category").value;
var stockpid=document.getElementById("stockpid").value;
var min_re_order_level=document.getElementById("min_re_order_level").value;
var price_range=document.getElementById("price_range").value;
var image_name=document.getElementById("file").value;
var sizerow=document.getElementById("sizerow").value;

var size_val = [];
var weightname_val = [];
for(var i=1;i<=sizerow;i++){
		var size_name=document.getElementById("size"+i).value;
		var weight=document.getElementById("weightname"+i).value;
		size_val.push(size_name);
		weightname_val.push(weight);
}
var sizevaltot=size_val.join(' ');
var weightvaltot=weightname_val.join(' ');
 
  
   $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>master/Item/insert_item',
                data: { item_name : item_name, Product_type : Product_type, category : category, stockpidname : stockpid, min_re_order_level : min_re_order_level, price_range : price_range, totalsize : sizevaltot, totalweight : weightvaltot},
                success: function (result) {
                    //Your success code here..
					//alert(result);
					//$("#successMessage").show();
					//$("#successMessage").html("It worked");
					
					$( ".txtHint" ).html( result ); 
					
					$('#success_message').fadeIn().html("Record Added Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
					
					//location.reload();
                },
                error: function (jqXHR) {                        
                    if (jqXHR.status === 200) {
                        alert("Value Not found");
                    }
                }
            });
		
}
</script>-->

<script>
/*function customerupdateFun(){                 

var Product_id=document.getElementById("Product_id").value;
var item_name=document.getElementById("item_name").value;
var Product_type=document.getElementById("Product_type").value;
var category=document.getElementById("category").value;
var unitn=document.getElementById("unit").value;
var min_re_order_level=document.getElementById("min_re_order_level").value;
var price_range=document.getElementById("price_range").value;
var image_name=document.getElementById("fileid").value;
var sizerow=document.getElementById("sizerow").value;

var size_val = [];
var weightname_val = [];
for(var i=1;i<=sizerow;i++){
		var size_name=document.getElementById("size"+i).value;
		var weight=document.getElementById("weightname"+i).value;
		size_val.push(size_name);
		weightname_val.push(weight);
}
var sizevaltot=size_val.join(' ');
var weightvaltot=weightname_val.join(' ');
 
   $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>master/Item/update_item',
                data: { Product_id : Product_id, item_name : item_name, Product_type : Product_type, category : category, unitname : unitn, min_re_order_level : min_re_order_level, price_range : price_range, image_name : image_name, totalsize : sizevaltot, totalweight : weightvaltot},
                success: function (result) {
                    //Your success code here..
					//alert(result);
					//$("#successMessage").show();
					$( ".txtHint" ).html( result );
					$('#success_message').fadeIn().html("Record Updated Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
					//location.reload();
                },
                error: function (jqXHR) {                        
                    if (jqXHR.status === 200) {
                        alert("Value Not found");
                    }
                }
            });
		
}*/
</script>

<script>
function samepro(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "sameitemequal?ID="+v, false);
 xhttp.send();
 document.getElementById("item_msg").innerHTML = xhttp.responseText;

}

function addProduct(){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "addItem", false);
 xhttp.send();
 document.getElementById("modal-contentadditem").innerHTML = xhttp.responseText;
}
  
</script>	

<script>

function EditcontactPriceLoc(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "updateItem?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
}
  
</script>	

<script>
	 function GetFileSize() {	 	
        var fi = document.getElementById('file'); // GET THE FILE INPUT.
	    // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.		
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.				
				var tsize = Math.round((fsize / 1024));				
				if(Number(tsize) < 12)				{
					document.getElementById("error").style.display= "none";
					document.getElementById("sv1").disabled = false;					
				}
					else{
							document.getElementById("error").style.display = "";
							document.getElementById("sv1").disabled = true;
						}				
                //document.getElementById('fp').innerHTML = document.getElementById('fp').innerHTML + '<br /> ' +  '<b>' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
	
	
	 function GetFileSizeto() {
	 	
        var fi = document.getElementById('fileid'); // GET THE FILE INPUT.
        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.			
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.				
				var tsize = Math.round((fsize / 1024));	
				if(Number(tsize) < 12)
				{
					document.getElementById("error1").style.display= "none";
					document.getElementById("sv11").disabled = false;					
				}
					else{
							document.getElementById("error1").style.display = "";
							document.getElementById("sv11").disabled = true;
						}				
                //document.getElementById('fp').innerHTML = document.getElementById('fp').innerHTML + '<br /> ' +  '<b>' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }

</script>
<script>
function rowAddform(tableID){
	
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			
			document.getElementById("sizerow").value=rowCount;
			
var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chkbox"+rowCount;
			cell1.appendChild(element1);
				

var cell4 = row.insertCell(1);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.style = "width: 100px";
			element3.className="form-control";
			element3.id = "size"+rowCount;
			element3.name = "size[]";
			cell4.appendChild(element3);


var cell5 = row.insertCell(2);
			var element4 = document.createElement("input");
			element4.type = "number";
			element4.step = "any";
			element4.style = "width: 100px";
			element4.className="form-control"
			element4.id = "weightname"+rowCount;
			element4.name = "weightname[]";
			cell5.appendChild(element4);
		
}

function editDeleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
			document.getElementById("sizerow").value=rowCount-1;				
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

</script>
<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
	
			document.getElementById("sizerow").value=rowCount;
			
var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chkbox"+rowCount;
			cell1.appendChild(element1);
				

var cell4 = row.insertCell(1);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.style = "width: 100px";
			element3.className="form-control";
			element3.id = "size"+rowCount;
			element3.name = "size[]";
			cell4.appendChild(element3);


var cell5 = row.insertCell(2);
			var element4 = document.createElement("input");
			element4.type = "number";
			element4.step = "any";
			element4.style = "width: 100px";
			element4.className="form-control"
			element4.id = "weightname"+rowCount;
			element4.name = "weightname[]";
			cell5.appendChild(element4);

		}


		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;			
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
			document.getElementById("sizerow").value=rowCount-1;			
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
	
<?php

$this->load->view("footer.php");
?>