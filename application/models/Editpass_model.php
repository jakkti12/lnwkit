<?php
class Editpass_model extends CI_Model
{
    public function updatepassword($post)
    {
        $this->db->where('id', $post['user_id']);
        $this->db->update('users', array('password' => $post['newpassword']));
        $success = $this->db->affected_rows();
        
        if(!$success){
            error_log('Unable to updateProfile('.$post['user_id'].')');
            return false;
        }
        return true;
    }
    
    public function checkpassword($post)
    {
        
        $this->load->library('password');
        $this->db->select('*');
        $this->db->where('password', $post['currentpassword']);
        $query = $this->db->get('users');
        $userInfo = $query->row();
        $count = $query->num_rows();
        
        if ($count == 1) {
            if (!$this->password->validate_password($post['currentpassword'], $userInfo->password)) {
                error_log('Unsuccessful login attempt(' . $post['currentpassword'] . ')');
                return false;
            } else {
                $this->updateLoginTime($userInfo->id);
            }
        } else {
            error_log('Unsuccessful login attempt(' . $post['currentpassword'] . ')');
            return false;
        }
        
        unset($userInfo->password);
        return $userInfo;
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
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
}