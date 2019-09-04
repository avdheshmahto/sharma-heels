<?php
 $ID=$_GET['ID'];

$pQ=$this->db->query("select * from tbl_product_stock where productname='$ID'");
$pfetch=$pQ->num_rows();
if($pfetch>0){
?>
<label id="category-error" class="error" for="category">Item name already exists.</label>
<?php
//echo $pfetch;
}else{

 } ?>