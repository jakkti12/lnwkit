<?php
class Editprofile_model extends CI_Model
{
    public function updateprofile($post)
    {
        $this->db->where('id', $post['user_id']);
                $this->db->update('users', array('firstname' => $post['firstname'] , 'lastname' => $post['lastname']));
                $success = $this->db->affected_rows();
        return true;
    }

    public function getAllSettings()
    {
        $this->db->select('*');
        $this->db->from('settings');
        return $this->db->get()->row();
    }

    public function getUserInfo($id)
    {
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function get_news_by_id($id)
    {
        if ($id == 0)
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function set_news($id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('title'), // $this->db->escape($this->input->post('title'))
            'slug' => $slug,
            'text' => $this->input->post('text'),
            'user_id' => $this->input->post('user_id'),
        );
        
        if ($id == 0) {
            //$this->db->query('YOUR QUERY HERE');
            return $this->db->insert('news', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('news', $data);
        }
    }
    
    public function delete_news($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('news'); // $this->db->delete('news', array('id' => $id));  
        
        // error() method will return an array containing its code and message
        // $this->db->error();
    }
}