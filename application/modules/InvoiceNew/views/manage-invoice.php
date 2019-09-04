<?php
$this->load->view("header.php");
?>
	 <!-- Main content -->
	 <div class="main-content">
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">National</a></li> 
<li class="active"><strong>Manage Order</strong></li>
</ol>
</form>	
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
						<div class="panel-body">
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="update_item">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th>Customer / Store</th>
		<th>Order No.</th>
		<th>Note</th>
	    <th>Item Name</th>
        <th>Description</th>
        <th>Category</th>
		<th>Size/Qty</th>
		<th>Total Qty</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
 $id=$_GET['id'];
 //echo $id;
  $ctg=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name='$id'");
  $pctg=$ctg->row();

	$orderdtlquert=$this->db->query("select * from tbl_order_dtl where category_id='$pctg->prodcatg_id'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  


$stockQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
		  $stock_list = $stockQuery->row();

$catQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->category_id)
           -> get('tbl_prodcatg_mst');
		  $category_list = $catQuery->row();

 $sizeval=$fetch_list_orderdtl->size_name;
 $qtyyval=$fetch_list_orderdtl->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
?>
<tr>
<td>
<?php
$Qhdr=$this->db->query("select * from tbl_order_hdr where order_id='$fetch_list_orderdtl->order_id'");
$Qfetch=$Qhdr->row();
$cust=$Qfetch->customer_id;
if($cust!=''){
	$custhdr=$this->db->query("select * from tbl_contact_m where contact_id='$cust'");
	$CustQfetch=$custhdr->row();
	echo $CustQfetch->first_name;
}else{
	$Lochdr=$this->db->query("select * from tbl_location where id='$Qfetch->store_id'");
	$LocQfetch=$Lochdr->row();
	echo $LocQfetch->location_name;
}
?>

</td>
<td><?php
$nextyear=date("y");

$ss=$fetch_list_orderdtl->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;

 ?></td>
<td><?php 
$log=$this->db->query("select * from tbl_order_note_log where order_id='$fetch_list_orderdtl->order_id' order by log_id desc");
$note=$log->row();
echo $note->note_msg;
?></td>

<td><?php echo  $stock_list->productname; ?>
<br />
<?php  $taxoncount=sizeof(explode(',', $fetch_list_orderdtl->category_type)); 
			$taxexp=explode(',', $fetch_list_orderdtl->category_type);
			
		for($it=0;$it<$taxoncount;$it++){
		  $taxid=$taxexp[$it];
		
		$taxonQuery=$this->db->query("select * from tbl_product_stock where Product_id='$taxid'");
		$taxonnamelist=$taxonQuery->row();
		
?>
	
	<p style="padding: 0px 0px 0px 66px; margin: 0em 0em 0em;"><?php echo  $taxonnamelist->productname; ?></p>
<?php } ?>
</td>
<td style="width:150px;"><?php echo  $fetch_list_orderdtl->desc_name; ?></td>
<td><?php echo  $category_list->prodcatg_name; ?></td>
<td style="width: 200px;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><strong>Size</strong></th>
<?php for($i=1;$i<$sizecount;$i++){ ?>
<th style="text-align:center"><?php echo $sizearr[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php for($j=1;$j<$sizecount;$j++){ ?>
<th style="text-align:center"><?php echo $qtyarr[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</td>
<td><?php echo  $fetch_list_orderdtl->total_qty; ?></td>
</tr>
<?php $i++;   }?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>
<form class="form-horizontal" role="form" method="post" action="insertorderlog" enctype="multipart/form-data">			
<div id="editLog" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contentt">

        </div>
    </div>	 
</div>
</form>
<script>
function ordercancel(v){
var invid=document.getElementById("invidval").value;
if(invid==0){

var result = confirm("Are you sure you want to order cancel?");
if (result) {
 
 	var pro=v;
    
   $.ajax({
                type: 'POST',
                url: 'ordercancelfun',
                data: { valueone : pro },
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
	  alert("Invoice has been created");
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