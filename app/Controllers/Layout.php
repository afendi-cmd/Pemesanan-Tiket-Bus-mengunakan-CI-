<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Layout extends BaseController
{
    public function index()
    {
        $login = $this->checkLogin();
if ($login) return $login;

$timeout = $this->checkSessionTimeout();
if ($timeout) return $timeout;
        return view('Layout/beranda');
    }
}
