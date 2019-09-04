<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
	 <!-- Main content -->
	 <div class="main-content">
<a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">MANAGE ORDER</a>
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
<a class="btn btn-sm gr" data-a="0" href="<?=base_url();?>salesorder/SalesOrder/manageSalesOrder" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Order </span>
</a>
</div>
</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show
            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('salesorder/SalesOrder/manageorder');?>" class="form-control input-sm">

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
<div class="table-responsive">	
<form class="form-horizontal" method="post" action="">					
<table class="table table-striped table-bordered table-hover" >
<thead>
<tr>
		<th>Order No.</th>
		<th>Note</th>
	  <th>Customer Name</th>
    <th>Order Date</th>
    <th>Total Qty</th>
		<th>Status</th>
		<th style="width:130px;">Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<?php  
$i=1;
 
  $query=$this->db->query("select * from tbl_order_hdr where status='A' Order by order_id desc limit $page,$per_page ");	       
  $result=$query->result(); 
 
  foreach($result as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->order_id; ?>">
<th><?php
$nextyear=date("y");

$ss=$fetch_list->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;

 ?></th>
<th><?php 
$log=$this->db->query("select * from tbl_order_note_log where order_id='$fetch_list->order_id' order by log_id desc");
$note=$log->row();
echo $note->note_msg;
?></th>
<th>
<?php
		
	if($fetch_list->customer_id!=''){	
	
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
<th>
<?php 
 $orderdtl = $this -> db
           -> select('*')
           -> where('order_id',$fetch_list->order_id)
           -> get('tbl_order_dtl');
		  foreach($orderdtl->result() as $orderdtl_list)
		  {
		  	$qtysum  = $qtysum + $orderdtl_list->total_qty;
		  }

echo $fetch_list->order_date;

?>
</th>
<th><?=$qtysum;?></th>
<th><?php
echo $fetch_list->invoice_status;
?></th>
<th class="bs-example">

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->order_id;?>" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="fa fa-eye"></i></button>
<button class="btn btn-sm modalEditcontacttt" data-a="<?php echo $fetch_list->order_id;?>" href='#editLog' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>Add Log</button>

<!-- <button class="btn btn-default modalUpdateOrder" data-a="<?php echo $fetch_list->order_id;?>" href='#updateorder' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button> -->

<?php if($fetch_list->cancel_status=='Cancel'){ ?>
<!-- <button class="btn btn-danger" type="button"> <i class="icon-cancel"></i> </button>-->
<?php } $qtysum=0; ?>
</th>
</tr>
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
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
</div>
</div>
</div>
</div>
</div>
</div>

<!--main-content close-->
<div id="updateorder" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Edit Order<span > </span></h4>
<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
<!-- <div id="msgdata" class="text-center "    style="font-size: 15px;color: red;"></div>  -->

</div>
<form  method="post" action="" id ="orderedEdit" >
  <!-- <input type="text" name="orderedvalue" value="hello"> -->
<div class="modal-body overflow" id="getupdataeEditOreder">
</div>
<div class="modal-footer" id="button">

  <input type="submit" class="btn btn-sm" value="Save"> 
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>






<!-- <div id="updateorder" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-updateorder">
        </div>
    </div>   
</div> -->


 <form class="form-horizontal" role="form" method="post" action="insertorderlog" enctype="multipart/form-data">			
<div id="editLog" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contentt">

        </div>
    </div>	 
</div>
</form> 
<script type="text/javascript">
function enterqty(d,r){
    
    var regex = /(\d+)/g;
    nn= d.match(regex)
    id=nn;  
  
var sp=d.split("orderedqtyidd");

var asx= sp[1];
//alert(d);

var class_name = document.getElementById(d).getAttribute("class");
//alert(class_name);
var totalqty =  sumOfQuantities(class_name,r);

/*
 var validationentettrqty=document.getElementById("checkorderedqtyidd"+asx).value;
      var twoqteeey=document.getElementById("orderedqtyidd"+asx).value;
            
  if(Number(twoqteeey)<=Number(validationentettrqty)){  
      document.getElementById("sv1").disabled = false;
  }else{    
      document.getElementById("sv1").disabled = true;
      document.getElementById("orderedqtyidd"+asx).focus();
  }

    var countsizeidall=document.getElementById("countsizeid"+r).value;        
        var sumtwoqty=0;
        var qtyselected = [];
     for(var k=1; k<countsizeidall; k++){
     var validationenterqty=document.getElementById("checkorderedqtyidd"+k+r).value;      
      var twoqty=document.getElementById("orderedqtyidd"+k+r).value;
      var validorredqty=document.getElementById("validorqtyid"+k+r).value;
      if(Number(twoqty)<=Number(validationenterqty)){       
        var sumorqty=Number(validorredqty)+Number(twoqty);        
          sumtwoqty +=Number(twoqty); 
          qtyselected.push(twoqty); 
      }else{
        var sumorqty=0;
        alert("Enter Qty Is Greate Then");                  
        
      }
           }
    
    var countsizeidallt=countsizeidall-1;
    var qtyselectedsd = [];
    for(var l=1;l<countsizeidallt; l++){
    var twdsoqty=document.getElementById("orderedqtyidd"+l+r).value;
    qtyselectedsd.push(twdsoqty);         
    }
    var sumtoallqty=Number(twdsoqty)+Number(sumorqty);           
    var qtysetall=qtyselectedsd+','+sumorqty;
    document.getElementById("totalorid"+r).value=+sumtoallqty; 
    document.getElementById("orqtyid"+r).value=qtysetall; 
        
    var priceorid=document.getElementById("priceorid"+r).value;     
    var multpri=Number(priceorid)*Number(sumtoallqty);
    document.getElementById("finalpriceorid"+r).value=multpri; */
  }     
</script>
<script>
function ordercancel(v){

var invid=document.getElementById("rmksid"+v).value;
if(invid!=''){

var result = confirm("Are you sure you want to Item cancel?");
if (result) { 
// alert(v);
 
 	var pro=v;
    
   $.ajax({
                type: 'POST',
                url: 'ordercancelfun',
                data: { valueone : pro, remaksval : invid },
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
	
	}else{
		

		}
	}else{ 
	  alert("Please enter remarks");
 }
}
</script>
<script>
    $('.modalEditcontact').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"viewOrder?ID="+ID,cache:true,success:function(result){
            $(".modal-contenttt").html(result);
        }});
    });

    $('.modalUpdateOrder').click(function(){
        var ID=$(this).attr('data-a');
      $.ajax({url:"updateOrder?ID="+ID,cache:true,success:function(result){
            $("#getupdataeEditOreder").html(result);
        }});
    });
	
	    $('.modalEditcontacttt').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"viewOrderLog?ID="+ID,cache:true,success:function(result){
            $(".modal-contentt").html(result);
        }});
    });
	
</script>	
<?php

$this->load->view("footer.php");
?>