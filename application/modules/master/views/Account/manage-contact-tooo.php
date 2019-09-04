<?php
$this->load->view("header.php");

?>
	 <!-- Main content -->

<form class="form-horizontal" role="form" method="post" action="insert_contact">	 
	 <div class="main-content">
			
			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Master</a></li> 
<li class="active"><strong>Add Contact</strong></li>
<div class="pull-right">
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-2"><i class="fa fa-pencil"></i>Add Contact</button>
<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Contact</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="hidden" name="contact_id" value="<?php echo $branchFetch->contact_id; ?>" />
<input type="text" name="first_name" value="<?php echo $branchFetch->first_name; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Group Name:</label> 
<div class="col-sm-4"> 
<?php
	   	 $hdrQuery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['id']."' or contact_id='".$_GET['view']."'");
         $hrdrow=$hdrQuery->row();
	  
	  ?>
	  <input type="hidden" name="grpname" value="<?php echo $hrdrow->contact_id;?>" />
<select name="maingroupname" class="form-control" required id="contact_id_copy5" <?php if(@$_GET['view']!=''){ ?> disabled <?php }?>>

<option value="">-------select---------</option>

<?php
if($_GET['popup']=='True' and $_GET['con']!=''  ){



$ugroup2=$this->db->query("SELECT * FROM tbl_account_mst where account_id= '".$_GET['con']."' " );

}

else
{


$ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");
}
foreach ($ugroup2->result() as $fetchunit){



?>

<option value="<?php  echo $fetchunit->account_id ;?>"<?php if($fetchunit->account_id==$hrdrow->group_name){ ?> selected <?php } ?>><?php echo $fetchunit->account_name;?></option>
<?php } ?>
</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" name="contact_person" value="<?php echo $branchFetch->contact_person?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" name="email" value="<?php echo $branchFetch->email; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="10 digit mobile number"  value="<?php echo $branchFetch->mobile; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 

<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your 10 phone number" name="phone" value="<?php echo $branchFetch->phone; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Pan No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="pan_no" pattern=".{10,10}" maxlength="10" id="pan" placeholder="PAN No 10 digist" title="PAN Number must be 10 character" value="<?php echo $branchFetch->pan_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?>  class="form-control">
</div> 
<label class="col-sm-2 control-label">GSTIN No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="tin_no" id="gstin"  placeholder="GSTIN" value="<?php echo $branchFetch->tin; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">

</div> 
</div>

<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">LST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="lst_no" value="<?php echo $branchFetch->lst; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">CST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="cst_no" value="<?php echo $branchFetch->cst; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Fax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="fax" value="<?php echo $branchFetch->fax; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">*Location:</label> 
<div class="col-sm-4" id="regid"> 
<select name="location_id" id="location_id"  class="form-control" onchange="contactcode()"  required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
					<option value="">----Select ----</option>
					<?php 
					$sqllo=$this->db->query("select * from tbl_location");
					foreach ($sqllo->result() as $fetchlist){ 
		
					?>

    <option value="<?php echo $fetchlist->id."^".$fetchlist->location_code; ?>"<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchlist->id."^".$fetchlist->location_code==$branchFetch->location_id){ ?> selected <?php } }?>><?php echo $fetchlist->location_name ; ?></option>

    <?php } ?></select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<div id="dataiddiv">
<input type="text" name="contact_code" value="<?php echo $branchFetch->contact_code; ?>" readonly=""  class="form-control">
</div>
</div> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="add_opening_balance" value="<?php echo $branchFetch->add_opening_balance; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Credit Limit:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="credit_limit" value="<?php echo $branchFetch->credit_limit; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="term" value="<?php echo $branchFetch->term; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control"><?php echo $branchFetch->note; ?></textarea>
</div>  
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address1"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address1 ;} ?> </textarea>
</div> 
</div>
<div class="form-group"> 

<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address3" <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address3 ;} ?> </textarea>
</div> 
</div>
<div class="table-responsive">
<h5>Contact Persons</h5>
<INPUT type="button" value="Add Row" class="btn btn-primary" onclick="addRow('dataTable')" />

<INPUT type="button" class="btn btn-danger" value="Delete Row" onclick="deleteRow('dataTable')" />
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Check</th>
<th>Name</th>
<th >Email Address</th>
<th >Mobile</th>
<th >Designation</th>
</tr>

<tr class="gradeA">
<th ><input type="checkbox" name="chkbox[]" /></th>
<th><input type="text" name="lot_no[]"      tabindex="5" class="form-control" ></th>
<th><input type="text" name="pl_no[]"  class="form-control"> </th>
<th><input type="number" step="any"   name="qtyy[]"   class="form-control"> </th>
<th><input type="text" name="start_date[]"   value="" class="form-control" ></th>
</tr>
</tbody>
</table>
</div>

</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save" />
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<a href="#/" class="btn btn-secondary btn-sm"><i class="fa fa-trash-o"></i> Delete</a>

</div>
</ol>
<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.name="chkbox[]";
			cell1.appendChild(element1);
			

			
			var cell3 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "lot_no[]";
			element2.className="form-control";
			cell3.appendChild(element2);

var cell4 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.className="form-control"
			element3.name = "pl_no[]";
			cell4.appendChild(element3);

		



var cell5 = row.insertCell(3);
			var element4 = document.createElement("input");
			element4.type = "number";
			element4.className="form-control"
			element4.name = "qtyy[]";
			cell5.appendChild(element4);


var cell6 = row.insertCell(4);
			var element5 = document.createElement("input");
			element5.type = "text";
			element5.name = "start_date[]";
			element5.className="form-control"
			cell6.appendChild(element5);

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
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
<script>
	function contactcode(){
		var contactidd=document.getElementById("location_id").value;
		if(contactidd!=''){
		var pro=contactidd;
		 var xhttp = new XMLHttpRequest();
		  xhttp.open("GET", "getdata_fun?con="+pro, false);
		  xhttp.send();
		  document.getElementById("dataiddiv").innerHTML = xhttp.responseText;
		}else{
			
			alert("Please Select Location");
				
		}
		} 
		

</script>		
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
<strong>Well done!</strong> You successfully read this important alert message. 
</div>	
			<div class="row">
				<div class="col-lg-12">
					<div>
						
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<th><a href="<?=base_url();?>master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#0F0'></i></a></th><th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#FF0'></i></a></th><th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i></a></th>
<th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i></a></th>
<th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#000'></i></a></th>

<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th> Name</th>
		<th>Group Name</th>
        <th>Email Id</th>
		<th>Mobile No.</th>
		<th>Phone No.</th>
        <th>Credit Limit</th>
		<th>Receivables</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>

<?php

$i=1;
  foreach($result as $fetch_list)
  {



  ?>


<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>

<th onClick="openpopup('update_contact',1200,500,'view',<?=$fetch_list->contact_id;?>)">
<?php

if($getPayment= $obj->payment_due($fetch_list->contact_id)>$fetch_list->credit_limit)
{
	
	?>
    <i class='icon-cancel' style="color:#F00;"></i>
    <?php
	
}

?>
<?=$fetch_list->first_name;

if($fifteenDays3<=$dataD && $dateD>=$fifteenDays3)
{
	
	echo "<i class='fa fa-circle text-purple m-r-15' style='color:#FF0'></i>";
}
elseif($thirtyDays3<=$dataD && $dateD>=$thirtyDays3)
{
	if($fiftyNineDays3<=$dataD && $dateD>=$fiftyNineDays3)
	{
		echo "<i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i>";
	    echo "<i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i>";
	}
	else
	{
	echo "<i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i>";
	}
}



elseif($abvoeDays3<=$dataD &&  $dateD>=$abvoeDays3)
{
	
	
	echo "<i class='fa fa-circle text-purple m-r-15' style='color:#000'></i>";
}
else
{
	
	echo "<i class='fa fa-circle text-purple m-r-15' style='color:#0F0'></i>";
}

?>

</th>

<?php
$contactQuery=$this->db->query("select *from tbl_account_mst where account_id='$fetch_list->group_name'");
$getContact=$contactQuery->row();
?>

<th onclick="contactDetails('<?php echo $urlvc ?>')">
<a></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->email;?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->phone;?></th>
<th><?=$fetch_list->credit_limit;?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?php echo $getPayment= $obj->payment_due($fetch_list->contact_id);?></th>
<th>



<a href="#"><i class="btn btn-sm glyphicon glyphicon-zoom-in" data-toggle="modal" data-target="#modal-table"></i></a>




<div id="modal-table" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Large modal</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="hidden" name="contact_id" value="<?php echo $fetch_list->contact_id; ?>" />
<input type="text" name="first_name" value="<?php echo $fetch_list->first_name; ?>" class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Group Name:</label> 
<div class="col-sm-4"> 
<?php
	   	 $hdrQuery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['id']."' or contact_id='".$_GET['view']."'");
         $hrdrow=$hdrQuery->row();
	  
	  ?>
	  <input type="hidden" name="grpname" value="<?php echo $hrdrow->contact_id;?>" />
<select name="maingroupname" class="form-control" required id="contact_id_copy5" <?php if(@$_GET['view']!=''){ ?> disabled <?php }?>>

<option value="">-------select---------</option>

<?php
if($_GET['popup']=='True' and $_GET['con']!=''  ){



$ugroup2=$this->db->query("SELECT * FROM tbl_account_mst where account_id= '".$_GET['con']."' " );

}

else
{


$ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");
}
foreach ($ugroup2->result() as $fetchunit){



?>

<option value="<?php  echo $fetchunit->account_id ;?>"<?php if($fetchunit->account_id==$hrdrow->group_name){ ?> selected <?php } ?>><?php echo $fetchunit->account_name;?></option>
<?php } ?>
</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" name="contact_person" value="<?php echo $fetch_list->contact_person?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" name="email" value="<?php echo $fetch_list->email; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="10 digit mobile number"  value="<?php echo $fetch_list->mobile; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 

<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your 10 phone number" name="phone" value="<?php echo $fetch_list->phone; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Pan No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="pan_no" pattern=".{10,10}" maxlength="10" id="pan" placeholder="PAN No 10 digist" title="PAN Number must be 10 character" value="<?php echo $fetch_list->pan_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?>  class="form-control">
</div> 
<label class="col-sm-2 control-label">GSTIN No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="tin_no" id="gstin"  placeholder="GSTIN" value="<?php echo $fetch_list->tin; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">

</div> 
</div>

<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">LST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="lst_no" value="<?php echo $fetch_list->lst; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">CST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="cst_no" value="<?php echo $fetch_list->cst; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Fax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="fax" value="<?php echo $fetch_list->fax; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">*Location:</label> 
<div class="col-sm-4" id="regid"> 
<select name="location_id" id="location_id"  class="form-control" onchange="contactcode()"  required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
					<option value="">----Select ----</option>
					<?php 
					$sqllo=$this->db->query("select * from tbl_location");
					foreach ($sqllo->result() as $fetchlist){ 
		
					?>

    <option value="<?php echo $fetchlist->id."^".$fetchlist->location_code; ?>"<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchlist->id."^".$fetchlist->location_code==$fetch_list->location_id){ ?> selected <?php } }?>><?php echo $fetchlist->location_name ; ?></option>

    <?php } ?></select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<div id="dataiddiv">
<input type="text" name="contact_code" value="<?php echo $fetch_list->contact_code; ?>" readonly=""  class="form-control">
</div>
</div> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="add_opening_balance" value="<?php echo $fetch_list->add_opening_balance; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Credit Limit:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="credit_limit" value="<?php echo $fetch_list->credit_limit; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="term" value="<?php echo $fetch_list->term; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control"><?php echo $fetch_list->note; ?></textarea>
</div>  
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address1"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $fetch_list->address1 ;} ?> </textarea>
</div> 
</div>
<div class="form-group"> 

<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address3" <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $fetch_list->address3 ;} ?> </textarea>
</div> 
</div>

<div class="clearfix"></div>

<div class="table-responsive">
<h5>Contact Persons</h5>

<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Check</th>
<th>Name</th>
<th >Email Address</th>
<th >Mobile</th>
<th >Designation</th>
</tr>

<tr class="gradeA">
<th ><input type="checkbox" name="chkbox[]" /></th>
<th><input type="text" name="lot_no[]"      tabindex="5" class="form-control" ></th>
<th><input type="text" name="pl_no[]"  class="form-control"> </th>
<th><input type="number" step="any"   name="qtyy[]"   class="form-control"> </th>
<th><input type="text" name="start_date[]"   value="" class="form-control" ></th>
</tr>
</tbody>
</table>
</div>

</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>


<?php
$pri_col='contact_id';
$table_name='tbl_contact_m';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
	
</th>
</tr>


<!--=================================================================-->
<div id="modal-<?php echo $i;?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Contact</h4>
</div>
<div class="modal-body overflow">
czxczx


</div>

</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save" />
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
<input type="text" style="display:none;" id="pri_col" value="contact_id">
</table>
</div>
</div>
</div>
</div>
</div>
</form>

<?php

$this->load->view("footer.php");
?>