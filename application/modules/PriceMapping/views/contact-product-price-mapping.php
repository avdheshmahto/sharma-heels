<?php
$this->load->view("header.php");
?>
<?php
    $conidget=$_GET['id'];
	$exp=explode('^',$conidget);
	 $ID=$exp[0];
	 $locname=$exp[1];
 $querycon=$this->db->query("select * from tbl_contact_m where status='A' and contact_id='$ID'");	  
 $fetchlistcon=$querycon->row();

?>  
<form id="f1" name="f1" method="POST" action="insertSalesOrder" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
	<div class="main-content">
		<div class="row">
<div class="col-sm-4">		
		<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li class="active"><strong>Price Mapping</strong></li>
<li class="active"><strong>Mapping</strong></li>
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

<div class="col-sm-2 breadcrumb breadcrumb-2">
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE" id="sv1" onclick="fsv(this)">
<input class="btn btn-secondary btn-sm" onclick="return quitBox('quit');" type="button" value="Cancel">
</div>
</div>
</div> 

			<div class="row">
				<div class="col-lg-12">
					<div>
						
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Customer Name</th>
<th>
<input type="hidden" name="customer_id" value="<?php echo $ID; ?>" class="form-control" style="width:100px;"  />
<input type="hidden" name="location_name" id="location_name" value="<?php echo $locname; ?>" class="form-control" style="width:100px;"  />
<?php echo $fetchlistcon->first_name;?></th>
<th>Set Credit Limit</th>
<th>
<?php if($fetchlistcon->credit_limit!=''){ ?>
<input type="number" name="" value="<?php echo $fetchlistcon->credit_limit; ?>" class="form-control" style="width:100px;" readonly  />
<?php }else{ ?>
<input type="number" name="credit_limit" value="" class="form-control" style="width:100px;"  />
<?php } ?>
</th>
<th style="width:115px;">Term</th>
<th style="width:170px;"><?php echo $fetchlistcon->term; ?>
&nbsp;
<?php
if($fetchlistcon->term!=''){ echo "Days"; } ?></th>
</tr>
</tbody>
</table>
<h6></h6>	  
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>Product Name</th>
<th>Category Name</th>
<th>New Price</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd"  onkeyup="getdata()" onClick="getdata()" id="prd" class="form-control" style=" width:230px;"  placeholder=" Search Items..." tabindex="5" >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
  <input type="hidden"  name="" id='cate_id'  value="" style="width:80px;"  />
</div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
//include("getproduct.php");
$this->load->view('getproduct');

?>
</div></th>
<th>
<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"></th>

<th><input type="number" id="qn" min="1" style="width:100px;"   class="form-control"></th>

</tr>
</tbody>
</table>
</div>

<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid " id="m">
<table id="invoice" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>S.No.</u></div></td>
<td style="width:11%;"><div align="center"><u>Product Name</u></div></td>
<td style="width:3%;"> <div align="center"><u>Category Name</u></div></td>
<td style="width:3%;"><div align="center"><u>Price</u></div></td>

<td style="width:3%; display:none"> <div align="center"><u>Action</u></div></td>
</tr>
</table>

</div>
<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />
<h6></h6>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">

<tbody>

<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE" id="sv1" onclick="fsv(this)">
<input class="btn btn-secondary btn-sm" onclick="return quitBox('quit');" type="button" value="Cancel">
</div>
</tbody>
</table>
</div>
<h6></h6>
<div class="row">
				<div class="col-lg-12">
					<div>
						
<div class="panel-body">
<div class="table-responsive---">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>	
		<th>S. No.</th>
	    <th>Product Name</th>
        <th>Category Name</th>
		<th>Price</th>
		<th>Action</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
 
  $query=$this->db->query("select * from tbl_contact_product_price_mapping where status='A' and contact_id='$ID' and location_name='$locname'");	       

  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->id; ?>">
<th><?=$i;?></th>
<th>
<?php 

$querypro=$this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->product_id'");	
$fetchpro=$querypro->row();
echo $fetchpro->productname;
 ?></th>

<th>
<?php 
$querycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$fetch_list->catg_id'");	
$fetchcate=$querycate->row();

echo $fetchcate->prodcatg_name;
 ?></th>
<th><?php echo $fetch_list->price; ?></th>
<th style="width:20%">

<button class="btn btn-sm modalEditContact" onclick="EditcontactPrice('<?php echo $fetch_list->id;?>')" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>Update Price</button>

</th>

</tr>
<?php $i++; } ?>
</tbody>
</table>
</form>
<form class="form-horizontal" role="form" method="post" action="updateprice" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="contentedit">

        </div>
    </div>	 
</div>
</form>
<script>
function EditcontactPrice(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "EditPriceMap?ID="+v, false);
 xhttp.send();
 document.getElementById("contentedit").innerHTML = xhttp.responseText;
}
</script>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<script language="javascript">

function quitBox(cmd) 
{      
    if (cmd=='quit')    
    {
       open(location, '_self').close();    
    }     
    return false;   
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


document.getElementById("tyd"+n).onkeyup  = function (e) {
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

document.getElementById("qn").focus();
}
}


document.getElementById("qn").onkeyup = function (e) {
var entr =(e.keyCode);
if(document.getElementById("qn").value=="" && entr==08){

}
   if (e.keyCode == "13")
	 {
	
	 e.preventDefault();
     e.stopPropagation();
	
	  if(ppp!=='' || ef==1)
	 {

	
			adda();	  	
			
				
		var ddid=document.getElementById("spid").value;
		var ddi=document.getElementById(ddid);
		ddi.id="d";
		
			}
	       else
			{
	   alert("Enter Correct Product");
			}
		return false;
    }
	}
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
		 var location_name=document.getElementById("location_name").value;	 
		 var product=product1+'^'+location_name;
				
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
  
////////////////////////////////////////////////////

 function slr(){
		var table = document.getElementById('invoice');
        var rowCount = table.rows.length;
		  for(var i=1;i<rowCount;i++)
		  {    
              table.rows[i].cells[0].innerHTML=i;
		  }
			 
}  


     var rw=0;
	 
 function adda()
		  { 
		 	 
				//alert("hello");
				var qn=document.getElementById("qn").value;
				var unit=document.getElementById("usunit").value;
				var cate_id=document.getElementById("cate_id").value;
	
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
             				clear();
				
					 currentCell = 0;
	if(pd!="" && qn!=0)
					{
				     var indexcell=0;
								var row = table.insertRow(-1);
						rw=rw+0;
						
						//cell 0st
	 var cell=cell+indexcell;		
 	 cell = row.insertCell(0);
	 cell.style.width=".20%";
	 cell.align="center"
	cell.innerHTML=rid;
				
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
			
	    cell = row.insertCell(indexcell);
				cell.style.width="11%";
				cell.align="center";
				
				//============================item text ============================
				var prd = document.createElement("input");
							prd.type="text";
							prd.border ="0";
							prd.value=pd;	
							prd.name='pd[]';//
							prd.id='pd'+rid;//
							prd.readOnly = true;
							prd.style="text-align:center";  
							prd.style.width="100%";
							prd.style.border="hidden"; 
							cell.appendChild(prd);
				var priidid = document.createElement("input");
							priidid.type="hidden";
							priidid.border ="0";
							priidid.value=pri_id;	
							priidid.name='main_id[]';//
							priidid.id='main_id'+rid;//
							priidid.readOnly = true;
							priidid.style="text-align:center";  
							priidid.style.width="100%";
							priidid.style.border="hidden"; 
							cell.appendChild(priidid);
							
							
							var unitt = document.createElement("input");
							unitt.type="hidden";
							unitt.border ="0";
							unitt.value=cate_id;	
							unitt.name='cate_id[]';//
							unitt.id='cate_id'+rid;//
							unitt.readOnly = true;
							unitt.style="text-align:center";  
							unitt.style.width="100%";
							unitt.style.border="hidden"; 
							cell.appendChild(unitt);
					
						// ends here
	
	
	//#################cell 2nd starts here####################//
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var salepr = document.createElement("input");
							salepr.type="text";
							salepr.border ="0";
							salepr.value=unit;	    
							salepr.name ='unit[]';
							salepr.id='unit'+rid;
							salepr.readOnly = true;
							salepr.style="text-align:center";
							salepr.style.width="100%";
							salepr.style.border="hidden"; 
							cell.appendChild(salepr);
	
	
		//==============================close 2nd cell =========================================
		
		//#################cell 3rd starts here####################//					
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start qnty===================================	
				var qtty = document.createElement("input");
							qtty.type="text";
							qtty.border ="0";
							qtty.value=qn;	    
							qtty.name ='new_price[]';
							qtty.id='qnty'+rid;
							qtty.readOnly = true;
							qtty.style="text-align:center";
							qtty.style.width="100%";
							qtty.style.border="hidden"; 
							cell.appendChild(qtty);
								
		//======================================close 3rd cell========================================
		
		
		//cell 3st
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
	var imageloc="/mr_bajaj/";
	var cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.style.display="none";
				cell.align="center";
				var delt =document.createElement("img");
						delt.src ="<?=base_url();?>assets/images/delete.png";
						delt.class ="icon";
						delt.border ="0";
						delt.style.width="30%";
						delt.style.height="20%";
						delt.name ='dlt';
						delt.id='dlt'+rid;
						delt.style.border="hidden"; 
						delt.onclick= function() { deleteselectrow(delt.id,delt); };
					    cell.appendChild(delt);
	var edt = document.createElement("img");
						edt.src ="<?=base_url();?>/assets/images/edit.png";
						edt.class ="icon";
						edt.style.width="60%";
						edt.style.height="40%";
						edt.border ="0";
						edt.name ='ed';
						edt.id='ed'+rid;
						edt.style.border="hidden"; 
						edt.onclick= function() { editselectrow(delt.id,edt); };
						cell.appendChild(edt);
			

			
			}
			else
			{
			if(qn==0)
				{
					alert('***Quantity Can not be Zero ***');
					
					
				}
				else
				{
				
			alert('***Please Select PRODUCT ***');
			
			}
			}

function clear()
{

// this finction is use for clear data after adding invoice
		document.getElementById("prd").value='';
		document.getElementById("usunit").value='';
		document.getElementById("qn").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("cate_id").value='';
		document.getElementById("prd").focus();	
		
		
}


////////////////////////////////// starts edit code ////////////////////////////////


function editselectrow(d,r) //modify dyanamicly created rows or product detail
 {
 
var regex = /(\d+)/g;
nn= d.match(regex)
id=nn;
if(document.getElementById("prd").value!=''){
document.getElementById("qn").focus();
alert("Product already in edit Mode");
return false;
}


// ####### starts ##############//
var pd=document.getElementById("pd"+id).value;
		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var lph=document.getElementById("lph"+id).value;
		
		var pri_id=document.getElementById("main_id"+id).value;
// ####### ends ##############//

// ####### starts ##############//
document.getElementById("pri_id").value=pri_id;
document.getElementById("qn").focus();
document.getElementById("prd").value=pd;
document.getElementById("usunit").value=unit;
document.getElementById("qn").value=qn;


// ####### ends ##############//
editDeleteCalculation();

    var i = r.parentNode.parentNode.rowIndex;
	document.getElementById("invoice").deleteRow(i);
}

////////////////////////////////// ends edit code ////////////////////////////////


////////////////////////////////// starts delete code ////////////////////////////////

function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
 {
 
var regex = /(\d+)/g;

nn= d.match(regex)
	id=nn;
	if(document.getElementById("prd").value!=''){
 		document.getElementById("qn").focus();
     alert("Product already in edit Mode");
return false;
}


		var pd=document.getElementById("pd"+id).value;
		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var lph=document.getElementById("lph"+id).value;
		
		var pri_id=document.getElementById("main_id"+id).value;

	    var i = r.parentNode.parentNode.rowIndex;
     var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
if (cnf== true)
 {
 document.getElementById("invoice").deleteRow(i);
  slr();
  
 editDeleteCalculation();
	serviceChargeCal();	
	grossDiscountCal();
	}
	
	}
////////////////////////////////// ends delete code ////////////////////////////////


function totalSum(){

var subb=document.getElementById("sub_total").value;
			var tol=(Number(nettot));
			var total=Number(tol)+Number(subb);
	
			document.getElementById("sub_total").value=total.toFixed(2);
			document.getElementById("grand_total").value=total.toFixed(2);	

}

// ###### starts when item we edit or delete ##########//
function editDeleteCalculation()
{
var sub_total=document.getElementById("sub_total").value;

sub_total_cal=sub_total-nettot;
document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
document.getElementById("grand_total").value=sub_total_cal.toFixed(2);
}
// ##### ends ###########

   }

// ###### starts service charge calculation ##########//
function serviceChargeCal()
{

var sub_total=document.getElementById("sub_total").value;
var service_charge=document.getElementById("service_charge").value;

service_total_per=Number(sub_total)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

document.getElementById("service_charge_total").value=service_total_per.toFixed(2);
document.getElementById("grand_total").value=service_total_cal.toFixed(2);
return service_total_cal.toFixed(2);
}
// ##### ends ###########
  

// ###### starts gross discount calculation ##########//
function grossDiscountCal()
{

var serviceTotl=serviceChargeCal();

var gross_discount_per=document.getElementById("gross_discount_per").value;
var gross_discount_total=document.getElementById("gross_discount_total").value;
var grand_total=document.getElementById("grand_total").value;


service_total_per=Number(serviceTotl)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

var totalGross=Number(serviceTotl)*Number(gross_discount_per)/100;
var totalGrossCal=Number(grand_total)-Number(totalGross);

document.getElementById("gross_discount_total").value=totalGross.toFixed(2);
document.getElementById("grand_total").value=totalGrossCal.toFixed(2);
}
// ##### ends ###########

</script>
</form>
<?php
$this->load->view("footer.php");
?>

