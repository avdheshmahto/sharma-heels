<?php
$this->load->view("header.php");

$entries = "";
  if($this->input->get('entries')!=""){
    $entries = $this->input->get('entries');
  }
?>
<form id="f1" name="f1" method="POST" action="">
<!-- Main content -->
<div class="main-content">
	<a class="page-title" style="padding: 0 0 0 400px;font-size: 20px;">USE CREDITS</a>
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
	</div>
	</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show
            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('/GstPayment/use_credits');?>" class="form-control input-sm">

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

    <div id="DataTables_Table_0_filter " class="dataTables_filter">
    <label>Search:
    <input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
    </label>
    </div>
    </div>
    </div>
    </div>  			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover">
<thead>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
	  <tr>
	   <th>Invoice No.</th>
	   <th>Firm</th>
       <th>Customer Name</th>
	   <th>Date</th>
	   <th>Total</th>
	   <th>GST Amount</th>
	   <th>Grand Total</th>		
	   <th style="width:230px;">Action</th>
	  </tr>

</thead>

<tbody id="getDataTable">

<?php  
$i=1;

	$query=$this->db->query("select * from tbl_gst_invoice_hdr ORDER BY gst_inv_id DESC limit $page,$per_page");
	foreach($query->result() as $res)
{
?>

  
<tr class="gradeC record" data-row-id="">
<th><?php
		
	echo $res->invoice_no;?></th>
<th>
<?php 
	  
	 $fquery=$this->db->query("select * from tbl_master_data where serial_number='$res->firm_id'");
	 $fres=$fquery->row();
	 echo $fres->keyvalue;
?>
</th>

<th>
<?php
	$cquery=$this->db->query("select * from tbl_contact_m where contact_id='$res->customer_name'");
	$cres=$cquery->row();
	echo $cres->first_name;
?>
</th>

<th>
<?=$res->inv_date;?>
</th>
<th>
<?=$res->total;?>
</th>
<th>
<?=$res->gst_amt;?>
</th>
<th>
<?=$res->grand_total;?>
</th>
<th class="bs-example">

<button class="btn btn-default" data-a="<?php echo $res->gst_inv_id;?>" href='#viewcontact' type="button" onclick="viewInvoice('<?php echo $res->gst_inv_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="fa fa-eye"></i></button>
<?php 
$duequery=$this->db->query("select *,sum(payment) as payment_sum from tbl_payment_gst_dtl_new where inv_no='$res->gst_inv_id'");
$rows=$duequery->num_rows();
if($rows>0)
{
$duequeryres=$duequery->row();

$balance=(($res->grand_total)-($duequeryres->payment_sum));
} else { $balance=$res->grand_total;}
if($balance!=0){
?>
<button class="btn btn-sm" data-a="<?php echo $res->gst_inv_id;?>" href='#usecreditid' type="button" onclick="usecredit('<?php echo $res->gst_inv_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'>USE CREDITS</button>
<?php }
else
echo "Invoice Paid";?>

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
<div id="viewcontact" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" align="center">VIEW INVOICE<span > </span></h4>
<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
<div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div> 
</div>
<div class="modal-body overflow" id="divupdateid">

</div>
<div class="modal-footer" id="button">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>
<!---------------------------------------------USE CREDIT-------------------------------->
<form class="form-horizontal" id="excess_amount" method="post" action="">
<div id="usecreditid" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" align="center"><span > </span></h4>
<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
<div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div> 
</div>
<div class="modal-body overflow" id="usecreditdata">

</div>
<div class="modal-footer" id="button">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>
</div>

<script>
function viewInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "view_gst_Ordered?vid="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 
function usecredit(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "use_credit_page?ucid="+pro, false);
  xhttp.send();
  document.getElementById("usecreditdata").innerHTML = xhttp.responseText;
 } 
</script>
<script>

$("#excess_amount").validate({
       
    rules: {
      invoice_amount_paid: "required",
         },
      submitHandler: function(e) {
        ur = "<?php echo base_url('GstPayment/use_credits_invoice_entry');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#excess_amount').serialize(), // serializes the form's elements.
                success : function (data) {              
                    
                    
                    $("#usecreditid .close").click();
                    
          $('#success_message').fadeIn().html("Record Edited Successfully.");
                        setTimeout(function() {
              $('#success_message').fadeOut("slow");
            }, 2000 ); 
                                     
               }
            });
          return false;
                                }
  });



</script>

<?php
$this->load->view("footer.php");
?>


