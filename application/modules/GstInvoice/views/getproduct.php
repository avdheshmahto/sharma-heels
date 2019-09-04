<?php

 $con1=$_GET['con'];
	//$_GET['con_id'];

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
      


		  function abc(pt,catid){
		  				
				
				   document.getElementById("prd").value=pt;
					
				   document.getElementById("cate_id").value=catid;
								
		  }



  </script>
</head>
<body>
<?php

 if($con3!="" )
 {

 $sel=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name like '%$con3%'");


  $i=0;

  foreach($sel->result() as $arr)
  {
  
 
  $i++;
  $id='d'; 

  $id.=$i; 
$countid+= count($id);
//echo $arr->size;


?>

<input type="text" id="ty<?php echo $id;?>"  class="prds" value="<?php echo $arr->prodcatg_name; ?>" name="<?php echo $id;?>"
 onFocus="abc(this.value,'<?php echo $arr->prodcatg_id; ?>')"
 onClick="abc(this.value,'<?php echo $arr->prodcatg_id; ?>')" style="width:240px;border:1px solid;" tabindex="-1"  readonly >



<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>