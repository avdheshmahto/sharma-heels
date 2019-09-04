<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add&nbsp;Customer</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="hidden" id="Ragarpura_name" name="Ragarpura_name" value="National" />
<input type="text" id="first_name" name="first_name" value="" class="form-control" required>
</div> 

<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" id="contact_person" name="contact_person" value="" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" id="email" name="email" value="" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Primary Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="Enter 10 digit mobile number"  value="" class="form-control" >
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Secondary Mobile No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter 10 digit mobile number" id="smobile" name="smobile" value="" class="form-control">
</div> 
<label class="col-sm-2 control-label">Phone No:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your phone number" id="phone" name="phone" value="" class="form-control">
</div> 
</div>

<div class="form-group">  
<label class="col-sm-2 control-label">GST %:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="gst_per" id="gst_perr"  value="18" class="form-control">
</div>
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<?php
 	 $contactid='5^NAT';
	 $ex=explode("^",$contactid);
	 $contact_id=$ex[0];
	 $location_code=$ex[1];
	 
	$Query=$this->db->query("select * from tbl_contact_m where location_id='$contactid'");
    foreach($Query->result() as $fetchlist){
	 $fetchlist->contact_code;
	}
	if($fetchlist->contact_code!=''){
	$sh=$fetchlist->contact_code;
	 $var = str_pad(++$sh,1,'0',STR_PAD_LEFT);
	}else{
	
	$number =1; 
	$numbercase = sprintf('%03d',$number);
	
	$countdata=$location_code;
	 $var='NAT'.$numbercase;
	}

 ?>
<input type="text" id="contact_code" name="contact_code" value="<?php echo $var; ?>" readonly=""  class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<select id="add_opening_balancename" name="add_opening_balancename"  style="width:105px" class="form-control">
<option value="">--Select--</option>
<option value="Dr">Dr</option>
<option value="Cr">Cr</option>
</select>
<input type="number" id="add_opening_balance" name="add_opening_balance" style="width:150px" value="" class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="term" name="term" value="" class="form-control">
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Tin No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="tinnoid" name="tinnoid" value="" class="form-control">
</div>	
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="address1" name="address1"></textarea>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="address3" name="address3"></textarea>
</div> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  id="note" name="note" class="form-control"></textarea>
</div>
</div>
<div class="table-responsive">

<h6></h6>	
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th >C.Firm Name</th>
<th >GSTIN No.</th>
<th style="width:200px;">State</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<input type="hidden" id="sizerow" name="sizerow" style="width:100px;"  class="form-control" value="1">
<tr class="gradeA">

<th><input type="text" id="c_firmid1" name="c_firmid[]" style="width:100px;"  class="form-control"></th>

<th><input type="text" style="width:100px;"   id="gstinnoid1" name="gstinnoid[]"   class="form-control"></th>

<th>
<select id="stateid1" name="stateid[]" class="form-control">
<option value="">--Select--</option>
<?php 
$state=$this->db->query("select * from tbl_state_m where countryid='1'");
foreach($state->result() as $stdata)
{
?>
<option value="<?php echo $stdata->stateid; ?>"><?=$stdata->stateName;?></option>
<?php }?>
</select>
</th>
<th>	
<INPUT type="button" value="Add Row" class="btn btn-sm" onclick="addRow('dataTable')" />
</th>
<th>
	&nbsp;
	<!-- <INPUT type="button" class="btn btn-secondary btn-sm" value="Delete Row" onclick="deleteRow(this)" />	 -->
</th>
<!--<input type="hidden" id="sizerow" name="sizerow" value="1" />-->
</tr>
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>