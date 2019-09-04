<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add&nbsp;StockPoint / Vendor</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="text" id="stockpointid" name="stockpointid" value="" class="form-control">
</div> 

<label class="col-sm-2 control-label">*Type:</label> 
<div class="col-sm-4"> 
<select id="pointtypeid" name="pointtypeid" class="form-control">
	<option value="">--select--</option>
	<option value="StockPoint">StockPoint</option>
	<option value="Vendor">Vendor</option>
</select>
</div> 
</div>
<div class="form-group">  
<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="Enter 10 digit mobile number"  value="" class="form-control" >
</div> 
<label class="col-sm-2 control-label">GST%:</label> 
<div class="col-sm-4"> 
<input type="number" id="gstid" name="gstid" value="" class="form-control">
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Address:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  id="addressid" name="addressid" class="form-control" required></textarea>
</div>  
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>