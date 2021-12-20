<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Log_attendance_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('log_attendance/log_attendance_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Log_attendance_model->json();
    }

    public function read($id) 
    {
        $row = $this->Log_attendance_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_class' => $row->id_class,
		'id_course' => $row->id_course,
		'id_user' => $row->id_user,
		'date' => $row->date,
	    );
            $this->load->view('log_attendance/log_attendance_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_attendance'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('log_attendance/create_action'),
	    'id' => set_value('id'),
	    'id_class' => set_value('id_class'),
	    'id_course' => set_value('id_course'),
	    'id_user' => set_value('id_user'),
	    'date' => set_value('date'),
	);
        $this->load->view('log_attendance/log_attendance_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_class' => $this->input->post('id_class',TRUE),
		'id_course' => $this->input->post('id_course',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Log_attendance_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('log_attendance'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Log_attendance_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('log_attendance/update_action'),
		'id' => set_value('id', $row->id),
		'id_class' => set_value('id_class', $row->id_class),
		'id_course' => set_value('id_course', $row->id_course),
		'id_user' => set_value('id_user', $row->id_user),
		'date' => set_value('date', $row->date),
	    );
            $this->load->view('log_attendance/log_attendance_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_attendance'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_class' => $this->input->post('id_class',TRUE),
		'id_course' => $this->input->post('id_course',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Log_attendance_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('log_attendance'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Log_attendance_model->get_by_id($id);

        if ($row) {
            $this->Log_attendance_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('log_attendance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_attendance'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_class', 'id class', 'trim|required');
	$this->form_validation->set_rules('id_course', 'id course', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "log_attendance.xls";
        $judul = "log_attendance";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Class");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Course");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	foreach ($this->Log_attendance_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_class);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_course);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=log_attendance.doc");

        $data = array(
            'log_attendance_data' => $this->Log_attendance_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('log_attendance/log_attendance_doc',$data);
    }

}

/* End of file Log_attendance.php */
/* Location: ./application/controllers/Log_attendance.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:47 */
/* http://harviacode.com */