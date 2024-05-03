<?php
class Profile_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas() {
        $query = $this->db->get('set_areas');
        return $query->result_array();
    }

    public function add_lot($userid, $email, $username, $password) {
        // Hash the new password

        $hashed_password = md5($password);
    
        // Fetch the current password for the user
        $this->db->select('password');
        $this->db->from('set_users');
        $this->db->where('id', $userid);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $current_password = $query->row()->password;
            
            // Check if the hashed new password is different from the current password
            if ($current_password == $hashed_password) {
                // The passwords are the same, update other information but not the password
                // $data_pr_history = [
                //     'email' => $email,
                //     'username' => $username,
                //     // Exclude password from the update
                // ];
    
                // $this->db->where('id', $userid);
                // $this->db->update('set_users', $data_pr_history);
    
                return 'error';
                
            } else {
                
                // The passwords are different, so update the user's password along with other data
                $data_pr_history = [
                    'email' => $email,
                    'username' => $username,
                    'password' => $hashed_password // Save the new hashed password
                ];
    
                $this->db->where('id', $userid);
                $this->db->update('set_users', $data_pr_history);
    
                return 'success';
            }
        } else {
            // User not found
            return 'user_not_found';
        }
    }
}
    

	
	

?>  
