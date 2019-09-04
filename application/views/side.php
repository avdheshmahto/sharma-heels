<div class="page-sidebar">
<div class="sidebar-fixed side-to">
<!-- Site header  -->
<header class="site-header">
<div class="site-logo"><a href="<?php echo base_url(); ?>master/Item/dashboar"><img src="<?=base_url();?>assets/images/logo.png" alt="ERP" title="ERP"></a></div>
<div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
<div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
</header>
<!-- /site header -->

<div style="width:100%; max-height:700px; overflow-x:auto;overflow-y:auto;">
<!-- Main navigation -->
<ul id="side-nav" class="main-menu navbar-collapse collapse">
<!--<li class="active"><a href="<?php echo base_url();?>master/Item/dashboar"><i class="icon-gauge"></i><span class="title">Dashboard</span></a></li>
-->
<?php
@session_start();
@$main=$_session['main'];
@$submain=$_session['submain'];
@$sub=$_session['sub'];
@$page0=$_SERVER['REQUEST_URI'];
@$page=explode('/',$page0);
 @$page1=@$page[2]."/".@$page[3]."/".@$page[4];
 @$page2=@$page[2]."/".@$page[3];
$query = $this->db->query("SELECT * FROM tbl_module_function where status='A' and function_url='$page1' or  function_url='$page2' ");
$row = $query->row();
 @$MN=$row->module_name;
 @$UR=$row->func_id;
 @$GP=$row->function_group;
$role = $this->session->userdata('role');


$mod_sql = $this->db->query("select module_id,module_name,module_url from tbl_module_mst where status='A' order by Order_id");
$countsss=1;
foreach ($mod_sql->result() as $mod_fetch){
$module_sqldata = $this->db->query("select COUNT(function_url) as ct from tbl_role_func_action where role_id='".$role."' and module_id='".$mod_fetch->module_id."' and action_id !='Inactive'");
$module_fetchdata = $module_sqldata->row();
 $module_fetchdata->ct;
  if($module_fetchdata->ct >0) {
  echo $mod_fetch->function_url;
  ?>

 <li <?php if($mod_fetch->module_id==$MN){ ?> class="active has-sub"<?php }?> class='has-sub'>

  <?php

if($mod_fetch->module_name=='Reports')
{
//echo "<li class='has-sub'>"; 
?>
<a href="#" onclick="window.location='<?=base_url();?>report/Report/report_function'"><i  class="<?php echo $mod_fetch->module_url; ?>"></i><span class="title"><?php echo $mod_fetch->module_name; ?></span></a> 
<?php } else { 
if($mod_fetch->module_name=='Logout')
{
?>
<a href="#" onclick="window.location='<?php echo base_url()?>master/Item/logout<?php echo $mod_fetch->function_url; ?>'"><i  class="<?php echo $mod_fetch->module_url; ?>"></i><span class="title"><?php echo $mod_fetch->module_name; ?></span></a>
<?php
}else{
?>
<a href="#"><i  class="<?php echo $mod_fetch->module_url; ?>"></i><span class="title"><?php echo $mod_fetch->module_name; ?></span></a> 

<?php } } ?>
<?php echo "<ul class='nav collapse'>"; 

$mod_sql2 = $this->db->query("select distinct f.function_group from tbl_module_function f  join tbl_role_func_action rf on f.func_id=rf.function_url where rf.role_id='".$role."' and rf.action_id !='Inactive' and f.module_name='".$mod_fetch->module_id."'");
	foreach ($mod_sql2->result() as $mod_fetch2){
	//echo $mod_fetch2->function_url;
			$mod_sql3 = $this->db->query("select func_id,function_name,function_url from tbl_module_function where status='A' and module_name='".$mod_fetch->module_id."' and function_group='".$mod_fetch2->function_group."'");
			
            if($mod_fetch2->function_group !='' )
            {
//echo "<li class='has-sub'>";

?>
 
<li <?php if($mod_fetch2->function_group==$GP){  ?> class="active has-sub" <?php }?> class='has-sub'>
<a href="#/"><span class="title"><?php echo $mod_fetch2->function_group; ?></span></a> 
<?php 
echo "<ul class='nav collapse'>";
	}
foreach ($mod_sql3->result() as $mod_fetch3){
$rr1=$this->db->query("select action_id from tbl_role_func_action where function_url='".$mod_fetch3->func_id."' and role_id='".$role."' and module_id='".$mod_fetch->module_id."'");
$rr = $rr1->row();
  $rr->action_id;
                if($rr->action_id != 'Inactive')
                {
	
	if($mod_fetch3->function_url=='report/Report/report_function')
	{}else{
	
		if($mod_fetch3->function_url=='master/Item/logout')
	{}else{

?>	

<li <?php if($mod_fetch2->function_group==$GP){  ?> <?php if($mod_fetch3->function_url==$page1 or $mod_fetch3->function_url==$page2){?> class="active" <?php }?> <?php }?>><a href="<?php echo base_url();?><?php echo $mod_fetch3->function_url; ?>"><span class="title"><?php echo $mod_fetch3->function_name; ?></span></a></li> 

<?php 
} }
//echo "</ul>";

} } 

  if($mod_fetch2->function_group!='')
    {
      echo "</ul></li>";
echo $mod_fetch3->module_name;
    }
 } echo "</ul></li>"; ?><?php } } ?>


</ul><!-- /main navigation -->		
</div>

</div>	 
</div>