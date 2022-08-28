<?php defined ('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{

    // start datatables
	var $column_order = array(null, 'tbl_pemesanan.nama_user', 'tbl_ruang.namaruang', 'tbl_pemesanan.nama_kegiatan', 'tbl_pemesanan.tanggal', null, null); //set column field database for datatable orderable
	var $column_search = array('tbl_pemesanan.nama_user', 'tbl_ruang.namaruang', 'tbl_pemesanan.tanggal'); //set column field database for datatable searchable
	var $order = array('tbl_ruang.namaruang' => 'asc'); // default order

    // datatables 

    var $column_order_online = ['tbl_ruang.namaruang', 'tbl_pemesananonline.nama_kegiatan', 'tbl_pemesananonline.nama_aplikasi', 'tbl_pemesananonline.tanggal', 'tbl_pemesananonline.mulai', 'tbl_pemesananonline.selesai'];
    var $column_search_online = ['tbl_ruang.namaruang', 'tbl_pemesananonline.nama_kegiatan', 'tbl_pemesananonline.tanggal'];
    var $order_online = ['tbl_ruang.namaruang' => "asc"];

    private function _get_datatables_query(){

        $where = "(tbl_pemesanan.status = 3)";

        $this->db->select('
            tbl_pemesanan.id_pemesanan, tbl_pemesanan.status, tbl_pemesanan.nama_user, tbl_ruang.namaruang, 
            tbl_pemesanan.tanggal, tbl_pemesanan.nama_kegiatan, tbl_pemesanan.mulai, tbl_pemesanan.selesai,
        ');
        $this->db->from('tbl_pemesanan');
        $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
        $this->db->where('MONTH(tbl_pemesanan.tanggal) = MONTH(CURRENT_DATE())');
        $this->db->where($where);
   
        $i = 0;

        foreach ($this->column_search as $item) { // loop column
            if(@$_POST['search']['value']) { // if datatable send POST for search
                
                if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
            }
            $i++;
        } // end loop
        if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}  else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }
    function get_datatables() {
		$this->_get_datatables_query();
		if(@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
    function count_all() {
		$this->db->from('tbl_pemesanan');
		return $this->db->count_all_results();
	}

    private function _get_datatables_query_online(){

        $where = "(tbl_pemesananonline.status = 3)";

        $this->db->select('
            tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.status, tbl_ruang.namaruang,  tbl_pemesananonline.nama_user,
            tbl_pemesananonline.tanggal, tbl_pemesananonline.nama_kegiatan, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai,
        ');
        $this->db->from('tbl_pemesananonline');
        $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
        $this->db->where('MONTH(tbl_pemesananonline.tanggal) = MONTH(CURRENT_DATE())');
        $this->db->where($where);

        $i = 0;

        foreach ($this->column_search_online as $item) { // loop column
            if(@$_POST['search']['value']) { // if datatable send POST for search
                
                if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search_online) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
            }
            $i++;
        } // end loop

        if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_order_online[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}  else if(isset($this->order)) {
			$order = $this->order_online;
			$this->db->order_by(key($order), $order[key($order)]);
		}

    }

    function get_datatables_online() {
		$this->_get_datatables_query_online();
		if(@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    function count_filtered_online() {
		$this->_get_datatables_query_online();
		$query = $this->db->get();
		return $query->num_rows();
	}
    function count_all_online() {
		$this->db->from('tbl_pemesananonline');
		return $this->db->count_all_results();
	}
    // end datatables
    ///////////////////////////////////////////////////////

    public function login($post)
    {
       
        $this->db->from('user');
        $this->db->where('emp_no',  $post['emp_no']);
        $this->db->where('password',($post['password']));
        $query = $this->db->get();
        return $query;
        }

    public function get($emp_no = null)
    {
        $this->db->from('user');
        if($emp_no != null){
            $this->db->where('emp_no', $emp_no);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getDetailListOfBooking(){
        $this->db->select('
            a.id_pemesanan, a.emp_no, a.status, a.nama_user, b.namaruang, a.tanggal, a.jumlah_peserta, 
            a.nama_kegiatan, a.mulai, a.selesai, a.pesan
        ');
        $this->db->from('tbl_pemesanan a');
        $this->db->join('tbl_ruang b', 'a.namaruang = b.id_ruang');
        $this->db->where('MONTH(a.tanggal) = MONTH(CURRENT_DATE())');

        $query = $this->db->get();
        return $query;
    }
    public function getDetailListOfBookingOnline(){
        $this->db->select('
            a.id_pemesanan, a.emp_no, a.status, a.nama_user, b.namaruang, a.tanggal, a.nama_aplikasi,
            a.nama_kegiatan, a.mulai, a.selesai,
        ');
        $this->db->from('tbl_pemesananonline a');
        $this->db->join('tbl_ruang b', 'a.namaruang = b.id_ruang');
        $this->db->where('MONTH(a.tanggal) = MONTH(CURRENT_DATE())');

        $query = $this->db->get();
        return $query;
    }

}