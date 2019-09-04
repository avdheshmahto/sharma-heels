<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class GstPayment extends my_controller {

function __construct(){
   parent::__construct(); 

	$this->load->model('model_admin_login');	
}



public function gst_payment_Nat_edit(){
	if($this->session->userdata('is_logged_in')){
		$id=$_GET['id'];
	$this->load->view('GstPayment/gst-payment-Nat-edit',$id);
	}
	else
	{
	redirect('index');
	}	
}
public function manage_gst_payment_det()
	{
		if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
	  $url   = site_url('/GstPayment/manage-gst-payment_det?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_admin_login->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'10';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/GstPayment/manage_gst_payment_det?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
			$this->load->view('manage-gst-paymentaa', $data);
	}
	else
	{
	redirect('index');
	}		
			
	}	
public function tbl_payment_gst_insert()
	{
		//echo "hello".$this->input->post('cf_name');
		$this->load->model('model_admin_login');
		$table_name="tbl_payment_gst";
		$table_name_log="tbl_payment_log";
		$payment_mode="GST_PAYMENT";
		$id=$this->input->post('gst_inv_id');
		$data = array(
		'customer_name'=>$this->input->post('customer_name'),
		'c_firm_name'=>$this->input->post('cf_name'),
		'date'=>$this->input->post('date'),
		'firm'=>$this->input->post('firm'),
		'remarks'=>$this->input->post('remarks'),
		'total_billamt'=>$this->input->post('amt'),
		'invoice_id'=>$this->input->post('gst_inv_id'),
		'payment_mode'=>$payment_mode,
		);
		
		$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_id'=> $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d'),
					);
		$data_all=array_merge($data,$sesio);
		$this->model_admin_login->insert_user($table_name,$data_all);
		$this->model_admin_login->insert_user($table_name_log,$data_all);
		$data1['id']=$id;
		
		$this->load->view('GstPayment/gst_payment_table',$data1);
	}
public function gst_payment_recieved_view()
	{
			if($this->session->userdata('is_logged_in'))
			{

				$data['id']=$_GET['view'];
				$this->load->view("GstPayment/gst-payment-Nat-view",$data);
			
			}
			else
			{
				redirect('index');
			}
	}

public function tbl_payment_gst_invoice_load()
	{
		$data['cid']=$_POST['customer_name'];
		$data['c_firm_name']=$_POST['c_firm_name'];
		$data['firmid']=$_POST['firmid'];
		$data['sum_invoices']=$_POST['sum_invoices'];
		$this->load->view("gst_payment_invoice_table",$data);
	}
public function payment_gst()
	{
		@extract($_POST);
		$table_name_hdr="tbl_payment_gst_hdr_new";
		$table_name_dtl="tbl_payment_gst_dtl_new";
		$table_name_credits="tbl_payment_gst_customer_credits";
		$table_name_log="tbl_payment_gst_new_log";
		$table_name_credits_log="tbl_payment_gst_customer_credits_log";
		$pri_col="credit_gst_id";
		/*if($this->input->post('paymentsubmit')!='')
			{
				$mmm =  $this->input->post('invoice_number');
       			echo  implode(',', $mmm); die;
			}
		*/	
		date_default_timezone_set('Asia/Kolkata');
        $dt = new DateTime();
        $mdate=$dt->format('d/m/Y H:i:s');
		
		$rows=$this->input->post("rows");
		//echo $rows;
		$amt=0;
		
		for($i=0;$i<($rows);$i++)
				{
					
					if($this->input->post("paymentsubmit")[$i]!='')
					{
						$mmm =  $this->input->post('invoice_number')[$i];
						$amt=$amt+($this->input->post('paymentsubmit')[$i]);
						$val=$val.$this->input->post('invoice_number')[$i].",";
					}
				}
		if($val!='')
		{
		$data=array(
					
					'customer_name'=>$this->input->post("customer_name"),
					'c_firm_name'=>$this->input->post("c_firm_name"),
					'firmid'=>$this->input->post("firmid"),
					'dates'=>$this->input->post("dates"),
					'payment_mode'=>$this->input->post("payment_mode"),
					'invoices'=>$val,
					'total_amount'=>$amt,
					
		   	      );
				$session=array(
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> $mdate,
							'author_date'=> date('y-m-d')
						
					  );
		$data_hdr=array_merge($data,$session);
		$this->model_admin_login->insert_user($table_name_hdr,$data_hdr);
		$last_hdr_id=$this->db->insert_id();
		if($this->input->post("excess_amount_value")!='' and $this->input->post("excess_amount_value")!=0){
					
					$fid=$this->input->post("firmid");
					$cfname=$this->input->post("c_firm_name");
					$cname=$this->input->post("customer_name");
					$datacredits=array(
					'customer_name'=>$this->input->post("customer_name"),
					'c_firm_name'=>$this->input->post("c_firm_name"),
					'firmid'=>$this->input->post("firmid"),
					'credit_date'=>$this->input->post("dates"),
					'credit_amount'=>$this->input->post("excess_amount_value"),
				 	'payment_status'=>"Excess Payment",
					'total_payment'=>$this->input->post("sum_invoices"),
				 	'p_status'=>"GST_PAYMENT_CREDITS",
				 );
					$sessioncredit=array(
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> $mdate,
							'author_date'=> date('y-m-d')
						
					  );		 
					$data_credits_merge=array_merge($datacredits,$sessioncredit);
					/*$cquery=$this->db->query("select * from tbl_payment_gst_customer_credits where firmid='$fid' and c_firm_name='$cfname' and customer_name='$cname'");	 
				 	$cqueryres=$cquery->row();
					$id=($cqueryres->credit_gst_id);
					if($id!='')
					$this->model_admin_login->update_user($pri_col,$table_name_credits,$id,$data_credits_merge);	
				 	else
*/		
			$this->model_admin_login->insert_user($table_name_credits,$data_credits_merge);
			$this->model_admin_login->insert_user($table_name_credits_log,$data_credits_merge);	
				 }
		
		//$last_hdr_id=$id;
		
		for($i=0;$i<($rows-1);$i++)
			{
				
				$inv_date=$this->input->post("inv_date")[$i];
				$inv_no=$this->input->post("invoice_no")[$i];
				$inv_number=$this->input->post("invoice_number")[$i];
				$inv_amt=$this->input->post("g_total")[$i];
				$payment=$this->input->post("paymentsubmit")[$i];
				$payment_status=$this->input->post("payment_status")[$i];
				$amount_due=($this->input->post("amount_due")[$i])-($payment);
				
				if($amount_due==0)
					{
					$payment_status="done";
					}
				if($payment!='')
					{
					
				$data_dtl_mini=array(
				
								'payment_hdr_id'=>$last_hdr_id,
								'inv_no'=>$this->input->post("invoice_no")[$i],
								'inv_amt'=>$inv_amt,
								'payment'=>$payment,
								'inv_date'=>$inv_date,
								'amount_due'=>$amount_due,
								'payment_status'=>$payment_status,
								'pay_status'=>"GST_PAYMENT",
						   );
				$session=array(
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> date('y-m-d'),
							'author_date'=> date('y-m-d')
						
					  );
				$data_dtl=array_merge($data_dtl_mini,$session);
				$this->model_admin_login->insert_user($table_name_dtl,$data_dtl);
				$this->model_admin_login->insert_user($table_name_log,$data_dtl);
					}
			}
		}
			redirect("GstPayment/manage_gst_payment");
	}
public function manage_gst_payment()
	{
	if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
		 $this->load->model('model_admin_login');
	  $url   = site_url('/GstPayment/manage-gst-payment?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_admin_login->count_alll($this->input->get());
	       if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/GstPayment/manage_gst_payment?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
			$this->load->view('manage_gst_payment', $data);
	}
	else
	{
	redirect('index');
	}	
	}
public function view_gst_payment_nat()
	{
		
		$data['cid']=$_GET['name'];
		$data['id']=$_GET['id'];
			//echo $data['cid']."cid";
		$this->load->view("view_gst_payment",$data);
	}
public function use_credits()
	{
	if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
		 $this->load->model('model_admin_login');
	  $url   = site_url('/GstPayment/use_credits?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_admin_login->count_all($this->input->get());
	  
	       if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/GstPayment/use_credits?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
			$this->load->view('use-credits', $data);
	}
	else
	{
	redirect('index');
	}	
	}
public function c_firm_name_func()
	{	
	if($this->session->userdata('is_logged_in')){
	$data=array(
	'cid'=>$_POST['cid'],
	);
	$this->load->view('c-firm-name-func',$data);
	}
	else
	{
	redirect('index');
	}
	}
public function view_gst_Ordered()
	{
		if($this->session->userdata('is_logged_in'))
			{
				$data['vid']=$_GET['vid'];
				$this->load->view('view_gst_Ordered',$data);
			}
		
	}	
public function use_credit_page()
	{
		if($this->session->userdata('is_logged_in'))
			{
				$data['ucid']=$_GET['ucid'];
				$this->load->view('use-credits-page',$data);
			}
		
	}
public function use_credits_invoice_entry()
	{

			
			if($this->session->userdata('is_logged_in'))
					{

						$table_name_hdr="tbl_payment_gst_hdr_new";
						$table_name_dtl="tbl_payment_gst_dtl_new";
						$table_name_log="tbl_payment_gst_new_log";
						$table_name_credits="tbl_payment_gst_customer_credits";
						$pri_col="credit_gst_id";
						$customer_name=$this->input->post("customer_name");
						$firm_id=$this->input->post("firmid");
						$c_firm_name=$this->input->post("c_firm_name");
						$payment_mode=$this->input->post("payment_mode");
						$invoice=$this->input->post("invoice");
						$payment_date=$this->input->post("payment_date");
						$inv_amt=$this->input->post("inv_amt");
						$inv_date=$this->input->post("inv_date");
						$rows=$this->input->post("rows");
						$amount_paid=$this->input->post("invoice_amount_paid");
						$credit_gst_id=$this->input->post("credit_gst_id");
						$invoiceheader=$this->input->post("invoiceheader");
						$invoice_amount_paid=0;
						for($i=0;$i<$rows;$i++)
							{
								
								$invoice_amount_paid=$invoice_amount_paid+$amount_paid[$i];
								
							}	
					if($invoice_amount_paid !='' and $invoice_amount_paid !='0'){
					
					for($i=0;$i<$rows;$i++)
							{
							
								$balance_due=$this->input->post("credit_available")[$i]-$amount_paid[$i];
								$datacredits=array(
								'customer_name'=>$customer_name,
								'c_firm_name'=>$c_firm_name,
								'firmid'=>$firm_id,
								'credit_amount'=>$balance_due,
							 					);
								$sessioncredit=array();	 
								$data_credits_merge=array_merge($datacredits,$sessioncredit);
								$id=$credit_gst_id[$i];
								if($id!='')
								$this->model_admin_login->update_user($pri_col,$table_name_credits,$id,$data_credits_merge);	
								}
							 }

		date_default_timezone_set('Asia/Kolkata');
        $dt = new DateTime();
        $mdate=$dt->format('d/m/Y H:i:s');
		if($invoice_amount_paid !='' and $invoice_amount_paid !='0')
		{
		$data=array(
					
					'customer_name'=>$customer_name,
					'c_firm_name'=>$c_firm_name,
					'firmid'=>$firm_id,
					'dates'=>$payment_date,
					'payment_mode'=>$payment_mode,
					'invoices'=>$invoiceheader,
					'total_amount'=>$invoice_amount_paid,
		   	      );
				$session=array(
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> $mdate,
							'author_date'=> date('y-m-d')
						
					  );
		$data_hdr=array_merge($data,$session);
		$this->model_admin_login->insert_user($table_name_hdr,$data_hdr);
		$last_hdr_id=$this->db->insert_id();
				/*
		$EditQryData=$this->db->query("select D.*,P.productname as pname,C.prodcatg_name  from tbl_ordered_invoice_dtl D,tbl_product_stock P,tbl_prodcatg_mst C where P.Product_id = D.item_id  AND D.category_id = C.prodcatg_id  AND D.ordered_invoiceid = ?  AND D.status = 'A'",array($_GET['editId']));*/
				
				$amt_due=($this->input->post("mybalance_due")-$invoice_amount_paid);					
				if($amt_due=='0')
					{
					$payment_status="done";
					}
				else
					$payment_status='';
				$data_dtl_mini=array(
				
								'payment_hdr_id'=>$last_hdr_id,
								'inv_no'=>$invoice,
								'inv_amt'=>$inv_amt,
								'payment'=>$invoice_amount_paid,
								'inv_date'=>$inv_date,
								'amount_due'=>$amt_due,
								'payment_status'=>$payment_status,
								'pay_status'=>"GST_PAYMENT_CREDITS",
						   );
				$session_dtl=array(
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> $mdate,
							'author_date'=> date('y-m-d')
						
					  );
				$data_dtl=array_merge($data_dtl_mini,$session_dtl);
				$this->model_admin_login->insert_user($table_name_dtl,$data_dtl);
				$this->model_admin_login->insert_user($table_name_log,$data_dtl);
					}
				}
	}	

}

?>