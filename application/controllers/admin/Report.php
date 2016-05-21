<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Report controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Report_model');
        $this->load->model('Activity_log_model');
        $this->load->helper(array('form', 'url'));
    }

    // Report_customer view in list
    public function index($offset = NULL) {

        $this->load->library('pagination');

        $data['report'] = $this->Report_model->get(array('limit' => 10, 'offset' => $offset));
        $data['title'] = 'Daftar laporan';
        $data['main'] = 'admin/report/report_list';
        $config['base_url'] = site_url('report/index');
        $config['total_rows'] = count($this->Report_model->get());
        $this->pagination->initialize($config);

        $this->load->view('admin/layout', $data);
    }

    // Add Report_customer and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('report_date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('report_description', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('report_trouble', 'Trouble', 'trim|required|xss_clean');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('report_id')) {
                $params['report_id'] = $this->input->post('report_id');
            } else {
                $params['report_input_date'] = date('Y-m-d H:i:s');
            }
            $params['report_last_update'] = date('Y-m-d H:i:s');
            $params['report_date'] = $this->input->post('report_date');
            $params['report_description'] = $this->input->post('report_description');
            $params['report_trouble'] = $this->input->post('report_trouble');
            $params['user_user_id'] = $this->session->userdata('user_id');
            $status = $this->Report_model->add($params);

            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Report',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Date:' . $this->input->post('report_date')
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Laporan Berhasil');
            redirect('admin/report');
        } else {
            if ($this->input->post('report_id')) {
                redirect('admin/report/edit/' . $this->input->post('report_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                if ($this->Report_model->get(array('id' => $id)) == NULL) {
                    redirect('admin/report');
                } else {
                    $data['report'] = $this->Report_model->get(array('id' => $id));
                }
            }
            $data['title'] = $data['operation'] . ' laporan';
            $data['main'] = 'admin/report/report_add';
            $this->load->view('admin/layout', $data);
        }
    }

    function detail($id = NULL) {
        if ($this->Report_model->get(array('id' => $id)) == NULL) {
            redirect('admin/report');
        }
        $data['report'] = $this->Report_model->get(array('id' => $id));
        $data['title'] = 'Detail laporan';
        $data['main'] = 'admin/report/report_detail';
        $this->load->view('admin/layout', $data);
    }

    // Delete Report
    public function delete($id = NULL) {
        if ($this->Report_model->get(array('id' => $id)) == NULL) {
            redirect('admin/report');
        }
        if ($_POST) {

            $this->Report_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Report',
                        'log_action' => 'Delete',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Date:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus laporan Berhasil');
            redirect('admin/report');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/report/edit/' . $id);
        }
    }

}

/* End of file report.php */
/* Location: ./application/controllers/ccp/report.php */
