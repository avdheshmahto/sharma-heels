﻿<?php $this->load->view("header.php");?>
<div class="main-content">

<h1 class="page-title">Dashboard</h1>
<br>

<!-- Row-->
<div class="row">

<!-- Online Signup -->
<a href="<?=base_url();?>purchaseorder/purchaseorder/manage_purchase_order">
<div class="col-lg-3 col-sm-6">
<div class="panel minimal secondary-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>&nbsp;</strong></h2>
<p>Purchase Order</p>
<div class="float-chart-sm pt-15">
<div id="online-signup" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
</a>
<!-- /Online Signup -->
<a href="<?=base_url();?>salesorder/SalesOrder/manageSalesOrder">
<!-- Last Month Sale -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal royalblue-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>&nbsp;</strong></h2>
<p>Sales Order</p>
</div>
<div class="float-chart-sm">
<div class="last-month-outer">
<div id="last-month-sale" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
<!-- /last month sale -->
</a>
<!-- New Visits -->
<a href="<?=base_url();?>invoice/manage_invoice">
<div class="col-lg-3 col-sm-6">
<div class="panel minimal royalblue-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>&nbsp;</strong></h2>
<p>Invoice Order</p>
</div>
<div class="float-chart-sm">
<div class="last-month-outer">
<div id="last-month-sale" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
<!-- /new visits -->
</a>
<a href="<?=base_url();?>report/Report/report_function">
<!-- Total Revenu -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal info-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>&nbsp;</strong></h2>
<p>Reports</p>
<div class="float-chart-sm pt-15">
<div id="total-revenue" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
</a>
<!-- /total revenu -->
</div>
<!-- /row-->

<!-- Row -->

<!-- /row-->

<!-- Row-->

<!-- /row-->

<!-- Row-->

<!-- /row-->

<!-- Row-->
<div class="row">

<div class="col-md-12"> 
<div class="panel panel-default">

<!-- Panel body --> 
<div class="panel-body"> 
<div class="jvectormap-section" id="world-map-markers" style="height: 400px"></div>
</div> 
<!-- /panel body -->
</div> 
</div>
</div>
<?php $this->load->view("footer.php");?>