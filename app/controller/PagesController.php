<?php 

namespace app\controller;
use app\core\Controller;

class PagesController extends Controller
{

    public function home()
    {
        $this->load('home/main');
    }

    public function sobre()
    {
        $this->load('sobre/main');
    }
}