<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update Contact</h4>
</div>
<div class="modal-body overflow">
<div class="table-responsive">
<div class="row">
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
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
