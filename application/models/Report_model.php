<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * report Model Class
 *
 * @package     REPORT
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Report_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('report.report_id', $params['id']);
        }

        if (isset($params['user_id'])) {
            $this->db->where('report.user_user_id', $params['user_id']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('report_last_update', 'desc');
        }

        $this->db->select('report.report_id, report_date, report_description, report_trouble,
            user_user_id,
            report_input_date, report_last_update');
        $this->db->select('user_name, user_full_name');

        $this->db->join('user', 'user.user_id = report.user_user_id', 'left');
        $res = $this->db->get('report');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array()) {

        if (isset($data['report_id'])) {
            $this->db->set('report_id', $data['report_id']);
        }

        if (isset($data['report_date'])) {
            $this->db->set('report_date', $data['report_date']);
        }

        if (isset($data['report_description'])) {
            $this->db->set('report_description', $data['report_description']);
        }

        if (isset($data['report_trouble'])) {
            $this->db->set('report_trouble', $data['report_trouble']);
        }
        
        if (isset($data['user_user_id'])) {
            $this->db->set('user_user_id', $data['user_user_id']);
        }

        if (isset($data['report_input_date'])) {
            $this->db->set('report_input_date', $data['report_input_date']);
        }

        if (isset($data['report_last_update'])) {
            $this->db->set('report_last_update', $data['report_last_update']);
        }

        if (isset($data['report_id'])) {
            $this->db->where('report_id', $data['report_id']);
            $this->db->update('report');
            $id = $data['report_id'];
        } else {
            $this->db->insert('report');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('report_id', $id);
        $this->db->delete('report');
    }


}
