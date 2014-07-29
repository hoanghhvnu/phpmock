<?php
class index extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
        $this->index();
    }
    public function index()
    {
       echo __METHOD__;
    }
    public function insert()
    {
        echo __METHOD__;   
    }
}