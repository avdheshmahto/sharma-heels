<?php
$this->load->view("header.php");
?>
	<!-- Main content -->
	<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">PAYMENT RECEIVED REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="searchPaymentReport">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Customer Name</label> 
<div class="col-sm-3"> 
<select id="contactid" class='form-control' name="contactid">
 <?php
 $contQuery=$this->db->query("select * from tbl_contact_m where comp_id='".$this->session->userdata('comp_id')."' and group_name='4' order by first_name");
 ?>
 <option value=''>Please Select</option>
 <?php 
 foreach($contQuery->result() as $contRow)
{

  ?>
    <option value="<?php echo $contRow->contact_id; ?>" <?php if($contRow->contact_id==$customerfname){?> selected="selected" <?php }?>>
    <?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?></option>
    <?php } ?>
</select>
</div>
<label class="col-sm-2 control-label">Payment Mode</label> 
<div class="col-sm-3"> 
<select name="payment_mode" id="payment_mode_id" class="form-control">
<option value="">--Select--</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">cheque</option>

</select>
</div>
<label class="col-sm-2 control-label"><button type="submit" name="Show" class="btn btn-info" value="Show">Show</button></label>  
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
 		<th>SERIAL No.</th>
		<th>CUSTOMER NAME</th>
        <th>RECEIVED AMOUNT</th>
		<th>DATE</th>   
		<th>PAYMENT MODE</th>
		
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($SearchPaymentReceived)) {
foreach($SearchPaymentReceived as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php 
$contQuery=$this->db->query("select * from tbl_contact_m where group_name='4' and contact_id='$rows->contact_id'");
$getInv=$contQuery->row();
echo $getInv->first_name; ?></th>
<th><?php echo $rows->receive_billing_mount; ?></th>
<th><?php echo $rows->date; ?></th>
<th><?php echo $rows->payment_mode;?></th>
	
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>