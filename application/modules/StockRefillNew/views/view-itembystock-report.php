<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
<body>	
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 425px;font-size: 20px;">ALL STOCKPOINT HISTORY&nbsp;</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-body panel-center" style="background: teal;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-2 control-label" style="color: #fff;">Product Name</label> 
<div class="col-sm-3"> 
<select name="product_idd" class="form-control ui fluid search dropdown location" id="product_idd" onChange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlstock=$this->db->query("select * from tbl_product_stock where status='A'");
						foreach ($sqlstock->result() as $fetchStock){						
					?>					
    <option value="<?php echo $fetchStock->Product_id; ?>"><?php echo $fetchStock->productname; ?></option>

    <?php } ?></select>
</div>  
</div>
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label" style="color: #fff;">From Date</label> 
<div class="col-sm-3"> 
<input type="text" name="fdate" class="form-control datepicker" value="<?php //echo date('d/m/Y'); ?>" />
</div>
<label class="col-sm-2 control-label" style="color: #fff;">To Date</label> 
<div class="col-sm-3"> 
<input type="text" name="tdate" class="form-control datepicker2" value="<?php //echo date('d/m/Y'); ?>" /> 
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

	<div class="row">
		<div class="col-sm-12">
			<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<div class="html5buttons">
			<div class="dt-buttons">
				<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
				<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
				<a class="btn btn-sm gr" data-a="0" href="<?=base_url();?>StockRefillNew/add_multiple_qty" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Quantity</span>
				</a>
			</div>
			</div>

			<div class="dataTables_length" id="DataTables_Table_0_length">
				<label>Show
				<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('StockRefillNew/repsitembyhistory');?>" class="form-control input-sm">

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
			<input type="text" id="searchTerm"  class="search_box form-control input-sm" onKeyUp="doSearch()"  placeholder="What you looking for?">
			</label>
			</div>	
			</div>
		</div>
	</div>	
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="userTbl">
<thead>

	<tr> 
		<th>Date</th>
		<th>Stock Date</th>
		<th>StockPoint</th>
		<th>Vendor Name</th>
		<th>Product Name</th>
		<th>Category</th>
		<th style="width: 285px;">Size / Qty</th>
        <th>Total Qty</th>
        <th>Action</th>
	</tr> 

</thead> 
<?php
	@extract($_POST);
	if($search!='')
	{
	
		$queryy="select * from tbl_product_stock_log where status='A'";
				
		if($product_idd!='')
		{				
			$queryy.=" and product_id like '%$product_idd%'";	  
		}
		
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("/",$tdate);
			
			$fdate=explode("/",$fdate);

			$todate1=$tdate[0]."/".$tdate[1]."/".$tdate[2];
	        $fdate1=$fdate[0]."/".$fdate[1]."/".$fdate[2];
			$queryy .="and maker_date >='$fdate1' and maker_date <='$todate1'";
		}
}else{
$queryy="select * from tbl_product_stock_log where status='A' ORDER BY p_logid DESC limit $page,$per_page ";
}

$result11=$this->db->query($queryy);
?>
<tbody id="getDataTable"> 

<?php
foreach($result11->result() as $line) {

 $dd=$line->maker_date;
?>
<tr class="gradeC record">
<th style="display:none"><input type="checkbox"  /></th>
<th><?php echo $dd; ?></th>
<th><?php echo $line->date_name; ?></th>
<th><?php
$spQuery = $this -> db
           -> select('*')
           -> where('stockpid',$line->stock_point)
           -> get('tbl_stockpoint_and_vendor');
		  $spRow = $spQuery ->row();

echo $spRow->stockpointname;

?></th>
<th><?php 

$spquery=$this->db->query("select * from tbl_stockpoint_and_vendor where type='Vendor' and stockpid='$line->vendor_id'");
$sprowslist=$spquery->row();
echo $sprowslist->stockpointname; 

?>	
</th>
<th><?php 
$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->productname;?></th>
<th>
<?php 
$sqlQrycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$line->category'");
$qryCateFetch=$sqlQrycate->row();
echo $qryCateFetch->prodcatg_name;?>
</th>

<th style="width:285px;">
<div class="table-responsive2" style="width:300px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

 $countsizesub=sizeof(explode(' | ', $line->size));
$expsize=explode(' | ', $line->size);
$countsize=$countsizesub-1;
for($i=1;$i<=$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php
$expweight=explode(' ', $line->quantity);
for($j=1;$j<=$countsize;$j++){
 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php echo $line->total_qty; ?></th>
<td>

<button class="btn btn-sm modalEditContact" onClick="EditcontactPriceLoc('<?php echo $line->p_logid;?>')" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>Update Qty</button>
<br/>
</td>
</tr>
<?php } ?>
</tbody> 
</table>
</div>
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
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="contentedit">

        </div>
    </div>	 
</div>
</form>
<script>
function EditcontactPriceLoc(v){

var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "Editqtyupdate?ID="+v, false);
 xhttp.send();
 document.getElementById("contentedit").innerHTML = xhttp.responseText;
}
</script>

<script>
	function entedqtyfun(){
		var sizeall=document.getElementById("sizerow").value;
		var sumqty='';
		var serimargqty=[];
		var sumactialqtys='';
		var sumtotalsqtys='';
		for(var i=0;i<=sizeall;i++){
		var entqtyidss=document.getElementById("entqtyid"+i).value;
		var entqtyviewidss=document.getElementById("entqtyviewid"+i).value;
		var entserialids=document.getElementById("entserialids"+i).value;			
	
		var sumqty=Number(sumqty)+Number(entqtyidss);
		var subqtys=Number(entserialids)-Number(entqtyviewidss);	
			
		var sumactuilqty=Number(subqtys)+Number(entqtyidss);
		serimargqty.push(sumactuilqty);
		var sumtotalsqtys=Number(sumtotalsqtys)+Number(sumactuilqty);
			
		}
	var serimarjsqtyss=serimargqty.join(' ');
	document.getElementById("totid").value=sumqty;
	document.getElementById("serisingalqtyids").value=serimarjsqtyss;
	document.getElementById("seritotids").value=sumtotalsqtys;	
	}
</script>
<script>
	function newentedqtyfun(){
		//alert("hello");
		var sizeall=document.getElementById("sizerow").value;
		var entserialids=document.getElementById("serisingalqtyids").value;	
		var stock_act_qtys = entserialids.split(" ");

		var sumqty='';
		var serimargqty=[];
		var newsumtotalsqtys='';
		for(var i=0;i<=sizeall;i++){
			//alert(stock_act_qtys[i]);
		if(stock_act_qtys[i]==undefined){
			var stock_act_qtys_zero='0';
			//alert(stock_act_qtys_zero);
		}else{
			var stock_act_qtys_zero=stock_act_qtys[i];
		}
		var newentqtyid=document.getElementById("new_ent_qtyid"+i).value;
		var sumqty=Number(sumqty)+Number(newentqtyid);
		var sumactuilqty=Number(stock_act_qtys_zero)+Number(newentqtyid);
		serimargqty.push(sumactuilqty);
		var newsumtotalsqtys=Number(newsumtotalsqtys)+Number(sumactuilqty);
			
		}
	
	var serimarjsqtyss=serimargqty.join(' ');

	document.getElementById("new_ent_stock_qtys").value=serimarjsqtyss;
	document.getElementById("new_seri_totids").value=newsumtotalsqtys;	
	document.getElementById("new_qty_tot_id").value=sumqty;	

	}
</script>
<script>
function editqtyitemby(){                 

var updateid=document.getElementById("updateid").value;
var proid=document.getElementById("proid").value;
var sizedata=document.getElementById("sizedata").value;
var sizerow=document.getElementById("sizerow").value;
var ent_qty_arry = [];
var old_ent_qty_arry = [];
for(var i=0;i<=sizerow;i++){
		var entqtyidss=document.getElementById("new_ent_qtyid"+i).value;	
		ent_qty_arry.push(entqtyidss);

		var old_entqtyidss=document.getElementById("entqtyid"+i).value;	
		old_ent_qty_arry.push(old_entqtyidss);
}
var ent_qty_tot=ent_qty_arry.join(' ');
var tottid=document.getElementById("new_qty_tot_id").value;

var old_ent_qty_tot=old_ent_qty_arry.join(' ');
var old_tottid=document.getElementById("totid").value;

var serialids=document.getElementById("serialids").value;
var serisingalqtyids=document.getElementById("new_ent_stock_qtys").value;
var seritotids=document.getElementById("new_seri_totids").value;
 //alert(ent_qty_tot);
   $.ajax({
                type: 'POST',
                url: 'edit_qty',
                data: { updateid : updateid, entqtysid : ent_qty_tot, totalqty : tottid, serialids : serialids, serisingalqtyids : serisingalqtyids, seritotids : seritotids, sizedata : sizedata, proid : proid, old_ent_qty_tot : old_ent_qty_tot, old_tottid : old_tottid },
                success: function (result) {
                    //Your success code here..
					//alert(result);
					$( ".txtHint" ).html( result ); 
					
					$('#success_message').fadeIn().html("Record Updated Successfully.");
						setTimeout(function() {
							$('#success_message').fadeOut("slow");
						}, 2000 ); 
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

</div>
</div>
</div>
</div>
</body>
<?php $this->load->view("footer.php");?>