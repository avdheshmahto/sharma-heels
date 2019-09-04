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
<input type="hidden" name="Ragarpura_name" value="Seelampur" />	
<input type="hidden" name="contact_id" id="contact_id" value="<?php echo $branchFetch->contact_id; ?>" />
<input type="text" name="first_name" id="first_name" value="<?php echo $branchFetch->first_name; ?>" class="form-control" required>
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
<input type="text" name="contact_person" id="contact_person" value="<?php echo $branchFetch->contact_person?>" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" name="email" id="email" value="<?php echo $branchFetch->email; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Primary Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="pmobile" name="mobile" title="10 digit mobile number"  value="<?php echo $branchFetch->mobile; ?>" class="form-control" >
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Secondary Mobile No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="tel" minlength="10" maxlength="10" id="smobile" name="smobile" title="10 digit mobile number"  value="<?php echo $branchFetch->smobile; ?>" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Phone No:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your phone number" name="phone" id="phone" value="<?php echo $branchFetch->phone; ?>" class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">GSTIN No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="tin_no" id="tin_no"  placeholder="GSTIN" value="<?php echo $branchFetch->tin; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">GST % :</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="gst_per" id="gst_per"  value="<?php echo $branchFetch->gst; ?>"   class="form-control">
</div> 
</div>

<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">LST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="lst_no" value="<?php echo $branchFetch->lst; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">CST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="cst_no" value="<?php echo $branchFetch->cst; ?>" class="form-control">
</div> 
</div>
<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">Fax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="fax" value="<?php echo $branchFetch->fax; ?>" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Location:</label> 
<div class="col-sm-4" id="regid"> 
<input type="hidden" name="location_id" value="<?php echo $branchFetch->location_id; ?>" class="form-control">
<select name="location_idddddd" id="location_id"  class="form-control" onchange="contactcode()"  required disabled="disabled">
					<option value="">----Select ----</option>
					<?php 
					$sqllo=$this->db->query("select * from tbl_location");
					foreach ($sqllo->result() as $fetchlist){ 
		
					?>

    <option value="<?php echo $fetchlist->id."^".$fetchlist->location_code; ?>"<?php if($fetchlist->id."^".$fetchlist->location_code==$branchFetch->location_id){ ?> selected <?php } ?>><?php echo $fetchlist->location_name ; ?></option>

    <?php } ?></select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Code:</label> 
<div class="col-sm-4" id="regid"> 
<div id="dataiddiv">
<input type="text" name="contact_code" id="contact_code" value="<?php echo $branchFetch->contact_code; ?>" readonly=""  class="form-control">
</div>
</div> 
<label class="col-sm-2 control-label">Opening Balance:</label> 
<div class="col-sm-4" id="regid"> 
<select name="add_opening_balancename" id="add_opening_balancename" style="width:105px" class="form-control">
<option value="">--Select--</option>
<option value="Dr"<?php if($branchFetch->add_opening_balancename=="Dr"){ ?> selected="selected" <?php }?>>Dr</option>
<option value="Cr"<?php if($branchFetch->add_opening_balancename=="Cr"){ ?> selected="selected" <?php }?>>Cr</option>
</select>
<input type="number" style="width:160px" id="add_opening_balance" name="add_opening_balance" value="<?php echo $branchFetch->add_opening_balance; ?>" class="form-control">
</div> 
</div>

<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">Credit Limit:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="credit_limit" value="<?php echo $branchFetch->credit_limit; ?>" class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="term" id="term" value="<?php echo $branchFetch->term; ?>" class="form-control">
</div>
<label class="col-sm-2 control-label">State:</label> 
<div class="col-sm-4" id="regid"> 
<select name="state" id="state" class="form-control" >
<option value="">--Select--</option>
<?php 
$state=$this->db->query("select * from tbl_state_m where countryid='1'");
foreach($state->result() as $stdata)
{
?>
<option value="<?=$stdata->stateid?>"<?php if($stdata->stateid==$branchFetch->state){ ?> selected  <?php } ?>> <?php echo $stdata->stateName;  ?></option>
<?php }?>
</select>
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="address1" name="address1"><?php echo $branchFetch->address1; ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" id="address3" name="address3"><?php echo $branchFetch->address3; ?> </textarea>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" class="form-control" id="note"><?php echo $branchFetch->note; ?></textarea>
</div>  
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm" data-dismiss="modal" onclick="customerInsertFun()">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
