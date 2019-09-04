
<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="invoiceInsertDirectReg">
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Regarpura</a></li> 
<li class="active"><a href="addInvoiceReg"><strong>Add Invoice</strong></a></li>
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
<a href="addInvoice"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</ol>
<?php
            if($this->session->flashdata('flashmsg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flashmsg');?></strong> 
</div>	
<?php }?>
			<div class="row">
				<div class="col-lg-12">
					
						<div class="panel-heading clearfix">
                       
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Customer Name</th>
<th>
<select name="customer_id" id="customer_id"  class="form-control ui fluid search dropdown email" onchange="locandstore()">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where module_status='Ragarpura'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id.'^custmr'; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php 
			} 
		?>
	</select>
</th>
<th>Date</th>
<th><input type="date" name="order_date" id="order_dateid" class="form-control md-w" value="" /></th>
</tr>
</tbody>
</table>

</div>

<!--row close-->

<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th style="width:40%">Item Name</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>Category</th>
<th>Enter Qty</th>
</tr>

<tr class="gradeA">
<th>
<div class="input-group"> 
<div>
<input type="text" name="prd"  onkeyup="getdata();" onClick="getdata();"  id="prd" class="form-control" placeholder="Search Items..." >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" />
 
 <input type="hidden"  name="cateidd" id='cateidd'  value=""/>
 </div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
$this->load->view('getproduct');
?>
</div></th>
<th>
<select name="" id="taxonid"  class="form-control" multiple="multiple">
 		
		<option value="">----Select ----</option>
		<?php 
						$sqltax=$this->db->query("select * from tbl_product_stock where Product_type='28'");
						foreach ($sqltax->result() as $fetchtax){						
					?>					
    <option value="<?php echo $fetchtax->Product_id; ?>"><?php echo $fetchtax->productname; ?></option>

    <?php } ?>
		
</select>
</th>
<th><input type="checkbox" id="checkboxidd"></th>

<th><input type="text"  id="usunit" style="width:100px;" readonly class="form-control"></th>
<th><input type="number" id="entid" style="width:100px;" class="form-control"></th>
<div >

</div>
</tr>

</tbody>

</table>

</div>
</div>
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>

<tr class="gradeA">
<th>Item Name</th>
<th>Category</th>
<th>Qty</th>
<th>Action</th>
</tr>

</tbody>

</table>
</div>
</div>
<div class="modal-footer">
<input type="button" class="btn btn-sm"  value="SAVE"   id="sv1" onclick="fsv(this)"  value="Save">
<a href="addInvoice"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button></a>
</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<script>
//add item into showling list
window.addEventListener("keydown", checkKeyPressed, false);
//funtion to select product
function checkKeyPressed(e) {
var s=e.keyCode;

var ppp=document.getElementById("prd").value;
var sspp=document.getElementById("spid").value;//
var ef=document.getElementById("ef").value;
		ef=Number(ef);
//alert("hello");		
var countids=document.getElementById("countid").value;

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup = function (e) {
var entr =(e.keyCode);

if(entr==13){
document.getElementById("usunit").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("usunit").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("entid").focus();

}
}

document.getElementById("entid").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){
 var entdatid=document.getElementById("entid").value;	
if(entdatid!=''){  
addRow('dataTable');
}
}
}


}


/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;

var customer_id=document.getElementById("customer_id").value;
var order_dateid=document.getElementById("order_dateid").value;

if(rc!=0)
{
if(customer_id!='' && order_dateid!=''){
v.type="submit";
}
}
else
{
	alert('No Item To Save..');	
}
}


function getdata()
		  {
		  
		 currentCell = 0;
		 var product1=document.getElementById("prd").value;	 
		 var product=product1;
		
		    if(xobj)
			 {
			 var obj=document.getElementById("prdsrch");
			
			 xobj.open("GET","getproduct?con="+product,true);
			 xobj.onreadystatechange=function()
			  {
			  if(xobj.readyState==4 && xobj.status==200)
			   {
				  
			    obj.innerHTML=xobj.responseText;
			   }
			  }
			 }
			 xobj.send(null);
		  }
  

</script>

<SCRIPT language="javascript">
		function addRow(tableID) {
	
			var table = document.getElementById(tableID);
			
			var rows=document.getElementById("rows").value;
			var rid =Number(rows)+1;
			document.getElementById("rows").value=rid;
			
			 var productval=document.getElementById("prd").value;
			 var itemval=document.getElementById("pri_id").value;
			 var categoryval=document.getElementById("usunit").value;	
			 var categoryid=document.getElementById("cateidd").value;	 
			 var entid=document.getElementById("entid").value;	 

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var rowcountsat=rowCount+1;
		
				//alert("hello");			
			var cell3 = row.insertCell(0);
			var element2 = document.createElement("input");
			element2.value=productval;
			element2.type = "text";
			element2.readOnly = true;
			element2.name = "item_name[]";
			element2.className="form-control";
			cell3.appendChild(element2);
			
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=itemval;			
			element21.readOnly = true;
			element21.name = "item_id[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);
			
//===============================================================================================

var cell4 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.value=categoryval;
			element2.type = "text";
			element2.readOnly = true;
			element2.name = "item_name[]";
			element2.className="form-control";
			cell4.appendChild(element2);
			
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=categoryid;			
			element21.readOnly = true;
			element21.name = "item_id[]";
			element21.style.border="hidden"; 
			cell4.appendChild(element21);

//================================================================================================			

//===============================================================================================

var cell5 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.value=entid;
			element2.type = "text";
			element2.readOnly = true;
			element2.name = "item_name[]";
			element2.className="form-control";
			cell5.appendChild(element2);
			
//================================================================================================			


var cell6 = row.insertCell(3);
			var element51 = document.createElement("input");
			element51.value= "Delete Item";
			element51.type = "button";
			element51.readOnly = true;
			element51.name = "start_date[]";
			element51.className="btn btn-secondary btn-sm"
			element51.onclick= function() { deleteRow(this); };
			cell6.appendChild(element51);
			

		clear();
		
		}


		function deleteRow(row) {
					 var i = row.parentNode.parentNode.rowIndex;
					 var result = confirm("Are you sure you want to delete item?");
					if (result) {
						document.getElementById('dataTable').deleteRow(i);
					}
        			
		}
		
		
function clear(){
document.getElementById("prd").value='';
document.getElementById("prd").focus();
document.getElementById("usunit").value='';
document.getElementById("entid").value='';	 
document.getElementById("catygoryidd").value='';

}		

	</SCRIPT>



<div>
</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />


</div>
</div>
</div>
</div>
</form>
<?php
$this->load->view("footer.php");
?>

