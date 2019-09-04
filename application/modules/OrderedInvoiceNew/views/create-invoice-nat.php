<?php
$this->load->view("header.php");
?>
	 <!-- Main content -->
	 <div class="main-content">
	 <a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">ADD INVOICE</a>
<form class="form-horizontal" method="post" action="insertCustomerByInvoice">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Date</th>
<th style="width:20px;"><input type="text" name="" id="currentdate_id" class="form-control datepicker" width="215"  value="<?php echo date('d/m/Y'); ?>" /></th>
<th>Term</th>
<th style="width:80px;" id="termidd"></th>
<th>Due Date</th>
<th style="width:200px;"><input type="text" name="due_date" id="currentdate_id" class="form-control datepicker2" width="215"  value="<?php echo date('d/m/Y'); ?>" /></th>
</tr>
<tr class="gradeA">
	<div id="act_val"></div>
<th>Customer Name </th>
<th>
<select  name="custid" id="customer_id" class="form-control" onchange="customertermfun();" >
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->contact_id.'^National'; ?>"><?php echo $fetchgroup->first_name; ?></option>

    <?php } ?></select>
</th>
<th>Credit Limit</th>
<th id="climitidd"></th>
<th colspan="2" style="font-size:20px;text-align:right;padding: 0 16px 0px 140px;">BALANCE DUE</th>
</tr>
<tr class="gradeA">
<th>Product Name</th>
<th>
<select name="product_idd" class="form-control ui fluid search dropdown location" id="product_idd" onchange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlstock=$this->db->query("select * from tbl_product_stock where status='A'");
						foreach ($sqlstock->result() as $fetchStock){						
					?>					
    <option value="<?php echo $fetchStock->Product_id; ?>"><?php echo $fetchStock->productname; ?></option>

    <?php } ?></select>
</th>
<th style="text-align:right;padding: 0 16px 0px 140px;" colspan="3">&nbsp;</th>
<th colspan="3"><input type="text" name="" style="text-align:center; border:none; background:#FFFFFF;font-size:2.8rem;" id="upbaltotpriid" class="form-control" readonly="true" /></th>
</tr>
</tbody>
</table>
<h6></h6>	  
</div>
<div id="custorderedid"></div>	 
<h6></h6>	  
<div class="table-responsive">
<h5>View Item</h5>
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th style="width:170px">Item Name</th>
<th style="width:170px">Description</th>
<th style="width:75px">Category</th>
<th>Size / Qty</th>
<th style="width:80px">Total Qty</th>
<th>Price</th>
<th>Total Price</th>
<th style="width:120px">Action</th>
</tr>
</tbody>
</table>
<table>
<h6></h6>
<tr> 
<th>Description<textarea name="tot_desc" class="form-control"></textarea></th>
<th style="text-align:right;padding: 0 16px 0px 550px;">Total</th>
<th>
<input type="text" class="form-control" name="sub_tot" style="text-align:center; border:none; background:#FFFFFF;" id="subtotpriid" readonly="true">
</th>
</tr>
<tr> 
<th>&nbsp;</th>
<th style="text-align:right;padding: 0 16px 0px 600px;">Balance Due</th>
<th>
<input type="text" name="balance_due" style="text-align:center; border:none; background:#FFFFFF;" id="baltotpriid" class="form-control" readonly="true" />
</th>
</tr>
</table>
</div>	
<input type="hidden" name="rows" id="rowsiddds">
<h5></h5>
<div class="pull-right">
<input class="btn btn-sm" type="button" value="SAVE" id="sv1" onclick="fsv(this)">
<a href="addInvoice"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
</div>
</form>		
</div>
<script>
function customerfun(){
var currentdate_id=document.getElementById("currentdate_id").value;
var product_idds=document.getElementById("product_idd").value;
var contactid=document.getElementById("customer_id").value;

var pro=contactid+'^'+currentdate_id+'^'+product_idds;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getorderedsecondpage?id="+pro, false);
  xhttp.send();
  document.getElementById("custorderedid").innerHTML = xhttp.responseText;
 } 
 
</script>

<script>
function customertermfun(){

var currentdate_id=document.getElementById("currentdate_id").value;
var product_idds=document.getElementById("product_idd").value;
var contactid=document.getElementById("customer_id").value;

var pro=contactid+'^'+currentdate_id+'^'+product_idds;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getterm?id="+pro, false);
  xhttp.send();
  document.getElementById("termidd").innerHTML = xhttp.responseText;
 
  creditlimitfun();
 
 } 
 
</script>

<script>
function creditlimitfun(){

var currentdate_id=document.getElementById("currentdate_id").value;
var contactid=document.getElementById("customer_id").value;

var pro=contactid+'^'+currentdate_id;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getcreditlimit?id="+pro, false);
  xhttp.send();
  document.getElementById("climitidd").innerHTML = xhttp.responseText;
 } 
 
</script>

<script>
	function orderedqtyfun(d,r){
		//alert(d);
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;	

	  var countsizeidall=document.getElementById("countsizeid"+r).value; 		
			
				var sumtwoqty=0; 
				var qtyselected = [];
		 for(var k=1; k<countsizeidall; k++){
		 var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;
		 	
			var twoqty=document.getElementById("enteredqtyidd"+k+r).value;
			
			if(Number(twoqty)<=Number(validationenterqty)){

					sumtwoqty +=Number(twoqty);		
					qtyselected.push(twoqty);	

			}else{
				alert("Qty Is Greater Than.");
			}
			
					 } 
		 	 			 
		document.getElementById("totalorid"+r).value=sumtwoqty; 
		document.getElementById("orqtyid"+r).value=qtyselected; 
		
		var priceorid=document.getElementById("priceorid"+r).value; 		
		var multpri=Number(priceorid)*Number(sumtwoqty);
		document.getElementById("finalpriceorid"+r).value=multpri; 
	}
</script>

<script>
	function taxonandsolefunus(d,r,rid){
		//alert(d);
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;	

	  var countsizeidall=document.getElementById("countsizeidto"+r+rid).value; 		
			//alert(countsizeidall);
				var sumtwoqty=0; 
				var qtyselected = [];
		 for(var k=1; k<countsizeidall; k++){
		 var validationenterqty=document.getElementById("checkorderedqtyiddto"+k+r+rid).value;
		 	
			var twoqty=document.getElementById("enteredqtyiddto"+k+r+rid).value;
	
			if(Number(twoqty)<=Number(validationenterqty)){

					sumtwoqty +=Number(twoqty);		
					qtyselected.push(twoqty);	

			}else{
				alert("Qty Is Greater");
			}
			
					 } 
		 	 			 
		document.getElementById("totaloridto"+r+rid).value=sumtwoqty; 
		document.getElementById("orqtyidto"+r+rid).value=qtyselected; 
		
		var priceorid=document.getElementById("priceoridto"+r+rid).value; 			
		var multpri=Number(priceorid)*Number(sumtwoqty);
		document.getElementById("finalpriceoridto"+r+rid).value=multpri; 
	}
</script>

<script>
	function clearFields(r){
						
	  var resetvalids=document.getElementById("resetvalid"+r).value; 
	  if(resetvalids=='false'){
	  var countsizeidall=document.getElementById("countsizeid"+r).value; 		
			
		 for(var k=1; k<countsizeidall; k++){
		 
		 document.getElementById("enteredqtyidd"+k+r).value='';
			
					 } 
		document.getElementById("totalorid"+r).value='';
		document.getElementById("orqtyid"+r).value='';
		document.getElementById("finalpriceorid"+r).value='';		 	 			 
		document.getElementById("myCheck"+r).checked = false;
	}	 
		 
	}
		
</script>
<script>
function myCheckFunction(r) {
    	
var checkid = document.getElementById('myCheck'+r).checked;

		if(checkid==true)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("checkorderedqtyidd"+k+r).value;
						sumtwoqty +=Number(twoqty);		
						 qtyselected.push(twoqty);	
						document.getElementById("enteredqtyidd"+k+r).value=twoqty;
						document.getElementById("enteredqtyidd"+k+r).readOnly = true; 
					 }
						 
					document.getElementById("totalorid"+r).value=sumtwoqty; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					var priceorid=document.getElementById("priceorid"+r).value; 		
					var multpri=Number(priceorid)*Number(sumtwoqty);
					document.getElementById("finalpriceorid"+r).value=multpri; 
					document.getElementById("resetvalid"+r).value=checkid;
					
		}
 
 
 
 if(checkid==false)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("enteredqtyidd"+k+r).value='';
						qtyselected.push(twoqty);
						document.getElementById("enteredqtyidd"+k+r).readOnly = false; 
					 }
						 
					document.getElementById("totalorid"+r).value=0; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					document.getElementById("finalpriceorid"+r).value=0; 
					document.getElementById("resetvalid"+r).value=checkid;
			
		}
 
}
</script>
<script>
function myCheckdoubleFunto(r,idr) {
    	
var checkid = document.getElementById('myCheck'+r+idr).checked;

		if(checkid==true)
		{

		document.getElementById("checkeddvalidationidtoone"+r+idr).value='1'; 		
			document.getElementById("myChecktoo"+r+idr).style.display='none';		
				 var countsizeidall=document.getElementById("countsizeidto"+r+idr).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("checkorderedqtyiddto"+k+r+idr).value;
						sumtwoqty +=Number(twoqty);		
						 qtyselected.push(twoqty);	
						document.getElementById("enteredqtyiddto"+k+r+idr).value=twoqty;
						document.getElementById("enteredqtyiddto"+k+r+idr).readOnly = true; 
					 }
						 
					document.getElementById("totaloridto"+r+idr).value=sumtwoqty; 
					document.getElementById("orqtyidto"+r+idr).value=qtyselected; 
					
					var priceorid=document.getElementById("priceoridto"+r+idr).value; 		
					var multpri=Number(priceorid)*Number(sumtwoqty);
					document.getElementById("finalpriceoridto"+r+idr).value=multpri; 
					document.getElementById("resetvalidto"+r+idr).value=checkid;

		}
 
 
 
 if(checkid==false)
		{
		
			document.getElementById("checkeddvalidationidtoone"+r+idr).value='0';
			//document.getElementById("myChecktoo"+r+idr).style.display=''; 	
			//document.getElementById("myChecktoo"+r+idr).checked = false;	
				
				 var countsizeidall=document.getElementById("countsizeidto"+r+idr).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("enteredqtyiddto"+k+r+idr).value='';
						qtyselected.push(twoqty);
						document.getElementById("enteredqtyiddto"+k+r+idr).readOnly = false; 
					 }
						 
					document.getElementById("totaloridto"+r+idr).value=0; 
					document.getElementById("orqtyidto"+r+idr).value=qtyselected; 
					
					document.getElementById("finalpriceoridto"+r+idr).value=0; 
					document.getElementById("resetvalidto"+r+idr).value=checkid;
			
		}
 
}
</script>
<script>
function submyCheckFunctionto(r,idr) {
    	
var checkid = document.getElementById('myChecktoo'+r+idr).checked;
//alert(r);
//alert(idr);
		if(checkid==true)
		{
			
		document.getElementById("checkeddvalidationidtotwo"+r+idr).value='1'; 		
			document.getElementById("myCheck"+r+idr).style.display='none';		
				 var countsizeidall=document.getElementById("countsizeidto"+r+idr).value; 	
				 var subrowi=document.getElementById("subrowidd"+r+idr).value; 							
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1;k<countsizeidall;k++){						
						var twoqty=document.getElementById("enteredqtyidd"+k+subrowi).value;
						sumtwoqty +=Number(twoqty);		
						 qtyselected.push(twoqty);	
						document.getElementById("enteredqtyiddto"+k+r+idr).value=twoqty;
						document.getElementById("enteredqtyiddto"+k+r+idr).readOnly = true; 
					 }
						 
					document.getElementById("totaloridto"+r+idr).value=sumtwoqty; 
					document.getElementById("orqtyidto"+r+idr).value=qtyselected; 
					
					var priceorid=document.getElementById("priceoridto"+r+idr).value; 		
					var multpri=Number(priceorid)*Number(sumtwoqty);
					document.getElementById("finalpriceoridto"+r+idr).value=multpri; 
					document.getElementById("resetvalidto"+r+idr).value=checkid;

		}
 
 
 
 if(checkid==false)
		{

		document.getElementById("checkeddvalidationidtotwo"+r+idr).value='0'; 	
		document.getElementById("myCheck"+r+idr).style.display=''; 	
			document.getElementById("myCheck"+r+idr).checked = false;		
				 var countsizeidall=document.getElementById("countsizeidto"+r+idr).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("enteredqtyiddto"+k+r+idr).value='';
						qtyselected.push(twoqty);
						document.getElementById("enteredqtyiddto"+k+r+idr).readOnly = false; 
					 }
						 
					document.getElementById("totaloridto"+r+idr).value=0; 
					document.getElementById("orqtyidto"+r+idr).value=qtyselected; 
					
					document.getElementById("finalpriceoridto"+r+idr).value=0; 
					document.getElementById("resetvalidto"+r+idr).value=checkid;
			
		}
 
}
</script>
<script>
function fsv(v)
{
var rc=document.getElementById("rowsiddds").value;	
	if(rc!=''){
		v.type="submit";	
	}
}
</script>

<SCRIPT language="javascript">
		function addRow(tableID,id) {
			var item_id=document.getElementById("item_id"+id).value;
			var category_id=document.getElementById("category_id"+id).value;
			var sizeval=document.getElementById("size_val"+id).value;
			var entqty=document.getElementById("orqtyid"+id).value;


		var pro=item_id+'^'+category_id+'^'+sizeval+'^'+entqty;
		 var xhttp = new XMLHttpRequest();
		  xhttp.open("GET", "validation_of_negative_qty?id="+pro, false);
		  xhttp.send();
		  document.getElementById("act_val").innerHTML = xhttp.responseText;
 
		  var validation_neg_id=document.getElementById("val_neg_id").value;
		   var validation_order_neg_id=document.getElementById("order_val_neg_id").value;
		  //alert(validation_neg_id);
		  if(validation_neg_id=='2' && validation_order_neg_id=='2'){
		
			
						var pricessid=document.getElementById("pricessid"+id).value;
							var finalpriceorid=document.getElementById("finalpriceorid"+id).value;
							
				if(pricessid==''){
					alert("Please Enter Price");
				}else if(finalpriceorid==''){
					alert("Please Enter Qty");
				}else{
						
					document.getElementById("testidt"+id).style.display='none'; 
						document.getElementById("clearid"+id).style.display='none'; 	
				
			var table = document.getElementById(tableID);
			
			var rows=document.getElementById("rowsiddds").value;
			var rid =Number(rows)+1;
			document.getElementById("rowsiddds").value=rid;
			//alert("hello");
			var productval=document.getElementById("productname"+id).value;
			var itemval=document.getElementById("item_id"+id).value;
			var descidd=document.getElementById("descidd"+id).value;
			var category_id=document.getElementById("category_id"+id).value;
			var categorynamess_id=document.getElementById("categorynamess_id"+id).value;	
			
			var coldata=document.getElementById("countsizeid"+id).value;	 
			var sizeval=document.getElementById("size_val"+id).value;
			var orderval=document.getElementById("orqtyid"+id).value;
			var totalorid=document.getElementById("totalorid"+id).value;	
			var orderid=document.getElementById("orderid"+id).value;
				var sizevaluessplit = sizeval.split(' | ');
				var ordervalqtysplite=orderval.split(',');
					
			var subtotal=document.getElementById("subtotpriid").value;
			subtotal=Number(subtotal);
			nptl=Number(finalpriceorid);	
			var subtl=subtotal+nptl;
			subtl=Number((subtl).toFixed(2));
			document.getElementById("subtotpriid").value=subtl;
			document.getElementById("baltotpriid").value=subtl;
			document.getElementById("upbaltotpriid").value=subtl;
			
			
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var rowcountsat=rowCount+1;
						
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.value=productval;
			element1.type = "text";
			element1.readOnly = true;
			element1.name = "productname[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);
			
			
			var element1 = document.createElement("input");
			element1.value=itemval;
			element1.type = "hidden";
			element1.readOnly = true;
			element1.name = "item_id[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);
			
			var element1 = document.createElement("input");
			element1.value=orderid;
			element1.type = "hidden";
			element1.readOnly = true;
			element1.name = "order_id[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);
			
			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.value= descidd;
			element2.type = "text";
			element2.readOnly = true;
			element2.name = "descname[]";
			element2.style.border="hidden"; 
			element2.className="form-control";
			element2.style="background: #ffff;border:none;";
			cell2.appendChild(element2);
			
		
	var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.value= categorynamess_id;
			element3.type = "text";
			element3.readOnly = true;
			element3.name = "empt";
			element3.style.border="hidden"; 
			element3.className="form-control";
			element3.style="background: #ffff;border:none;";
			cell3.appendChild(element3);
			
			var element3 = document.createElement("input");
			element3.value=category_id;
			element3.type = "hidden";
			element3.readOnly = true;
			element3.name = "category_id[]";
			element3.style.border="hidden"; 
			element3.className="form-control";
			element3.style="background: #ffff;border:none;";
			cell3.appendChild(element3);		

			var cell4 = row.insertCell(3);

 			cell4.setAttribute("style", "width: 220px!important;float: left;overflow-y: auto;overflow-x: scroll;");
			var x = document.createElement("TABLE");
    		x.setAttribute("id", "myTable"+rowcountsat);
    		cell4.appendChild(x);

			var element4 = document.createElement("input");
			element4.value=sizeval;
			element4.type = "hidden";
			element4.readOnly = true;
			element4.name = "size_value[]";
			element4.style.border="hidden"; 
			element4.className="form-control";
			element4.style="background: #ffff;border:none;";
			cell4.appendChild(element4);

			for(var j=1; j<coldata;j++){
			
			 var y = document.createElement("TR");
    y.setAttribute("id", "myTr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(y);

			
	var z = document.createElement("TD");
	 z.setAttribute("style", "text-align: center;");
    var t = document.createTextNode(sizevaluessplit[j]);
    z.appendChild(t);
    document.getElementById("myTr"+rowcountsat).appendChild(z);
	
	}

cell4.appendChild(document.createElement("br"));	
		
		var element8 = document.createElement("input");
			element8.value= orderval;
			element8.style = "width: 64px;margin: 10px; background: #ffff;border:none;";
			element8.type = "hidden";
			element8.readOnly = true;
			element8.className="form-control"
			element8.name = "entqty_value[]";
			cell4.appendChild(element8);
		
for(var k=1; k<coldata;k++){
			var mk=k-1;
     var yrr = document.createElement("TR");
    yrr.setAttribute("id", "myTrr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(yrr);
		
  var zr = document.createElement("TD");
   zr.setAttribute("style", "text-align: center");
    var tr = document.createTextNode(ordervalqtysplite[mk]);
    zr.appendChild(tr);
    document.getElementById("myTrr"+rowcountsat).appendChild(zr);			

}
			var cell5 = row.insertCell(4);
			var element5 = document.createElement("input");
			element5.value= totalorid;
			element5.type = "text";
			element5.readOnly = true;
			element5.name = "total_qty[]";
			element5.style.border="hidden"; 
			element5.className="form-control";
			element5.style="background: #ffff;border:none;";
			cell5.appendChild(element5);
			
			var cell6 = row.insertCell(5);
			var element6 = document.createElement("input");
			element6.value= pricessid;
			element6.type = "text";
			element6.readOnly = true;
			element6.name = "item_byprice[]";
			element6.style.border="hidden"; 
			element6.className="form-control";
			element6.style="background: #ffff;border:none;";
			cell6.appendChild(element6);
			
			var cell7 = row.insertCell(6);
			var element7 = document.createElement("input");
			element7.value= finalpriceorid;
			element7.type = "text";
			element7.readOnly = true;
			element7.name = "total_prices[]";
			element7.id = "finalpriceorid"+rowCount;
			element7.style.border="hidden"; 
			element7.className="form-control";
			element7.style="background: #ffff;border:none;";
			cell7.appendChild(element7);
		
			var cell8 = row.insertCell(7);
			var element8 = document.createElement("input");
			element8.value= "Delete Item";
			element8.type = "button";
			element8.readOnly = true;
			element8.name = "start_date[]";
			element8.className="btn btn-secondary btn-sm"
			element8.onclick= function() { deleteRowone(this); };
			cell8.appendChild(element8);
		//clear();
		
		}
	}else{
		alert('Stock / Order is less then.');
	}
}
		function deleteRowone(row) {
					 var i = row.parentNode.parentNode.rowIndex;
					 var result = confirm("Are you sure you want to delete item?");
					if (result) {
												
						var finalpriceorid=document.getElementById("finalpriceorid"+i).value;
						//alert(finalpriceorid);
						var subtotal=document.getElementById("subtotpriid").value;
						subtotal=Number(subtotal);
						nptl=Number(finalpriceorid);	
						var subtl=subtotal-nptl;
						subtl=Number((subtl).toFixed(2));
						document.getElementById("subtotpriid").value=subtl;
						document.getElementById("baltotpriid").value=subtl;
						document.getElementById("upbaltotpriid").value=subtl;
						
						document.getElementById('dataTable').deleteRow(i);
						
					}
        			
		}
		
		
function clear(){
/*
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
addrowandqty();*/
}		

	</SCRIPT>

<SCRIPT language="javascript">
		function addRowTo(tableID,id,ridd) {
			
			var pricessid=document.getElementById("pricessidto"+id+ridd).value;
					var finalpriceorid=document.getElementById("finalpriceoridto"+id+ridd).value;
					
		if(pricessid==''){
			alert("Please Enter Price");
		}else if(finalpriceorid==''){
			alert("Please Enter Qty");
		}else{	
		
				document.getElementById("testidtto"+id+ridd).style.display='none'; 
						document.getElementById("clearidto"+id+ridd).style.display='none'; 	
			
			var table = document.getElementById(tableID);
			
			var rows=document.getElementById("rowsiddds").value;
			var rid =Number(rows)+1;
			document.getElementById("rowsiddds").value=rid;
			
			var productval=document.getElementById("productnameto"+id+ridd).value;
			var itemval=document.getElementById("item_idto"+id+ridd).value;
			var descidd=document.getElementById("desciddto"+id+ridd).value;
			var category_id=document.getElementById("category_idto"+id+ridd).value;
			var categorynamess_id=document.getElementById("categorynamess_idto"+id+ridd).value;	
			
			var coldata=document.getElementById("countsizeidto"+id+ridd).value;	 
			var sizeval=document.getElementById("size_valto"+id+ridd).value;
			var orderval=document.getElementById("orqtyidto"+id+ridd).value;
			var totalorid=document.getElementById("totaloridto"+id+ridd).value;	
			var orderidto=document.getElementById("orderidto"+id+ridd).value;	
			var subitem_idto=document.getElementById("subitem_idto"+id+ridd).value;		
			//alert(pricessid);
				var sizevaluessplit = sizeval.split(' | ');
				var ordervalqtysplite=orderval.split(',');
			
			var subtotal=document.getElementById("subtotpriid").value;
			subtotal=Number(subtotal);
			nptl=Number(finalpriceorid);	
			var subtl=subtotal+nptl;
			subtl=Number((subtl).toFixed(2));
			document.getElementById("subtotpriid").value=subtl;
			document.getElementById("baltotpriid").value=subtl;
			document.getElementById("upbaltotpriid").value=subtl;
			
			//alert(categorynamess_id);	
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			var rowcountsat=rowCount+1;
						
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.value=productval;
			element1.type = "text";
			element1.readOnly = true;
			element1.name = "productname[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);	
			
			var element1 = document.createElement("input");
			element1.value=itemval+'^'+subitem_idto;
			element1.type = "hidden";
			element1.readOnly = true;
			element1.name = "item_id[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);
			
			var element1 = document.createElement("input");
			element1.value=orderidto;
			element1.type = "hidden";
			element1.readOnly = true;
			element1.name = "order_id[]";
			element1.style.border="hidden"; 
			element1.className="form-control";
			element1.style="background: #ffff;border:none;";
			cell1.appendChild(element1);
			
			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.value= descidd;
			element2.type = "text";
			element2.readOnly = true;
			element2.name = "descname[]";
			element2.style.border="hidden"; 
			element2.className="form-control";
			element2.style="background: #ffff;border:none;";
			cell2.appendChild(element2);
			
		
	var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.value= categorynamess_id;
			element3.type = "text";
			element3.readOnly = true;
			element3.name = "empt";
			element3.style.border="hidden"; 
			element3.className="form-control";
			element3.style="background: #ffff;border:none;";
			cell3.appendChild(element3);
			
			var element3 = document.createElement("input");
			element3.value=category_id;
			element3.type = "hidden";
			element3.readOnly = true;
			element3.name = "category_id[]";
			element3.style.border="hidden"; 
			element3.className="form-control";
			element3.style="background: #ffff;border:none;";
			cell3.appendChild(element3);		

			var cell4 = row.insertCell(3);

 			cell4.setAttribute("style", "width: 220px!important;float: left;overflow-y: auto;overflow-x: scroll;");
			var x = document.createElement("TABLE");
    		x.setAttribute("id", "myTable"+rowcountsat);
    		cell4.appendChild(x);

			var element4 = document.createElement("input");
			element4.value= sizeval;
			element4.type = "hidden";
			element4.readOnly = true;
			element4.name = "size_value[]";
			element4.style.border="hidden"; 
			element4.className="form-control";
			element4.style="background: #ffff;border:none;";
			cell4.appendChild(element4);

			for(var j=1; j<coldata;j++){
						
			 var y = document.createElement("TR");
    y.setAttribute("id", "myTr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(y);

			
	var z = document.createElement("TD");
	 z.setAttribute("style", "text-align: center");
    var t = document.createTextNode(sizevaluessplit[j]);
    z.appendChild(t);
    document.getElementById("myTr"+rowcountsat).appendChild(z);
	
	}

cell4.appendChild(document.createElement("br"));	
		
		var element8 = document.createElement("input");
			element8.value= orderval;
			element8.style = "width: 64px;margin: 10px; background: #ffff;border:none;";
			element8.type = "hidden";
			element8.readOnly = true;
			element8.className="form-control form-control-m"
			element8.name = "entqty_value[]";
			cell4.appendChild(element8);
		
for(var k=1; k<coldata;k++){
			var mk=k-1;

     var yrr = document.createElement("TR");
    yrr.setAttribute("id", "myTrr"+rowcountsat);
    document.getElementById("myTable"+rowcountsat).appendChild(yrr);
		
  var zr = document.createElement("TD");
   zr.setAttribute("style", "text-align: center");
    var tr = document.createTextNode(ordervalqtysplite[mk]);
    zr.appendChild(tr);
    document.getElementById("myTrr"+rowcountsat).appendChild(zr);			

}
			var cell5 = row.insertCell(4);
			var element5 = document.createElement("input");
			element5.value= totalorid;
			element5.type = "text";
			element5.readOnly = true;
			element5.name = "total_qty[]";
			element5.style.border="hidden"; 
			element5.className="form-control";
			element5.style="background: #ffff;border:none;";
			cell5.appendChild(element5);
			
			var cell6 = row.insertCell(5);
			var element6 = document.createElement("input");
			element6.value= pricessid;
			element6.type = "text";
			element6.readOnly = true;
			element6.name = "item_byprice[]";
			element6.style.border="hidden"; 
			element6.className="form-control";
			element6.style="background: #ffff;border:none;";
			cell6.appendChild(element6);
			
			var cell7 = row.insertCell(6);
			var element7 = document.createElement("input");
			element7.value= finalpriceorid;
			element7.type = "text";
			element7.readOnly = true;
			element7.name = "total_prices[]";
			element7.id = "finalpriceoridtoidd"+rowCount;
			element7.style.border="hidden"; 
			element7.className="form-control";
			element7.style="background: #ffff;border:none;";
			cell7.appendChild(element7);
		
			var cell8 = row.insertCell(7);
			var element8 = document.createElement("input");
			element8.value= "Delete Item";
			element8.type = "button";
			element8.readOnly = true;
			element8.name = "start_date[]";
			element8.className="btn btn-secondary btn-sm"
			element8.onclick= function() { deleteRow(this); };
			cell8.appendChild(element8);
		//clear();
		
		}
	}

		function deleteRow(row) {
					 var i = row.parentNode.parentNode.rowIndex;
					 var result = confirm("Are you sure you want to delete item?");
					if (result) {
					//alert(i);
						var finalpriceorid=document.getElementById("finalpriceoridtoidd"+i).value;
						var subtotal=document.getElementById("subtotpriid").value;
						subtotal=Number(subtotal);
						nptl=Number(finalpriceorid);	
						var subtl=subtotal-nptl;
						subtl=Number((subtl).toFixed(2));
						document.getElementById("subtotpriid").value=subtl;
						document.getElementById("baltotpriid").value=subtl;
						document.getElementById("upbaltotpriid").value=subtl;
						
						document.getElementById('dataTable').deleteRow(i);	
					
					}
        			
		}
		
	</SCRIPT>	

<?php
$this->load->view("footer.php");
?>