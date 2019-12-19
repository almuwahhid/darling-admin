<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Register extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('users_model');
    $this->load->model('main_model');
  }
  public function index(){
    include_once 'class.verifyEmail.php';
    $data2 = json_decode($this->input->post('data'));
    $password = $this->users_model->hash_password($data2->password);

    $data2->password = $password;

    if(!$this->users_model->check_email($data2->email)){
      $vmail = new verifyEmail();
      $vmail->setStreamTimeoutWait(20);
      $vmail->Debug= TRUE;
      $vmail->Debugoutput= 'html';

      $vmail->setEmailFrom($data2->email);//email which is used to set from headers,you can add your own/company email over here

      if ($vmail->check($data2->email)) {
        $insert = $this->main_model->create($data2, 'user');

        if($insert){
          $confirm_hash = $this->users_model->hash_password($data2->email.date('Y-m-d H:i:s'));
          $data = array(
            'confirmation_code' => $confirm_hash,
          );
          $update = $this->main_model->update($data, 'user', ['email' => $data2->email]);
          $x = ['nama_lengkap' => $data2->nama, 'username' => $data2->email];
          if($update){
              $this->requestEmailConfirmation((object) $x, $confirm_hash);
          }
        }
      } elseif (verifyEmail::validate($email)) {
        $data = array(
                    'status'           => "202",
                    'message'           => "valid, but not exist!",
                    'data'          => $email);
        echo json_encode($data);
      } else {
        $data = array(
                    'status'           => "500",
                    'message'           => "Email tidak valid!",
                    'data'          => "");
                    echo json_encode($data);
      }
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => "Email sudah terdaftar!",
                  'data'          => "");
                  echo json_encode($data);
    }
  }

  public function requestEmailConfirmation($data, $hash){
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
                        <td style="height: 97px;">Untuk mengkonfirmasi akun kamu, klik tombol dibawah ini</td>
                      </tr>
                      <tr style="height: 36px;">
                        <td style="height: 36px;">
                          <a href='' target='_blank' href='http://localhost/meetu/api/register/confirm?hash=$hash'>http://localhost/meetu/api/register/confirm?hash=$hash</a>
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

    $confirm_data = (object) parent::send_email($data->username, 'Konfirmasi Akun Aplikasi BERES', $message);
    if($confirm_data->status=="sukses"){
      $data = array(
                  'status'           => "200",
                  'message'           => "Silahkan cek email Anda untuk melakukan konfirmasi");
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => $confirm_data->message);
    }

    echo json_encode($data);
  }

  public function confirm(){
    $hash = $this->input->get('hash');
    $data = array(
      'confirmation_code' => '',
      'aktif' => 'Y'
    );

    if($this->main_model->getDetail('user', ['confirmation_code' => $hash])){
      $update = $this->main_model->update($data, 'user', ['confirmation_code' => $hash]);
      if($update){
        echo "Anda berhasil mengkonfirmasi akun, silahkan login untuk akses lebih lanjut";
        // echo "<script>window.close();</script>";
      }
    } else {
      echo "Kode konfirmasi Anda salah";
    }
  }


  public function registeremail(){
    include_once 'class.verifyEmail.php';
    $email = $this->input->post('username');

    if(!$this->users_model->check_email($email)){
      $vmail = new verifyEmail();
      $vmail->setStreamTimeoutWait(20);
      $vmail->Debug= TRUE;
      $vmail->Debugoutput= 'html';

      $vmail->setEmailFrom($email);//email which is used to set from headers,you can add your own/company email over here

      if ($vmail->check($email)) {
        $data = array(
                    'status'           => "200",
                    'message'           => "Email tersedia",
                    'data'          => $email);
      } elseif (verifyEmail::validate($email)) {
        $data = array(
                    'status'           => "202",
                    'message'           => "valid, but not exist!",
                    'data'          => $email);
      } else {
        $data = array(
                    'status'           => "500",
                    'message'           => "Email tidak valid!",
                    'data'          => "");
      }
    } else {
      $data = array(
                  'status'           => "404",
                  'message'           => "Email sudah terdaftar!",
                  'data'          => "");
    }
    echo json_encode($data);
  }
}
