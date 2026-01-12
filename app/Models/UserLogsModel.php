<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLogsModel extends Model
{
    protected $table            = 'user_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'email',
        'user_name',
        'activity',
        'description',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'  => 'required|integer',
        'activity' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Log user activity
     */
    public function logActivity($userId, $activity, $description = null, $ipAddress = null, $userAgent = null, $email = null, $userName = null)
    {
        $request = \Config\Services::request();
        
        $data = [
            'user_id'     => $userId,
            'email'       => $email,
            'user_name'   => $userName,
            'activity'    => $activity,
            'description' => $description,
            'ip_address'  => $ipAddress ?: $request->getIPAddress(),
            'user_agent'  => $userAgent ?: $request->getUserAgent()->getAgentString(),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    /**
     * Get logs by user ID
     */
    public function getLogsByUser($userId, $limit = 50)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Get logs by activity type
     */
    public function getLogsByActivity($activity, $limit = 50)
    {
        return $this->where('activity', $activity)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Get recent logs
     */
    public function getRecentLogs($limit = 100)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}