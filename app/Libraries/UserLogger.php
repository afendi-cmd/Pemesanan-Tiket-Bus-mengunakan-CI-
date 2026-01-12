<?php

namespace App\Libraries;

use App\Models\UserLogsModel;

class UserLogger
{
    protected $userLogsModel;
    protected $request;

    public function __construct()
    {
        $this->userLogsModel = new UserLogsModel();
        $this->request = \Config\Services::request();
    }

    /**
     * Log user login activity
     */
    public function logLogin($userId, $email = null)
    {
        $description = $email ? "User logged in with email: {$email}" : "User logged in";
        return $this->userLogsModel->logActivity(
            $userId,
            'LOGIN',
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log user logout activity
     */
    public function logLogout($userId)
    {
        return $this->userLogsModel->logActivity(
            $userId,
            'LOGOUT',
            'User logged out',
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log user registration
     */
    public function logRegistration($userId, $email = null)
    {
        $description = $email ? "New user registered with email: {$email}" : "New user registered";
        return $this->userLogsModel->logActivity(
            $userId,
            'REGISTER',
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log data creation
     */
    public function logCreate($userId, $module, $recordId = null)
    {
        $description = "Created new record in {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        return $this->userLogsModel->logActivity(
            $userId,
            'CREATE',
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log data update
     */
    public function logUpdate($userId, $module, $recordId = null)
    {
        $description = "Updated record in {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        return $this->userLogsModel->logActivity(
            $userId,
            'UPDATE',
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log data deletion
     */
    public function logDelete($userId, $module, $recordId = null)
    {
        $description = "Deleted record from {$module}";
        if ($recordId) {
            $description .= " (ID: {$recordId})";
        }
        
        return $this->userLogsModel->logActivity(
            $userId,
            'DELETE',
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Log custom activity
     */
    public function logCustom($userId, $activity, $description = null)
    {
        return $this->userLogsModel->logActivity(
            $userId,
            strtoupper($activity),
            $description,
            $this->request->getIPAddress(),
            $this->request->getUserAgent()->getAgentString()
        );
    }

    /**
     * Get user activity logs
     */
    public function getUserLogs($userId, $limit = 50)
    {
        return $this->userLogsModel->getLogsByUser($userId, $limit);
    }

    /**
     * Get recent system logs
     */
    public function getRecentLogs($limit = 100)
    {
        return $this->userLogsModel->getRecentLogs($limit);
    }
}