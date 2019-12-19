<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('users_model');
    $this->load->model('main_model');
  }

  public function index(){
    $data = json_decode($this->input->post('data'));

    if ($this->users_model->check_login($data->email, $data->password)) {
      $user = $this->users_model->get_user($data->email);
      if($user->aktif == 'N'){
        $data = array(
                    'status'           => "204",
                    'message'           => "Akun belum dikonfirmasi oleh Admin",
                    'data'          => new stdClass());
      } else {
        $data = array(
                    'status'           => "200",
                    'message'           => "Login berhasil",
                    'data'          => $user);
      }
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => "Username atau password salah",
                  'data'          => new stdClass());
    }

    echo json_encode($data);
  }

  public function updateLupaPassword(){
    $password = $this->input->get('password');
    $code = $this->input->get('code');
    if($this->users_model->get_user_by_code($code)){
      $this->users_model->update_login_by_code($code, $password);
      $data = array(
                  'status'           => "success",
                  'message'          => "Berhasil mengubah password",
                  'data'             => new stdClass());
    } else {
      $data = array(
                  'status'           => "failed",
                  'message'          => "Kode sudah usang / tidak ditemukan",
                  'data'             => new stdClass());
    }
    echo json_encode($data);
  }

  public function lupaPassword(){
    $data = $this->input->post('data');
    if ($this->users_model->check_email($data)) {
      $user = $this->users_model->get_user($data);
      $confirm_hash = $this->users_model->hash_password($user->email.date('Y-m-d H:i:s'));
      $this->users_model->update_forgot_password($confirm_hash, $user->email);
      $x = ['nama_lengkap' => $user->nama, 'username' => $user->email];
      $this->requestEmail((object) $x, $confirm_hash);
    } else {
      $data = array(
                  'status'           => "failed",
                  'message'          => "Email belum terdaftar!",
                  'data'             => new stdClass());
    }
  }

  public function requestEmail($data, $hash){
    $message = <<<EMAIL
              <!DOCTYPE html>
              <html>
                <body>
                  <table>
                    <tbody>
                      <tr style="height: 27px;">
                        <td style="height: 27px;">Hi, $data->nama_lengkap</td>
                      </tr>
                      <tr style="height: 97px;">
                        <td style="height: 97px;">Untuk mengubah password akun kamu, klik tombol dibawah ini</td>
                      </tr>
                      <tr style="height: 36px;">
                        <td style="height: 36px;">
                          <a href='http://meetu.tutorial-sourcecode.com/lupapassword?code=$hash'>Klik disini untuk mengubah password</a>
                        </td>
                      </tr>
                      <tr style="height: 75px;">
                        <td style="height: 75px;">
                          <p>Terimakasih,</p>
                          <p>Admin</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </body>
              </html>
EMAIL;

    $confirm_data = (object) parent::send_email($data->username, 'Mengubah password akun Darling', $message);
    if($confirm_data->status=="sukses"){
      $data = array(
                  'status'           => "success",
                  'message'           => "Silahkan cek email Anda untuk melakukan konfirmasi");
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => $confirm_data->message);
    }

    echo json_encode($data);
  }
}
