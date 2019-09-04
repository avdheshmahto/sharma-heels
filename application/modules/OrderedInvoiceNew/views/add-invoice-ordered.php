<?php
$this->load->view("header.php");

$entries = "";
  if($this->input->get('entries')!=""){
    $entries = $this->input->get('entries');
  }
?>
<form id="f1" name="f1" method="POST" action="" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
	<a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">MANAGE INVOICE</a>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	<div class="html5buttons">
	<div class="dt-buttons">
	<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
	<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
	<a class="btn btn-sm gr" data-a="0" href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/invoiceInNational" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Invoice</span>
	</a>
	</div>
	</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show
            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('OrderedInvoiceNew/OrderedInvoiceNew/addInvoice');?>" class="form-control input-sm">

            <option value="10">10</option>
            <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
            <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
            <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
            <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
			<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
			<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>All</option>
            </select>
            entries</label>
            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -5px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
              <?php
              $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
              echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
              ?> of <?=$dataConfig['total'];?> entries
            </div>
</div>

    <div id="DataTables_Table_0_filter" class="dataTables_filter">
    <label>Search:
    <input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
    </label>
    </div>
    </div>
    </div>
    </div>  			
<div id="ordereddataidss">			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover" >
<thead>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
	   <th>Date</th>
	   <th>Invoice No.</th>
	   <th>Customer Name</th>
	   <th>Builty No.</th>	
	   <th>Amount</th>	
	   <th style="width:50px;">Action</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php  
$i=1;
$sqlorder=$this->db->query("select * from tbl_ordered_invoice_hdr where status='A' ORDER BY ordered_invoiceid DESC limit $page,$per_page ");
	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid; ?>">
<th><?php echo $fetch_list->invoice_date;?></th>
<th><?php 
$nextyear=date("y");
$ss=$fetch_list->ordered_invoiceid;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<th><?php
		
	if($fetch_list->customer_id!='0'){	
$itemQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list->customer_id)
           -> get('tbl_contact_m');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->first_name;
 }else{

$compQuery = $this -> db
           -> select('*')
           -> where('id',$fetch_list->store_id)
           -> get('tbl_location');
		  $compRow = $compQuery->row();

echo $compRow->location_name;		   
 }
?></th>
<th><button class="btn btn-default" href='#moduleaddbuiltno' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><img src="<?=base_url();?>assets/images/plus.png" style="width:16px;" onclick="addbuiltyno('<?php echo $fetch_list->ordered_invoiceid;?>')" /></button>&nbsp;<?php echo $fetch_list->builty_no; ?></th>
<th><?php echo $fetch_list->sub_tot;  ?></th>

<th class="bs-example">
 <a href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/printInvoice?id=<?php echo $fetch_list->ordered_invoiceid; ?>" target="_blank">
    <button class="btn btn-default" data-a="#" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-print"></i>
    </button>
</a>	

 <!-- <button class="btn btn-sm modalEditcontact" href="#modal-1" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="updateInvoice('<?php echo $fetch_list->ordered_invoiceid;?>')"><i>Edit Invoice</i></button> 
 -->
</th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
<div class="row">
<div class="col-md-12 text-right">
<div class="col-md-6 text-left"> 
<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
</div>
<div class="col-md-6"> 
<?php echo $pagination; ?>
</div>
</div>
</div>
<!--main-content close-->
<div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<form  method="post" id ="invoiceEditForm" >
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Edit Invoice<span > </span></h4>
<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
<div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div> 
</div>
<div class="modal-body overflow" id="divupdateid"></div>
<div class="modal-footer" id="button">
  <input type="submit" class="btn btn-sm" value="Save"> 
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 
<form class="form-horizontal" id="invoiceEditForm" role="form"  enctype="multipart/form-data">		method="post" action="invoiceInsert" -->	
<!-- <div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="diveditid">

        </div>
    </div>	 
</div>
</form>  -->

		
<!-- <div id="editinvoiceordered" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg" style="background: #fff;">
    	<form class="form-horizontal"  id="f1" name="f1" role="form" method="post" action="invoiceUpdateFun" enctype="multipart/form-data">	
        <div id="divupdateid">

		 </div>	
    <input type="hidden" name="rows" id="rowsiddds">
     <h5></h5>
     <div class="pull-right">
     <input class="btn btn-sm" type="button" value="SAVE" id="sv1" onclick="fsv(this)">
     <a href="addInvoice"><input class="btn btn-secondary btn-sm" type="button" value="Cancel"></a>
    </div>
   </div>
  </form>
  </div> -->	
  
<form class="form-horizontal" role="form" id="formbuiltyid" method="post" action="" enctype="multipart/form-data">			
<div id="moduleaddbuiltno" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="divbuiltyid">

        </div>
    </div>	 
</div>
</form>


<script>

function addbuiltyno(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "addBuilty?ID="+pro, false);
  xhttp.send();
  document.getElementById("divbuiltyid").innerHTML = xhttp.responseText;
 } 


function updateInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "updateInvoiceOrdered?editId="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 

function viewInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "viewInvoiceOrdered?ID="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 

</script>
<script>
 $("#formbuiltyid").validate({
    rules: {
      /*first_name: "required",
      mobile:"required"*/
    },
      submitHandler: function(e) {
        ur = "<?=base_url('OrderedInvoiceNew/OrderedInvoiceNew/insert_builty_no');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#formbuiltyid').serialize(), // serializes the form's elements.
                success : function (data) {                 
				 $( ".txtHint" ).html(data); 		 
				  $("#moduleaddbuiltno .close").click();
                  $('#formbuiltyid')[0].reset(); 				 	
					$('#success_message').fadeIn().html("Record Added Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
				       
                 ajex_contactListData();
               }
            });
          return false;
      }
  });
</script>
<script>
function locandstore(){
var contactid=document.getElementById("customer_id").value;
var pro=contactid;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getordered?id="+pro, false);
  xhttp.send();
  document.getElementById("ordereddataid").innerHTML = xhttp.responseText;
 } 
 
</script>

<script>
	function orderedqtyfun(d,r){
		
	  var regex = /(\d+)/g;
		nn = d.match(regex)
		id = nn;	

	  var countsizeidall = document.getElementById("countsizeid"+r).value; 		
	  var sumtwoqty      = 0; 
	  var qtyselected     = [];
		 for(var k=1; k<countsizeidall; k++){
		 var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;
		 	
			var twoqty=document.getElementById("orderedqtyidd"+k+r).value;
			
			if(Number(twoqty)<=Number(validationenterqty)){

					sumtwoqty +=Number(twoqty);		
					qtyselected.push(twoqty);	

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
	function editandupdateorderedqtyfun(d,r){
		
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;	

	  var countsizeidall=document.getElementById("countsizeid"+r).value; 		
				var sumtwoqty=0; 
				var qtyselected = [];
		 for(var k=1; k<countsizeidall; k++){
		// var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;
		 	
			var twoqty=document.getElementById("orderedqtyidd"+k+r).value;
			
			

					sumtwoqty +=Number(twoqty);		
					qtyselected.push(twoqty);	

			
			
					 }
		 	 
		document.getElementById("totalorid"+r).value=sumtwoqty; 
		document.getElementById("orqtyid"+r).value=qtyselected; 
		
		var priceorid=document.getElementById("priceorid"+r).value; 		
		var multpri=Number(priceorid)*Number(sumtwoqty);
		document.getElementById("finalpriceorid"+r).value=multpri; 
	}
</script>

<script>
function invoiceedit(v){
 var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "updateInvoice?ID="+pro, false);
  xhttp.send();
  document.getElementById("diveditid").innerHTML = xhttp.responseText;
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
						document.getElementById("orderedqtyidd"+k+r).value=twoqty;
						document.getElementById("orderedqtyidd"+k+r).readOnly = true; 
											
					 }
					
				
					document.getElementById("totalorid"+r).value=sumtwoqty; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					var priceorid=document.getElementById("priceorid"+r).value; 		
					var multpri=Number(priceorid)*Number(sumtwoqty);
					document.getElementById("finalpriceorid"+r).value=multpri; 
			
		}
 
 
 
 if(checkid==false)
		{
		
				 var countsizeidall=document.getElementById("countsizeid"+r).value; 		
							var sumtwoqty=0; 
							var qtyselected = [];
					 for(var k=1; k<countsizeidall; k++){
						var twoqty=document.getElementById("orderedqtyidd"+k+r).value=0;
						qtyselected.push(twoqty);
						document.getElementById("orderedqtyidd"+k+r).readOnly = false; 
					 }
						 
					document.getElementById("totalorid"+r).value=0; 
					document.getElementById("orqtyid"+r).value=qtyselected; 
					
					document.getElementById("finalpriceorid"+r).value=0; 
			
		}
 
}
</script>
<?php
$this->load->view("footer.php");
?>