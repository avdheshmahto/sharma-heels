<?php

 $conidd=$_GET['con'];

$exp=explode('^',$conidd);
 $con1=$exp[0];
 $valItemcheck=$exp[1];
 $custandstoreid=$exp[2];
 $typeofcustomer=$exp[3]; 

if($valItemcheck!=''){
$valItem=$valItemcheck;
}else{
$valItem=0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
 var x = document.getElementsByClassName("prds");
    function ChangeCurrentCell() {

    }

    ChangeCurrentCell();

    $(document).keydown(function(e){

        if (e.keyCode == 37) { 

           currentCell--;

		   alert(currentCell);

          // ChangeCurrentCell();

           return false;

        }

        if (e.keyCode == 39)

		 { 

           currentCell++;

         //  ChangeCurrentCell();

           return false;

        }
	

        if (e.keyCode == 38)

		 { 
 

		 if(currentCell>0)

		{

		currentCell--;

		//alert(currentCell);

		 x[currentCell].focus();

         x[currentCell].select();

		}

		else

		{

		var mx = document.getElementById("ttsp").value;

		currentCell=mx;


		 x[currentCell].focus();

         x[currentCell].select();

		 currentCell--;

		 //alert("Last...");

		}

		//  alert(currentCell);

              return false;

        }

		
        if (e.keyCode == 40) 

		{ 

		var mx = document.getElementById("ttsp").value;


		if(currentCell<mx)

		{

		 x[currentCell].focus();

         x[currentCell].select();

		currentCell++;

		 e.preventDefault();

		 e.stopPropagation();

		e.returnValue = false;

//Window.focus()

		 //break; 

		//alert(currentCell);

		}

		else

		{

		currentCell=0;

		 x[currentCell].focus();

         x[currentCell].select();

				//alert('rowCount'); 		          

	document.getElementById('prdsrch').scrollTop =0;

		}

		}

	    });


var xobj;

   //modern browers

   if(window.XMLHttpRequest)

    {

	  xobj=new XMLHttpRequest();

	  }
	  //for ie

    else if(window.ActiveXObject)

	   {
	    xobj=new ActiveXObject("Microsoft.XMLHTTP");
		}

		else

		{

	  alert("Your broweser doesnot support ajax");

		  }
         /*   function abc(pt,pr,tid,qs,lq)
		  {
	       		   document.getElementById("prd").value=pt;
					document.getElementById("qn").value=1;
					document.getElementById("lpr").innerHTML=pr;
					document.getElementById("lph").value=pr;
		//document.getElementById("spid").value=tid;
				/*if(qs<lq)
					{
					///alert('The city of ' + city + ' is located in ' + country + '.');
				alert(pt+ '- has Reached to Re-Order Level (' + lq + '). \n Please Re-Order...! ');
					}
			}*/


		  function abc(pt,pr,tid,q,inq,u,cateid,itid,pricet){
		  				//alert(itid);
						var pid=pt.split("^");
		  				var pids=pid[1];
						
						var pidsize=pr.split(" | ");
		  				var pidsi=pidsize.length;
						
					document.getElementById("pri_id").value=itid;
				   document.getElementById("prd").value=pt;
					
					document.getElementById("qn").value=q;
					document.getElementById("priceid").value=pricet;
					document.getElementById("ordinqty").value=inq;
					document.getElementById("sizecu").value=pidsi;
					document.getElementById("prd").value=pt;
					document.getElementById("lpr").value=pr;
					document.getElementById("lph").value=pr;
					document.getElementById("spid").value=tid;
					document.getElementById("usunit").value=u;
					document.getElementById("cateidd").value=cateid;
					document.getElementById("tpr").innerHTML=pr;
					document.getElementById("tph").value=pr;
					document.getElementById("np").innerHTML=pr;
					document.getElementById("nph").value=pr;
				    document.getElementById("quantity").value=q;					
					document.getElementById("abqt").value=q;
					
		  }



  </script>
</head>
<body>
<?php

 if($con1!="" )
 {


if($typeofcustomer=='Customer'){
$invhdr=$this->db->query("select * from tbl_ordered_invoice_dtl where customer_id='$custandstoreid' and productname like '%$con1%'");
}else if($typeofcustomer=='Store'){
$invhdr=$this->db->query("select * from tbl_ordered_invoice_dtl where store_id='$custandstoreid' and productname like '%$con1%'");
}else{
$invhdr=$this->db->query("select * from tbl_ordered_invoice_dtl where status='Notresult'");
}

/* foreach($invhdr->result() as $fetchRowlist)
  {
  
  		echo $fetchRowlist->productname;
		echo $fetchRowlist->item_id;
  
  }


// and Product_id not in ($valItem)

  $sel=$this->db->query("select * from tbl_product_stock where productname like '%$con1%'");

*/
  $i=0;

  foreach($invhdr->result() as $arr)
  {
  
  
  $usageunit=$arr->usageunit;
   $qtyrr=$arr->qty_val;
   $totalprice=$arr->total_price;
   
   $orderedqtyinstock=$arr->qtyinstock;
   
   $sizedata=$arr->size_val;
   

$product_det1 = $this->db->query("Select * from tbl_prodcatg_mst where prodcatg_id='$arr->category_id'");

	$prod_Details1 = $product_det1->row();

	  $categoryname=$prod_Details1->prodcatg_name;
	  $categoryid=$prod_Details1->prodcatg_id;		

  $i++;
  $id='d'; 

  $id.=$i; 
$countid+= count($id);
//echo $arr->size;
$sqlunit=$this->db->query("select * from tbl_master_data where serial_number='$arr->size'");
$fetchsize=$sqlunit->row();						


?>

<input type="text" id="ty<?php echo $id;?>"  class="prds" value="<?php echo $arr->productname;?>" name="<?php echo $id;?>"
 onFocus="abc(this.value,'<?php echo $sizedata; ?>',this.id,'<?php echo $qtyrr; ?>','<?php echo $orderedqtyinstock; ?>','<?php echo $categoryname; ?>','<?php echo $categoryid; ?>','<?php echo $arr->item_id;?>','<?php echo $totalprice;?>')"
 onClick="abc(this.value,'<?php echo $sizedata; ?>',this.id,'<?php echo $qtyrr; ?>','<?php echo $orderedqtyinstock; ?>','<?php echo $categoryname; ?>','<?php echo $categoryid; ?>','<?php echo $arr->item_id;?>','<?php echo $totalprice;?>')" tabindex="-1"  readonly >


<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>