<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Course_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('course/course_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Course_model->json();
    }

    public function read($id) 
    {
        $row = $this->Course_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'id_user' => $row->id_user,
	    );
            $this->load->view('course/course_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('course'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('course/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'id_user' => set_value('id_user'),
	);
        $this->load->view('course/course_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Course_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('course'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Course_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('course/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'id_user' => set_value('id_user', $row->id_user),
	    );
            $this->load->view('course/course_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('course'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Course_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('course'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Course_model->get_by_id($id);

        if ($row) {
            $this->Course_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('course'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('course'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "course.xls";
        $judul = "course";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->Course_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=course.doc");

        $data = array(
            'course_data' => $this->Course_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('course/course_doc',$data);
    }

}

/* End of file Course.php */
/* Location: ./application/controllers/Course.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:46 */
/* http://harviacode.com */