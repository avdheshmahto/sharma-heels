<?php
$this->load->view("header.php");
$id=$_GET['id'];
?>
<body onLoad="showww()">	
<?php 
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$id'");
$getContact=$contactQuery->row();

?>
<div class="main-content">
<h1 class="page-title">GST</h1>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">View Payments/Dues in Gst&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $getContact->first_name;?>)</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body panel-center">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Firm Name</label> 
<div class="col-sm-3"> 
<select name="f_name" class="form-control">
<option value="">--Select--</option>
<?php 
$sqlprotype=$this->db->query("select * from tbl_master_data where param_id='25'");
foreach ($sqlprotype->result() as $fetch_protype){
?>
<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
<?php }?>
</select>
</div>
<label class="col-sm-2 control-label">Remarks</label> 
<div class="col-sm-3"> 
<input type="text" name="remarks" class="form-control" value="" /> 
</div>  
</div>
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="fdate" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="tdate" class="form-control" value="" /> 
</div> 
</div>
<div class="form-group panel-body-to"> 
<div class="col-sm-3">
</div>
<div class="col-sm-3">
</div>
<label class="col-sm-2 control-label"></label>
<label class="col-sm-2 control-label"><input type="submit" name="search" class="btn btn-sm" value="Search"></label> 
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" style="width:-webkit-fill-available !important;">
<thead>
<tr style="border-bottom:3px solid #000;">
<th>Closing Balance</th>
<th></th>
<th id="close"></th>
<th id="debit"></th>
<th id="credit"></th>
<th id="actgst"></th>
<th id="paigst"></th>
<th></th>
</tr> 
<tr> 
<th>Date</th>
<th>Firm Name</th>
<th>Remarks</th>
        <th>Debit Amount</th>
		<th>Credit Amount</th> 
		<th>Actual GST 18%</th>
		<th>GST Paid <?=$getContact->gst;?>%</th> 
		<th>Action</th> 
		</tr> 
</thead> 
 

<?php
	@extract($_POST);
	if($search!='')
	{
	
		$queryy="select * from tbl_payment_gst where  contact_id='$id'";
		if($f_name!='')
		{				
			$queryy.=" and firm  = '$f_name'";	  
		}
		
		if($remarks!='')
		{				
			$queryy.=" and remarks like '%$remarks%'";	  
		}
		
		
		
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("-",$tdate);
			
			$fdate=explode("-",$fdate);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and date >='$fdate1' and date <='$todate1'";
		}
}else{
$queryy="select * from tbl_payment_gst where  contact_id='$id'";
}

$result11=$this->db->query($queryy);
?>
<tbody>
<?php 
foreach($result11->result() as $line) {
$getgst=$getContact->gst;
if($line->status=='Invoice'){
   $c+=$line->total_billamt; 
   $a=$line->total_billamt;
   $totgstamt=$line->cgst+$line->sgst+$line->igst;
   $gsttotal+=$line->cgst+$line->sgst+$line->igst;
   $paygstamt+=($a-$totgstamt)*$getgst/100;
}
if($line->status=='Payment'){
   $b+=$line->total_billamt; 
 
}
 $dd=$line->date;
?>
<tr class="gradeC record">

<th><?php echo $dd; ?></th>
<th><?php 
$sqlQry=$this->db->query("select * from tbl_master_data where serial_number='$line->firm'");
$qryFetch=$sqlQry->row();
echo $qryFetch->keyvalue;?></th>
<th><?php echo $line->remarks;?></th>
<th><?php if($line->status=='Invoice'){?><?php echo $line->total_billamt; ?><?php }elseif($line->status=='Opening Balance'){echo $line->total_billamt;} else{ echo "0"; }?></th>
<th><?php if($line->status=='Payment'){?><?php echo $line->total_billamt;?><?php }else{ ?>0<?php }?></th>
<th><?php if($line->status=='Invoice'){echo $totgstamt;?><?php }?></th>
<th><?php if($line->status=='Invoice'){ echo ($a-$totgstamt)*$getgst/100;}?></th>
<th>
<button class="btn btn-default modalEditItem" data-a="<?php echo $fetch_list->contact_id;?>" href='#editItem' onClick="add_payment('<?php echo $line->invoice_gstid;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
</th>
</tr>
<?php 
 
$debit_total=$debit_total+$balance_total;
	$credit_totals=$credit_totals+$rem_amt12;
	$closing_bal=$closing_bal+$rem_amt;
	 //$z++; 

}  
?>
</tbody> 
<input type="hidden" name="debitres" id="debitres" value="<?php echo $c;?>" />
<input type="hidden" name="creditres" id="creditres" value="<?php echo $b;?>" />
<input type="hidden" name="closres" id="closres" value="<?php echo $c-$b;?>" />
<input type="hidden" name="gsttot" id="gsttot" value="<?php echo $gsttotal;?>" />
<input type="hidden" name="pagstamt" id="pagstamt" value="<?php echo $paygstamt;?>" />
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="update_invoice_payment" enctype="multipart/form-data">			
<div id="editItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contentitem" id="modal-contentitem">

        </div>
    </div>	 
</div>
</body>
</form>
<script>
//--------------------------add Tailor start----------------------------
function add_payment(v){
//alert(v);
var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "edit_payment?ID="+pro, false);
  xhttp.send();
  document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
 } 
//--------------------------add Tailor end----------------------------

function calculation(v){
//alert(v);
var type=document.getElementById("type").value;
//alert(type);
if(type==""){
alert("First Select Type");
document.getElementById("type").focus();
document.getElementById("amt").value='';
}else{
if(type=="Invoice"){
//alert();
//document.getElementById("check").style.display="Block";
var state=document.getElementById("state").value;
//alert(state);
var gst=document.getElementById("gst").value;
//alert(gst);
var gstamt=Number(v)-(Number(v)/((100+18)/100));
	if(state=='7'){
		var cgst=Number(gstamt)/2;
		var sgst=Number(gstamt)/2;
		//alert(cgst);
		//alert(sgst);
		document.getElementById("cgst").value = cgst.toFixed(2);
		document.getElementById("sgst").value = sgst.toFixed(2);
		document.getElementById("igst").value = '';
	}else{
		document.getElementById("igst").value = gstamt.toFixed(2);
		document.getElementById("cgst").value = '';
		document.getElementById("sgst").value = '';
	}
	var result=(Number(v)/((100+18)/100));
		document.getElementById("priAmt").value = result.toFixed(2);
		var backendCalc=(Number(result)*(Number(gst)/100));
		//alert(backendCalc);
		document.getElementById("paidamt").value = backendCalc.toFixed(2);
}
}
}

function showww(){
//alert();
var debit=document.getElementById("debitres").value;
var credit=document.getElementById("creditres").value;
var closeee=document.getElementById("closres").value;
var gsttot=document.getElementById("gsttot").value;
var pagstamt=document.getElementById("pagstamt").value;
document.getElementById("close").innerHTML=closeee;
document.getElementById("credit").innerHTML=credit;
document.getElementById("debit").innerHTML=debit;
document.getElementById("actgst").innerHTML=gsttot;
document.getElementById("paigst").innerHTML=pagstamt;
}
</script>
<?php $this->load->view("footer.php");?>