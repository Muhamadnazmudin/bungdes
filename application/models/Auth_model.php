<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function cek_user($username)
    {
        return $this->db
            ->where('username', $username)
            ->where('aktif', 1)
            ->get('users')
            ->row();
    }
}
