
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Tech Vyas Software</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='<?=base_url();?>assets/images/favicon.ico' />
<!-- /site favicon -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
<!-- Entypo font stylesheet -->
<link href="<?=base_url();?>assets/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="<?=base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->
<!------------------------report menu-------------------------->

<link href="<?php echo base_url();?>assets/report/report.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/report-js/jquery.min.js" type="text/javascript"></script>

<!------------------------report menu close-------------------------->
<!-- Integral core stylesheet -->
<link href="<?=base_url();?>assets/css/integral-core.css" rel="stylesheet">
<!-- /integral core stylesheet -->

<!--Jvector Map-->
<link href="<?=base_url();?>assets/plugins/jvectormap/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<link href="<?=base_url();?>assets/css/integral-forms.css" rel="stylesheet">

<link href="<?=base_url();?>assets/css/invoice.css" rel="stylesheet">
 

<style>
.side-to{/*position:fixed;*/ background-color:#2F2F38;}
#pagination_controls{margin:20px 0 0 0px;}

</style>



</head>
<?php $this->load->view("javascriptPage.php");?>
<body <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?>>


<div class="loader-backdrop">          
<div class="loader">
<div class="bounce-1"></div>
</div>
</div>

	
<!-- Page container -->
<div class="page-container">

<div class="main-header row">
<div class="col-sm-4 col-xs-4">
Anoj
</div>


<div class="col-sm-4 col-xs-4">
<strong><div id="success_message" class="ajax_response"></div></strong> 
</div>

<div class="col-sm-4 col-xs-4">
<div class="pull-right">



<ul class="user-info pull-left">
<!-- Notifications -->
<li class="notifications dropdown">
<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-attention"></i><span class="badge badge-info">6</span></a>
<ul class="dropdown-menu pull-right">
<li class="first">
<div class="small"><a class="pull-right" href="#">Mark all Read</a> You have <strong>3</strong> new notifications.</div>
</li>
<li>
<ul class="dropdown-list">
<li class="unread notification-success"><a href="#"><i class="icon-user-add pull-right"></i><span class="block-line strong">New user registered</span><span class="block-line small">30 seconds ago</span></a></li>
<li class="unread notification-secondary"><a href="#"><i class="icon-heart pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="unread notification-primary"><a href="#"><i class="icon-user pull-right"></i><span class="block-line strong">Privacy settings have been changed</span><span class="block-line small">2 hours ago</span></a></li>
<li class="notification-danger"><a href="#"><i class="icon-cancel-circled pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="notification-info"><a href="#"><i class="icon-info pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="notification-warning"><a href="#"><i class="icon-rss pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
</ul>
</li>
<li class="external-last"> <a href="#">View all notifications</a> </li>
</ul>
</li>
<!-- /notifications -->

<!-- Messages -->
<li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> 
<img width="22" class="img-circle avatar" alt="" src="<?=base_url();?>assets/images/man-3.jpg">Admin <span class="caret"></span></a>

<!-- User action menu -->
<ul class="dropdown-menu">
<li style="display:none"><a href="<?php echo base_url();?>master/Item/profile"><i class="icon-user" ></i>My profile</a></li>
<li><a href="<?php echo base_url();?>master/changePassword/changepwd"><i class="icon-cog"></i>Change Password</a></li>
<li><a href="<?php echo base_url();?>master/Item/logout"><i class="icon-logout"></i>Logout</a></li>
</ul>
<!-- /user action menu -->

</li>
<!-- /messages -->

</ul><!-- /user alerts -->
</div><!--pull-right close-->
</div>
</div>
<?php if($_GET['popup']=='True'){} else {?>

<!-- Page Sidebar -->
<?php 
//require_once(APPPATH.'views/side.php');
$this->load->view("side.php");?>
<!-- /page sidebar -->
  
  <!-- Main container -->
<div class="main-container">

<!-- Main header -->

<?php }?>
<!-- /main header -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
