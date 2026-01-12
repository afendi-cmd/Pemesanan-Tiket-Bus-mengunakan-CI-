<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-history"></i> <?= $title ?></h4>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-select" id="activityFilter">
                                    <option value="">All Activities</option>
                                    <option value="LOGIN">Login</option>
                                    <option value="LOGOUT">Logout</option>
                                    <option value="REGISTER">Register</option>
                                    <option value="CREATE">Create</option>
                                    <option value="UPDATE">Update</option>
                                    <option value="DELETE">Delete</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="userIdFilter" placeholder="User ID">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="filterLogs()">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <button class="btn btn-secondary" onclick="resetFilter()">
                                    <i class="fas fa-refresh"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- Logs Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Email</th>
                                        <th>User Name</th>
                                        <th>Activity</th>
                                        <th>Description</th>
                                        <th>IP Address</th>
                                        <th>User Agent</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody id="logsTableBody">
                                    <?php if (!empty($logs)): ?>
                                        <?php foreach ($logs as $log): ?>
                                            <tr>
                                                <td><?= $log['id'] ?></td>
                                                <td><?= $log['user_id'] ?></td>
                                                <td><?= $log['email'] ?? '-' ?></td>
                                                <td><?= $log['user_name'] ?? '-' ?></td>
                                                <td>
                                                    <span class="badge bg-<?= getActivityBadgeColor($log['activity']) ?>">
                                                        <?= $log['activity'] ?>
                                                    </span>
                                                </td>
                                                <td><?= $log['description'] ?? '-' ?></td>
                                                <td><?= $log['ip_address'] ?? '-' ?></td>
                                                <td title="<?= $log['user_agent'] ?>">
                                                    <?= substr($log['user_agent'] ?? '-', 0, 50) ?>...
                                                </td>
                                                <td><?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No logs found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function getActivityBadgeColor(activity) {
            const colors = {
                'LOGIN': 'success',
                'LOGOUT': 'secondary',
                'REGISTER': 'info',
                'CREATE': 'primary',
                'UPDATE': 'warning',
                'DELETE': 'danger'
            };
            return colors[activity] || 'secondary';
        }

        function filterLogs() {
            const activity = document.getElementById('activityFilter').value;
            const userId = document.getElementById('userIdFilter').value;
            
            let url = '<?= base_url('userlogs/getLogs') ?>?';
            const params = new URLSearchParams();
            
            if (activity) params.append('activity', activity);
            if (userId) params.append('user_id', userId);
            
            fetch(url + params.toString())
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTable(data.data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function resetFilter() {
            document.getElementById('activityFilter').value = '';
            document.getElementById('userIdFilter').value = '';
            location.reload();
        }

        function updateTable(logs) {
            const tbody = document.getElementById('logsTableBody');
            tbody.innerHTML = '';
            
            if (logs.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" class="text-center">No logs found</td></tr>';
                return;
            }
            
            logs.forEach(log => {
                const row = `
                    <tr>
                        <td>${log.id}</td>
                        <td>${log.user_id}</td>
                        <td>${log.email || '-'}</td>
                        <td>${log.user_name || '-'}</td>
                        <td><span class="badge bg-${getActivityBadgeColor(log.activity)}">${log.activity}</span></td>
                        <td>${log.description || '-'}</td>
                        <td>${log.ip_address || '-'}</td>
                        <td title="${log.user_agent}">${(log.user_agent || '-').substring(0, 50)}...</td>
                        <td>${new Date(log.created_at).toLocaleString('id-ID')}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }
    </script>
</body>
</html>

<?php
function getActivityBadgeColor($activity) {
    $colors = [
        'LOGIN' => 'success',
        'LOGOUT' => 'secondary', 
        'REGISTER' => 'info',
        'CREATE' => 'primary',
        'UPDATE' => 'warning',
        'DELETE' => 'danger'
    ];
    return $colors[$activity] ?? 'secondary';
}
?>