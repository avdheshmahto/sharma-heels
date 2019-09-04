<?php

if($_GET['editId'] != ""){
   
   $EditQry=$this->db->query("select * from tbl_ordered_invoice_hdr where ordered_invoiceid='".$_GET['editId']."' AND status='A'");
   $editResult = $EditQry->result_array();
 
	if(sizeof($editResult) > 0){
	        
        $contactQry   = $this->db->query("select * from tbl_contact_m where contact_id =?",array($editResult[0]['customer_id']))->row();
        $customerName = $contactQry->first_name;

        $EditIdinvoice_date = $editResult[0]['invoice_date'];
        $EditIdDue_date     = $editResult[0]['due_date'];
        $EditIdTerm_name    = $editResult[0]['term_name'];
        $EditIdCredit_name  = $editResult[0]['credit_name'];
        $EditIdsub_tot      = $editResult[0]['sub_tot'];
        $EditIdbalance_due  = $editResult[0]['balance_due'];
          
   }
 }
?>

<div class="table-responsive">	 
	<table class="table table-striped table-bordered table-hover" id="dataTable" >	
		<tbody>
			<tr class="gradeA">
				<div id="divtestid"></div>
	            <th>Customer</th>
				<th><?=$customerName?></th>
				<th>Date:</th>
				<th><?=$EditIdinvoice_date!=""?$EditIdinvoice_date:date('d/m/Y'); ?></th>
				<th>Term : &nbsp;&nbsp;&nbsp;<?=$EditIdTerm_name;?></th>
				<th>Due Date : </th>
				<th colspan="2"><?=$EditIdDue_date!=""?$EditIdDue_date:date('d/m/Y'); ?></th>
			</tr>
			<tr class="gradeA">		    
			    <th>Credit Limit</th>
				<th colspan="2"><?=$EditIdCredit_name;?></th>
				<th colspan="2" style="text-align: right;">BALANCE DUE</th>
				<th colspan="3">
					<input type="text" id="actbaldue" value="<?=$EditIdbalance_due;?>" style="border: none;"  readonly="true"></th>
			</tr>
		</tbody>
		<tbody>
			<tr class="gradeA">
				<th style="width:170px">Item Name</th>
				<th style="width:170px">Description</th>
				<th style="width:75px">Category</th>
				<th>Order id</th>
				<!-- <th>Size / Qty</th> -->
				<th style="width:80px">Size/Qty</th>
				<th>Total Qty</th>
				<th>Price</th>
				<th style="width:120px">Total Price</th>
			</tr>
		 <?php if($_GET['editId'] != ""){
		    $EditQryData=$this->db->query("select D.*,P.productname as pname,C.prodcatg_name  from tbl_ordered_invoice_dtl D,tbl_product_stock P,tbl_prodcatg_mst C where P.Product_id = D.item_id  AND D.category_id = C.prodcatg_id  AND D.ordered_invoiceid = ?  AND D.status = 'A'",array($_GET['editId']));
		    $editResultData =  $EditQryData->result_array();
		  //   echo "<pre>";
		  // print_r($editResultData);
		  //  echo "</pre>";
			  if(sizeof($editResultData) > 0){
		          foreach ($editResultData as $dtdata) {
                // echo "select * from  tbl_order_dtl  where order_id = '".$dtdata['order_id']."' AND item_id ='".$dtdata['item_id']."' AND customer_id = '".$dtdata['customer_id']."' AND category_id IN ('".$dtdata['category_id']."'";
                    if($dtdata['sub_item_id'] != ""){
                   // 	echo "select * from  tbl_order_dtl  where order_id = ".$dtdata['order_id'] ." AND customer_id = ".$dtdata['customer_id']." AND category_id = ".$dtdata['category_id']." AND find_in_set(".$dtdata['item_id'].",category_type) AND item_id = '".$dtdata['sub_item_id']."' AND status = 'A'";
                      $qry = "select * from  tbl_order_dtl  where order_id = ?  AND customer_id = ? AND category_id =?  AND find_in_set(".$dtdata['item_id'].",category_type) AND item_id = '".$dtdata['sub_item_id']."' AND status = 'A'";
                    }else{
                     $qry = "select * from  tbl_order_dtl  where order_id = ?  AND customer_id = ? AND category_id =? AND item_id = '".$dtdata['item_id']."' AND status = 'A'";
                    }
		          	$EditQryData1    =  $this->db->query($qry,array($dtdata['order_id'],$dtdata['customer_id'],$dtdata['category_id']));
		            $editResultData1 =  $EditQryData1->result_array();
		          
			        $expd_size =   explode('|', $editResultData1[0]['size_name']);
			        $qty_name  =   explode('|', $editResultData1[0]['qty_name']);
			        $loopVal   =   count($expd_size)-1;
			        $expdQty   =   explode(',', $dtdata['qty_val']);

			        $EditIdtotal_price     = $dtdata['total_price'];
	                $EditIdone_item_price  = $dtdata['one_item_price'];
	                $EditInvoiceDltID      = $dtdata['ordered_invoiceid_dtl'];
	              //  print_r($qty_name);
         ?>
		<tr>
			<th>
			 <span style="font-size:14px; text-decoration:underline; color:#ec407a;">
			    <p style="padding: 0px 0px 0px 40px; margin: 0em 0em 0em;"><?=$dtdata['pname'];?></p>
			      <input type="hidden"  value="<?=$loopVal;?>" name = "cellsSize[]">
			      <input type="hidden"  value="<?=$EditInvoiceDltID;?>" name = "rowId[]">
			      <input type="hidden"  value="<?=$_GET['editId'];?>" name = "invoiceId">
			 </span>
			</th>
			<th>
			<textarea style="height:95px; background-color:#fff;" name ="descname[]"><?=$dtdata['description'];?></textarea>
			</th>	
			<th>
			  <?=$dtdata['prodcatg_name'];?>
			</th>
			<th>
				<?php
					$nextyear=date("y");
					$ss=$dtdata['order_id'];
					$var = str_pad($ss,1,'0',STR_PAD_LEFT);
					$numbercase = sprintf('%04d',$var);
					echo "NAT"."/".$nextyear."/".$numbercase;
				 ?>
			</th>
		    <th style="width:312px;">
				<div class="table-responsive2" style="width:320px;color:#000000;overflow-y: auto;overflow-x: scroll;">
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
						<th style="width:200px;"><div class="qty-size"><strong>Size</strong></div></th>
						<?php 
						$totalSize = 0;
						for($i=1;$i<=$loopVal;$i++) { ?>
						<th style="text-align:center;width: 10px;"><?=$expd_size[$i];?></th>
						<?php 
                          $totalSize = $totalSize.'_'.$expd_size[$i];
					    } ?>
					    <input type="hidden" id="totalSize<?=$dtdata['ordered_invoiceid_dtl'];?>" value="<?=$totalSize;?>">
						</tr>
						</thead>
						<tbody>
						  <tr class="gradeX">
							<td><strong>Ord Qty</strong></td>

							<?php 
							
							for($i=1;$i<=$loopVal;$i++) { ?>
							<input type="hidden" value="<?=$qty_name[$i];?>" id="checkorderedqtyiddto161" class="form-control">
							<th style="text-align:center">
								<?=$qty_name[$i];?></th><!-- $qty_name[$i]+$expdQty[$i-1] -->
							<?php 
                                   
						    } ?>
                           </tr>

							<tr class="gradeX">
							<td><strong>Ent Qty</strong></td>
							<?php 
 							$totalEntQty = 0;
							for($i=0;$i<$loopVal;$i++) { ?>
							<th style="text-align:center">
								<input type="text" class="form-control" id="enterqty<?=$dtdata['ordered_invoiceid_dtl'];?>_<?=$expd_size[$i+1];?>"  style="width:65px; text-align:center; padding:0 0 0 0px; background-color:#FFFFFF;" name="enterQty[]"  value="<?=$expdQty[$i];?>" onkeyup="enterQty(this.id,'<?=$dtdata['ordered_invoiceid_dtl'];?>');">
								<input type="hidden" name="totalQty1" value = "<?=$qty_name[$i+1]+$expdQty[$i];?>" id="hiddenQty<?=$dtdata['ordered_invoiceid_dtl'];?>^<?=$expd_size[$i+1];?>" >
							</th>
							<?php 
                              } 
                            ?>

							</tr>
						</tbody>
					</table>
				</div>
		 </th>

		<th style="width:10px;">
		  <div style="width:100px;">
			<div class="table-responsive2">
				<table class="table table-striped table-bordered">
					 <thead>
					  <tr><th style="text-align:center" colspan="2"><strong>All Sizes</strong></th></tr>
					 </thead>
				<tbody>
					<tr class="gradeX">
					  <th style="text-align:center;"><?=$editResultData1[0]['total_qty'];?></th>
					</tr>
					<tr>
						<th style="text-align:center">
					    <input type="text" name="totalqty[]" id="totalShowQty_<?=$dtdata['ordered_invoiceid_dtl'];?>" class="form-control" style="text-align:center; background-color:#FFFFFF;" value="<?=$dtdata['total_qty'];?>" readonly="">
						</th>
						<input type="hidden" name="" id="valnotnullidto" class="form-control" style="text-align:center" value="" readonly="">
					</tr>
				</tbody>
						</table>
					</div>
				</div>
			</th>
		<input type="hidden" name="" id="pricessidto" class="form-control" style="text-align:center" value="" readonly="">
		   <th style="text-align:center"><?=$EditIdone_item_price;?></th>
		   <th style="width:10px;">
		   <div style="width:100px;">
		   <div class="table-responsive2">
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				   <th style="text-align:center" colspan="2"></th>
				  </tr>
				</thead>
				<tbody>
				 <tr class="gradeX">	
					<td style="text-align:center"><?=$editResultData1[0]['total_qty'];?></td>
					</tr>
					<tr class="gradeX">
					<th style="text-align:center">
					<input type="hidden" name="" id="priceid<?=$dtdata['ordered_invoiceid_dtl'];?>" class="form-control" value="<?=$EditIdone_item_price;?>" readonly="">
					<input type="text" name="finalPrice[]" id="finalprice<?=$dtdata['ordered_invoiceid_dtl'];?>" class="form-control" value="<?=$EditIdtotal_price;?>" style="text-align:center; background-color:#FFFFFF;  padding:0 0 0 0px;" readonly="">

					<input type="hidden" id="finalpricesecond<?=$dtdata['ordered_invoiceid_dtl'];?>" class="form-control" value="<?=$EditIdtotal_price;?>">
				    </th>
					<input type="hidden" id="resetvalidto61" class="form-control" value="false">
				</tr>
				</tbody>
			</table>
		</div>
		</div>
		</th>
		</tr>
		<?php }}} ?>
	</tbody>		
    <tr> 
		<th colspan="6" style="text-align: right;">Total</th>
		<th colspan="2">
	    <input type="text" class="form-control" name="sub_tot" style="text-align:center; border:none; background:#FFFFFF;" id="subtotpriid" readonly="true" value="<?=$EditIdsub_tot;?>">

	     <input type="hidden" class="form-control" id="subtotpriidsecond" value="<?=$EditIdsub_tot;?>">
		</th>
	</tr>
	<tr> 
		<th colspan="6" style="text-align: right;">Balance Due</th>
		<th colspan="2">
		<input type="text"  name="balance_due" style="text-align:center; border:none; background:#FFFFFF;" id="baltotpriid" class="form-control" readonly="true"  value="<?=$EditIdbalance_due;?>" />
		</th>
	</tr>
   </table>
</div>
