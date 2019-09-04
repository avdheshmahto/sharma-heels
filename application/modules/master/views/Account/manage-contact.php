<?php
$this->load->view("header.php");

?>
	 <!-- Main content -->
	 <div class="main-content">
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Master</a></li> 
<li class="active"><strong>Add Contact</strong></li>
<div class="pull-right">
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0"><i class="fa fa-pencil"></i>Add Contact</button>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<form class="form-horizontal" role="form" method="post" action="insert_contact">	 
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add&nbsp;Contact</h4>
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
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save" />
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</form>
</div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<a href="#/" class="btn btn-secondary btn-sm"><i class="fa fa-trash-o"></i> Delete</a>

</div>
</ol>
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



<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data">											
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<th><a href="<?=base_url();?>master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#0F0'></i></a></th><th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#FF0'></i></a></th><th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i></a></th>
<th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i><i class='fa fa-circle text-purple m-r-15' style='color:#F00'></i></a></th>
<th><a href="master/Account/manage_contact"><i class='fa fa-circle text-purple m-r-15' style='color:#000'></i></a></th>

<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th> Name</th>
		<th>Location</th>
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
<th>
<?php

		 $locexp=explode('^',$fetch_list->location_id);
		 $locidd=$locexp[0];	

$locQuery=$this->db->query("select * from tbl_location where id='$locidd'");
$getLoc=$locQuery->row();
echo $getLoc->location_name;
?>


</th>
<?php
$contactQuery=$this->db->query("select *from tbl_account_mst where account_id='$fetch_list->group_name'");
$getContact=$contactQuery->row();
?>

<th onclick="contactDetails('<?php echo $urlvc ?>')">
<a><?=$getContact->account_name;?></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->email;?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->phone;?></th>
<th><?=$fetch_list->credit_limit;?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?php echo $getPayment= $obj->payment_due($fetch_list->contact_id);?></th>
<th>

<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i;?>" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php
$pri_col='contact_id';
$table_name='tbl_contact_m';
	?>
<button class="btn btn-default delbutton" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>	
</th>
</tr>

<div id="modal-<?php echo $i;?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">View&nbsp;Contact</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="text" name="first_name" value="<?php echo $fetch_list->first_name; ?>" readonly="" class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Group Name:</label> 
<div class="col-sm-4"> 
<select name="maingroupname" class="form-control" required id="contact_id_copy5" disabled="disabled">

<option value="">-------select---------</option>

<?php

$ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");

foreach ($ugroup2->result() as $fetchunit){

?>
<option value="<?php  echo $fetchunit->account_id ;?>"<?php if($fetchunit->account_id==$fetch_list->group_name){ ?> selected <?php } ?>><?php echo $fetchunit->account_name;?></option>
<?php } ?>
</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" name="contact_person" value="<?php echo $fetch_list->contact_person;?>"  readonly="" class="form-control">
</div> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4"> 
<input type="email" name="email" value="<?php echo $fetch_list->email; ?>" readonly="" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Mobile No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="10 digit mobile number"  value="<?php echo $fetch_list->mobile; ?>" readonly="" class="form-control" >
</div> 

<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter your 10 phone number" name="phone" value="<?php echo $fetch_list->phone; ?>" readonly=""  class="form-control">
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Pan No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="pan_no" pattern=".{10,10}" maxlength="10" id="pan" placeholder="PAN No 10 digist" title="PAN Number must be 10 character" value="<?php echo $fetch_list->pan_no; ?>" readonly="" class="form-control">
</div> 
<label class="col-sm-2 control-label">GSTIN No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="tin_no" id="gstin"  placeholder="GSTIN" value="<?php echo $fetch_list->tin; ?>"  readonly="" class="form-control">

</div> 
</div>

<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">LST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="lst_no" value="<?php echo $fetch_list->lst; ?>" readonly="" class="form-control">
</div> 
<label class="col-sm-2 control-label">CST No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="cst_no" value="<?php echo $fetch_list->cst; ?>" readonly="" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Fax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="fax" value="<?php echo $fetch_list->fax; ?>" readonly="" class="form-control">
</div> 
<label class="col-sm-2 control-label">*Location:</label> 
<div class="col-sm-4" id="regid"> 
<select name="location_idddddd" id="location_id"  class="form-control" onchange="contactcode()"  required disabled="disabled">
					<option value="">----Select ----</option>
					<?php 
					$sqllo=$this->db->query("select * from tbl_location");
					foreach ($sqllo->result() as $fetchlist){ 
		
					?>

    <option value="<?php echo $fetchlist->id."^".$fetchlist->location_code; ?>"<?php if($fetchlist->id."^".$fetchlist->location_code==$fetch_list->location_id){ ?> selected <?php } ?>><?php echo $fetchlist->location_name ; ?></option>

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
<input type="number" name="add_opening_balance" value="<?php echo $fetch_list->add_opening_balance; ?>" readonly="" class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Credit Limit:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="credit_limit" value="<?php echo $fetch_list->credit_limit; ?>" readonly="" class="form-control">
</div> 
<label class="col-sm-2 control-label">Term:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="term" value="<?php echo $fetch_list->term; ?>" readonly=""  class="form-control">
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Note:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  name="note" readonly="" class="form-control"><?php echo $fetch_list->note; ?></textarea>
</div>  
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address1" readonly ><?php echo $fetch_list->address1 ; ?> </textarea>
</div> 
</div>
<div class="form-group"> 

<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address3" readonly ><?php echo $fetch_list->address3 ; ?> </textarea>
</div> 
</div>
</div>
<div class="modal-footer">
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
</form>
</div>
</div>
</div>
</div>


</div>			
<form class="form-horizontal" role="form" method="post" action="insert_contact" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>
<script>
    $('.modalEditcontact').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"updateContact?ID="+ID,cache:true,success:function(result){
            $(".modal-contenttt").html(result);
        }});
    });
</script>	
<?php
$this->load->view("footer.php");
?>