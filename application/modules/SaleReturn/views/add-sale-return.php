
<?php
$this->load->view("header.php");
?>
<form id="f1" name="f1" method="POST" action="insertsalereturn" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">

<div class="row">
<div class="col-sm-4">		
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">National</a></li> 
<li class="active"><strong>Add Sale Return</strong></li>
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
<a href="manageSaleReturn"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
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
<th class="customerclass">Customer Name</th>
<th class="customerclass">
<select name="customer_id" id="customer_id"  class="form-control ui fluid search dropdown email">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php } ?></select>

</th>
<th class="storeclass">Store</th>
<th class="storeclass">
<select name="store_id" id="store_id" class="form-control ui fluid search dropdown location">
						<option value="">----Select ----</option>
					<?php 
						$sqlloc=$this->db->query("select * from tbl_location");
						foreach ($sqlloc->result() as $fetchloc){						
					?>					
    <option value="<?php echo $fetchloc->id; ?>"><?php echo $fetchloc->location_name; ?></option>

    <?php } ?></select>
</th>
<th>Date</th>
<th><input type="text" name="return_date" id="order_dateid" class="datepicker" width="280" value="<?php echo date('d/m/Y'); ?>" /></th>
</tr>
</tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".customerclass").hide();
	$(".storeclass").hide();
    $("#type_id").click(function(){
      var val=$("#type_id").val();
	if(val=='Customer'){
		$(".customerclass").show();
		$(".storeclass").hide();
	}else if(val=='Store'){		
		$(".storeclass").show();
		$(".customerclass").hide();
	}else{
		$(".customerclass").hide();
		$(".storeclass").hide();
	}	
		
    });
   
});
</script>
</div>
<div class="row">
<div class="col-sm-6">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th style="width: 225px;">Item Name</th>
<th style="width: 125px;">Category</th>
<th style="width: 125px;">Price</th>
</tr>

<tr class="gradeA">
<th>
<div class="input-group"> 
 <div>
 <input type="text" name="prd"  onkeyup="getdata();addrowandqty()" onClick="getdata();addrowandqty()"  id="prd" class="form-control" placeholder="Search Items..." >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" />
 
 <input type="hidden"  name="cateidd" id='cateidd'  value=""/>
 <input type="hidden"  name="" id='enteridvalidtion'  value=""/>
 </div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
$this->load->view('getproduct');
?>
</div>
</th>
<th><input type="text" readonly="" id="usunit" style="width:90px;" class="form-control"></th>
<th><input type="text" id="priceid" style="width:90px;" class="form-control"></th>

<th style="display:none">
<b><input type="hidden" style="border:none" id="lpr" value="" readonly /></b>
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
<div class="col-sm-6">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>


<tr class="gradeA">
<th>Size</th>
<th>Sale Qty</th>
<th>Quantity</th>

</tr>

<tr class="gradeA">
	<td><input type="number" step="any" name="" class="form-control" value="" /></td>
		<td><input type="number" step="any" name="" class="form-control" value="" /></td>
	<td><input type="number" step="any"  name="" class="form-control" value="" /></td>
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
 var totaleff=Number(actqty)+Number(entqty);
 document.getElementById("effqty"+id).value=totaleff; 
 
				document.getElementById("demo"+id).value=entqty;	

	}
	
function entertest(){ 
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getsizecounttest", false);
  xhttp.send();
  document.getElementById("sizeandqtytesta").innerHTML = xhttp.responseText;
}

</script>

<div class="table-responsive">
<h5>View Item</h5>
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Qty</th>
<th>Price</th>
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
<a href="manageSaleReturn"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
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
document.getElementById("usunit").focus();
document.getElementById("prdsrch").innerHTML=" ";
addrowandqty();
}
}
}

document.getElementById("usunit").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("priceid").focus();

}
}


document.getElementById("priceid").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("qty1").focus();

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

if(rc!=0)
{
v.type="submit";
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
		  var itement=document.getElementById("enteridvalidtion").value;
		  var type_id=document.getElementById("type_id").value;  
		  var custid=document.getElementById("customer_id").value;
		  var storeid=document.getElementById("store_id").value;	
		  if(type_id=='Customer'){
		  		var typecustidd=custid;
		  }else if(type_id=='Store'){		  
		   		var typecustidd=storeid;
		  }else{
		  		var typecustidd='';
		  }
		  //alert(typecustidd);
		   if(custid=='' && storeid==''){
		   		alert("Please Select Customer Name / Store");
		   }else{
		   	 
		 var product=product1+'^'+itement+'^'+typecustidd+'^'+type_id;
		
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
		  }
  

</script>
<SCRIPT language="javascript">
				var fruits = [];
				document.getElementById("enteridvalidtion").value= fruits;
		function addRow(tableID) {
				
			var table = document.getElementById(tableID);
			
			var rows=document.getElementById("rows").value;
			var rid =Number(rows)+1;
			document.getElementById("rows").value=rid;

			fruits.push(document.getElementById("pri_id").value);                   
			document.getElementById("enteridvalidtion").value = fruits;

			 var productval=document.getElementById("prd").value;
			 var itemval=document.getElementById("pri_id").value;	 
			 var categoryval=document.getElementById("usunit").value;
			  var priceiddd=document.getElementById("priceid").value;	
			 var categoryid=document.getElementById("cateidd").value;	 
			  var sizeval=document.getElementById("lph").value;	 
			  var coldata=document.getElementById("sizecu").value;	  
					var sizetest=" "+sizeval;
				var sizevalues = sizetest.replace(/ /g,' | ');
				
				var sizevaluessplit = sizeval.split(' | ');
				//var aaj=console.log(sizevalues.split(" | "));
				//alert(sizevaluessplit[0].length); 
				
				var sum=0;	
				var sumeff=0;
			for(i=1;i<coldata;i++)
				{				
				var dm=document.getElementById("demo"+i).value;
				var effqty=document.getElementById("effqty"+i).value;
				var str=str+" "+dm;					
				var sum=Number(sum)+Number(dm);
				//alert(dm);
				var streff=streff+" "+effqty;
				
				var str = str;
				var cntlenght=str.length; 
				var res = str.slice(9, cntlenght);
				
				var cntlenghteff=streff.length; 
				var totaleff = streff.slice(9, cntlenghteff);
			
				}

			document.getElementById("demottt").value=res;	
			
			//var qtysplitesum=res;
			var qtysplite=res.split(" ");
			//alert(qtysplite[1].length);
			
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var rowcountsat=rowCount+1;
			
			
			var cell3 = row.insertCell(0);
			var element2 = document.createElement("input");
			element2.value=productval;
			element2.type = "text";
			element2.style="background: #ffff;border:none;";
			element2.readOnly = true;
			element2.name = "item_name[]";
			element2.className="form-control";
			cell3.appendChild(element2);
			
			var element21 = document.createElement("input");
			element21.type = "hidden";
			element21.id = 'itemvalid'+rowcountsat;
			element21.value=itemval;			
			element21.readOnly = true;
			element21.name = "item_id[]";
			element21.style.border="hidden"; 
			cell3.appendChild(element21);

			
var cell4 = row.insertCell(1);
			var element3 = document.createElement("input");
			element3.value=categoryval;
			element3.type = "text";
			element3.style="background: #ffff;border:none;";
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


		cell5.setAttribute("style", "width: 370px!important;float: left;overflow-y: auto;overflow-x: scroll;");

var x = document.createElement("TABLE");
    x.setAttribute("id", "myTable"+rowcountsat);
    cell5.appendChild(x);

//============================================================= 		
			var element4 = document.createElement("input");
			element4.value= sizeval;
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
//=============================================================

for(var j=1; j<coldata;j++){

			var element8 = document.createElement("input");
			element8.value= sizevaluessplit[j];
			element8.style = "width: 50px;margin: 10px;";
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
				
for(var k=1; k<coldata;k++){
			
var element8 = document.createElement("input");
			element8.value= qtysplite[k];
			element8.style = "width: 50px;margin: 10px;";
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


var cell6 = row.insertCell(3);
			var element5 = document.createElement("input");
			element5.value= sum;
			element5.type = "text";
			element5.style="background: #ffff;border:none;";
			element5.readOnly = true;
			element5.name = "total_qty_value[]";
			element5.className="form-control"
			cell6.appendChild(element5);

var cell411 = row.insertCell(4);
			var element311 = document.createElement("input");
			element311.value=priceiddd;
			element311.type = "text";
			element311.style="background: #ffff;border:none;";
			element311.readOnly = true;
			element311.className="form-control"
			element311.name = "pricename[]";
			cell411.appendChild(element311);


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
					
					var fruitss=document.getElementById('enteridvalidtion').value;
                                        
                    var fruits = JSON.parse("[" + fruitss + "]");


                   fruits.splice(Number(i-1),1);
    
    				 var result = confirm("Are you sure you want to delete item?");
					if (result) {
										  
						document.getElementById('dataTable').deleteRow(i);
						//document.getElementById("enteridvalidtion").value = fruits;
					}
        			
		}

		
		
function clear(){
document.getElementById("prd").value='';
document.getElementById("prd").focus();
document.getElementById("usunit").value='';
document.getElementById("priceid").value='';
document.getElementById("sizecu").value='';
document.getElementById("notactionid").value=1;
addrowandqty();
}		

</SCRIPT>
</form>
<form class="form-horizontal" role="form" method="post" action="insert_item" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>
<script>
    $('.modalEditcontact').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"updateItemNat?ID="+ID,cache:true,success:function(result){
            $(".modal-contenttt").html(result);
        }});
    });
</script>
<script>
function rowAddform(tableID){
	
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.name="chkbox[]";
			cell1.appendChild(element1);
				

var cell4 = row.insertCell(1);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.style = "width: 100px";
			element3.className="form-control";
			element3.name = "size[]";
			cell4.appendChild(element3);


var cell5 = row.insertCell(2);
			var element4 = document.createElement("input");
			element4.type = "number";
			element4.step = "any";
			element4.style = "width: 100px";
			element4.className="form-control"
			element4.name = "weightname[]";
			cell5.appendChild(element4);
		
}

function editDeleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

</script>
<script>
	 function GetFileSize() {	 	
        var fi = document.getElementById('file'); // GET THE FILE INPUT.
	    // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.		
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.				
				var tsize = Math.round((fsize / 1024));				
				if(Number(tsize) < 12)				{
					document.getElementById("error").style.display= "none";
					document.getElementById("sv1").disabled = false;					
				}
					else{
							document.getElementById("error").style.display = "";
							document.getElementById("sv1").disabled = true;
						}				
                //document.getElementById('fp').innerHTML = document.getElementById('fp').innerHTML + '<br /> ' +  '<b>' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
	
	
	 function GetFileSizeto() {
	 	
        var fi = document.getElementById('fileid'); // GET THE FILE INPUT.
        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.			
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.				
				var tsize = Math.round((fsize / 1024));	
				if(Number(tsize) < 12)
				{
					document.getElementById("error1").style.display= "none";
					document.getElementById("sv11").disabled = false;					
				}
					else{
							document.getElementById("error1").style.display = "";
							document.getElementById("sv11").disabled = true;
						}				
                //document.getElementById('fp').innerHTML = document.getElementById('fp').innerHTML + '<br /> ' +  '<b>' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }

</script>

<?php
$this->load->view("footer.php");
?>

