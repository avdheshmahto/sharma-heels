<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update Customer</h4>
</div>
<div class="modal-body overflow">

<?php
	 $ContactQuery=$this->db->query("select * from tbl_contact_m where contact_id='$ID'");
         $branchFetch=$ContactQuery->row();

?>

<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 			
<input type="hidden" name="Ragarpura_name" value="National" />	
<input type="hidden" id="contact_id" name="contact_id" value="<?php echo $branchFetch->contact_id; ?>" />
<input type="text" id="first_nameid" name="first_name" value="<?php echo $branchFetch->first_name; ?>" class="form-control" required>
</div> 

<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" id="contact_personid" name="contact_person" value="<?php echo $branchFetch->contact_person?>" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email"  id="emailidd" name="email" value="<?php echo $branchFetch->email; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Primary Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="pmobileid"  name="mobile"  title="10 digit mobile number"  value="<?php echo $branchFetch->mobile; ?>" class="form-control" >
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Secondary Mobile No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="tel" minlength="10" maxlength="10" id="smobileid" name="smobile" title="10 digit mobile number"  value="<?php echo $branchFetch->smobile; ?>" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Phone No</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your 10 phone number" name="phone" id="phoneid" value="<?php echo $branchFetch->phone; ?>" class="form-control">
</div> 
</div>

<div class="form-group">
  
 
<label class="col-sm-2 control-label">GST % :</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="gst_perid" name="gst_per" value="<?php echo $branchFetch->gst; ?>"   class="form-control">
</div>  
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<div id="dataiddiv">
<input type="text" id="contact_codeid" name="contact_codeid" value="<?php echo $branchFetch->contact_code; ?>" readonly=""  class="form-control">
</div>
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<select id="add_opening_balancenameid" name="add_opening_balancename"  style="width:100px" class="form-control">
<option value="">--Select--</option>
<option value="Dr"<?php if($branchFetch->add_opening_balancename=="Dr"){ ?> selected="selected" <?php }?>>Dr</option>
<option value="Cr"<?php if($branchFetch->add_opening_balancename=="Cr"){ ?> selected="selected" <?php }?>>Cr</option>
</select>
<input type="number" style="width:160px" id="add_opening_balanceid" name="add_opening_balance" value="<?php echo $branchFetch->add_opening_balance; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="termid" name="term" value="<?php echo $branchFetch->term; ?>" class="form-control">
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Tin No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="tinnoid" name="tinnoid" value="<?php echo $branchFetch->tinno_id; ?>" class="form-control">
</div>
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="addressid" name="address1"><?php echo $branchFetch->address1; ?> </textarea>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="addresstoid" name="address3"><?php echo $branchFetch->address3; ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" id="noteid" class="form-control"><?php echo $branchFetch->note; ?></textarea>
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

<?php  
$norw=0;
$countsize=sizeof(explode(',', $branchFetch->firma_name));
$expfname=explode(',', $branchFetch->firma_name);
$expgstinno=explode(',', $branchFetch->tin);
$expstateid=explode(',', $branchFetch->state);
for($i=0;$i<$countsize;$i++){
	//if($expfname[$i]!=''){
	$rid=$norw+1;
 ?>
<tr class="gradeA">

<th><input type="text" id="c_firmid<?php echo $rid; ?>" name="c_firmid[]" style="width:100px;" class="form-control" value="<?php echo $expfname[$i]; ?>"></th>

<th><input type="text" style="width:100px;" id="gstinnoid<?php echo $rid; ?>" name="gstinnoid[]" class="form-control" value="<?php echo $expgstinno[$i]; ?>"></th>

<th>
<select id="stateid<?php echo $rid; ?>" name="stateid[]" class="form-control" >
<option value="">--Select--</option>
<?php 
$state=$this->db->query("select * from tbl_state_m where countryid='1'");
foreach($state->result() as $stdata)
{
?>
<option value="<?php echo $stdata->stateid; ?>" <?php if($stdata->stateid==$expstateid[$i]){ ?> selected  <?php } ?>><?=$stdata->stateName;?></option>
<?php }?>
</select>
</th>
<th><input type="button" value="Add Row" class="btn btn-sm" onclick="addRow('dataTable')"></th>

</tr>
<?php $norw++; } //} ?>
<input type="hidden" id="sizerow" name="sizerow" value="<?php echo $norw; ?>" />
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
