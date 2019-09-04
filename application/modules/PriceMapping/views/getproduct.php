<?php

 $con1=$_GET['con'];
	$_GET['con_id'];

$con2=explode("^",$con1);
 $con3=$con2[0];
 $locationname=$con2[1];
		
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
      


		  function abc(pt,pr,tid,q,u,piddds,catid){
		  				
						var pid=pt.split("^");
		  				var pids=pid[1];
						
					document.getElementById("pri_id").value=piddds;
				   document.getElementById("prd").value=pt;
					
					document.getElementById("qn").value=1;
					
					document.getElementById("prd").value=pt;
					document.getElementById("cate_id").value=catid;
					//document.getElementById("lph").value=pr;
					document.getElementById("spid").value=tid;
					document.getElementById("usunit").value=u;
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

 if($con3!="" )
 {

if($locationname=='National'){
  $sel=$this->db->query("select * from tbl_product_stock where productname like '%$con3%'");
}else if($locationname=='Ragarpura'){
  $sel=$this->db->query("select * from tbl_product_stock_regarpura where productname like '%$con3%'");
}else if($locationname=='Madipur'){
  $sel=$this->db->query("select * from tbl_product_stock_madipur where productname like '%$con3%'");
}else if($locationname=='Seelampur'){
  $sel=$this->db->query("select * from tbl_product_stock_seelampur where productname like '%$con3%'");
}else if($locationname=='Mumbai'){
  $sel=$this->db->query("select * from tbl_product_stock_mumbai where productname like '%$con3%'");
}else if($locationname=='BapaNagar'){
  $sel=$this->db->query("select * from tbl_product_stock_bapanagar where productname like '%$con3%'");
}else{
 $sel=$this->db->query("select * from tbl_product_stock where productname='NotResult'");
}

  $i=0;

  foreach($sel->result() as $arr)
  {
  
  //
 // if($_GET['con_id']!=''){
  $queryContactPrice=$this->db->query("select *from tbl_contact_product_price_mapping where product_id='$arr->Product_id'");
  //}
	
 /* if($_GET['stor_id']!=''){
  $queryContactPrice=$this->db->query("select *from tbl_contact_product_price_mapping where product_id='$arr->Product_id' and store_id='".$_GET['stor_id']."'");
  } */

	  
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
   $qty=$arr->quantity;

$product_det1 = $this->db->query("Select * from tbl_master_data where serial_number= '$arr->usageunit'");

	$prod_Details1 = $product_det1->row();

	 // $usunit=$prod_Details1->keyvalue;		

if($locationname=='National'){	  	  
	  $product_det1 = $this->db->query("Select * from tbl_prodcatg_mst where prodcatg_id='$arr->category'");
}else{
	  $product_det1 = $this->db->query("Select * from tbl_prodcatg_mst where prodcatg_id='$arr->category_id'");
}
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

<input type="text" id="ty<?php echo $id;?>"  class="prds" value="<?php echo $arr->productname; ?>" name="<?php echo $id;?>"
 onFocus="abc(this.value,'<?php echo $priceP; ?>',this.id,'<?php echo $qty; ?>','<?php echo $categoryname; ?>','<?php echo $arr->Product_id; ?>','<?php echo $categoryid; ?>')"
 onClick="abc(this.value,'<?php echo $priceP; ?>',this.id,'<?php echo $qty; ?>','<?php echo $categoryname; ?>','<?php echo $arr->Product_id; ?>','<?php echo $categoryid; ?>')" style="width:240px;border:1px solid;" tabindex="-1"  readonly >


<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>