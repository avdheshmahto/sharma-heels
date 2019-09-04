
<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="insertorder" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
<div class="row">
<div class="col-sm-4">		
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">National</a></li> 
<li class="active"><strong>Add Invoice</strong></li>
</ol>
</div>

<div class="col-sm-6 breadcrumb breadcrumb-2">
<?php
            if($this->session->flashdata('flashmsg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert" style="float:left; width:400px; text-align:center;margin:0 150px 0 0px; font-size:14px; color: #a94442;"><strong>Well done! &nbsp;<?php echo $this->session->flashdata('flashmsg');?></strong> 
</div>

<?php } ?>
</div>

<div class="col-sm-2">
<div class="table-responsive">
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
<a href="manageorder"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</div>
</div>
</div> 


			<div class="row">
				<div class="col-lg-12">
					
						<div class="panel-heading clearfix">
                       
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Type</th>
<th>
	<select name="type_name" id="type_id" onchange="typefunction()" class="form-control md-w">
			<option value="">--select--</option>
			<option value="Customer">Customer</option>
			<option value="Store">Store</option>
	</select>
</th>
<th>Date</th>
<th><input type="text" name="order_date" id="order_dateid" class="datepicker" width="280" value="<?php echo date('d/m/Y'); ?>" /></th>
<th>Term</th>
<th><input type="text" name="order_date" class="form-control"  width="280" value="" /></th>
</tr>
<tr class="gradeA">
<th colspan="4" id="emptyiddd">&nbsp;</th>
<th class="customerclass">Customer Name</th>
<th class="customerclass">
<select name="customer_id"  class="form-control ui fluid search dropdown email">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php } ?></select>
</th>
<th id="customeriddname"><button class="btn btn-success modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="glyphicon glyphicon-user"></i></button></th>
<th class="storeclass">Store</th>
<th class="storeclass">
<select name="store_id" class="form-control ui fluid search dropdown location">
						<option value="">----Select ----</option>
					<?php 
						$sqlloc=$this->db->query("select * from tbl_location");
						foreach ($sqlloc->result() as $fetchloc){						
					?>					
    <option value="<?php echo $fetchloc->id; ?>"><?php echo $fetchloc->location_name; ?></option>

    <?php } ?></select>
</th>
<th>Due Date</th>
<th colspan="3"><input type="date" name="due_date" style="width:50%" class="form-control" value="" /></th>
</tr>
</tbody>
</table>
</div>
<h6></h6>
<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Item Name</th>
<th>Category</th>
<th>Description</th>
<th>Size/Qty</th>
<th>Total Qty</th>
<th>Price</th>
<th>Total Price</th>
</tr>

<tr class="gradeA">
<th>
<div class="input-group"> 
<div>

<input type="text" name="prd"  onkeyup="getdata();addrowandqty()" onClick="getdata();addrowandqty()"  id="prd" class="form-control" style="width:70px;" placeholder="Search Items..." >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" />
 
 <input type="hidden"  name="cateidd" id='cateidd'  value=""/>
 
</div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
$this->load->view('getproduct');
?>
</div></th>

<th><input type="hidden" readonly="" id="usunit" style="width:70px;" class="form-control"><p id=""></p></th>
<th><textarea id="destextaid" class="form-control" style="width:100px;height:80px;"></textarea></th>

<th style="width:312px;">
<div class="table-responsive2" style="width:490px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<input type="hidden" name="size_val[]" value="<?php echo $dd->size_name; ?>" />
<input type="hidden" name="ordered_qty_val[]" value="<?php echo $dd->qty_name; ?>" />
<?php 
 $sizeval=$dd->size_name;
 $qtyyval=$dd->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
?>
<input type="hidden" id="countsizeid<?php echo $idm;?>" value="<?php echo $sizecount; ?>" />
<tr>
<th style="width:200px;"><div class="qty-size"><strong>Size</strong></div></th>

<th style="text-align:center;width: 10px;"><?php //echo $sizearr[$k]; ?></th>

</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Ord Qty</strong></td>

<input type="hidden" value="<?php echo $qtyarr[$j]; ?>" id="checkorderedqtyidd<?php echo $j; ?><?php  echo $idm; ?>" class="form-control" />
<th style="text-align:center"><?php //echo $qtyarr[$j]; ?></th>

</tr>
<tr class="gradeX">
<td><strong>Pend Qty</strong></td>
<th style="text-align:center"><?php //echo $qtyarr[$j]; ?></th>
</tr>
<tr class="gradeX">
<td><strong>Ent Qty</strong></td>
<th style="text-align:center"><?php //echo $qtyarr[$j]; ?></th>
</tr>
</tbody>
</table>
</div>
</th>

<th><input type="hidden" readonly="" id="usunit" style="width:70px; border:none" class="form-control"></th>
<th><input type="hidden" readonly="" id="usunit" style="width:70px;border:none;" class="form-control"></th>
<th><input type="hidden" readonly="" id="usunit" style="width:70px;border:none;" class="form-control"></th>
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
<th style="width:170px">Item Name</th>
<th style="width:170px">Description</th>
<th style="width:170px">Category</th>
<th>Size / Qty</th>
<th style="width:170px">Total Qty</th>
<th>Price</th>
<th>Total Price</th>
<th style="width:120px">Action</th>
</tr>
</tbody>
</table>
</div>
<div>
<h6></h6>
<tbody>
<tr class="gradeA">
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
<a href="manageorder"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
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
  xhttp.open("GET", "getsizecount?countsize="+pro, false);
  xhttp.send();
  document.getElementById("sizeandqty").innerHTML = xhttp.responseText;
 } 
 
</script>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".customerclass").hide();
	$("#customeriddname").hide();
	$(".storeclass").hide();
    $("#type_id").click(function(){
      var val=$("#type_id").val();
	if(val=='Customer'){
		$(".customerclass").show();
		$("#customeriddname").show();
		$(".storeclass").hide();
		$("#emptyiddd").hide();
	}else if(val=='Store'){		
		$(".storeclass").show();
		$(".customerclass").hide();
		$("#customeriddname").hide();
		$("#emptyiddd").hide();
	}else{
		$(".customerclass").hide();
		$("#customeriddname").hide();
		$(".storeclass").hide();
		$("#emptyiddd").show();
	}	
		
    });
   
});
</script>
	
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

document.getElementById("soleidd").focus();

}
}

document.getElementById("soleidd").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("destextaid").focus();

}
}

document.getElementById("destextaid").onkeydown = function (e) {
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

/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;
var type_id=document.getElementById("type_id").value;
var order_dateid=document.getElementById("order_dateid").value;

if(rc!=0)
{

	if(type_id!=''){
	var valsave=1;
	}else{
	alert("Please Select Type");
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
			 var checkboxvaliidval=document.getElementById("checkboxvaliid").value;	 
			 var categoryval=document.getElementById("usunit").value;	
			 var categoryid=document.getElementById("cateidd").value;
			 var destextaid=document.getElementById("destextaid").value;	 
			  var sizeval=document.getElementById("lph").value;	 
			  var coldata=document.getElementById("sizecu").value;	  
					var sizetest=" "+sizeval;
				var sizevalues = sizetest.replace(/ /g,' | ');
				
				var sizevaluessplit = sizeval.split(' ');
				
				 var catevalue = Array.prototype.filter.call( document.getElementById("catygoryidd").options, el => el.selected).map(el => el.value).join(",");
				 
				var catename=Array.prototype.filter.call(document.getElementById('catygoryidd').options, el => el.selected).map(el => el.innerHTML).join(",");
				
				var solevalue = document.getElementById("soleidd").value;
				if(solevalue!=''){
				var e = document.getElementById("soleidd");
				var solename= e.options[e.selectedIndex].text;
				}else{
				var solename='';
				}
				 //var solevalue = Array.prototype.filter.call( document.getElementById("soleidd").options, el => el.selected).map(el => el.value).join(",");
				
				//var solename=Array.prototype.filter.call(document.getElementById('soleidd').options, el => el.selected).map(el => el.innerHTML).join(",");
									
				var categoryidsplit = catevalue.split(',');

				var categoryidcount=categoryidsplit.length;
				
				var soleidsplit = solevalue.split(',');

				var soleeeidcount=soleidsplit.length;
				
				var taxonandsolemap=catevalue+','+solevalue;
				
				var sum=0;	
			for(i=0;i<coldata;i++)
				{				
				var dm=document.getElementById("demo"+i).value;
				var str=str+" | "+dm;			
				var sum=Number(sum)+Number(dm);
				
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
			element2.style.border="hidden"; 
			element2.className="form-control";
			element2.style="background: #ffff;border:none;";
			cell3.appendChild(element2);
			
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.value=itemval;			
			element21.readOnly = true;
			element21.name = "item_id[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);
			
			var catename = catename.split(',');
			
			var solenameget = solename.split(',');
			//alert(categoryidcount);
		for(var i=0;i<categoryidcount;i++){
				
				if(catename[i]=='----Select ----'){
				
				}else{	
			
			var element212 = document.createElement("input");
			element212.type = "text";
			element212.value=catename[i];			
			element212.readOnly = true;
			element212.name = "catename[]";
			element212.style="padding:0 0 0 66px;font-size: 14px;"
			element212.style.border="hidden"; 
			cell3.appendChild(element212);
			cell3.appendChild(document.createElement("br"));	
			}
		}	
		
		
		for(var si=0;si<soleeeidcount;si++){
				
				if(solenameget[si]=='----Select ----'){
				
				}else{	
			
			var element212 = document.createElement("input");
			element212.type = "text";
			element212.value=solenameget[si];			
			element212.readOnly = true;
			element212.name = "solename[]";
			element212.style="padding:0 0 0 66px;font-size: 14px;"
			element212.style.border="hidden"; 
			cell3.appendChild(element212);
			cell3.appendChild(document.createElement("br"));	
			}
		}		
			
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
			element21.value=taxonandsolemap;			
			element21.readOnly = true;
			element21.name = "categorysoletype[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);
<!--==========================================================-->

var cell411 = row.insertCell(1);
			var element311 = document.createElement("textarea");
			element311.value=destextaid;
			element311.type = "text";
			element311.readOnly = true;
			element311.style="background: #ffff;border:none;";
			element311.className="form-control"
			element311.name = "desc_name[]";
			cell411.appendChild(element311);
			
var cell4 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.value=categoryval;
			element3.type = "text";
			element3.readOnly = true;
			element3.style="background: #ffff;border:none;";
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

var cell5 = row.insertCell(3);
 cell5.setAttribute("style", "width: 370px!important;float: left;overflow-y: auto;overflow-x: scroll;");

var x = document.createElement("TABLE");
    x.setAttribute("id", "myTable"+rowcountsat);
    cell5.appendChild(x);

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

			var element8 = document.createElement("input");
			element8.value= sizevaluessplit[j];
			element8.style = "width: 64px;margin: 10px; background: #ffff;border:none;";
			element8.type = "hidden";
			element8.readOnly = true;
			element8.className="form-control form-control-m"
			element8.name = "siz[]";
			cell5.appendChild(element8);

	 var y = document.createElement("TR");
    y.setAttribute("id", "myTr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(y);

			
	var z = document.createElement("TD");
	 z.setAttribute("style", "text-align: center");
    var t = document.createTextNode(sizevaluessplit[j]);
    z.appendChild(t);
    document.getElementById("myTr"+rowcountsat).appendChild(z);
			
}

cell5.appendChild(document.createElement("br"));	
				
for(var k=1; k<=coldata;k++){
			
var element8 = document.createElement("input");
			element8.value= qtysplite[k];
			element8.style = "width: 64px;margin: 10px; background: #ffff;border:none;";
			element8.type = "hidden";
			element8.readOnly = true;
			element8.className="form-control form-control-m"
			element8.name = "siz[]";
			cell5.appendChild(element8);

     var yrr = document.createElement("TR");
    yrr.setAttribute("id", "myTrr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(yrr);
		
  var zr = document.createElement("TD");
   zr.setAttribute("style", "text-align: center");
    var tr = document.createTextNode(qtysplite[k]);
    zr.appendChild(tr);
    document.getElementById("myTrr"+rowcountsat).appendChild(zr);			

}

var cell6 = row.insertCell(4);
			var element5 = document.createElement("input");
			element5.value= sum;
			element5.type = "text";
			element5.readOnly = true;
			element5.style="background: #ffff;border:none;";
			element5.name = "total_value[]";
			element5.className="form-control"
			cell6.appendChild(element5);


var cell7 = row.insertCell(5);
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
document.getElementById("destextaid").value='';
document.getElementById("usunit").value='';
document.getElementById("catygoryidd").value='';
document.getElementById("soleidd").value='';
document.getElementById("checkboxidd").checked = false;
document.getElementById("checkboxidd").style.display = "none";
document.getElementById("checkboxvaliid").value ='0';
document.getElementById("sizecu").value='';
document.getElementById("notactionid").value=1;
addrowandqty();
}		

	</SCRIPT>
</form>
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>
<script>
function customerInsertFun(){                 

var customerName=document.getElementById("first_name").value;
var contact_person=document.getElementById("contact_person").value;
var email=document.getElementById("email").value;
var mobile=document.getElementById("mobile").value;
var smobile=document.getElementById("smobile").value;
var phone=document.getElementById("phone").value;
var tin_no=document.getElementById("gstin").value;
var contact_code=document.getElementById("contact_code").value;
var add_opening_balancename=document.getElementById("add_opening_balancename").value;
var add_opening_balance=document.getElementById("add_opening_balance").value;
var term=document.getElementById("term").value;
var state=document.getElementById("state").value;
var address1=document.getElementById("address1").value;
var address3=document.getElementById("address3").value;
var note=document.getElementById("note").value;
//var mstatus=document.getElementById("Ragarpura_name").value;
//alert(contact_person);

    
   $.ajax({
                type: 'POST',
                url: 'insert_contact',
                 data: { first_name : customerName, contact_person : contact_person, email : email, mobile : mobile, smobile : smobile, phone : phone, tin_no : tin_no, contact_code : contact_code, add_opening_balancename : add_opening_balancename, add_opening_balance : add_opening_balance, term : term, state : state, address1 : address1, address3 : address3, note : note },
                success: function (result) {
                    //Your success code here..
					//alert(result);
					//location.reload();
                },
                error: function (jqXHR) {                        
                    if (jqXHR.status === 200) {
                        alert("Value Not found");
                    }
                }
            });
		
}
</script>
<script>
    $('.modalEditcontact').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"updateContactNat?ID="+ID,cache:true,success:function(result){
            $(".modal-contenttt").html(result);
        }});
    });
</script>	

<?php
$this->load->view("footer.php");
?>

