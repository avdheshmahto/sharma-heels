<table class="table table-striped table-bordered table-hover txtHint" id="userTbl">
<thead>
<tr>
		<th style="display:none"><input name="check_all"  type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>StockPoint /Vendor Name</th>
	    <th>Type</th>
		<th>Phone No.</th>
		<th>GST %</th>
        <th>Address</th>	
		 <th>Action</th>
</tr>
</thead>

<tbody>

<?php

$i=1;
 $query=$this->db->query("select * from tbl_stockpoint_and_vendor where status='A' ORDER BY stockpid DESC limit 10 ");
  foreach($query->result() as $fetch_list)
  {

  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->stockpid; ?>">
<th style="display:none"><input name="cid[]" type="checkbox"  id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->stockpid; ?>" value="<?php echo $fetch_list->stockpid;?>" /></th>

<th><?php echo $fetch_list->stockpointname; ?></th>
<th><?php echo $fetch_list->type; ?></th>
<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->phone_no;?></a></th>
<th><?php echo $fetch_list->gst_per; ?></th>
<th><?php echo $fetch_list->address; ?></th>

<th>

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->stockpid;?>" href='#editcontact' type="button" onclick="stockPointUpdate('<?php echo $fetch_list->stockpid;?>')" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php
$pri_col='stockpid';
$table_name='tbl_stockpoint_and_vendor';
?>
<!--<button class="btn btn-default delbutton"  id="<?php echo $fetch_list->stockpid."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>	-->
</th>
</tr>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_stockpoint_and_vendor">  
<input type="text" style="display:none;" id="pri_col" value="stockpid">
</table>