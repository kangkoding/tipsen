<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_log_attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_log_attendance_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('detail_log_attendance/detail_log_attendance_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Detail_log_attendance_model->json();
    }

    public function read($id) 
    {
        $row = $this->Detail_log_attendance_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_log_attendance' => $row->id_log_attendance,
		'id_student' => $row->id_student,
		'description' => $row->description,
	    );
            $this->load->view('detail_log_attendance/detail_log_attendance_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_log_attendance'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_log_attendance/create_action'),
	    'id_log_attendance' => set_value('id_log_attendance'),
	    'id_student' => set_value('id_student'),
	    'description' => set_value('description'),
	);
        $this->load->view('detail_log_attendance/detail_log_attendance_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_log_attendance' => $this->input->post('id_log_attendance',TRUE),
		'id_student' => $this->input->post('id_student',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Detail_log_attendance_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_log_attendance'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_log_attendance_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_log_attendance/update_action'),
		'id_log_attendance' => set_value('id_log_attendance', $row->id_log_attendance),
		'id_student' => set_value('id_student', $row->id_student),
		'description' => set_value('description', $row->description),
	    );
            $this->load->view('detail_log_attendance/detail_log_attendance_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_log_attendance'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_log_attendance' => $this->input->post('id_log_attendance',TRUE),
		'id_student' => $this->input->post('id_student',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Detail_log_attendance_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_log_attendance'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_log_attendance_model->get_by_id($id);

        if ($row) {
            $this->Detail_log_attendance_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_log_attendance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_log_attendance'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_log_attendance', 'id log attendance', 'trim|required');
	$this->form_validation->set_rules('id_student', 'id student', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_log_attendance.xls";
        $judul = "detail_log_attendance";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Log Attendance");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Student");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");

	foreach ($this->Detail_log_attendance_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_log_attendance);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_student);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=detail_log_attendance.doc");

        $data = array(
            'detail_log_attendance_data' => $this->Detail_log_attendance_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('detail_log_attendance/detail_log_attendance_doc',$data);
    }

}

/* End of file Detail_log_attendance.php */
/* Location: ./application/controllers/Detail_log_attendance.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:46 */
/* http://harviacode.com */