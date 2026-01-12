<?php

namespace App\Controllers;

use App\Models\PaketBusModel;

class Home extends BaseController
{
    protected $paketBusModel;

    public function __construct()
    {
        $this->paketBusModel = new PaketBusModel();
    }

    public function index()
    {
        // Load paket bus data for the homepage
        $data['paketbus'] = $this->paketBusModel->getPaketBusWithDetails();

        return view('tampilanawal/index', $data);
    }
}
