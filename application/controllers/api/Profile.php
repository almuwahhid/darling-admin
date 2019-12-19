<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Profile extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('users_model');
    $this->load->model('main_model');
  }
  public function editprofile(){
    $data = json_decode($this->input->post('data'));

    $update = $this->main_model->update($data, 'user', ['email' => $data->email]);
    if($update){
      $user = $this->users_model->get_user($data->email);

      $data = array(
                  'status'           => "200",
                  'message'           => "Update Berhasil",
                  'data'          => $user);
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => "Ada yang bermasalah dengan server",
                  'data'          => new stdClass());
    }

    echo json_encode($data);
  }

  public function editpassword(){
    $data = json_decode($this->input->post('data'));

    if ($this->users_model->check_login_user($data->email, $data->password_lama)) {
      $p_baru = $this->users_model->hash_password($data->password_baru);

      $data2 = array(
        'password' => $p_baru
      );
      $update = $this->main_model->update($data2, 'user', ['email' => $data->email]);
      if($update){
        $data = array(
                    'status'           => "200",
                    'message'           => "Berhasil mengubah password",
                    'data'          => new stdClass());
      } else {
        $data = array(
                    'status'           => "404",
                    'message'           => "Ada yang bermasalah dengan server",
                    'data'          => new stdClass());
      }
    } else {
      $data = array(
                  'status'           => "204",
                  'message'           => "Password Anda salah",
                  'data'          => new stdClass());
    }

    echo json_encode($data);
  }
}
