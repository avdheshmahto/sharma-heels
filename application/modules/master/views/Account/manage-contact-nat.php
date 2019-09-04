<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
	 <!-- Main content -->
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">MANAGE CUSTOMER</a>
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
<a class="btn btn-sm gr" data-a="0" href='#addCustomer' onclick="addCustomer()" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Contact</span>
</a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('master/Account/manageContactNat');?>" class="form-control input-sm">

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
<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data">											
<table class="table table-striped table-bordered table-hover txtHint" id="userTbl">
<thead>
<tr>
		<th style="display:none"><input name="check_all"  type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>Name</th>
		<th>Receivable</th>
		<th>Payable</th>
        <th>Credit Limit</th>
		<th>Mobile No.</th>
        <th>Email Id</th>		
		 <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php

$i=1;
 $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='National' ORDER BY contact_id DESC limit $page,$per_page");
  foreach($query->result() as $fetch_list)
  {

  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
<th style="display:none"><input name="cid[]" type="checkbox"  id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>

<th><a href="<?=base_url();?>master/Account/contact_log?id=<?php echo $fetch_list->contact_id; ?>" target="_blank">
<?php echo $fetch_list->first_name; ?></a></th>
<th><?php if($fetch_list->add_opening_balancename=="Dr"){ echo $fetch_list->add_opening_balance." ".$fetch_list->add_opening_balancename; }?></th>
<th><?php if($fetch_list->add_opening_balancename=="Cr"){echo $fetch_list->add_opening_balance." ".$fetch_list->add_opening_balancename;}?></th>
<th><?php echo $fetch_list->credit_limit;?></th>

<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->email;?></th>

<th>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#viewcontact' type="button" onclick="viewcustomer('<?php echo $fetch_list->contact_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="fa fa-eye"></i></button>


<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#editcontact' type="button" onclick="updatecustomer('<?php echo $fetch_list->contact_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php
$pri_col='contact_id';
$table_name='tbl_contact_m';

$ordrhdr=$this->db->query("select * from tbl_order_hdr where customer_id='$fetch_list->contact_id'");
$hdrcount=$ordrhdr->num_rows();

$invhdr=$this->db->query("select * from tbl_ordered_invoice_hdr where customer_id='$fetch_list->contact_id'");
$invcount=$invhdr->num_rows();

$pcash=$this->db->query("select * from tbl_payment_cash where contact_id='$fetch_list->contact_id'");
$pcashcount=$pcash->num_rows();

$pgst=$this->db->query("select * from tbl_payment_gst where contact_id='$fetch_list->contact_id'");
$pgstcount=$pgst->num_rows();

$map=$this->db->query("select * from tbl_contact_product_price_mapping where contact_id='$fetch_list->contact_id'");
$mapcount=$map->num_rows();

$iddds=$hdrcount + $invcount + $pcashcount + $pgstcount + $mapcount ;

//echo $iddds;

if($iddds=='0')
{
?>
<!-- <button class="btn btn-default delbutton"  id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button> -->	
<?php } ?>
</th>
</tr>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
<input type="text" style="display:none;" id="pri_col" value="contact_id">
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
</div>			
<form class="form-horizontal" role="form" id="contactform" method="post" action="insert_contact" enctype="multipart/form-data">	
	 <div id="addCustomer" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
	    <div id="modal-contentaddcustomer">

        </div>
    </div>	 
	</div>
	</form>	
	
<form class="form-horizontal" role="form" id="editcontactform" method="post" action="update_contact_nat" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-conten-update">

        </div>
    </div>	 
</div>
</form>

<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="viewcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="modal-content-view">

        </div>
    </div>	 
</div>
</form>
<script>

function updatecustomer(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "updateContactNat?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-conten-update").innerHTML = xhttp.responseText;
}
  
</script>	

<script>
function viewcustomer(v){
var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "viewCustomerNat?ID="+v, false);
 xhttp.send();
 document.getElementById("modal-content-view").innerHTML = xhttp.responseText;
}
</script>	

<script>

function addCustomer(){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "addCustomer", false);
 xhttp.send();
 document.getElementById("modal-contentaddcustomer").innerHTML = xhttp.responseText;
}
  
</script>

<script>
  $("#contactform").validate({
    rules: {
      first_name: "required",
      mobile:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Account/insert_contact');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#contactform').serialize(), // serializes the form's elements.
                success : function (data) {                 
				 $( ".txtHint" ).html(data); 				 
				  $("#addCustomer .close").click();
                  $('#contactform')[0].reset(); 				 	
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

 $("#editcontactform").validate({
    rules: {
      first_name: "required",
      mobile:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Account/update_contact_nat');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#editcontactform').serialize(), // serializes the form's elements.
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

<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
	
			document.getElementById("sizerow").value=rowCount;
					

var cell4 = row.insertCell(0);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.style = "width: 100px";
			element3.className="form-control";
			element3.id = "c_firmid"+rowCount;
			element3.name = "c_firmid[]";
			cell4.appendChild(element3);


var cell5 = row.insertCell(1);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.style = "width: 100px";
			element4.className="form-control"
			element4.id = "gstinnoid"+rowCount;
			element4.name = "gstinnoid[]";
			cell5.appendChild(element4);

			//Create array of options to be added
			var cell6 = row.insertCell(2);
			<?php 
			$state=$this->db->query("select * from tbl_state_m where countryid='1'");
			 $sname[] = '--Select--';
			 $idname[] = '';
			foreach($state->result() as $stdata)
			{ 
				 $sname[]=$stdata->stateName;
				 $idname[]=$stdata->stateid;
			}
			$json = json_encode($sname);
			$idjson = json_encode($idname);
			?>
			var ar=JSON.parse('<?php echo $json; ?>');
			var stateid=JSON.parse('<?php echo $idjson; ?>');
			var array = ar;
			var arrayid = stateid;
			//Create and append select list
			var selectList = document.createElement("select");
			selectList.setAttribute("id", "stateid"+rowCount);
			selectList.setAttribute("name", "stateid[]");
			selectList.setAttribute("class", "form-control");
			cell6.appendChild(selectList);
			
			//Create and append the options
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.setAttribute("value", arrayid[i]);
				option.text = array[i];
				selectList.appendChild(option);
			}

var cell7 = row.insertCell(3);
			var element41 = document.createElement("input");
			element41.type = "button";
			element41.value = "Add Row";
			element41.className="btn btn-sm";
			element41.onclick= function() { addRow('dataTable') };
			cell7.appendChild(element41);

var cell8 = row.insertCell(4);
			var element42 = document.createElement("input");
			element42.type = "button";
			element42.value = "Delete Row";
			element42.id = "dtl"+rowCount;
			element42.className="btn btn-secondary btn-sm";
			element42.onclick= function() { deleteRow1(this) };
			cell8.appendChild(element42);

		}

		function deleteRow1(ths) {
		 $(ths).parent().parent().remove();
		 var rowidd=document.getElementById("sizerow").value;
		 document.getElementById("sizerow").value=rowidd-1;
		}

	</SCRIPT>
<?php
$this->load->view("footer.php");
?>