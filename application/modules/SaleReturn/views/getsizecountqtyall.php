<?php

 $countsize;

	$pidsize=explode("^",$countsize);
	$countsizetotal=$pidsize[0];	
	$sizetotal=$pidsize[1];
	$qtytotal=$pidsize[2];	
	$orderinqtytotal=$pidsize[3];	
	$sizeval=explode(" | ",$sizetotal);
	$qtyval=explode(",",$qtytotal);
	$orderinqtyval=explode(" ",$orderinqtytotal);

?>

<div class="col-sm-6">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>


<tr class="gradeA">
<th>Size</th>
<th>Sale Qty</th>
<th>Quantity</th>

</tr>
<?php
for($j=1;$j<$countsizetotal;$j++){
$jr=$j-1;
?>
<tr class="gradeA">
	<td><input type="text" name="" readonly id="sizeiddd<?php echo $j; ?>" class="form-control" value="<?php echo $sizeval[$j]; ?>" /></td>
	<td><input type="text" name="" readonly class="form-control" value="<?php echo $qtyval[$jr]; ?>" /></td>
	<td><input type="number" step="any"  name="" id="qty<?php echo $j; ?>" tabindex="1" class="form-control" onkeyup="qtyenter(this.id,this);entertest();" value="" /></td>
	<input type="hidden" id="demo<?php echo $j; ?>" />
</tr>
<?php } ?>
<input type="hidden" id="demottt" />
<input type="hidden" id="demottttd" />
<input type="hidden" id="notactionid" value="" />
</tbody>

</table>
</div>
</div>

<div class="col-sm-4">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="display:none">
<tbody>
<tr class="gradeA">
<th>Actual Qty</th>
<th>Effective Qty</th>
</tr>
<?php
for($k=0;$k<$countsizetotal;$k++){
$affiqty= $qtyval[$k]-$orderinqtyval[$k];
?>
<tr class="gradeA">
	<td><input type="text" name="" id="actqty<?php echo $k; ?>"  readonly class="form-control" value="<?php echo $qtyval[$k]; ?>" /></td>
	<td><input type="text" name="" id="effqty<?php echo $k; ?>" readonly class="form-control" value="<?php echo $affiqty; ?>" /></td>
</tr>
<?php } ?>
</tbody>

</table>
</div>
</div>