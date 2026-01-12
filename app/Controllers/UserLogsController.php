<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserLogsModel;
use App\Libraries\UserLogger;

class UserLogsController extends BaseController
{
    protected $userLogsModel;
    protected $userLogger;

    public function __construct()
    {
        $this->userLogsModel = new UserLogsModel();
        $this->userLogger = new UserLogger();
    }

    /**
     * Display all user logs (Admin only)
     */
    public function index()
    {
        // Check if user is admin
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied');
        }

        $data = [
            'title' => 'User Activity Logs',
            'logs' => $this->userLogsModel->getRecentLogs(100)
        ];

        return view('admin/user_logs', $data);
    }

    /**
     * Display user's own logs
     */
    public function myLogs()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        
        $data = [
            'title' => 'My Activity Logs',
            'logs' => $this->userLogsModel->getLogsByUser($userId, 50)
        ];

        return view('user/my_logs', $data);
    }

    /**
     * Get logs via AJAX
     */
    public function getLogs()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $userId = $this->request->getGet('user_id');
        $activity = $this->request->getGet('activity');
        $limit = $this->request->getGet('limit') ?? 50;

        if ($userId) {
            $logs = $this->userLogsModel->getLogsByUser($userId, $limit);
        } elseif ($activity) {
            $logs = $this->userLogsModel->getLogsByActivity($activity, $limit);
        } else {
            $logs = $this->userLogsModel->getRecentLogs($limit);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $logs
        ]);
    }

    /**
     * Example: Log a test activity
     */
    public function testLog()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        
        // Log test activity
        $this->userLogger->logCustom($userId, 'TEST', 'This is a test log entry');

        return redirect()->back()->with('success', 'Test log created successfully');
    }
}