<?php
$tableName='tbl_account_mst';
$this->load->view('softwareheader'); 
?>

<h1>GROUP LIST</h1> 
<div class="actions">
<div class="blogroll">
<div id="">
		<a type="button" class="btn btn-primary pull-right delete_all">Delete Selected</a>
   </div>
	</div>
</div><!--actions close-->

<div class="add">
<?php if($add!=''){ ?>
<a href="add_account"><img src="<?php echo base_url();?>/assets/images/plus.png" alt="" border="0" />Create New Account Grop</a>
<?php } ?>
</div><!--add close-->
<div class="clear"></div>
</div><!--title close-->

<div class="container-right-text">
<div id="container">
<div>
<div class="table-row">


<table class="bordered"id="dataTables-example">
    <thead>

    <tr>
        <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>        
      
        <th style="width: 200px;">Group Name</th>
		<th>Primary</th>
		<th>Under Group</th>
        <th>Alias Name</th>
		<th>Print Name</th>
        <th>Action</th>
		
    </tr>
	<tr>
      <td><input type="checkbox"></td>  
        <td><input type="text" id="id1" onKeyUp="search_row(this.id,1)" class="input-small"></td>
		<td><input type="text" id="id2" onKeyUp="search_row(this.id,2)" class="input-small"></td>
		<td><input type="text" id="id3" onKeyUp="search_row(this.id,3)" class="input-small"></td>
		<td><input type="text" id="id4" onKeyUp="search_row(this.id,4)" class="input-small"></td>
		<td><input type="text" id="id5" onKeyUp="search_row(this.id,5)" class="input-small"></td>
        <td></td>
    </tr>
    </thead>
   
	<?php
	
		  @$queryy="select *from $tableName where status='A' and comp_id = '".$this->session->userdata('comp_id')."'";
		 
$mod_sql = $this->db->query($queryy);

foreach ($mod_sql->result() as $line){
		 
   ?>
   <tr class="record" data-row-id="<?php echo $line->account_id; ?>">
   <td><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $line->account_id; ?>" value="<?php echo $line->account_id;?>" /></td>
 	  	
    	<td><?php echo $line->account_name;?></td>
		
		 <?php if(
$line->main_account_id==1){$Primary="Y";}else{$Primary="N";}?>
	<td><?php echo $Primary; ?></td>

		 <td><?php if($line->main_account_id!='1'){ @$ugrou="select * from $tableName where status='A' and account_id='".@$line->main_account_id."'"; 
   
@$ung = $this->db->query(@$ugrou);
@$row = @$ung->row();

		?><?php echo @$row->account_name; }?></td>
		 <td><?php echo $line->alias;?></td>
		<td><?php echo $line->printname;?></td>
	 	
                     
<td>
<?php if($view!=''){ ?>

<img src="<?php echo base_url();?>/assets/images/add.png" onclick="openpopup('add_account',900,400,'mid',<?php echo $line->account_id; ?>)"  alt="" border="0" class="icon" title="add" />
<?php } if($edit!=''){ ?>


<img src="<?php echo base_url();?>/assets/images/edit.png" onclick="openpopup('add_account',900,400,'id',<?php echo $line->account_id; ?>)"  alt="" border="0" class="icon" title="Edit" />
<?php } if($delete!=''){

$pri_col='account_id';
$table_name='tbl_account_mst';
	?>
<img src="<?php echo base_url();?>/assets/images/delete.png" id="<?php echo $line->account_id."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"  alt="" border="0"  title="Delete" />
<?php } ?>
</td>
    </td></tr>
	<?php } ?>
<input type="text" style="display:none;" id="table_name" value="tbl_account_mst">  
<input type="text" style="display:none;" id="pri_col" value="account_id"> 	       
</table>
</form>
<!--bordered close-->
<div class="clear"></div>
</div><!--table-row close-->

<script src="<?php echo base_url();?>/assets/jsw/jquery.js"></script>
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>

<?php $this->load->view('softwarefooter'); ?>