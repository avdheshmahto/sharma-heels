<?php

//echo "df".$Productctg_id=$_REQUEST['Productctg_id'];

 //$con1=$_REQUEST['con'];
 $conidd=$_GET['con'];
	$_GET['con_id'];

$exp=explode('^',$conidd);
 $con1=$exp[0];
 $valItemcheck=$exp[1];
 $stockpointid=$exp[2];
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


		  function abc(pt,pr,tid,q,inq,u,cateid,itid){
		  				//alert(itid);
						var pid=pt.split("^");
		  				var pids=pid[1];
						
						var pidsize=pr.split(" ");
		  				var pidsi=pidsize.length;
						
					document.getElementById("pri_id").value=itid;
				   document.getElementById("prd").value=pt;
					
					document.getElementById("qn").value=q;
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

  $sel=$this->db->query("select * from tbl_product_stock where stockpid='$stockpointid' and productname like '%$con1%'");

  $i=0;

  foreach($sel->result() as $arr)
  {
  
$queryserial=$this->db->query("select * from tbl_product_serial where stock_point='$arr->stockpid' and product_id='$arr->Product_id'");
  $rowser=$queryserial->num_rows();
if ($rowser>0) {
	
}else{	
	


  //
  $queryContactPrice=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$arr->Product_id' and contact_id='".$_GET['con_id']."'");
  $getContactMapPrice=$queryContactPrice->row();
  $cnt=$queryContactPrice->num_rows();
  
  if($cnt>0)
  
  {
   $priceP=$getContactMapPrice->price;
  
  }
  else
  
  {
  
  $priceP=$arr->unitprice_sale;
  }
  
  //
  
  
  $usageunit=$arr->usageunit;
   $qtyrr=$arr->quantity;
   
   $orderedqtyinstock=$arr->qtyinstock;
   
   $sizedata=$arr->size;
   

$product_det1 = $this->db->query("Select * from tbl_prodcatg_mst where prodcatg_id='$arr->category'");

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
 onFocus="abc(this.value,'<?php echo $sizedata; ?>',this.id,'<?php echo $qtyrr; ?>','<?php echo $orderedqtyinstock; ?>','<?php echo $categoryname; ?>','<?php echo $categoryid; ?>','<?php echo $arr->Product_id;?>')"
 onClick="abc(this.value,'<?php echo $sizedata; ?>',this.id,'<?php echo $qtyrr; ?>','<?php echo $orderedqtyinstock; ?>','<?php echo $categoryname; ?>','<?php echo $categoryid; ?>','<?php echo $arr->Product_id;?>')" tabindex="-1"  readonly >


<?php

 }

}
}

?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>