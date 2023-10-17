<?php
class Pages extends Controller{
    public function __construct()
    {
        $this->index();
    }

    public function index(){
        $this->view('pages/index');
    }
}