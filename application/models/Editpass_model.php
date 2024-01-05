<?php
class Editpass_model extends CI_Model
{
    public function updatepassword($post)
    {
        if (!$this->db->where('id', $post['user_id'])) {
            redirect('edit_password');
        } else {
            if (!$this->db->where('password', $post['oldpassword'])) {
                redirect('edit_password');
            } else {
                $this->db->update('users', array('password' => $post['newpassword']));
                $success = $this->db->affected_rows();
            }
        }
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
