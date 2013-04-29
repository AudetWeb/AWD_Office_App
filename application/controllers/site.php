<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function Site()
	{
		parent::__construct();	

        $this->validSession = $this->_verify_session();

        $this->load->model('Vendor_m');
        $this->load->model('Expense_code_m');
        $this->load->model('Payment_code_m');
        $this->load->model('Expense_m');

    }
	
	function index()
	{
        $this->_verify_page_access($this->validSession,'site/login');
        
        $sidebarData['office_summary'] = FALSE;

        $data['titleTag'] = "Office.AudetWebHosting.net";
        $data['pageTitle'] = "Office.AudetWebHosting.net";
        $data['mainContent'] = $this->load->view('pages/home','',true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
		$this->load->view('site_template',$data);
	}

    //-------------------------------------------------------------------------
    // Chorus Profile - Pages and Functions

    function chorus_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $state_code = $this->uri->segment(3,FALSE);

        $chorus_list = $this->Chorus_profile_m->get_all_chorus_profile($state_code);
        $pageData['chorus_list'] = $chorus_list;
        
        $data_status = $this->_update_data_status($chorus_list);
        $pageData['data_status'] = $data_status;

        $chorus_count = $this->Chorus_profile_m->get_chorus_total_count($state_code);
        
        $sidebarData['office_summary'] = FALSE;

        $data['titleTag'] = "Chorus List";
        $data['pageTitle'] = "Chorus List<em>".$state_code." &raquo; ".$chorus_count." entries</em>";
        $data['mainContent'] = $this->load->view('pages/chorus_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }
    
    function create_new_chorus_profile()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newChorusProfileID = $this->Chorus_profile_m->create_new_chorus_profile();
        
        if ( $newChorusProfileID > 0 ) {
            redirect('site/update_chorus_profile/'.$newChorusProfileID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Chorus Profile - Error";
            $data['pageTitle'] = "New Chorus Profile - Error";
            $data['mainContent'] = $this->load->view('pages/chorus_profile_error',$pageData,true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_chorus_profile()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $chorus_profile_id = $this->uri->segment(3,0);
        $pageData['id_cpr'] = $chorus_profile_id;

        if ( $this->input->post('update_chorus_profile') ) {
            $this->_update_chorus_profile($chorus_profile_id);
        }

        $pageData['chorus_profile'] = $this->Chorus_profile_m->get_chorus_profile($chorus_profile_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Chorus Profile";
        $data['pageTitle'] = "Chorus Profile";
        $data['mainContent'] = $this->load->view('pages/chorus_profile',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_chorus_profile($row_id)
    {
        $post_data['chorus_name_cpr'] = $this->input->post('chorus_name_cpr');
        $post_data['chorus_website_cpr'] = $this->input->post('chorus_website_cpr');
        $post_data['chorus_description_cpr'] = $this->input->post('chorus_description_cpr');
        $post_data['mail_address_cpr'] = $this->input->post('mail_address_cpr');
        $post_data['mail_city_cpr'] = $this->input->post('mail_city_cpr');
        $post_data['mail_state_cpr'] = $this->input->post('mail_state_cpr');
        $post_data['mail_zip_cpr'] = $this->input->post('mail_zip_cpr');
        $post_data['org_phone_cpr'] = $this->input->post('org_phone_cpr');
        $post_data['org_email_cpr'] = $this->input->post('org_email_cpr');
        $post_data['pri_contact_name_cpr'] = $this->input->post('pri_contact_name_cpr');
        $post_data['pri_contact_title_cpr'] = $this->input->post('pri_contact_title_cpr');
        $post_data['pri_contact_phone_cpr'] = $this->input->post('pri_contact_phone_cpr');
        $post_data['pri_contact_email_cpr'] = $this->input->post('pri_contact_email_cpr');
        $post_data['sec_contact_name_cpr'] = $this->input->post('sec_contact_name_cpr');
        $post_data['sec_contact_title_cpr'] = $this->input->post('sec_contact_title_cpr');
        $post_data['sec_contact_phone_cpr'] = $this->input->post('sec_contact_phone_cpr');
        $post_data['sec_contact_email_cpr'] = $this->input->post('sec_contact_email_cpr');
        $post_data['is_active_cpr'] = $this->input->post('is_active_cpr');

        $this->Chorus_profile_m->update_chorus_profile($post_data,$row_id);       
        
        redirect($this->uri->uri_string());
    }

    //-------------------------------------------------------------------------
    // Reports & Summary - Pages and Functions

    function chorus_list_summary()
    {
        $this->_verify_page_access($this->validSession,'site/login');

        $sort_type = $this->uri->segment(3,0);

        $pageData['chorus_summary_sort'] = $this->Chorus_profile_m->get_chorus_state_count($sort_type);
        $pageData['chorus_summary'] = $this->Chorus_profile_m->get_chorus_state_count();
        
        $pageData['chorus_count'] = $this->Chorus_profile_m->get_chorus_total_count();
        
        $data['titleTag'] = "Chorus List - Summary by State";
        $data['pageTitle'] = "Chorus List - Summary by State";
        $data['mainContent'] = $this->load->view('pages/chorus_list_summary',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$pageData,true);
        
        $this->load->view('site_template',$data);
    }

    function chorus_list_recent()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $list_count = $this->uri->segment(3,30);

        $pageData['chorus_summary'] = $this->Chorus_profile_m->get_chorus_state_count();
        
        $chorus_list = $this->Chorus_profile_m->get_recent_chorus_profile($list_count);
        $pageData['chorus_list'] = $chorus_list;
        
        $data_status = $this->_update_data_status($chorus_list);
        $pageData['data_status'] = $data_status;

        $data['titleTag'] = "Chorus List - Recent Entries";
        $data['pageTitle'] = "Chorus List - Recent Entries";
        $data['mainContent'] = $this->load->view('pages/chorus_list_recent',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$pageData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_data_status($chorus_list)
    {
        // Set some flags for display data status of chorus profile
        $data_status = FALSE;
        
        foreach ($chorus_list->result() as $rec)
        {
            if ($rec->chorus_website_cpr)
            {
                 $data_status[$rec->id_cpr]['W'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['W'] = FALSE;                
            }

            if ($rec->chorus_description_cpr)
            {
                 $data_status[$rec->id_cpr]['D'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['D'] = FALSE;                
            }

            if ($rec->mail_address_cpr && $rec->mail_city_cpr && $rec->mail_zip_cpr)
            {
                 $data_status[$rec->id_cpr]['A'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['A'] = FALSE;                
            }

            if ($rec->org_phone_cpr OR $rec->org_email_cpr)
            {
                 $data_status[$rec->id_cpr]['C'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['C'] = FALSE;                
            }

            if ($rec->pri_contact_name_cpr)
            {
                 $data_status[$rec->id_cpr]['P'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['P'] = FALSE;                
            }
            if ($rec->pri_contact_phone_cpr OR $rec->pri_contact_email_cpr)
            {
                 $data_status[$rec->id_cpr]['PC'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['PC'] = FALSE;                
            }

            if ($rec->sec_contact_name_cpr)
            {
                 $data_status[$rec->id_cpr]['S'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['S'] = FALSE;                
            }
            if ($rec->sec_contact_phone_cpr OR $rec->sec_contact_email_cpr)
            {
                 $data_status[$rec->id_cpr]['SC'] = TRUE;
            }
            else
            {
                 $data_status[$rec->id_cpr]['SC'] = FALSE;                
            }
        }
        
        return $data_status;
    }


    //-------------------------------------------------------------------------
    // Site Security - Pages and Functions
    
    function login()
    {
        // If logged in, do not show the login page. Go directly to the home/index page.
        $this->_verify_page_access(!$this->validSession,'site/index');

        //----- Validation Rules -----
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $this->form_validation->set_rules('theUserID', 'User ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('thePassword', 'Password', 'trim|required|max_length[20]');
                
        if ($this->form_validation->run() === TRUE)
        {
            $userid = $this->input->post('theUserID');
            $password = $this->input->post('thePassword');    
            $validUser = $this->_verify_user($userid,$password);
            
            if ( $validUser ) {
                redirect("site/index");
            }        
        }
        
        $this->chorus_count = FALSE;

        $data['titleTag'] = "Login - Office.AudetWebHosting.net";
        $data['pageTitle'] = "Login";
        $data['mainContent'] = $this->load->view('pages/login','',true);
        $data['styleContent'] = ' noLHS'; // Reminder: add a space before the class name
        $data['lhsContent'] = FALSE;
        
        $this->load->view('site_template',$data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->validSession = FALSE;

        $this->chorus_count = FALSE;

        $data['titleTag'] = "Logout - Office.AudetWebHosting.net";
        $data['pageTitle'] = "Logout";
        $data['mainContent'] = $this->load->view('pages/logout','',true);
        $data['styleContent'] = ' noLHS'; // Reminder: add a space before the class name
        $data['lhsContent'] = FALSE;
        
        $this->load->view('site_template',$data);
    }
    
    function _verify_page_access($sessionName,$redirectOnFalse)
    {
        // If the sessionName is true, return true.
        // Otherwise, redirect to the specified page.
        if ( ! $sessionName ) {
            redirect($redirectOnFalse);
        } else {
            return TRUE;
        }
    }
    
    function _verify_session()
    {
        /* Checks for a valid user session */
        
        if ($this->session->userdata('user_valid') === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }

    function _verify_user($username,$password)
    {
        if ( ($username == 'admin' && $password == 'admin2020')  ) 
        {
            $newdata = array(
                   'user_name' => $username,
                   'user_valid' => TRUE,
                   );
            
            $this->session->set_userdata($newdata);
            return TRUE;

        } else {
            return FALSE;
        };    
    }
    
    //-------------------------------------------------------------------------
    // Resources - Pages and Functions

    function resource_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $sort_type = $this->uri->segment(3,0);

        $pageData['resource'] = $this->Resource_m->get_all_resource($sort_type);

        $sidebarData['office_summary'] = FALSE;

        $pageData['resource_count'] = $this->Resource_m->get_resource_total_count();

        $data['titleTag'] = "Resources";
        $data['pageTitle'] = "Resources";
        $data['mainContent'] = $this->load->view('pages/resource_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function create_new_resource()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newResourceID = $this->Resource_m->create_new_resource();
        
        if ( $newResourceID > 0 ) {
            redirect('site/update_resource/'.$newResourceID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Resource - Error";
            $data['pageTitle'] = "New Resource - Error";
            $data['mainContent'] = $this->load->view('pages/resource_error','',true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_resource()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $resource_id = $this->uri->segment(3,0);
        $pageData['id_res'] = $resource_id;

        if ( $this->input->post('update_resource') ) {
            $this->_update_resource($resource_id);
        }

        $pageData['resource'] = $this->Resource_m->get_resource($resource_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Resource Details";
        $data['pageTitle'] = "Resource Details";
        $data['mainContent'] = $this->load->view('pages/resource',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_resource($row_id)
    {
        $post_data['resource_name_res'] = $this->input->post('resource_name_res');
        $post_data['resource_website_res'] = $this->input->post('resource_website_res');
        $post_data['resource_description_res'] = $this->input->post('resource_description_res');
        $post_data['is_deleted_res'] = $this->input->post('is_deleted_res');

        $this->Resource_m->update_resource($post_data,$row_id);       
        
        redirect($this->uri->uri_string());
    }

    //-------------------------------------------------------------------------
    // Vendors - Pages and Functions

    function vendor_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $pageData['vendor'] = $this->Vendor_m->get_all_vendor();

        $pageData['vendor_count'] = $this->Vendor_m->get_vendor_total_count();

        $sidebarData['office_summary'] = FALSE;

        $data['titleTag'] = "Office - Vendors";
        $data['pageTitle'] = "Vendors";
        $data['mainContent'] = $this->load->view('pages/vendor_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function create_new_vendor()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newVendorID = $this->Vendor_m->create_new_vendor();
        
        if ( $newVendorID > 0 ) {
            redirect('site/update_vendor/'.$newVendorID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Vendor - Error";
            $data['pageTitle'] = "New Vendor - Error";
            $data['mainContent'] = $this->load->view('pages/resource_error','',true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_vendor()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $vendor_id = $this->uri->segment(3,0);
        $pageData['id_ven'] = $vendor_id;

        if ( $this->input->post('update_vendor') ) {
            $this->_update_vendor($vendor_id);
        }

        $pageData['vendor'] = $this->Vendor_m->get_vendor($vendor_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Vendor Details";
        $data['pageTitle'] = "Vendor Details";
        $data['mainContent'] = $this->load->view('pages/vendor',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_vendor($row_id)
    {
        $post_data['vendor_name_ven'] = $this->input->post('vendor_name_ven');
        $post_data['vendor_website_ven'] = $this->input->post('vendor_website_ven');
        $post_data['is_active_ven'] = $this->input->post('is_active_ven');
        $post_data['is_deleted_ven'] = $this->input->post('is_deleted_ven');

        $this->Vendor_m->update_vendor($post_data,$row_id);       
        
        redirect($this->uri->uri_string());
    }

    //-------------------------------------------------------------------------
    // Expense Codes - Pages and Functions

    function expense_code_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $pageData['expense_code'] = $this->Expense_code_m->get_all_expense_code();

        $pageData['expense_code_count'] = $this->Expense_code_m->get_expense_code_total_count();

        $sidebarData['office_summary'] = FALSE;

        $data['titleTag'] = "Office - Expense Codes";
        $data['pageTitle'] = "Expense Codes";
        $data['mainContent'] = $this->load->view('pages/expense_code_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function create_new_expense_code()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newExpenseCodeID = $this->Expense_code_m->create_new_expense_code();
        
        if ( $newExpenseCodeID > 0 ) {
            redirect('site/update_expense_code/'.$newExpenseCodeID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Expense Code - Error";
            $data['pageTitle'] = "New Expense Code - Error";
            $data['mainContent'] = $this->load->view('pages/resource_error','',true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_expense_code()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $expense_code_id = $this->uri->segment(3,0);
        $pageData['id_ec'] = $expense_code_id;

        if ( $this->input->post('update_expense_code') ) {
            $this->_update_expense_code($expense_code_id);
        }

        $pageData['expense_code'] = $this->Expense_code_m->get_expense_code($expense_code_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Expense Code Details";
        $data['pageTitle'] = "Expense Code Details";
        $data['mainContent'] = $this->load->view('pages/expense_code',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_expense_code($row_id)
    {
        $post_data['expense_code_ec'] = $this->input->post('expense_code_ec');
        $post_data['description_ec'] = $this->input->post('description_ec');
        $post_data['is_active_ec'] = $this->input->post('is_active_ec');
        $post_data['is_deleted_ec'] = $this->input->post('is_deleted_ec');

        $this->Expense_code_m->update_expense_code($post_data,$row_id);       
        
        redirect($this->uri->uri_string());
    }

    //-------------------------------------------------------------------------
    // Payment Codes - Pages and Functions

    function payment_code_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $pageData['payment_code'] = $this->Payment_code_m->get_all_payment_code();

        $pageData['payment_code_count'] = $this->Payment_code_m->get_payment_code_total_count();

        $sidebarData['office_summary'] = FALSE;

        $data['titleTag'] = "Office - Payment Codes";
        $data['pageTitle'] = "Payment Codes";
        $data['mainContent'] = $this->load->view('pages/payment_code_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function create_new_payment_code()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newPaymentCodeID = $this->Payment_code_m->create_new_payment_code();
        
        if ( $newPaymentCodeID > 0 ) {
            redirect('site/update_payment_code/'.$newPaymentCodeID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Payment Code - Error";
            $data['pageTitle'] = "New Payment Code - Error";
            $data['mainContent'] = $this->load->view('pages/resource_error','',true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_payment_code()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $payment_code_id = $this->uri->segment(3,0);
        $pageData['id_pc'] = $payment_code_id;

        if ( $this->input->post('update_payment_code') ) {
            $this->_update_payment_code($payment_code_id);
        }

        $pageData['payment_code'] = $this->Payment_code_m->get_payment_code($payment_code_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Payment Code Details";
        $data['pageTitle'] = "Payment Code Details";
        $data['mainContent'] = $this->load->view('pages/payment_code',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_payment_code($row_id)
    {
        $post_data['payment_code_pc'] = $this->input->post('payment_code_pc');
        $post_data['description_pc'] = $this->input->post('description_pc');
        $post_data['is_active_pc'] = $this->input->post('is_active_pc');
        $post_data['is_deleted_pc'] = $this->input->post('is_deleted_pc');

        $this->Payment_code_m->update_payment_code($post_data,$row_id);       
        
        redirect($this->uri->uri_string());
    }

    //-------------------------------------------------------------------------
    // Expenses - Pages and Functions

    function expense_list()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $pageData['expense'] = $this->Expense_m->get_all_expense();

        $pageData['expense_count'] = $this->Expense_m->get_expense_total_count();

        $sidebarData['office_summary'] = FALSE;
        
        $pageData['vendor_menu'] = $this->Vendor_m->get_vendor_list();
        $pageData['payment_code_menu'] = $this->Payment_code_m->get_payment_code_list();
        $pageData['expense_code_menu'] = $this->Expense_code_m->get_expense_code_list();

        $pageData['vendor_menu'][0]       = "Not Selected";
        $pageData['payment_code_menu'][0] = "Not Selected";
        $pageData['expense_code_menu'][0] = "Not Selected";

        $data['titleTag'] = "Office - Expenses";
        $data['pageTitle'] = "Expenses";
        $data['mainContent'] = $this->load->view('pages/expense_list',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function create_new_expense()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $newExpenseID = $this->Expense_m->create_new_expense();
        
        if ( $newExpenseID > 0 ) {
            redirect('site/update_expense/'.$newExpenseID);
        } else {
            $sidebarData['office_summary'] = FALSE;
            $data['titleTag'] = "New Payment Code - Error";
            $data['pageTitle'] = "New Payment Code - Error";
            $data['mainContent'] = $this->load->view('pages/resource_error','',true);
            $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
            
            $this->load->view('site_template',$data);
        }
    }

    function update_expense()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $expense_id = $this->uri->segment(3,0);
        $pageData['id_exp'] = $expense_id;
        $pageData['upload_rc'] = FALSE;
        $pageData['upload_msg'] = FALSE;

        if ( $this->input->post('update_expense') ) {
            
            $config['upload_path'] = UPLOAD_PATH . '/';
            $config['allowed_types'] = 'pdf|jpg|docx|txt';
            $this->load->library('upload', $config);
            $this->load->helper('language');

            if (! $this->upload->do_upload())
            {
                $upload_rc = $this->upload->display_errors();                
                $upload_msg = strpos($upload_rc,lang('upload_no_file_selected')) ? FALSE : TRUE;
                $upload_file_name = FALSE;
            }
            else
            {
                $upload_rc = $this->upload->data();
                $upload_msg = FALSE;
                $upload_file_name = $upload_rc['file_name'];
            }
        
            $pageData['upload_rc'] = $upload_rc;
            $pageData['upload_msg'] = $upload_msg;

            $this->_update_expense($expense_id,$upload_file_name);
        }

        $pageData['vendor_menu'] = $this->Vendor_m->get_vendor_list();
        $pageData['payment_code_menu'] = $this->Payment_code_m->get_payment_code_list();
        $pageData['expense_code_menu'] = $this->Expense_code_m->get_expense_code_list();

        $pageData['expense'] = $this->Expense_m->get_expense($expense_id);

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Expense Detail";
        $data['pageTitle'] = "Expense Detail";
        $data['mainContent'] = $this->load->view('pages/expense',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _update_expense($row_id,$upload_file_name=FALSE)
    {
        $post_data['date_exp'] = $this->input->post('date_exp');
        $post_data['amount_exp'] = $this->input->post('amount_exp');
        $post_data['description_exp'] = $this->input->post('description_exp');
        $post_data['vendor_exp'] = $this->input->post('vendor_exp');

        if($upload_file_name)
        {
            $post_data['invoice_exp'] = $upload_file_name;
        }

        $post_data['expense_code_exp'] = $this->input->post('expense_code_exp');
        $post_data['payment_code_exp'] = $this->input->post('payment_code_exp');
        $post_data['payment_detail_exp'] = $this->input->post('payment_detail_exp');

        $post_data['is_active_exp'] = $this->input->post('is_active_exp');
        $post_data['is_deleted_exp'] = $this->input->post('is_deleted_exp');

        $this->Expense_m->update_expense($post_data,$row_id);       
        
        //redirect($this->uri->uri_string());
    }

    function update_expense_grid()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        // need to track the list of id_exp
        
        // From the list page, get a list of id_exp values....
        
        // if id_exp = 0, then this is a new record so we need to create a new record and update the field values
        
        // if id_exp !== 0, then we simply do an update.
        
        if ( $this->input->post('update_expense_grid') ) {            
            $expenseList = $this->_process_expense_import_items();
            $pageData['expense_items'] = $expenseList;
        }
        else
        {
            $fields = array('id_exp','date_exp',
                            'amount_exp',
                            'expense_code_exp',
                            'description_exp',
                            'payment_code_exp',
                            'vendor_exp');
            $values = array('0',
                            '',
                            '',
                            '0',
                            '',                
                            '0',
                            '0');
            $row = array_combine($fields,$values);
            $pageData['expense_items'] = array_fill(1,12,$row);
        }

        $pageData['vendor_menu'] = $this->Vendor_m->get_vendor_list();
        $pageData['payment_code_menu'] = $this->Payment_code_m->get_payment_code_list(TRUE);
        $pageData['expense_code_menu'] = $this->Expense_code_m->get_expense_code_list();

        $pageData['vendor_menu'][0]       = "Not Selected";
        $pageData['payment_code_menu'][0] = "Not Selected";
        $pageData['expense_code_menu'][0] = "Not Selected";

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Expense Grid";
        $data['pageTitle'] = "Expense Grid";
        $data['mainContent'] = $this->load->view('pages/update_expense_grid',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function import_expense()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        if ( $this->input->post('import_expense') ) {
            $pageData = $this->_process_expense_import_list();
        }
        else // import_expense
        {
            $pageData['expense_import_list'] = FALSE;
            $pageData['expense_import_items'] = FALSE;
            $pageData['expense_items'] = FALSE;            
        } // import_expense

        if ( $this->input->post('save_expense_items') ) {
            $pageData['data'] = $this->_process_expense_import_items();
            $this->load->view('data_dump',$pageData);

            redirect('site/expense_list');
        }
        
        $pageData['vendor_menu'] = $this->Vendor_m->get_vendor_list();

        $pageData['payment_code_menu'] = $this->Payment_code_m->get_payment_code_list(TRUE);
        $pageData['expense_code_menu'] = $this->Expense_code_m->get_expense_code_list();

        $pageData['payment_code_menu'][0] = "Not Selected";
        $pageData['expense_code_menu'][0] = "Not Selected";

        $sidebarData['office_summary'] = FALSE;
          
        $data['titleTag'] = "Import Expense List";
        $data['pageTitle'] = "Import Expense List";
        $data['mainContent'] = $this->load->view('pages/import_expense',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }

    function _process_expense_import_list()
    {
        $expense_import_list = $this->input->post('expense_import_list');

        if($expense_import_list) 
        {
            // (1) Parse in expense_import_list line-by-line into an array
            $expense_import_items = explode("\n", trim($expense_import_list));

            // (2) Explode each line into separate fields
            //     Check for the field separator: \t , ; |
            function trim_value(&$value){ $value = trim($value); }

            $data_keys = array('date_exp','amount_exp','expense_code_exp','description_exp','payment_code_exp','id_exp');

            foreach ($expense_import_items as $item)
            {
                $item_fields = explode("\t", $item);
                array_walk($item_fields, 'trim_value');

                // [0] Set date format
                $item_date = new DateTime($item_fields[0]);
                $item_fields[0] = $item_date->format('Y-m-d');

                // [1] Set currency format
                $item_fields[1] = str_replace('$','',$item_fields[1]);

                // [2] Set expense code
                $expense_code_list = $this->Expense_code_m->get_expense_code_list();
                $item_fields[2] = array_search($item_fields[2],$expense_code_list);

                // [4] Set payment code
                $payment_code_list = $this->Payment_code_m->get_payment_code_list(TRUE);
                $item_fields[4] = array_search($item_fields[4],$payment_code_list);

                // [5] Set id
                $item_fields[5] = 0;
                $expense_items[] = array_combine($data_keys,$item_fields);
            } 
        }
        else
        {
            $expense_import_items = FALSE;
            $expense_items = FALSE;
        }

        // Echo back imported data back to the form
        $pageData['expense_import_list'] = $expense_import_list;
        $pageData['expense_import_items'] = $expense_import_items;
        $pageData['expense_items'] = $expense_items;

        return $pageData;
    }

    function _process_expense_import_items()
    {
        // (1) Get the post variables        
        $id_exp_tmp = $this->input->post('id_exp');
        $date_exp = $this->input->post('date_exp');
        $amount_exp = $this->input->post('amount_exp');
        $expense_code_exp = $this->input->post('expense_code_exp');
        $description_exp = $this->input->post('description_exp');
        $payment_code_exp = $this->input->post('payment_code_exp');
        $vendor_exp = $this->input->post('vendor_exp');
        
        foreach ($id_exp_tmp as $row_id => $val)
        {
            // Simple Validation Rule: check for an amount
            $validAmount = strlen($amount_exp[$row_id]);

            if($validAmount>0)
            {
                $newItemID = (int) $id_exp_tmp[$row_id];

                if ($newItemID == 0)
                {
                    $newItemID = $this->Expense_m->create_new_expense();
                }

                $post_data['date_exp'] = $date_exp[$row_id];
                $post_data['amount_exp'] = $amount_exp[$row_id];
                $post_data['description_exp'] = $description_exp[$row_id];
                $post_data['expense_code_exp'] = $expense_code_exp[$row_id];
                $post_data['payment_code_exp'] = $payment_code_exp[$row_id];
                $post_data['vendor_exp'] = $vendor_exp[$row_id];

                $this->Expense_m->update_expense($post_data,$newItemID);  
                
                $post_data['id_exp'] = $newItemID;
                
                $expenseList[] = $post_data;  
                
                unset($post_data['id_exp']);
                   
            }
        }
        
        /*
        $data['id_exp'] = $id_exp;
        $data['amount_exp'] = $amount_exp;
        $data['expense_code_exp'] = $expense_code_exp;
        $data['description_exp'] = $description_exp;
        $data['payment_code_exp'] = $payment_code_exp;
        */
        
        return $expenseList;
    }
    
    //-------------------------------------------------------------------------
    // Reports - Pages and Functions

    function expense_report()
    {
        $this->_verify_page_access($this->validSession,'site/login');
        
        $pageData['expense'] = $this->Expense_m->get_total_by_expense_code();

        $pageData['expense_count'] = $this->Expense_m->get_expense_total_count();

        $sidebarData['office_summary'] = FALSE;
        
        $pageData['vendor_menu'] = $this->Vendor_m->get_vendor_list();
        $pageData['payment_code_menu'] = $this->Payment_code_m->get_payment_code_list();
        $pageData['expense_code_menu'] = $this->Expense_code_m->get_expense_code_list();

        $pageData['vendor_menu'][0]       = "Not Selected";
        $pageData['payment_code_menu'][0] = "Not Selected";
        $pageData['expense_code_menu'][0] = "Not Selected";

        $data['titleTag'] = "Report - Total Expenses by Expense Code By Month and Quarter";
        $data['pageTitle'] = "Report - Total Expenses by Expense Code By Month and Quarter";
        $data['mainContent'] = $this->load->view('pages/expense_report',$pageData,true);
        $data['lhsContent'] = $this->load->view('pages/office_lhs',$sidebarData,true);
        
        $this->load->view('site_template',$data);
    }
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */
