<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_user_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_user/detail_user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Detail_user_model->json();
    }

    public function read($id) 
    {
        $row = $this->Detail_user_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'name' => $row->name,
		'email' => $row->email,
		'phone' => $row->phone,
		'address' => $row->address,
	    );
            $this->load->view('detail_user/detail_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_user/create_action'),
	    'id_user' => set_value('id_user'),
	    'name' => set_value('name'),
	    'email' => set_value('email'),
	    'phone' => set_value('phone'),
	    'address' => set_value('address'),
	);
        $this->load->view('detail_user/detail_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'address' => $this->input->post('address',TRUE),
	    );

            $this->Detail_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_user/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'name' => set_value('name', $row->name),
		'email' => set_value('email', $row->email),
		'phone' => set_value('phone', $row->phone),
		'address' => set_value('address', $row->address),
	    );
            $this->load->view('detail_user/detail_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_user' => $this->input->post('id_user',TRUE),
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'address' => $this->input->post('address',TRUE),
	    );

            $this->Detail_user_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_user_model->get_by_id($id);

        if ($row) {
            $this->Detail_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_user.xls";
        $judul = "detail_user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Address");

	foreach ($this->Detail_user_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->address);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=detail_user.doc");

        $data = array(
            'detail_user_data' => $this->Detail_user_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('detail_user/detail_user_doc',$data);
    }

}

/* End of file Detail_user.php */
/* Location: ./application/controllers/Detail_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:47 */
/* http://harviacode.com */