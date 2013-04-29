<?php 

class Payment_code_m extends CI_Model {

    function Payment_code_m()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_new_payment_code()
    {
        $data['modify_by_pc']     = $this->session->userdata('user_name');
        $data['create_by_pc']     = $this->session->userdata('user_name');
        $data['modify_date_pc']   = NULL;
        $data['create_date_pc']   = NULL;
        
        $this->db->insert('payment_code_pc', $data);  

        return $this->db->insert_id();
    }
    
    function update_payment_code($field_values,$row_id)
    {
        $field_values['modify_by_pc'] = $this->session->userdata('user_name');

        $this->db->set($field_values);
        $this->db->where('id_pc', $row_id); 
        $this->db->update('payment_code_pc'); 
    }

    function get_payment_code($row_id)
    {
        $this->db->where('id_pc',$row_id);
        $this->db->limit(1);
        
        $query = $this->db->get('payment_code_pc');
        
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
        } else {
            $row = NULL;
        } 

        return $row;
    }

    function get_all_payment_code($sort_type=FALSE)
    {
        switch (strtolower($sort_type)) {
            case "date":
                $this->db->order_by('create_date_pc', 'desc');
                break;
            case "alpha":
                $this->db->order_by('payment_code_pc', 'asc');
                break;
            default:
                $this->db->order_by('payment_code_pc', 'asc');
        }
        
        $this->db->where('is_deleted_pc','0'); 
        $query = $this->db->get('payment_code_pc');

        return $query;

    }

    function get_payment_code_list($short_form=FALSE)
    {
        $this->db->order_by('payment_code_pc', 'asc');
        $this->db->where('is_deleted_pc','0'); 
        $query = $this->db->get('payment_code_pc');

        if($query->result())
        {
            foreach ($query->result() as $row) 
            {
                if($short_form)
                {
                    $list[$row->id_pc] = $row->payment_code_pc;
                }
                else
                {
                    $list[$row->id_pc] = $row->payment_code_pc . ($row->description_pc ? ' - ' . $row->description_pc : "");
                }
            }
        }
        else
        {
            $list = FALSE;
        }
        return $list;
    }

    function get_payment_code_total_count()
    {
        $this->db->select("count(1) 'payment_code_count_pc'");        
        $this->db->where('is_deleted_pc','0');
        $query = $this->db->get('payment_code_pc');

        return $query->row()->payment_code_count_pc;
    }

}

?>
