											
<table class="table table-striped table-bordered table-hover txtHint" id="userTbl">
<thead>
<tr>
		<th style="display:none"><input name="check_all"  type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>Name</th>
		<th>Receivable</th>
		<th>Payable</th>
        <th>Credit Limit</th>
		<th>Mobile No.</th>
        <th>Email Id</th>		
		 <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php

$i=1;
 $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='National' ORDER BY contact_id DESC limit 10");
  foreach($query->result() as $fetch_list)
  {

  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
<th style="display:none"><input name="cid[]" type="checkbox"  id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>

<th><a href="<?=base_url();?>master/Account/contact_log?id=<?php echo $fetch_list->contact_id; ?>">
<?php echo $fetch_list->first_name; ?></a></th>
<th><?php if($fetch_list->add_opening_balancename=="Dr"){ echo $fetch_list->add_opening_balance." ".$fetch_list->add_opening_balancename; }?></th>
<th><?php if($fetch_list->add_opening_balancename=="Cr"){echo $fetch_list->add_opening_balance." ".$fetch_list->add_opening_balancename;}?></th>
<th><?php echo $fetch_list->credit_limit;?></th>

<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><?=$fetch_list->email;?></th>

<th>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#viewcontact' type="button" onclick="viewcustomer('<?php echo $fetch_list->contact_id;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="fa fa-eye"></i></button>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->contact_id;?>" href='#editcontact' type="button" onclick="updatecustomer('<?php echo $fetch_list->contact_id;?>')"  data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php
$pri_col='contact_id';
$table_name='tbl_contact_m';

$ordrhdr=$this->db->query("select * from tbl_order_hdr where customer_id='$fetch_list->contact_id'");
$hdrcount=$ordrhdr->num_rows();

$invhdr=$this->db->query("select * from tbl_ordered_invoice_hdr where customer_id='$fetch_list->contact_id'");
$invcount=$invhdr->num_rows();

$pcash=$this->db->query("select * from tbl_payment_cash where contact_id='$fetch_list->contact_id'");
$pcashcount=$pcash->num_rows();

$pgst=$this->db->query("select * from tbl_payment_gst where contact_id='$fetch_list->contact_id'");
$pgstcount=$pgst->num_rows();

$map=$this->db->query("select * from tbl_contact_product_price_mapping where contact_id='$fetch_list->contact_id'");
$mapcount=$map->num_rows();

$iddds=$hdrcount + $invcount + $pcashcount + $pgstcount + $mapcount ;

//echo $iddds;

if($iddds=='0')
{
?>
<!-- <button class="btn btn-default delbutton"  id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>	
 --><?php } ?>
</th>
</tr>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
<input type="text" style="display:none;" id="pri_col" value="contact_id">
</table>

