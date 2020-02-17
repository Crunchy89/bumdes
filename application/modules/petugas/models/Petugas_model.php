<?php
class Petugas_model extends CI_Model
{
	public function join()
	{
		return $this->db->query("SELECT simpanan.*,anggota.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota = anggota.id_anggota order by simpanan.id_simpanan DESC")->result();
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
}
