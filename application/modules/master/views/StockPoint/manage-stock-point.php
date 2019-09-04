<?php
$this->load->view("header.php");
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
	 <!-- Main content -->
<div class="main-content">
 <a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">MANAGE STOCK POINT AND VENDOR</a>
	<form class="form-horizontal" role="form" id="insertstockpointform" method="post" action="insert_stockpoint" enctype="multipart/form-data">	
	 <div id="addStockPoint" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
	    <div id="modal-content-stockpoint">

        </div>
    </div>	 
	</div>
	</form>	

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
							<a class="btn btn-sm gr" data-a="0" href='#addStockPoint' onclick="addStockPointss()" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add StockPoint / Vendor</span>
							</a>
							</div>
							</div>

							<div class="dataTables_length" id="DataTables_Table_0_length">
							<label>Show
							<select name="DataTables_Table_0_length" url="<?=base_url('master/StockPoint/manageStockPoint');?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">

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
							<input type="text" id="searchTerm"  class="search_box form-control input-sm" onKeyUp="doSearch()"  placeholder="What you looking for?">
							</label>
							</div>
							</div>
							</div>
							</div>

							<div class="table-responsive">
<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data">											
<table class="table table-striped table-bordered table-hover txtHint" id="userTbl">
<thead>
<tr>
		<th style="display:none"><input name="check_all"  type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>StockPoint /Vendor Name</th>
	    <th>Type</th>
		<th>Phone No.</th>
		<th>GST %</th>
        <th>Address</th>	
		 <th>Action</th>
</tr>
</thead>

<tbody>

<?php

$i=1;
 $query=$this->db->query("select * from tbl_stockpoint_and_vendor where status='A' ORDER BY stockpid DESC limit $page,$per_page");
  foreach($query->result() as $fetch_list)
  {

  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->stockpid; ?>">
<th style="display:none"><input name="cid[]" type="checkbox"  id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->stockpid; ?>" value="<?php echo $fetch_list->stockpid;?>" /></th>

<th><?php echo $fetch_list->stockpointname; ?></th>
<th><?php echo $fetch_list->type; ?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->phone_no;?></a></th>
<th><?php echo $fetch_list->gst_per; ?></th>
<th><?php echo $fetch_list->address; ?></th>

<th>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->stockpid;?>" href='#editcontact' type="button" onclick="stockPointUpdate('<?php echo $fetch_list->stockpid;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php
$pri_col='stockpid';
$table_name='tbl_stockpoint_and_vendor';
?>
<!--<button class="btn btn-default delbutton"  id="<?php echo $fetch_list->stockpid."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>	-->
</th>
</tr>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_stockpoint_and_vendor">  
<input type="text" style="display:none;" id="pri_col" value="stockpid">
</table>
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
</form>
</div>
</div>
</div>
</div>
</div>
</div>			

<form class="form-horizontal" role="form" method="post" id="editstockform" action="" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-stockpoint-update">

        </div>
    </div>	 
</div>
</form>

<script>

function stockPointUpdate(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "updateStockPoint?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-stockpoint-update").innerHTML = xhttp.responseText;
}
  
</script>	


<script>

function addStockPointss(){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "addStockPoint", false);
 xhttp.send();
 document.getElementById("modal-content-stockpoint").innerHTML = xhttp.responseText;
}
  
</script>


<script>
  $("#insertstockpointform").validate({
    rules: {
      stockpointid: "required",
      pointtypeid:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/StockPoint/insert_stockpoint');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#insertstockpointform').serialize(), // serializes the form's elements.
                success : function (data) {              
				 $( ".txtHint" ).html(data); 				 
				  $("#addStockPoint .close").click();
                  $('#insertstockpointform')[0].reset(); 				 	
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

 $("#editstockform").validate({
    rules: {
     stockpointid: "required",
      pointtypeid:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/StockPoint/updateStockPointss');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#editstockform').serialize(), // serializes the form's elements.
                success : function (data) {   
				       
				 $( ".txtHint" ).html(data); 				 
				  $("#editcontact .close").click();
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

<?php
$this->load->view("footer.php");
?>