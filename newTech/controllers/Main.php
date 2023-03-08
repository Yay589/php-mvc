<?php

//use App\Controller;
require_once("../app/Controller.php");

class Main extends Controller
{
    public function index()
    {
        echo "inside index Main";
        $this->render('main');
    }
}
