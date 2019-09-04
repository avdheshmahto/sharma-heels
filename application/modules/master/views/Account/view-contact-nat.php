<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">View Customer</h4>
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
<input type="hidden" name="contact_id" id="contact_id" value="<?php echo $branchFetch->contact_id; ?>" />
<input type="text" name="first_name" id="first_name" value="<?php echo $branchFetch->first_name; ?>" readonly="true" class="form-control" required>
</div> 
<label class="col-sm-2 control-label" style="display:none">*Group Name:</label> 
<div class="col-sm-4" style="display:none"> 

	  <input type="hidden" name="grpname" value="<?php echo $branchFetch->contact_id;?>" />
<select name="maingroupname" class="form-control" required id="contact_id_copy5">
<?php

$ugroup2=$this->db->query("select * from tbl_account_mst where status='A' and account_id='4'");

foreach ($ugroup2->result() as $fetchunit){

?>
<option value="<?php  echo $fetchunit->account_id ;?>"<?php if($fetchunit->account_id==$branchFetch->group_name){ ?> selected <?php } ?>><?php echo $fetchunit->account_name;?></option>
<?php } ?>
</select>
</div> 
<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" readonly="true" name="contact_person" id="contact_person" value="<?php echo $branchFetch->contact_person?>" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" name="email" readonly="true" id="email" value="<?php echo $branchFetch->email; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Primary Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" readonly="true" maxlength="10" id="pmobile" name="mobile" title="10 digit mobile number"  value="<?php echo $branchFetch->mobile; ?>" class="form-control" >
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Secondary Mobile No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="tel" minlength="10" readonly="true" maxlength="10" id="smobile" name="smobile" title="10 digit mobile number"  value="<?php echo $branchFetch->smobile; ?>" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Phone No</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10" readonly="true"  pattern="[0-9]{10}" title="Enter your 10 phone number" name="phone" id="phone" value="<?php echo $branchFetch->phone; ?>" class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">GST % :</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="gst_per" readonly="true" id="gst_per"  value="<?php echo $branchFetch->gst; ?>"   class="form-control">
</div>  
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<div id="dataiddiv">
<input type="text" name="contact_code" id="contact_code" value="<?php echo $branchFetch->contact_code; ?>" readonly="true"  class="form-control">
</div>
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<select name="add_opening_balancename" id="add_opening_balancename"  style="width:104px" class="form-control" disabled="disabled">
<option value="">--Select--</option>
<option value="Dr"<?php if($branchFetch->add_opening_balancename=="Dr"){ ?> selected="selected" <?php }?>>Dr</option>
<option value="Cr"<?php if($branchFetch->add_opening_balancename=="Cr"){ ?> selected="selected" <?php }?>>Cr</option>
</select>
<input type="number" readonly="true" style="width:160px" name="add_opening_balance" id="add_opening_balance" value="<?php echo $branchFetch->add_opening_balance; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="term" readonly="true" id="term" value="<?php echo $branchFetch->term; ?>" class="form-control">
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Tin No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" readonly="true"  value="<?php echo $branchFetch->tinno_id; ?>" class="form-control">
</div>
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" readonly="true" name="address1" id="address1"><?php echo $branchFetch->address1; ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" readonly="true" name="address3" id="address3"><?php echo $branchFetch->address3; ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" id="note" readonly="true" class="form-control"><?php echo $branchFetch->note; ?></textarea>
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
</tr>
<?php  

$countsize=sizeof(explode(',', $branchFetch->firma_name));
$expfname=explode(',', $branchFetch->firma_name);
$expgstinno=explode(',', $branchFetch->tin);
$expstateid=explode(',', $branchFetch->state);
for($i=0;$i<$countsize;$i++){
	if($expfname[$i]!=''){
	
 ?>
<tr class="gradeA">

<th><input type="text" id="c_firmid1" style="width:100px;" readonly="true"  class="form-control" value="<?php echo $expfname[$i]; ?>"></th>

<th><input type="text" style="width:100px;"   id="gstinnoid1" readonly="true"    class="form-control" value="<?php echo $expgstinno[$i]; ?>"></th>

<th>
<select id="stateid1" class="form-control" disabled="disabled">
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
<input type="hidden" id="sizerow" value="1" />
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
