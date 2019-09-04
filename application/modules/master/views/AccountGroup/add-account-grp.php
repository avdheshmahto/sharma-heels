<?php
$tableName='tbl_account_mst';
$location='manage_account';
$this->load->view('softwareheader'); 
?>

	<?php if($_GET['id']!=''){ ?>
		<h1 class="page-title">UPDATE ACCOUNT GROUP</h1>
		<?php }elseif($_GET['view']!=''){ ?>
		<h1 class="page-title">VIEW ACCOUNT GROUP</h1>
		<?php }else{ ?> 
		<h1 class="page-title">ADD ACCOUNT GROUP</h1>
		<?php } ?>
<form action="insert_account" method="post">



<div class="actions-right">

<?php if(@$_GET['view']!='' ){

 

 }

 else

 { 

 if(@$_GET['id']==''){?>

 <td> <input name="save" type="submit" value="Save" class="submit" /> </td>



	  <?php }else {?>

      <td> <input name="edit" type="submit" value="Save" class="submit" /> </td>



	   <?php } }?>



<?php if(@$_GET['popup'] == 'True') {?>

<a href="#" onClick="window.close()" title="Cancel" class="btn btn-blue"> Cancel</a>

	   	 <?php }else {  ?>

       <a href="<?php echo @$location; ?>" title="Cancel" class="btn btn-blue"> Cancel</a>

       <?php } ?><div class="clear"></div>

</div><!--title close-->



<div class="container-right-text">

<div class="table-row">


<table class="bordered">

<thead>



<tr>

<th colspan="4">ACCOUNT DETAILS</th>        

</tr>



</thead>

<tr>




<?php
if(@$_GET['id']!='' or @$_GET['mid']!=''){
@$branchQuery = $this->db->query("SELECT * FROM tbl_account_mst where status='A' and account_id='".$_GET['id']."' or account_id='".$_GET['mid']."'");
$branchFetch = $branchQuery->row();
 
}


 if(@$_GET['id']!='' ){
 


  ?>         


<td style="display:none"><input type="text" name="account_id" class="span6 "value="<?php echo $branchFetch->account_id;?>" readonly size="22" aria-required='true' /></td>

<?php } else {

$query = $this->db->query("SELECT * FROM $tableName where status='A' order by account_id desc limit 0,1");
$row = $query->row();

?>

    <td style="display:none"><input type="text" name="account_idd" value="<?php if (count($row)!=''){ echo $row->account_id+1; } else{ echo 1; }?>" readonly size="22" class="span6 " aria-required='true' /></td>

                <?php }?>

<td class="text-r"><star>*</star>
  Account Name:</td>     
        
<td><input type="hidden" name="mid" value="<?php if(@$_GET['mid']==''){ echo $mid=1;}else{echo $midd=@$_GET['mid'];}?>">

<input name="account_name" required type="text" onchange="accountFun1(this.value)" class="span6" id="account_name"  size="22"  aria-required='true' value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->account_name; }?>"/><a id="accountdiv" style="color:#0000FF"></a></td>



 <?php if(@$_GET['mid']!='' or (@$branchFetch->main_account_id!='') ){
 $ugroup=$this->db->query("SELECT * FROM tbl_account_mst where account_id='".@$_GET['mid']."'" );
		$ungroup=$ugroup->row();
	//$ugroup=mysql_query("SELECT * FROM tbl_account_mst where account_id='".$ungroup['account_name']."'" );
 ?>
 
 <td class="text-r"><?php $az=0; if(@$ungroup->account_name!='' or (@$branchFetch->main_account_id!='1') ){ $az=1; echo "Under Group:";}?></td>         

<td ><input name="undergroup" id="undergroup" type="<?php if($az==1){ echo "text";}else{echo"hidden";} ?>" class="span6" value="<?php if(@$ungroup->account_name!='') { echo $ungroup->account_name;}else{ 

@$ugrou="select * from $tableName where status='A' and account_id='".$branchFetch->main_account_id."'"; 
   
$ung = $this->db->query($ugrou);
$row = $ung->row();

echo @$row->account_name;} ?>"  size="22"  aria-required='true' /><input name="mid1" type="hidden"  class="span6" size="22"  aria-required='true'  value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->main_account_id; }?>"/></td>
<?php }?>


</tr>        

<tr style="display:none">

<td class="text-r"><star>*</star>Print Name</td>

<td><input name="printname" type="text" id="print_name"  class="span6" size="22"  aria-required='true'  value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->printname; }?>"/></td>
<td class="text-r"><star>*</star>Alias</td>

<td><input name="alias"  type="text" onchange="accountAliesFun1(this.value)" class="span6" size="22" aria-required='true'  value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->alias; }?>" /><a id="aliesdiv" style="color:#0000FF"></a></td>
</tr>
<tr>
<td class="text-r"><star></star>
 Description</td>
	<td><textarea name="description"  type="text" cols="80" rows="6"><?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->Description; }?></textarea></td>
</tr>
</table>


<!--bordered close-->

<div class="clear"></div>



<div class="paging-row">

<div class="paging-right">



<div class="actions-right">

<?php 



 if(@$_GET['view']!='' ){

 

 }

 else

 {

if(@$_GET['id']==''){?>





 <td> <input name="save" type="submit" value="Save" class="submit" /> </td>



 <?php }else {?>

	   <td> <input name="edit" type="submit" value="Save" class="submit" /> </td>



	      <?php }}?>

<?php if(@$_GET['popup'] == 'True') {?>

<a href="#" onClick="window.close()" title="Cancel" class="btn btn-blue"> Cancel</a>

	   	 <?php }else {  ?>

       <a href="<?php echo @$location; ?>" title="Cancel" class="btn btn-blue"> Cancel</a>

       <?php } ?></form>


</div><!--paging-right close-->

</div><!--paging-row close-->



</div><!--table-row close-->

</div><!--container-right-text close-->





</div><!--container-right close-->







</div><!--container close-->
<?php $this->load->view('softwarefooter'); ?>