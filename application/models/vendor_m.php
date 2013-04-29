<?php 

class Vendor_m extends CI_Model {

    function Vendor_m()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_new_vendor()
    {
        $data['modify_by_ven']     = $this->session->userdata('user_name');
        $data['create_by_ven']     = $this->session->userdata('user_name');
        $data['modify_date_ven']   = NULL;
        $data['create_date_ven']   = NULL;
        
        $this->db->insert('vendor_ven', $data);  

        return $this->db->insert_id();
    }
    
    function update_vendor($field_values,$row_id)
    {
        $field_values['modify_by_ven'] = $this->session->userdata('user_name');

        $this->db->set($field_values);
        $this->db->where('id_ven', $row_id); 
        $this->db->update('vendor_ven'); 
    }

    function get_vendor($row_id)
    {
        $this->db->where('id_ven',$row_id);
        $this->db->limit(1);
        
        $query = $this->db->get('vendor_ven');
        
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
        } else {
            $row = NULL;
        } 

        return $row;
    }

    function get_all_vendor($sort_type=FALSE)
    {
        switch (strtolower($sort_type)) {
            case "date":
                $this->db->order_by('create_date_ven', 'desc');
                break;
            case "alpha":
                $this->db->order_by('vendor_name_ven', 'asc');
                break;
            default:
                $this->db->order_by('vendor_name_ven', 'asc');
        }
        
        $this->db->where('is_deleted_ven','0'); 
        $query = $this->db->get('vendor_ven');

        return $query;

    }

    function get_vendor_list()
    {
        $this->db->order_by('vendor_name_ven', 'asc');
        $this->db->where('is_deleted_ven','0'); 
        $query = $this->db->get('vendor_ven');

        if($query->result())
        {
            foreach ($query->result() as $row) 
            {
                $list[$row->id_ven] = $row->vendor_name_ven;
            }
        }
        else
        {
            $list = FALSE;
        }
        return $list;
    }

    function get_vendor_total_count()
    {
        $this->db->select("count(1) 'vendor_count_ven'");        
        $this->db->where('is_deleted_ven','0');
        $query = $this->db->get('vendor_ven');

        return $query->row()->vendor_count_ven;
    }

}

?>
