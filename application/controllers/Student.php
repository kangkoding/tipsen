<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('student/student_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Student_model->json();
    }

    public function read($id) 
    {
        $row = $this->Student_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'phone' => $row->phone,
		'id_classroom' => $row->id_classroom,
	    );
            $this->load->view('student/student_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('student/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'phone' => set_value('phone'),
	    'id_classroom' => set_value('id_classroom'),
	);
        $this->load->view('student/student_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'id_classroom' => $this->input->post('id_classroom',TRUE),
	    );

            $this->Student_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('student'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Student_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('student/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'phone' => set_value('phone', $row->phone),
		'id_classroom' => set_value('id_classroom', $row->id_classroom),
	    );
            $this->load->view('student/student_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
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
		'phone' => $this->input->post('phone',TRUE),
		'id_classroom' => $this->input->post('id_classroom',TRUE),
	    );

            $this->Student_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('student'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Student_model->get_by_id($id);

        if ($row) {
            $this->Student_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('student'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('student'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('id_classroom', 'id classroom', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "student.xls";
        $judul = "student";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Classroom");

	foreach ($this->Student_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_classroom);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=student.doc");

        $data = array(
            'student_data' => $this->Student_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('student/student_doc',$data);
    }

}

/* End of file Student.php */
/* Location: ./application/controllers/Student.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:47 */
/* http://harviacode.com */