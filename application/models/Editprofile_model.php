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
}