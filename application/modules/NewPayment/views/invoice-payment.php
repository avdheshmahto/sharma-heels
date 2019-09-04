<?php
$this->load->view("header.php");
?>
	<!-- Main content -->
	<div class="main-content">	
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">Payment</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Vendor Name</label> 
<div class="col-sm-3"> 
<select id="contactid" class='form-control'>
 <?php
 $contQuery=$this->db->query("select * from tbl_contact_m where comp_id='".$this->session->userdata('comp_id')."' and group_name='5' order by first_name");
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
</div>
</form>
<label class="col-sm-4 control-label"><button onclick="leadsfun()" name="Show" class="btn btn-info" value="Show">Show</button></label>  
</div>
<form class="form-horizontal" id="myForm" method="post" action="insert_payment">
<div class="table-responsive" id="dataiddiv"></div>
</form>
<script>
function leadsfun(){
var contactidd=document.getElementById("contactid").value;
if(contactidd!=''){
var pro=contactidd;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getdata_fun?con="+pro, false);
  xhttp.send();
  document.getElementById("dataiddiv").innerHTML = xhttp.responseText;
}else{
	
	alert("Please Select Customer Name");
		
}
} 

function myFunction() {
	
	var rec_amt_id=document.getElementById("rec_amt_id").value;
	var dateid=document.getElementById("dateid").value;
	var payment_mode_id=document.getElementById("payment_mode_id").value;
	if(rec_amt_id==''){
		alert("Please Enter Receive Amount");
	}else if(dateid==''){
		alert("Please Select Date");
	}else if(payment_mode_id==''){
		alert("Please Select Payment Mode");
	}else{			
    document.getElementById("myForm").submit();
	}
}
</script>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>