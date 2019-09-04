<?php
$this->load->view("header");
$entries = "";
  if($this->input->get('entries')!=""){
    $entries = $this->input->get('entries');
  }
?>
<style>
.newpayment{background-color:#1ABC9C!important;border:none!important;color:#FFFFFF!important;
}
</style>
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 380px;font-size: 20px;">MANAGE GST PAYMENT</a>
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
	    	<a class="dt-button buttons-collection buttons-colvis newpayment" href="<?=base_url("Payment/gst_payment_Nat_edit");?>"><span>New Payment</span></a>
	
	</div>
	</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show
            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('Payment/manage_gst_payment');?>" class="form-control input-sm">

            <option value="10">10</option>
            <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
            <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
            <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
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

<table class="table table-striped table-bordered table-hover" >
<thead>
<tr>
<th>Date</th>
<th>Customer</th>
<th>Invoice</th>
<th>Mode</th>
<th>Amount</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$payment_hdr=$this->db->query("select * from tbl_payment_gst_hdr_new limit $page,$per_page");

foreach($payment_hdr->result() as $payment_hdr_res)
{
?>
<tr>
<th><?php echo $payment_hdr_res->dates;?></th>
<th><?php $cquery=$this->db->query("select * from tbl_contact_m where contact_id='$payment_hdr_res->customer_name'");$cqueryres=$cquery->row();echo $cqueryres->first_name;?></th>
<th><?php echo $payment_hdr_res->invoices;?>
</th>
<th><?php echo $payment_hdr_res->payment_mode;?></th>
<th><?php echo $payment_hdr_res->total_amount;?></th>
<th>
	
<button class="btn btn-default" type="button" data-toggle="modal" href='#viewgstpayment' data-backdrop='static' data-keyboard='false' onclick="View_Gst_Payment(<?php echo $payment_hdr_res->payment_gst_id; ?>,<?=$payment_hdr_res->customer_name?>)"> <i class="fa fa-eye"></i> </button>

</th>
</tr>

<?php }?>

</tbody>
</table>
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
<div id="viewgstpayment" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="popupform">
			
        </div>
    </div>	 
</div>
</form>
<script>
function View_Gst_Payment(id,name){
//alert(id+"id"+name+"name");
var xhttp = new XMLHttpRequest();

 xhttp.open("GET", "view_gst_payment_nat?name="+name+"&id="+id, false);
 xhttp.send();
 document.getElementById("popupform").innerHTML = xhttp.responseText;
 }
</script>
<?php
$this->load->view("footer");
?>
