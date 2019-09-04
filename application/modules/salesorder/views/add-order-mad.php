
<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="insertordermad" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Madipur</a></li> 
<li class="active"><strong>Add Order</strong></li>
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
<a href="manageorderMad"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
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
<select name="customer_id" id="customer_id"  class="form-control ui fluid search dropdown email">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where module_status='Madipur'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php } ?></select>
</th>
<th>Date</th>
<th><input type="date" name="order_date" id="order_dateid" class="form-control md-w" value="" /></th>
</tr>
</tbody>
</table>

</div>

<div class="row">
<div class="col-sm-5">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th style="width:40%">Item Name</th>
<th style="width:50%">&nbsp;</th>
<th>&nbsp;</th>
<th>Category</th>
</tr>

<tr class="gradeA">
<th>
<div class="input-group"> 
<div>
<input type="text" name="prd"  onkeyup="getdata();addrowandqty()" onClick="getdata();addrowandqty()"  id="prd" class="form-control" placeholder="Search Items..." >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" />
 
 <input type="hidden"  name="cateidd" id='cateidd'  value=""/>
 
 </div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
$this->load->view('getproduct-mad');
?>
</div></th>
<th>

<select name="" id="catygoryidd"  class="form-control" multiple="multiple">
						<option value="">----Select ----</option>
					<?php 
						$sqlsole=$this->db->query("select * from tbl_product_stock where Product_type='28'");
						foreach ($sqlsole->result() as $fetchsole){						
					?>					
    <option value="<?php echo $fetchsole->Product_id; ?>"><?php echo $fetchsole->productname; ?></option>

    <?php } ?></select>

</th>
<th><input type="checkbox" id="checkboxidd"></th>

<th><input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"></th>
<div>

</div>
<th style="display:none">
<b><input type="hidden" style="border:none" id="lpr" value="" readonly /></b>
<input type="text" id="checkboxvaliid" value="0" />
<input type="text"  id="lph"  value="" class="form-control" style="width:100px;">
<input type="text" id="qn"  min="1" style="width:100px;"   class="form-control">
<input type="text" id="ordinqty"   style="width:100px;"   class="form-control">
<input type="text"  id="sizecu"  value="" class="form-control" style="width:100px;">
<!--=================================================================-->
All Check&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="checkboxid" onchange="allqty(this)">
</th>
<th style="display:none"><input type="text" id="toqn" readonly style="width:100px;"   class="form-control"></th>
</tr>

</tbody>

</table>

</div>
</div>

<div id="sizeandqty">
<div class="col-sm-3">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>

<tr class="gradeA">
<th>Size</th>
<th>Quantity</th>

</tr>

<tr class="gradeA">
	<td><input type="number" step="any" name="" class="form-control" value="" /></td>
	<td><input type="number" step="any"  name="" class="form-control" value="" /></td>
</tr>
</tbody>

</table>
</div>
</div>

<div class="col-sm-4">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Actual Qty</th>
<th>Ordered Qty</th>
<th>Effective Qty</th>
</tr>

<tr class="gradeA">
	<td><input type="text" name="" class="form-control" value="" /></td>
	<td><input type="text" name="" class="form-control" value="" /></td>
	<td><input type="text" name="" class="form-control" value="" /></td>
</tr>

</tbody>

</table>
</div>
</div>
</div>
</div><!--row close-->

<div class="row">
<div class="col-sm-12"> 
<div id="sizeandqtytesta">
</div>
</div>
</div>

<script>
var text = "";
	function qtyenter(d,r){
	var regex = /(\d+)/g;
nn= d.match(regex)
id=nn;

 var entqty=document.getElementById("qty"+id).value; 
 var actqty=document.getElementById("actqty"+id).value; 
 var ordqty=document.getElementById("ordqty"+id).value; 
 var sumqty=Number(entqty)+Number(ordqty);
 var totaleff=Number(actqty)-Number(sumqty);
 document.getElementById("effqty"+id).value=totaleff; 
 
				document.getElementById("demo"+id).value=entqty;	

	}
	
function entertest(){ 
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getsizecounttest", false);
  xhttp.send();
  document.getElementById("sizeandqtytesta").innerHTML = xhttp.responseText;
}

 $("#checkboxidd").on("click", function(){
    if(checkboxidd.checked) {		
		document.getElementById("checkboxvaliid").value='1';				
    } else {
		document.getElementById("checkboxvaliid").value='0';
    }
}); 
</script>
<div class="table-responsive">
<h5>View Order</h5>
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Qty</th>
<th>Action</th>
</tr>
</tbody>
</table>
</div>
<div>
<tbody>

<tr class="gradeA">
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
<a href="manageorderMad"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</tr>
</tbody>

</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />


<script>

function addrowandqty(){
var contactid=document.getElementById("sizecu").value;
var sizedata=document.getElementById("lph").value;
var qtydata=document.getElementById("qn").value;
var ordinqty=document.getElementById("ordinqty").value;
var pro=contactid+'^'+sizedata+'^'+qtydata+'^'+ordinqty;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getsizecountreg?countsize="+pro, false);
  xhttp.send();
  document.getElementById("sizeandqty").innerHTML = xhttp.responseText;
 } 
 
</script>
</div>
</div>
</div>
</div>

<script>
function allqty(checkboxElem){

if (checkboxElem.checked) {


var allsizeval=document.getElementById("lph").value;

var qnval=document.getElementById("qn").value;

var allsizevals=allsizeval.split(" ");
var totalsizeall=allsizevals.length;

var allqnval=qnval.split(" ")[0];

	var sumq="";
for(var i=0;i<totalsizeall;i++){

	sumq +=Number(allqnval)+" ";
}
//alert(sumq.trim());

document.getElementById("qn").value=sumq.trim( );
  } else {



var allsizeval=document.getElementById("lph").value;

var qnval=document.getElementById("qn").value;

var allsizevals=allsizeval.split(" ");
var totalsizeall=allsizevals.length;

var allqnval=qnval.split(" ")[0];

  document.getElementById("qn").value=allqnval;
  
}
}
</script>

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
		
var countids=document.getElementById("countid").value;

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup = function (e) {
var entr =(e.keyCode);

if(entr==13){
document.getElementById("catygoryidd").focus();
document.getElementById("prdsrch").innerHTML=" ";
addrowandqty();
}
}
}

document.getElementById("catygoryidd").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("checkboxidd").focus();

}
}

document.getElementById("checkboxidd").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("usunit").focus();

}
}


document.getElementById("usunit").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("qty0").focus();

}
}

}

function addRowdata(d,r){
var regex = /(\d+)/g;
nn= d.match(regex)
id=nn;

//qtyenter(d,r);
//document.getElementById("qty"+id).onkeyup = function (e) {
//alert("jj");
//var entr =(e.keyCode);
//if(entr==13){
//alert("jj");
//addRow('dataTable');
//document.getElementById("tstid").focus();
//document.getElementById("prd").value='';
//document.getElementById("prd").focus();
//clear();
//}
//}
}


/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;
var type_id=document.getElementById("customer_id").value;
var order_dateid=document.getElementById("order_dateid").value;

if(rc!=0)
{

if(type_id!=''){
	var valsave=1;
	}else{
	alert("Please Customer Name");
	}
	
	if(order_dateid!=''){
		var valsavedate=1;
	}else{
	alert("Please Select Date");
	}
if(Number(valsave)==Number(valsavedate)){
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
			
			 xobj.open("GET","getproductmad?con="+product,true);
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
			 var checkboxvaliidval=document.getElementById("checkboxvaliid").value;	 
			 var categoryval=document.getElementById("usunit").value;	
			 var categoryid=document.getElementById("cateidd").value;	 
			  var sizeval=document.getElementById("lph").value;	 
			  var coldataval=document.getElementById("sizecu").value;
			  //alert(coldata);	  
					var sizetest=" "+sizeval;
				//var sizevalues = sizetest.replace(/ /g,' | ');
					var sizevalues = sizeval;
				var sizevaluessplit = sizeval.split(' | ');
				
				 var catevalue = Array.prototype.filter.call( document.getElementById("catygoryidd").options, el => el.selected).map(el => el.value).join(",");
				//alert(catevalue);
				
				var sum=0;	
				var coldata=coldataval-1;
			for(i=0;i<coldata;i++)
				{				
				var dm=document.getElementById("demo"+i).value;
				var str=str+" | "+dm;			
				var sum=Number(sum)+Number(dm);
				//alert(dm);
				
			var str = str;
			var cntlenght=str.length; 
			var res = str.slice(9, cntlenght);
									
			var orqty=document.getElementById("ordqty"+i).value;
			var qtyinsumm=Number(dm)+Number(orqty);
			
			var strqtyinstock=strqtyinstock+" "+qtyinsumm;	
			var cntlenghtins=strqtyinstock.length; 
			var resinstock = strqtyinstock.slice(9, cntlenghtins);

				}
				
			document.getElementById("demottt").value=res;	
			
			//var qtysplitesum=res;
			var qtysplite=res.split(" | ");
			//alert(qtysplite[1].length);
			
			if(checkboxvaliidval=='1'){				
				var checkedsumqty=Number(sum)*2;
				//	alert(sum);
			}else{
				var checkedsumqty=Number(sum);
			}
			
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var rowcountsat=rowCount+1;
			
			
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
<!--==========================================================-->
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=checkedsumqty;			
			element21.readOnly = true;
			element21.name = "checkboxvaluess[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);

			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=catevalue;			
			element21.readOnly = true;
			element21.name = "categorysoletype[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);
<!--==========================================================-->
			
var cell4 = row.insertCell(1);
			var element3 = document.createElement("input");
			element3.value=categoryval;
			element3.type = "text";
			element3.readOnly = true;
			element3.className="form-control"
			element3.name = "category_name[]";
			cell4.appendChild(element3);
			
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=categoryid;			
			element21.readOnly = true;
			element21.name = "category_id[]";
			element21.style.border="hidden"; 
			cell4.appendChild(element21);

var cell5 = row.insertCell(2);

//============================================================= 		
			var element4 = document.createElement("input");
			element4.value= sizevalues;
			element4.type = "hidden";
			element4.className="form-control form-control-m"
			element4.name = "sizeallval[]";
			cell5.appendChild(element4);

var element7 = document.createElement("input");
			element7.value= res;
			element7.type = "hidden";
			element7.className="form-control form-control-m"
			element7.name = "qtyyallval[]";
			cell5.appendChild(element7);

var element71 = document.createElement("input");
			element71.value= resinstock;
			element71.type = "hidden";
			element71.className="form-control form-control-m"
			element71.name = "qtyinstock[]";
			cell5.appendChild(element71);

//=============================================================

for(var j=0; j<coldata;j++){
			var jst=j+1;
			var element8 = document.createElement("input");
			element8.value= sizevaluessplit[jst];
			element8.style = "width: 50px;margin: 10px;";
			element8.type = "text";
			element8.readOnly = true;
			element8.className="form-control form-control-m"
			element8.name = "siz[]";
			cell5.appendChild(element8);
						
}

cell5.appendChild(document.createElement("br"));	
				
for(var k=1; k<=coldata;k++){
			
var element8 = document.createElement("input");
			element8.value= qtysplite[k];
			element8.style = "width: 50px;margin: 10px;";
			element8.type = "text";
			element8.readOnly = true;
			element8.className="form-control form-control-m"
			element8.name = "siz[]";
			cell5.appendChild(element8);

}


var cell6 = row.insertCell(3);
			var element5 = document.createElement("input");
			element5.value= sum;
			element5.type = "text";
			element5.readOnly = true;
			element5.name = "total_value[]";
			element5.className="form-control"
			cell6.appendChild(element5);


var cell7 = row.insertCell(4);
			var element51 = document.createElement("input");
			element51.value= "Delete Item";
			element51.type = "button";
			element51.readOnly = true;
			element51.name = "start_date[]";
			element51.className="btn btn-secondary btn-sm"
			element51.onclick= function() { deleteRow(this); };
			cell7.appendChild(element51);
			

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
document.getElementById("catygoryidd").value='';
document.getElementById("checkboxidd").checked = false;
document.getElementById("checkboxvaliid").value ='0';
document.getElementById("sizecu").value='';
document.getElementById("notactionid").value=1;
addrowandqty();
}		

	</SCRIPT>
</form>
<?php
$this->load->view("footer.php");
?>

