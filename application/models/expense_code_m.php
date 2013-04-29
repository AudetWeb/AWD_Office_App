<?php 

class Expense_code_m extends CI_Model {

    function Expense_code_m()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_new_expense_code()
    {
        $data['modify_by_ec']     = $this->session->userdata('user_name');
        $data['create_by_ec']     = $this->session->userdata('user_name');
        $data['modify_date_ec']   = NULL;
        $data['create_date_ec']   = NULL;
        
        $this->db->insert('expense_code_ec', $data);  

        return $this->db->insert_id();
    }
    
    function update_expense_code($field_values,$row_id)
    {
        $field_values['modify_by_ec'] = $this->session->userdata('user_name');

        $this->db->set($field_values);
        $this->db->where('id_ec', $row_id); 
        $this->db->update('expense_code_ec'); 
    }

    function get_expense_code($row_id)
    {
        $this->db->where('id_ec',$row_id);
        $this->db->limit(1);
        
        $query = $this->db->get('expense_code_ec');
        
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
        } else {
            $row = NULL;
        } 

        return $row;
    }

    function get_all_expense_code($sort_type=FALSE)
    {
        switch (strtolower($sort_type)) {
            case "date":
                $this->db->order_by('create_date_ec', 'desc');
                break;
            case "alpha":
                $this->db->order_by('expense_code_ec', 'asc');
                break;
            default:
                $this->db->order_by('expense_code_ec', 'asc');
        }
        
        $this->db->where('is_deleted_ec','0'); 
        $query = $this->db->get('expense_code_ec');

        return $query;

    }

    function get_expense_code_list($sort_type=FALSE)
    {
        switch (strtolower($sort_type)) {
            case "date":
                $this->db->order_by('create_date_ec', 'desc');
                break;
            case "alpha":
                $this->db->order_by('expense_code_ec', 'asc');
                break;
            default:
                $this->db->order_by('expense_code_ec', 'asc');
        }

        $this->db->where('is_deleted_ec','0'); 
        $query = $this->db->get('expense_code_ec');

        if($query->result())
        {
            foreach ($query->result() as $row) 
            {
                $list[$row->id_ec] = $row->expense_code_ec;
            }
        }
        else
        {
            $list = FALSE;
        }
        return $list;
    }

    function get_expense_code_total_count()
    {
        $this->db->select("count(1) 'expense_code_count_ec'");        
        $this->db->where('is_deleted_ec','0');
        $query = $this->db->get('expense_code_ec');

        return $query->row()->expense_code_count_ec;
    }

}

?>
