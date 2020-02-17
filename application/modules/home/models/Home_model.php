<?php
class Home_model extends CI_Model
{
    public function login()
    {
        $post = $this->input->post();
        $db = $this->db;
        $username = htmlspecialchars($post['user']);
        $password = htmlspecialchars($post['pass']);
        $cek = $db->get_where('user', ['username' => $username, 'password' => $password])->row();
        if ($cek) {
            if ($cek->status != 1) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center" role="alert">
                Akun Anda belum di verifikasi
              </div>');
                redirect('home');
            }
            $data = [
                'id' => $cek->id_login,
                'level' => $cek->id_level,
                'username' => $cek->username
            ];
            $this->session->set_userdata($data);
            if ($cek->id_level == 3) {
                redirect('member');
            } else if ($cek->id_level == 2 || $cek->id_level == 1) {
                redirect('admin');
            } else if ($cek->id_level == 4) {
                redirect('petugas');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center" role="alert">
            Username atau Password salah
          </div>');
            redirect('home');
        }
    }
    public function daftar()
    {
        $post = $this->input->post();
        $db = $this->db;
        $gambar = $this->_uploadImage();
        $cek = $db->get_where('user', ['username' => $post['user']]);
        if ($cek->username == $post['user']) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center" role="alert">
        Username Sudah terpakai
      </div>');
            redirect('home');
        }
        $data = [
            'nik' => htmlspecialchars($post['nik']),
            'nama' => htmlspecialchars($post['nama']),
            'jk' => htmlspecialchars($post['jk']),
            'agama' => htmlspecialchars($post['agama']),
            'status' => htmlspecialchars($post['status']),
            'pekerjaan' => htmlspecialchars($post['pekerjaan']),
            'alamat' => htmlspecialchars($post['alamat']),
            'tempat' => htmlspecialchars($post['tempat']),
            'lahir' => htmlspecialchars($post['lahir']),
            'no_hp' => htmlspecialchars($post['no_hp']),
            'gambar' => $gambar
        ];
        $db->insert('anggota', $data);
        $id = $db->insert_id();
        $data = [
            'username' => htmlspecialchars($post['user']),
            'password' => htmlspecialchars($post['pass']),
            'id_login' => $id,
            'id_level' => 3,
            'status' => 0,
        ];
        $db->insert('user', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center" role="alert">
            Akun Berhasil dibuat silahkan tunggu konfirmasi Admin
          </div>');
        redirect('home');
    }
    private function _uploadImage()
    {
        $config['upload_path']          = 'assets/img/anggota/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        return "noimage.png";
    }
}
