<?php 

class Expense_m extends CI_Model {

    function Expense_m()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_new_expense()
    {
        $data['modify_by_exp']     = $this->session->userdata('user_name');
        $data['create_by_exp']     = $this->session->userdata('user_name');
        $data['modify_date_exp']   = NULL;
        $data['create_date_exp']   = NULL;
        
        $this->db->insert('expense_exp', $data);  

        return $this->db->insert_id();
    }
    
    function update_expense($field_values,$row_id)
    {
        $field_values['modify_by_exp'] = $this->session->userdata('user_name');

        $this->db->set($field_values);
        $this->db->where('id_exp', $row_id); 
        $this->db->update('expense_exp'); 
    }

    function get_expense($row_id)
    {
        $this->db->where('id_exp',$row_id);
        $this->db->limit(1);
        
        $query = $this->db->get('expense_exp');
        
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
        } else {
            $row = NULL;
        } 

        return $row;
    }

    function get_all_expense($sort_type=FALSE)
    {
        switch (strtolower($sort_type)) {
            case "date":
                $this->db->order_by('create_date_exp', 'desc');
                break;
            case "alpha":
                $this->db->order_by('expense_exp', 'asc');
                break;
            default:
                $this->db->order_by('date_exp', 'desc');
        }
        
        $this->db->where('is_deleted_exp','0'); 
        $query = $this->db->get('expense_exp');

        return $query;

    }

    function get_expense_total_count()
    {
        $this->db->select("count(1) 'expense_count_exp'");        
        $this->db->where('is_deleted_exp','0');
        $query = $this->db->get('expense_exp');

        return $query->row()->expense_count_exp;
    }

    function get_total_by_expense_code($year=FALSE)
    {
        $sql = "SELECT expense_code_exp, 
        SUM(amount_exp) total,
        SUM(CASE MONTH(date_exp) WHEN 1 THEN amount_exp ELSE 0 END) 'jan',
        SUM(CASE MONTH(date_exp) WHEN 2 THEN amount_exp ELSE 0 END) 'feb',
        SUM(CASE MONTH(date_exp) WHEN 3 THEN amount_exp ELSE 0 END) 'mar',
        SUM(CASE MONTH(date_exp) WHEN 4 THEN amount_exp ELSE 0 END) 'apr',
        SUM(CASE MONTH(date_exp) WHEN 5 THEN amount_exp ELSE 0 END) 'may',
        SUM(CASE MONTH(date_exp) WHEN 6 THEN amount_exp ELSE 0 END) 'jun',
        SUM(CASE MONTH(date_exp) WHEN 7 THEN amount_exp ELSE 0 END) 'jul',
        SUM(CASE MONTH(date_exp) WHEN 8 THEN amount_exp ELSE 0 END) 'aug',
        SUM(CASE MONTH(date_exp) WHEN 9 THEN amount_exp ELSE 0 END) 'sep',
        SUM(CASE MONTH(date_exp) WHEN 10 THEN amount_exp ELSE 0 END) 'oct',
        SUM(CASE MONTH(date_exp) WHEN 11 THEN amount_exp ELSE 0 END) 'nov',
        SUM(CASE MONTH(date_exp) WHEN 12 THEN amount_exp ELSE 0 END) 'dec',
        SUM(CASE MONTH(date_exp) BETWEEN 1 AND 3 WHEN TRUE THEN amount_exp ELSE 0 END) 'q1',
        SUM(CASE MONTH(date_exp) BETWEEN 4 AND 6 WHEN TRUE THEN amount_exp ELSE 0 END) 'q2',
        SUM(CASE MONTH(date_exp) BETWEEN 7 AND 9 WHEN TRUE THEN amount_exp ELSE 0 END) 'q3',
        SUM(CASE MONTH(date_exp) BETWEEN 10 AND 12 WHEN TRUE THEN amount_exp ELSE 0 END) 'q4'
        FROM expense_exp
        LEFT JOIN expense_code_ec ON id_ec = expense_code_exp
        WHERE YEAR(date_exp)  = '2012'  
        GROUP BY expense_code_exp
        ORDER BY expense_code_ec";

        $query = $this->db->query($sql);   
             
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        } 
    }
}

?>
