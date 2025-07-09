<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'assignment1'; // Make sure your database is named 'assignment1'

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select customers with their policy information using JOIN
// This demonstrates the relationship between customers and their policies
$sql = "SELECT c.customer_id, c.first_name, c.last_name, c.address, c.birth_date, 
               c.email, c.phone, c.join_date, c.status,
               cp.policy_number, cp.policy_type, cp.premium_amount, cp.coverage_amount
        FROM customers c 
        LEFT JOIN customer_policies cp ON c.customer_id = cp.customer_id 
        ORDER BY c.join_date DESC, cp.premium_amount DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Customers - Assignment 1</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            margin: 0; 
            padding: 20px; 
            min-height: 100vh;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }
        .content {
            padding: 30px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            background: #fff; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        th, td { 
            border: 1px solid #ecf0f1; 
            padding: 12px 15px; 
            text-align: left; 
        }
        th { 
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); 
            color: #fff; 
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 1px;
        }
        tr:nth-child(even) { background: #f8f9fa; }
        tr:hover { background: #ecf0f1; }
        .high-premium { color: #e74c3c; font-weight: bold; }
        .medium-premium { color: #f39c12; font-weight: bold; }
        .low-premium { color: #27ae60; font-weight: bold; }
        .status-active { background: #27ae60; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-inactive { background: #f39c12; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-suspended { background: #e74c3c; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .policy-type { font-weight: bold; }
        .policy-auto { color: #3498db; }
        .policy-home { color: #27ae60; }
        .policy-life { color: #e74c3c; }
        .policy-health { color: #9b59b6; }
        .policy-business { color: #f39c12; }
        .no-policy { color: #95a5a6; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Insurance Customers</h1>
            <p>Assignment 1 - HTTP5225 | Customer and Policy Information</p>
        </div>
        
        <div class="content">
            <h2>Customer and Policy Details</h2>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Birth Date</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Policy #</th>
                            <th>Policy Type</th>
                            <th>Premium</th>
                            <th>Coverage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while($row = $result->fetch_assoc()): 
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['customer_id']) ?></td>
                                <td><strong><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></strong></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= htmlspecialchars($row['birth_date']) ?></td>
                                <td><?= htmlspecialchars($row['join_date']) ?></td>
                                <td>
                                    <?php if ($row['status'] === 'active'): ?>
                                        <span class="status-active">Active</span>
                                    <?php elseif ($row['status'] === 'inactive'): ?>
                                        <span class="status-inactive">Inactive</span>
                                    <?php else: ?>
                                        <span class="status-suspended">Suspended</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['policy_number']): ?>
                                        <strong><?= htmlspecialchars($row['policy_number']) ?></strong>
                                    <?php else: ?>
                                        <span class="no-policy">No Policy</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['policy_type']): ?>
                                        <span class="policy-type policy-<?= $row['policy_type'] ?>">
                                            <?= ucfirst(htmlspecialchars($row['policy_type'])) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="no-policy">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['premium_amount']): ?>
                                        <span class="<?= $row['premium_amount'] > 2000 ? 'high-premium' : ($row['premium_amount'] > 1000 ? 'medium-premium' : 'low-premium') ?>">
                                            $<?= number_format($row['premium_amount'], 2) ?>
                                            <?php if ($row['premium_amount'] > 2000): ?>
                                                <span> (High)</span>
                                            <?php elseif ($row['premium_amount'] > 1000): ?>
                                                <span> (Medium)</span>
                                            <?php else: ?>
                                                <span> (Low)</span>
                                            <?php endif; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="no-policy">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['coverage_amount']): ?>
                                        $<?= number_format($row['coverage_amount'], 2) ?>
                                    <?php else: ?>
                                        <span class="no-policy">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
            <?php else: ?>
                <p>No customer data found. Please check your database and table.</p>
                <p>Make sure you have:</p>
                <ol>
                    <li>Imported the database_setup.sql file</li>
                    <li>Created the 'assignment1' database</li>
                    <li>All tables are properly created with sample data</li>
                </ol>
            <?php endif; ?>
            
            <div style="margin-top: 30px; text-align: center;">
                <a href="insurance_dashboard.php" style="display: inline-block; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; margin: 5px;">View Full Dashboard</a>
            </div>
        </div>
    </div>
    
    <?php $conn->close(); ?>
</body>
</html> 