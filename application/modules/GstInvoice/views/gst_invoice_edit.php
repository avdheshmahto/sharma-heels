<?php
$this->load->view("header.php");

$upid=$_GET['id'];

   	$EditQry=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='$upid'");
   	$editResult =  $EditQry->row();
 	
	$Qry=$this->db->query("select * from tbl_gst_invoice_dtl where inv_id='$upid'");
 	$dispQry=$Qry->result();
		
?>

<form id="f1" name="f1" method="POST" action="editgstinvoice" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
	<div class="main-content">
	<a class="page-title" style="padding: 0 0 0 400px;font-size: 20px;">EDIT GST INVOICE </a>

			<div class="row">
				<div class="col-lg-12">
					<div>
						
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Firm</th>
        <th> <select  name="firmid" id="" class="form-control">
            <option value="">----Select ----</option>
			<?php 
		$query1=$this->db->query("select * from tbl_master_data where param_id=25");
		foreach($query1->result() as $que){
			
			?>
			<option value="<?=$que->serial_number;?>" <?php if($editResult->firm_id==$que->serial_number){?>  selected="selected" <?php }?>><?=$que->keyvalue;?></option>
			<?php } ?>
          </select>
        </th>
        <th>Date</th>
        <th style="width:140px;"><input type="text" name="currentdate_id" id="" class="form-control datepicker" width="215"  value="<?php echo $editResult->inv_date; ?>"/></th>
        <th>Invoice No.</th>
        <th style="width:150px;" id="termidd"><input type="text" name="invoice_id" id="invoice_id" class="form-control" value="<?=$editResult->invoice_no;?>"/></th>
</tr>
<th>
<input type="hidden" name="customer_id" value="<?php echo $ID; ?>" class="form-control" style="width:100px;"  />
<input type="hidden" name="location_name" id="location_name" value="<?php echo $locname; ?>" class="form-control" style="width:100px;"  />
</th>
<input type="hidden" name="myupid" id="myupid" value="<?=$_GET['id'];?>" />
<tr class="gradeA">
<th>*Customer Name</th>
<th>
<select  name="customer_id" id="customer_id" class="form-control" required>
						<option value="">----Select ----</option>
<?php
$query=$this->db->query("select * from tbl_contact_m");
$qu=$query->result();
foreach($qu as $q)
{
?>
<option value="<?=$q->contact_id?>" <?php if($editResult->customer_name==$q->contact_id){?>  selected="selected" <?php }?>><?=$q->first_name?></option>

<?php }?>
</select>
</th>				

<th style="width:100px" colspan="4">&nbsp;</th>

</tr>

</tbody>
</table>
<h6></h6>	  
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>Category</th>
<th>Qty</th>
<th>Rate</th>
<th>GST Percent</th>
<th>Amount</th>
<th>GST</th>
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
<input type="number" id="qty" style="width:100px;" class="form-control"></th>

<th><input type="number" id="rate" min="1" style="width:100px;"   class="form-control"></th>

<th><input type="number" id="gst_percent" style="width:100px;" class="form-control"  /> </th>

<th><input type="number" id="amount" style="width:100px;" class="form-control" readonly=""/> </th>

<th><input type="number" id="gst" style="width:100px;" class="form-control" readonly=""/> </th>
</tr>
</tbody>
</table>
</div>

<!--=============================================================================================================
-->
<div class="table-responsive">
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000;" id="tableinvoice">
<table id="invoice2" style="width:100%;background: #fff;height:70%;border: 1px solid #e3ebf4;" title="Invoice">
<tr>
<td style="width:3%;"><div align="center"><u>Sno.</u></div></td>
<td style="width:3%;"><div align="center"><u>Category</u></div></td>
<td style="width:3%;"><div align="center"><u>Qty</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rate</u></div></td>
<td style="width:3%;"><div align="center"><u>GST Percent</u></div></td>
<td style="width:11%;"><div align="center"><u>Amt</u></div></td>
<td style="width:3%;"><div align="center"><u>GST</u></div></td>

<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
<?php
$i=1;
foreach($dispQry as $disp)
	{
	$Query=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$disp->category_id'");
	$prodQuer=$Query->result();
	foreach($prodQuer as $prodQuery)
		{

?>
<tr>
<input type="hidden" name="upid_dtl" value="<?=$disp->inv_id?>" />

<td style="width:3%;"><div align="center"><?=$i;?></div>
</td>
<td style="width:3%;"><div align="center"><input type="text"  class="form-control" name="" value="<?php echo $prodQuery->prodcatg_name;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><?php echo $disp->qty;?></td>
<td style="width:3%;"><?=$disp->rate;?></td>
<td style="width:3%;"><?=$disp->gstp;?></td>
<td style="width:11%;"><div align="center"><input type="text" id="amtidd<?php $i; ?>"  class="form-control" value="<?=$disp->amt;?>" readonly="readonly" /></div></td>
<td style="width:3%;"><div align="center"><input type="text" id="gstidd<?php $i; ?>"  class="form-control" value="<?=$disp->gst;?>" readonly="true"/></div></td>
<td style="width:3%"><button class="btn btn-default modalEditcontact" data-a="<?php echo $disp->p_id;?>" href='#addItem' type="button" onclick="EditInvoiceItem('<?php echo $disp->p_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
<button class="btn btn-default" type="button" onclick="deleteinvoicedtl('<?php echo $disp->p_id;?>');" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-trash"></i></button></td>
</tr>
<?php $i++;}} ?>
<tbody id="invoice"></tbody>
</table>
</div>
</div>
<!--============================================================================================================
-->
<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />


<h6></h6>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">

<tbody>
	<tr> 
<th style="text-align:right;padding: 0 16px 0px 600px;">Total</th>
<th>
<input type="text" class="form-control" name="total" id="total" style="text-align:center; border:none; background:#FFFFFF;width:340px" readonly="true"  value="<?=$editResult->total?>"/>
</th>

<th style="display:none">
<input type="hidden" class="form-control" name="sumtot" id="sumtot" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->total;?>"/>

</th>
<th style="display:none">
<input type="hidden" class="form-control" name="sumgst" id="sumgst" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->gst_amt;?>"/>

</th>

</tr>
<tr> 
<th style="text-align:right;padding: 0 16px 0px 450px;">GST AMOUNT</th>
<th>
<input type="text" class="form-control" name="gstamt" id="gstamt" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->gst_amt?>">
</th>


</tr>
<tr> 
<th style="text-align:right;padding: 0 16px 0px 500px;">Grand Total</th>
<th>
<input type="text" class="form-control" name="grandtotal" id="grandtotal" style="text-align:center; border:none; background:#FFFFFF;" readonly="true" value="<?=$editResult->grand_total?>">
</th>
</tr>
</tbody>
</table>
</div>
<h6></h6>

<div class="col-sm-2 breadcrumb breadcrumb-2">
</div>
<div class="col-sm-12 breadcrumb breadcrumb-2">
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE" id="sv1" onclick="fsv(this)">
<a href="<?=base_url();?>GstInvoice/manage_invoice"><input class="btn btn-secondary btn-sm"  type="button" value="Cancel"></a>


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
//var qty=document.getElementById("qty").value;
var ppp=document.getElementById("prd").value;
var sspp=document.getElementById("spid").value;//
var ef=document.getElementById("ef").value;
		ef=Number(ef);
		
var countids=document.getElementById("countid").value;

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup  = function (e) {
var entr =(e.keyCode);
var catp=document.getElementById("prd").value;
if(entr==13 && catp!=''){
document.getElementById("qty").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("qty").onkeyup = function (e) {
var qty=document.getElementById("qty").value;
var entr =(e.keyCode);
if(entr==13 && qty!=''){

document.getElementById("rate").focus();
}
}

document.getElementById("rate").onkeyup = function (e) {
var rate=document.getElementById("rate").value;
var entr =(e.keyCode);
if(entr==13 && rate!=''){
autoamt();
document.getElementById("gst_percent").focus();
}
}

document.getElementById("gst_percent").onkeyup = function (e) {
var gstp=document.getElementById("gst_percent").value;
var entr =(e.keyCode);
if(entr==13 && gstp!=''){
autogst();
document.getElementById("amount").focus();
}
}


document.getElementById("amount").onkeyup = function (e) {
var amt=document.getElementById("amount").value;
var entr =(e.keyCode);
if(entr==13 && amt!=''){

document.getElementById("gst").focus();
}
}


document.getElementById("gst").onkeyup = function (e) {
var entr =(e.keyCode);
var gstam=document.getElementById("gst").value;
if(document.getElementById("gst").value=="" && entr==08){

}
   if (e.keyCode == "13" && gstam!='')
	 {
	
	 e.preventDefault();
     e.stopPropagation();
	
	  if(ppp!=='' || ef==1)
	 {

			
			adda();
			totals();
				  	
			
				
		var ddid=document.getElementById("spid").value;
		var ddi=document.getElementById(ddid);
		ddi.id="d";
		
			}
	    /*   else
			{
	   alert("Enter Correct Product");
			}*/
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
function autoamt()
	{
		var rate=document.getElementById("rate").value;
		var qty=document.getElementById("qty").value;
		amount=Number(qty)*Number(rate);
		document.getElementById("amount").value=amount;
	}
function autogst()
	{
		var gstp=document.getElementById("gst_percent").value;
		var amt=document.getElementById("amount").value;
		gst=Number(amt)*Number(gstp/100);
		
		document.getElementById("gst").value=gst;
	}
function autoamtedit()
	{
		var rate=document.getElementById("myrate").value;
		var qty=document.getElementById("myqty").value;
		amount=Number(qty)*Number(rate);
		document.getElementById("myamount").value=amount;
		
		var amtid=document.getElementById("amtid").value;
			
		var totid=document.getElementById("totid").value;
		var ftotamt=Number(totid)-Number(amtid);
		var sumamt=Number(ftotamt)+Number(amount);
		document.getElementById("to_totid").value=sumamt;
		
		var to_gsttotid=document.getElementById("to_gsttotid").value;
		var gtotid=Number(to_gsttotid)+Number(sumamt);
		document.getElementById("to_gtotid").value=gtotid;
				
	}
function autogstedit()
	{
		var gstp=document.getElementById("mygst_percent").value;
		var amt=document.getElementById("myamount").value;
		gst=Number(amt)*Number(gstp/100);
		
		document.getElementById("mygst").value=gst;
		
		var gstid=document.getElementById("gstid").value;
		var gsttotid=document.getElementById("gsttotid").value;
		var fgst=Number(gsttotid)-Number(gstid);
		var sumgst=Number(fgst)+Number(gst);
		document.getElementById("to_gsttotid").value=sumgst;
		
		var vartotid=document.getElementById("to_totid").value;
		var gtotid=Number(vartotid)+Number(sumgst);
		document.getElementById("to_gtotid").value=gtotid;
		
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
		 	 
				
				var qty=document.getElementById("qty").value;
				var rate=document.getElementById("rate").value;
				var gstp=document.getElementById("gst_percent").value;
				var amt=document.getElementById("amount").value;
				var gst=document.getElementById("gst").value;
				var cate_id=document.getElementById("cate_id").value;
	
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
							var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					var sum=document.getElementById("sumtot").value;
					var gstto=document.getElementById("sumgst").value;
					gstto=Number(gstto)+Number(gst);
					sum=Number(sum)+Number(amt);
					//var gsts=gsts+gst;
					document.getElementById("sumtot").value=sum;
					document.getElementById("sumgst").value=gstto;
             				clear();
				
					 currentCell = 0;
	if(pd!="" && amount!=0)
					{
				     var indexcell=0;
								var row = table.insertRow(-1);
						rw=rw+0;
						
						//cell 0st
	 var cell=cell+indexcell;		
 	 cell = row.insertCell(0);
	 cell.style.width="3%";
	 cell.align="center";
	cell.innerHTML=rid;
				
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
			
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";		
				cell.align="center";
				
				//============================item text ============================
				var prd = document.createElement("input");
							prd.type="text";
							prd.border ="0";
							prd.value=pd;	
							prd.name='pd[]';//
							prd.id='pd'+rid;//
							prd.readOnly = true;
							prd.style="text-align:center;background:#dddddd";  
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
							priidid.style="text-align:center;background:#dddddd";  
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
							unitt.style="text-align:center;background:#dddddd";  
							unitt.style.width="100%";
							unitt.style.border="hidden"; 
							cell.appendChild(unitt);
					
						// ends here
	
	
	//#################cell 2nd starts here####################//
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center";
				var salepr = document.createElement("input");
							salepr.type="text";
							salepr.border ="0";
							salepr.value=qty;	    
							salepr.name ='qty[]';
							salepr.id='qty'+rid;
							salepr.readOnly = true;
							salepr.style="text-align:center;background:#dddddd";
							salepr.style.width="100%";
							salepr.style.border="hidden"; 
							cell.appendChild(salepr);
	
	
		//==============================close 2nd cell =========================================
		
		//#################cell 3rd starts here####################//					
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center";
		//========================================start qnty===================================	
				var varia = document.createElement("input");
							varia.type="text";
							varia.border ="0";
							varia.value=rate;	    
							varia.name='ratesname[]';
							varia.id='rate'+rid;
							varia.readOnly = true;
							varia.style="text-align:center;background:#dddddd";
						
							varia.style.width="100%";
							varia.style.border="hidden"; 
							cell.appendChild(varia);
				
				//------------mine gst_percent---------------------
					indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
        			cell = row.insertCell(indexcell);
					cell.style.width="3%";
					cell.align="center";
				
				var qttyq = document.createElement("input");
							qttyq.type="text";
							qttyq.border ="0";
							qttyq.value=gstp;	    
							qttyq.name ='gstp[]';
							qttyq.id='gstp'+rid;
							qttyq.readOnly = true;
							qttyq.style="text-align:center;background:#dddddd";
							qttyq.style.width="100%";
							qttyq.style.border="hidden"; 
							cell.appendChild(qttyq);

				
				//--------------mine till here				
				//------------mine gst_percent---------------------
					indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
        			cell = row.insertCell(indexcell);
					cell.style.width="11%";
					cell.align="center";
				

				var amtt = document.createElement("input");
							amtt.type="text";
							amtt.border ="0";
							amtt.value=amt;	    
							amtt.name ='amt[]';
							amtt.id='amt'+rid;
							amtt.readOnly = true;
							amtt.style="text-align:center;background:#dddddd";
							amtt.style.width="100%";
							amtt.style.border="hidden"; 
							cell.appendChild(amtt);

				
				//--------------mine till here				
//------------mine gst_percent---------------------
					indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
        			cell = row.insertCell(indexcell);
					cell.style.width="3%";
					cell.align="center";
				

				var gstr = document.createElement("input");
							gstr.type="text";
							gstr.border ="0";
							gstr.value=gst;	    
							gstr.name ='gst[]';
							gstr.id='gst'+rid;
							gstr.readOnly = true;
							gstr.style="text-align:center;background:#dddddd";
							gstr.style.width="100%";
							gstr.style.border="hidden"; 
							cell.appendChild(gstr);

				
				//--------------mine till here				



		//======================================close 3rd cell========================================
		
		
		//cell 3st
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
	var cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center";
				
			var delt = document.createElement("input");
							delt.type="button";
							delt.border ="0";
							delt.value="Delete";	    
							delt.id='dlt'+rid;
							delt.style="text-align:center;background:#dddddd";
							delt.style.width="55%";
							delt.style.height="80%";
							delt.style.border="hidden"; 
							delt.onclick= function() { deleteselectrow(delt.id,delt); };
							cell.appendChild(delt);
		
/*
			indexcell=Number(indexcell+1);		
			var cell=cell+indexcell;
			var cell = row.insertCell(indexcell);
			cell.style.width="3%";
			cell.align="center";
				
			var edt = document.createElement("input");
							edt.type="button";
							edt.border ="0";
							edt.value="Update";	    
							edt.id='dlt'+rid;
							edt.style="text-align:center";
							edt.style.width="55%";
							edt.style.height="20%";
							edt.style.border="hidden"; 
							edt.onclick= function() { deleteselectrow(edt.id,edt); };
							cell.appendChild(edt);*/

			
			}
			
function clear()
{

// this finction is use for clear data after adding invoice
		document.getElementById("prd").value='';
		document.getElementById("qty").value='';
		document.getElementById("rate").value='';
		document.getElementById("gst_percent").value='';
		document.getElementById("amount").value='';
		document.getElementById("gst").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("cate_id").value='';
		document.getElementById("prd").focus();	
		
		
}

}

function totals()
	{
		
		var sumtot=document.getElementById("sumtot").value;
		var sumgst=document.getElementById("sumgst").value;
				
		document.getElementById("total").value=sumtot;
		document.getElementById("gstamt").value=sumgst;
		var grandtotal=Number(sumtot)+Number(sumgst);
		
		
		document.getElementById("grandtotal").value=grandtotal;
	}

//=====================================================START DELETE ROW ===========================================================
function deleteselectrow(d,r)
 {
var regex = /(\d+)/g;
nn= d.match(regex);
id=nn;

var np=document.getElementById("amt"+id).value; 
var gstval=document.getElementById("gst"+id).value;
    	var i = r.parentNode.parentNode.rowIndex;
	    var cnf = confirm('Are You Sure..??? you want to Delete line no.'+(id));
	  alert(i);
if (cnf== true)
 {
	
	document.getElementById("invoice").deleteRow((i-2));	
	var total=document.getElementById("sumtot").value;
	var gst=document.getElementById("sumgst").value;
	var grandtotals=document.getElementById("grandtotal").value;
	 total=Number(total);
	 gst=Number(gst);
 	total=total-np;
 	gst=gst-Number(gstval);
	total=Number((total).toFixed(2));
	gst=Number((gst).toFixed(2));
 	var gt=Number(grandtotals)-(Number(np)+Number(gstval));
 	var gtss=Number((gt).toFixed(2));
	document.getElementById("gstamt").value=gst;
 	document.getElementById("total").value=total;
 	document.getElementById("grandtotal").value=gtss;
 
 }
	

}
//====================================CLOSE DELETE ROW ===========================================================

function EditInvoiceItem(v)
    {
	var a=document.getElementById("myupid").value;
	var pro=v+'^'+a;
	var xhttp = new XMLHttpRequest();
	 xhttp.open("GET", "edit_gst_item?eid="+pro, false);
	 xhttp.send();
	 document.getElementById("modal-contentadditem").innerHTML = xhttp.responseText; 
    }
	
//====================================================================================================================
</script>
</form>
<form class="form-horizontal" role="form" id="insertstockpointform" method="post" action="" enctype="multipart/form-data">	
	 <div id="addItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
	    <div id="modal-contentadditem">

        </div>
    </div>	 
</div>
</form>	
<script>

$("#insertstockpointform").validate({
    rules: {
      mycatid: "required",
      myqty:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('GstInvoice/updategstorder');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#insertstockpointform').serialize(), // serializes the form's elements.
                success : function (data) {              
				 $( ".txtHint" ).html(data); 				 
				  $("#addItem .close").click();
                  $('#insertstockpointform')[0].reset(); 
				   
					//tableinvoicefunc();
   
				  //$("#invoice2").hide();  
						
						//referesh table
				 	//$( "#tableinvoice" ).load("gst-table.php");
					$('#success_message').fadeIn().html("Record Edited Successfully.");
												setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
   														       
					 //location.reload();
                // ajex_contactListData();
               }
            });
          return false;
      }
  });



function deleteinvoicedtl(id)
	{
		var conf=confirm("Do you really want to delete this entry!!!!!!!");
		var total=document.getElementById("total").value;
		var gstamt=document.getElementById("gstamt").value;
		var grandtotal=document.getElementById("grandtotal").value;
		//alert(id);
		//var np=document.getElementById("amtidd"+id).value; 
		//var gp=document.getElementById("gstidd"+id).value; 

		//var gstid=document.getElementById(gstidd).value;
			if(conf==true)
			{
				  
			/*  Number(total)=Number(total)-Number(np);
			  Number(gstamt)=Number(gstamt)-Number(gp);
			  Number(grandtotal)=Number(grandtotal)-(Number(np)+Number(gp));
			 document.getElementById("total").value=total;
			  document.getElementById("gstamt").value=gstamt;
			  document.getElementById("grandtotal").value=grandtotal;
			  */
			  var delid="&id="+id+"&total="+total+"&grandtotal="+grandtotal+"&gstamt="+gstamt;
			  
				$.ajax({
					type:"GET",
					url:"<?=base_url();?>GstInvoice/GstInvoice/deleteinvoicedtl",
					data:delid,
					success:function(html)
						{
									
							//$.(id).hide();
							$('#success_message').fadeIn().html("Entry deleted Successfully.");
								setTimeout(function() {
									$('#success_message').fadeOut("slow");
								}, 2000 );
							
							
						}
				
				});
			}
	}
</script>
<script>
 function tableinvoicefunc()
		  {
			 
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET", "gst_table?catid="+catid, false);
			xhttp.send();
			document.getElementById("tableinvoice").innerHTML = xhttp.responseText; 
		  }   
</script>

<?php
$this->load->view("footer.php");
?>

