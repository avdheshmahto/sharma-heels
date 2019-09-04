
<select name="c_firm_name" id="c_firm_name" required class="form-control" onchange="invoicedetail();">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where contact_id='$cid' and module_status='National'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<?php $arr=explode(',', $fetch_protype->firma_name);foreach ($arr as $item) {?>	
				<option value="<?php echo $fetch_protype->contact_id."^".$item;?>"><?=$item?></option>
					<?php }} ?>

					</select>