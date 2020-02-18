<?php
class Petugas_model extends CI_Model
{
	public function join()
	{
		return $this->db->query("SELECT simpanan.*,anggota.*,penarikan.*,anggota.id_anggota as id FROM simpanan INNER JOIN anggota on simpanan.id_anggota = anggota.id_anggota LEFT JOIN penarikan on simpanan.id_simpanan = penarikan.id_simpanan GROUP BY simpanan.id_anggota order by simpanan.id_simpanan DESC")->result();
	}
	public function join_pinjaman()
	{
		return $this->db->query("SELECT pinjaman.*,anggota.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota = anggota.id_anggota order by pinjaman.id_pinjaman DESC")->result();
	}
	public function join_angsuran()
	{
		return $this->db->query("SELECT pinjaman.*,pinjaman.id_pinjaman as pinjam,anggota.*,angsuran.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota = anggota.id_anggota INNER JOIN angsuran on pinjaman.id_pinjaman = angsuran.id_pinjaman GROUP BY angsuran.id_pinjaman ORDER BY angsuran.id_pinjaman DESC")->result();
	}
	function getUsers($postData)
	{

		$response = array();

		if (isset($postData['search'])) {
			// Select record
			$this->db->select('*');
			$this->db->like("nik", $postData['search']);

			$records = $this->db->get('anggota')->result();

			foreach ($records as $row) {
				$response[] = array(
					"lahir" => $row->lahir,
					"jk" => $row->jk,
					"tempat" => $row->tempat,
					"noHp" => $row->no_hp,
					"alamat" => $row->alamat,
					"id" => $row->id_anggota,
					"nama" => $row->nama,
					"label" => $row->nik
				);
			}
		}

		return $response;
	}
	function getAngsur($postData)
	{

		$response = array();

		if (isset($postData['search'])) {
			// Select record
			$cari = $postData['search'];
			$records = $this->db->query("SELECT anggota.*,pinjaman.*, pinjaman.id_pinjaman as pinjam,angsuran.* FROM anggota INNER JOIN pinjaman on anggota.id_anggota = pinjaman.id_anggota LEFT JOIN angsuran on pinjaman.id_pinjaman = angsuran.id_pinjaman WHERE anggota.nik LIKE '%$cari%' Group by anggota.nik order by pinjaman.id_pinjaman desc")->result();

			foreach ($records as $row) {
				$this->db->select('besar_angsuran');
				$this->db->where('id_pinjaman', $row->pinjam);
				$query = $this->db->get('angsuran')->result();
				$sisa = 0;
				foreach ($query as $sum) {
					$sisa += $sum->besar_angsuran;
				}
				$sisa = $row->total_pinjaman - $sisa;
				$bulan = $row->total_pinjaman / 10;
				$response[] = array(
					'sisa' => (string) $sisa,
					"tgl" => $row->tgl_pelunasan,
					"bulan" => (string) $bulan,
					"total" => $row->total_pinjaman,
					"id" => $row->pinjam,
					"nama" => $row->nama,
					"label" => $row->nik
				);
			}
		}

		return $response;
	}
	public function simpan()
	{
		$post = $this->input->post();
		$data = [
			'id_anggota' => $post['id'],
			'petugas' => $this->session->userdata('username'),
			'besar_simpanan' => $post['simpanan'],
			'ket' => htmlspecialchars($post['ket'])
		];
		$this->db->insert('simpanan', $data);
		redirect('petugas');
	}
	public function pinjam_simpan()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$tes = $this->db->query("SELECT pinjaman.*,anggota.*,angsuran.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota INNER JOIN angsuran on pinjaman.id_pinjaman=angsuran.id_pinjaman WHERE angsuran.sisa_angsuran = 0 AND pinjaman.id_anggota = $id")->result();
		$cek = $this->db->query("SELECT pinjaman.*,anggota.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota WHERE pinjaman.id_anggota = $id")->result();
		if (!$cek) {
			(int) $persen = $post['simpanan'] * 1.5 / 100;
			(int) $total = $post['simpanan'] + $persen;
			$tgl1 = date('Y/m/d');
			$tgl2 = date('Y/m/d', strtotime('+10 month', strtotime($tgl1)));

			$data = [
				'id_anggota' => $post['id'],
				'petugas' => $this->session->userdata('username'),
				'besar_pinjaman' => $post['simpanan'],
				'tgl_pinjaman' => $tgl1,
				'tgl_pelunasan' => $tgl2,
				'total_pinjaman' => $total
			];
			$this->db->insert('pinjaman', $data);
			redirect('petugas/pinjaman');
		} else if (!$tes) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center" role="alert">
			Anggota Belum menyelesaikan pinjaman sebelumnya
		  </div>');
			redirect('petugas/pinjaman');
		}
	}
	public function angsuran_simpan()
	{
		$post = $this->input->post();
		$data = [
			'id_pinjaman' => $post['id'],
			'petugas' => $this->session->userdata('username'),
			'besar_angsuran' => $post['simpanan'],
			'id_pinjaman' => $post['id'],
			'angsuran_ke' => $post['ke'],
			'ket' => $post['ket']
		];
		$this->db->insert('angsuran', $data);
		redirect('petugas/angsuran');
	}
}
