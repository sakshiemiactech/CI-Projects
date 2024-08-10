<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author Mahesh
 */
 
class Pagination_lib {

    //put your code here
    private $CI;
    private $config;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function initialize($config) {
        $this->config = $config;
        $pages = ceil($config['total_rows'] / ROWS_PER_PAGE);
        $this->config['pages'] = $pages;
        return TRUE;
    }

    public function create_links() {
        $data['pages'] = $this->config['pages'];
        $data['url'] = $this->config['url'];
        $data['current_page'] = $this->config['current_page'];
        return $this->CI->load->view('admin/common/pagination', $data, TRUE);
    }

}