<?php  
	$all_data=$_GET['id'];
	$ex=explode("^",$all_data);
	$proid=$ex[0];
	$cateid=$ex[1];
	$sizeall=$ex[2];
	$entered_qty=$ex[3];
	$order_qty=$ex[4];
	$act_qty=$ex[5];

$qry=$this->db->query("select * from tbl_product_stock where Product_id='$proid' and category='$cateid'");	
$fetchq=$qry->row();
$stock_order_value = $fetchq->qtyinstock;
$stock_act_qty = $fetchq->quantity;	

				$qtycount = sizeof(explode(',', $entered_qty));
	 		    $sizecount   = count(explode(' | ', $sizeall));
	 		     //explode(' | ', $sizeval);
		  
			     $sizent      = 0;
			     $qtynt       = 0;
			     $sumactqty   = 0;

					  $sub_ord_qty    = array();
					  $sub_act_qty   = array();
                        $exp_qty       = explode(',', $entered_qty);
					    $exp_ord     = explode(' ', $stock_order_value);
					    $exp_act    = explode(' ', $stock_act_qty);
					for($p=0;$p<$sizecount;$p++){
						//echo $expor[$p].'-'.$exp[$p];
					    $sub_ord_qty[]  = $exp_ord[$p]-$exp_qty[$p];
					    $sub_act_qty[] = $exp_act[$p]-$exp_qty[$p];
                        $sumactqty +=$exp_qty[$p];	
					}

			    // $impqtyoreder = implode(' ', $out);
			    // $impactqty    = implode(' ', $outactqty);

				 $implode_qty_oreder = implode(' ', $sub_ord_qty);
			     $implode_act_qty    = implode(' ', $sub_act_qty);
					
				$str = $implode_qty_oreder;
				$str . "<br>";
			    //print_r($stockqtyord = rtrim($str,"0!"));	
				
				$stractqty   = $implode_act_qty;
				$stractqty ."<br>";
				//print_r($stockqtyordactqty=rtrim($stractqty,"0!"));	

				//$ts=array(7,-10,13,8,4,-7.2,-12,-3.7,3.5,-9.6,6.5,-1.7,-6.2,7);
				//echo $ts=$sub_ord_qty;

//========================== order function ============================================
				$order_pos_arr=array(); $order_neg_arr=array();
				foreach($sub_ord_qty as $val)
				{
				    ($val<0) ?  $order_neg_arr[]=$val : $order_pos_arr[]=$val;
				}
				//print_r($order_pos_arr);
				//print_r($order_neg_arr);

				 $order_neg_count=count($order_neg_arr);

				 	if($order_neg_count>0){

		?>
				<input type="hidden" id="order_val_neg_id" value="1">
		<?php

				}else{

			?>
				<input type="hidden" id="order_val_neg_id" value="2">
			<?php
		}                    
//========================= stock function =============================================				

				$stock_pos_arr=array(); $stock_neg_arr=array();
				foreach($sub_act_qty as $val)
				{
				    ($val<0) ?  $stock_neg_arr[]=$val : $stock_pos_arr[]=$val;
				}
				//print_r($stock_pos_arr);
				//print_r($stock_neg_arr);
				 $neg_stock=count($stock_neg_arr);
				if($neg_stock>0){

		?>
				<input type="hidden" id="val_neg_id" value="1">
		<?php

				}else{

			?>
				<input type="hidden" id="val_neg_id" value="2">
			<?php
		}                                                                     
//========================= end stock function =============================================
?>			



