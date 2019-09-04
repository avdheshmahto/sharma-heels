<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Report extends my_controller {
function __construct(){
   parent::__construct(); 
    $this->load->model('model_report');	
}     

function report_function() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
    $this->load->view('open-page-report');
	}
	else
	{
	redirect('index');
	}
}


function searchStock() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['stockSearch'] = $this->model_report->getSearchStock($p_name,$p_code);
    $this->load->view('add-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}



function searchTotalStock() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['totalSearchStock'] = $this->model_report->geTtotalSearchStock($p_name,$p_code);
    $this->load->view('total-product-stock-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

function searchPaymentReport() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['totalSearchPayment'] = $this->model_report->getSearchPayment($contactid,$payment_mode);
    $this->load->view('payment-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

function searchPaymentReceivedReport(){
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['SearchPaymentReceived'] = $this->model_report->getSearchPaymentReceived($contactid,$payment_mode);
    $this->load->view('payment-received-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

function searchProductStockSummery() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['searchProductStockSummery'] = $this->model_report->geTSearchProductStockSummery($p_name,$p_code);
    $this->load->view('product-stock-summery-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}



function searchPurchaseOrder() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['purchaseOrderSearch'] = $this->model_report->getSearchPurchaseOrder($p_no,$v_name,$f_date,$t_date,$g_total);
    $this->load->view('add-purchaseorder-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}	

function searchSalesOrder() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['saleOrderSearch'] = $this->model_report->getSearchSaleOrder($p_no,$v_name,$f_date,$t_date,$g_total);
    $this->load->view('add-saleorder-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}	

}

?>