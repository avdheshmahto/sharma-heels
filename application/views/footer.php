<!-- Footer -->
<footer class="footer-main"> 
Copyright &copy; 2016 <a target="_blank" href="http://www.techvyas.com/"> techvyas</a> All rights reserved.
</footer>	
<!-- /footer -->
</div>
<!-- /main content -->
</div>
  <!-- /main container -->
</div>
<!-- /page container -->

<!--Load JQuery-->

<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/metismenu/js/jquery.metisMenu.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery.blockUI.js"></script>

<!--Knob Charts-->
<script src="<?=base_url();?>assets/plugins/knob/js/jquery.knob.min.js"></script>

<!--Jvector Map-->
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>

<!--ChartJs-->
<script src="<?=base_url();?>assets/plugins/chartjs/js/Chart.min.js"></script>

<!--Morris Charts-->
<script src="<?=base_url();?>assets/plugins/morris/js/raphael-min.js"></script>
<script src="<?=base_url();?>assets/plugins/morris/js/morris.min.js"></script>

<!--Float Charts-->
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.resize.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.pie.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.time.min.js"></script>

<!--Functions Js-->
<script src="<?=base_url();?>assets/js/functions.js"></script>

<!--Dashboard Js-->
<script src="<?=base_url();?>assets/js/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
<script>


$("#invoiceEditForm").validate({
   
      submitHandler: function(form) {
        ur = "<?=base_url('OrderedInvoiceNew/OrderedInvoiceNew/ajax_updateInvoice');?>";
        var formData = new FormData(form); 
        // alert('$(this)[0]');
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                 // alert(data); // show response from the php script.                    
                    if(data == 1){
                        var msg = "Data Successfully Update !";
            
                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-1 .close").click();
                      $("#resultarea").text(" "); 
                      $('#invoiceEditForm')[0].reset(); 
                      //$("#Product_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
                // ajex_termListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

$("#orderedEdit").validate({
    // rules: {
    //   first_name: "required",
    //   maingroupname:"required"
    // },
      submitHandler: function(e) {
        ur = "<?=base_url('salesorder/SalesOrder/ajax_editOrder');?>";
         // alert($('#orderedEdit').serialize());
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#orderedEdit').serialize(), // serializes the form's elements.
                success : function (data) {
                  console.log(data); // show response from the php script.
                    
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#updateorder .close").click();
                      $("#resultarea").text(" "); 
                      $('#orderedEdit')[0].reset(); 
                   // $("#Product_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
                // ajex_contactListData();
               }
            });
          return false;
        //e.preventDefault();
      }
  });

  function sumOfQuantities(calssname,rowid){
     
      var sum = 0;
      $("input[class *= '"+calssname+"']").each(function(){
        sum += +$(this).val();
     });
     
     $("#totqtyidd_"+rowid).val(sum);

  }
// $("#orderedEdit").validate({
   
//       submitHandler: function(form) {
//         ur = "<?=base_url('salesorder/SalesOrder/ajax_editOrder');?>";
//         //alert();
//         var formData = new FormData("#orderedEdit"); 
//         alert($().serialize());
//         console.log(formData);
//             $.ajax({
//                 type : "POST",
//                 url  :  ur,
//                 //dataType : 'json', // Notice json here
//                 data : formData, // serializes the form's elements.
//                 success : function (data) {
//                   alert(data); // show response from the php script.
//                   if(data == 1){
//                     var msg = "Data Successfully Update !";
                      

//                    $("#resultarea").text(msg); 
//                    setTimeout(function() {   //calls click event after a certain time
//                       $("#updateorder .close").click();
//                       $("#resultarea").text(" "); 
//                       $('#orderedEdit')[0].reset(); 
//                       //$("#Product_id").val("");
//                    }, 1000);
//                 }else{
//                     $("#resultarea").text(data);
//                }
//                // ajex_termListData();
//               },
//               error: function(data){
//                  alert("error");
//               },
//             cache: false,
//             contentType: false,
//             processData: false
//         });
//      return false;
//          //e.preventDefault();
//    }
//  });

function  enterQty(id,itemval){
    var res = id.split("_");
     
    var enterQty  =  document.getElementById(id).value;
    
    var hiddenQty =  document.getElementById('hiddenQty'+itemval+'^'+res[1]).value;
    var totalsize =  document.getElementById('totalSize'+itemval).value;
    //alert(hiddenQty);
    
   
    //alert(countTotalSize);
    if(Number(enterQty) > Number(hiddenQty)){
       alert('Please Enter Qty is Less ord Qty !');
       document.getElementById(id).value = 0;
       //enterQty(id);
       document.getElementById(id).focus();

    }

    var totalsizeArr = totalsize.split("_");
    //alert(totalsizeArr);
    var countTotalSize = 0;
    for (var i = 1; i < totalsizeArr.length; i++) {
      countTotalSize  =  countTotalSize+Number(document.getElementById('enterqty'+itemval+'_'+totalsizeArr[i]).value);
    }
  //  alert('totalShowQty_'+itemval);  
    var priceVal = document.getElementById('priceid'+itemval).value;
    document.getElementById('totalShowQty_'+itemval).value = countTotalSize;
   // alert(priceVal)
    document.getElementById('finalprice'+itemval).value = Number(priceVal)*countTotalSize;
    var finalsec=document.getElementById('finalpricesecond'+itemval).value;
    var totprice=Number(priceVal)*countTotalSize;
    totalprice(finalsec,totprice);
  }

function totalprice(pretotprice,totalprice){
    var subtot=document.getElementById('subtotpriidsecond').value;
    var baldue=document.getElementById('baltotpriid').value;    
    //alert(subtot);
    var subprice=Number(subtot)-Number(pretotprice);
    var sumtotprice=Number(subprice)+Number(totalprice);
    document.getElementById('subtotpriid').value=sumtotprice;
    var subbaldue=Number(baldue)-Number(pretotprice);
    var sumbaldue=Number(subbaldue)+Number(totalprice);
    document.getElementById('actbaldue').value=sumbaldue;
}

$('.email.dropdown').dropdown();

$('.emails.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>
<script>

$('.location.dropdown').dropdown();

$('.location.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>

<script>

$('.categytypeid.dropdown').dropdown();

$('.categytypeid.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>

<script>

$('.itemboth.dropdown').dropdown();

$('.itemboth.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>


</body>

</html>
<!-- starts here this javascript code is for multiple delete -->
<script type="text/javascript">
$(document).ready(function(){
	jQuery('#master').on('click', function(e) {
		if($(this).is(':checked',true))  
		{
			$(".sub_chk").prop('checked', true);  
		}  
		else  
		{  
			$(".sub_chk").prop('checked',false);  
		}  
	});
	
	
	jQuery('.delete_all').on('click', function(e) { 
		var allVals = [];  
		$(".sub_chk:checked").each(function() {  
			allVals.push($(this).attr('data-id'));
		});  
		//alert(allVals.length); return false;  
		if(allVals.length <=0)  
		{  
			alert("Please select row.");  
		}  
		else {  
			//$("#loading").show(); 
			WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){  
				//for server side
				
				var table_name=document.getElementById("table_name").value;
				var pri_col=document.getElementById("pri_col").value;
				var join_selected_values = allVals.join(","); 
			//alert(join_selected_values);
				$.ajax({   
				  
					type: "POST",  
					url: "multiple_delete_two_table",  
					cache:false,  
					data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
					success: function(response)  
					{   
						$("#loading").hide();  
						$("#msgdiv").html(response);
						//referesh table
					}   
				});
              //for client side
			  $.each(allVals, function( index, value ) {
				  $('table tr').filter("[data-row-id='" + value + "']").remove();
			  });
				

			}  
		}  
	});
	jQuery('.remove-row').on('click', function(e) {
		WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){
				$('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
			}
	});
});
</script> 

<!-- ends here this javascript code is for multiple delete -->

<!-- starts here this javascript code is for single delete -->
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for single delete -->
<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonSales").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_sales_order_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->
<!-- starts here this javascript code is for  invoice delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonInvoice").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_invoice_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for invoice delete -->

<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {
$(".delbuttonPurchase").click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id");
//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_purchase_order_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->
<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}
</script>

<!-----------------drop down select start here------------->

<script type="text/javascript" src="<?=base_url();?>assets/dropdown-customer/mock.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.css">
<script src="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.js"></script>
<script>

    var Random = Mock.Random;
    var json1 = Mock.mock({
      "data|10-50": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled|1-2": true,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-1').dropdown({
      data: json1.data,
      limitCount: 40,
      multipleMode: 'label',
      choice: function () {
        // console.log(arguments,this);
      }
    });

    var json2 = Mock.mock({
      "data|10000-10000": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled": false,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-2').dropdown({
      limitCount: 5,
      searchable: false
    });

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

    $('.dropdown-sin-2').dropdown({
      data: json2.data,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });
</script>
<!--Loader Js-->
<script src="<?=base_url();?>assets/js/loader.js"></script>

<script src="<?=base_url();?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/vfs_fonts.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables-script.js"></script>

<link href="<?=base_url();?>assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">

<!-----------------drop down select ends here------------->
<!-----------------flash timmer code starts here------------->
<script>
$(document).ready(function(){

   setTimeout(function(){

       $('#success-alert').fadeOut();}, 4000);

});

</script>
<!-----------------ends timmer code starts here-----  datecss -------->
<!---------------------datepicker js------------------------------->

<script src="<?=base_url();?>assets/datecss/gijgo.min.js" type="text/javascript"></script>
<link href="<?=base_url();?>assets/datecss/gijgo.min.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function () {
  
    $("#entries").change(function()
    {
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
      url = pageurl+"?entries="+value;
      window.location.href = url;
    });

    $('.datepicker').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>

<script>
$(document).ready(function () {
    $('.datepicker2').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>

<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}

//manage page search script//

function doSearch() {
  
    var searchText = document.getElementById('searchTerm').value;
    var targetTable = document.getElementById('dataTable');
    var targetTableColCount;
            
    //Loop through table rows
    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        //Get column count from header row
        if (rowIndex == 0) {
           targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
           continue; //do not execute further code for header row.
        }
                
        //Process data rows. (rowIndex >= 1)
        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
        }

        //If search term is not found in row data
        //then hide the row, else show
        if (rowData.indexOf(searchText) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
        else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
    }
}
   

   ////manage page search script///
/*

function doSearch() {
    //alert('afsdfasdf');
   var searchText = document.getElementById('searchTerm').value;
   var targetTable = document.getElementById('getDataTable');
   var targetTableColCount;
          // alert('aadf');
   //Loop through table rows
   for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
       var rowData = '';

       //Get column count from header row
       if (rowIndex == 0) {
          targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
          continue; //do not execute further code for header row.
       }
               
       //Process data rows. (rowIndex >= 1)
       for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
           rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
       }

       //If search term is not found in row data
       //then hide the row, else show
       if (rowData.indexOf(searchText) == -1)
           targetTable.rows.item(rowIndex).style.display = 'none';
       else
           targetTable.rows.item(rowIndex).style.display = 'table-row';
   }
}
*/


// ends

//starts ####this code is use for search ul li code####//
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}

//ends ####this code is use for search ul li code####//
// ends
</script>
<!---------------------datepicker js------------------------------->