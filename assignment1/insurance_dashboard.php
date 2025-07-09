<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'assignment1';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 6: Output Dataset Content - Get all data from multiple tables
$customers_sql = "SELECT * FROM customers ORDER BY join_date DESC";
$customers_result = $conn->query($customers_sql);

$policies_sql = "SELECT cp.*, c.first_name, c.last_name 
                 FROM customer_policies cp 
                 JOIN customers c ON cp.customer_id = c.customer_id 
                 ORDER BY cp.start_date DESC";
$policies_result = $conn->query($policies_sql);

$claims_sql = "SELECT cc.*, c.first_name, c.last_name, cp.policy_number 
               FROM customer_claims cc 
               JOIN customers c ON cc.customer_id = c.customer_id 
               JOIN customer_policies cp ON cc.policy_id = cp.policy_id 
               ORDER BY cc.claim_date DESC";
$claims_result = $conn->query($claims_sql);

$payments_sql = "SELECT p.*, c.first_name, c.last_name, cp.policy_number 
                 FROM payments p 
                 JOIN customers c ON p.customer_id = c.customer_id 
                 JOIN customer_policies cp ON p.policy_id = cp.policy_id 
                 ORDER BY p.payment_date DESC";
$payments_result = $conn->query($payments_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Database Dashboard - Assignment 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 { color: #333; }
        h2 { color: #333; }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            background: #fff; 
            margin-bottom: 30px;
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 10px; 
            text-align: left; 
        }
        th { 
            background: #0074D9; 
            color: #fff; 
        }
        tr:nth-child(even) { background: #f9f9f9; }
        .high-premium { color: #d80000; font-weight: bold; }
        .medium-premium { color: #f39c12; font-weight: bold; }
        .low-premium { color: #008000; font-weight: bold; }
        .status-active { background: #27ae60; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-pending { background: #f39c12; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-rejected { background: #e74c3c; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-paid { background: #27ae60; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-completed { background: #27ae60; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .status-failed { background: #e74c3c; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; }
        .policy-auto { color: #3498db; font-weight: bold; }
        .policy-home { color: #27ae60; font-weight: bold; }
        .policy-life { color: #e74c3c; font-weight: bold; }
        .policy-health { color: #9b59b6; font-weight: bold; }
        .policy-business { color: #f39c12; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Insurance Database Dashboard</h1>
    <p><strong>Assignment 1 - HTTP5225</strong></p>

    <!-- Customers Section -->
    <h2>Customer Information</h2>
    <?php if ($customers_result && $customers_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birth Date</th>
                <th>Join Date</th>
                <th>Status</th>
            </tr>
            <?php while($row = $customers_result->fetch_assoc()): ?>
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
                            <span class="status-pending">Inactive</span>
                        <?php else: ?>
                            <span class="status-rejected">Suspended</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No customer data found.</p>
    <?php endif; ?>

    <!-- Policies Section -->
    <h2>Policy Information</h2>
    <?php if ($policies_result && $policies_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Policy #</th>
                <th>Customer</th>
                <th>Type</th>
                <th>Coverage</th>
                <th>Premium</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
            <?php while($row = $policies_result->fetch_assoc()): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($row['policy_number']) ?></strong></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td>
                        <span class="policy-<?= $row['policy_type'] ?>">
                            <?= ucfirst(htmlspecialchars($row['policy_type'])) ?>
                        </span>
                    </td>
                    <td>$<?= number_format($row['coverage_amount'], 2) ?></td>
                    <td class="<?= $row['premium_amount'] > 2000 ? 'high-premium' : ($row['premium_amount'] > 1000 ? 'medium-premium' : 'low-premium') ?>">
                        $<?= number_format($row['premium_amount'], 2) ?>
                        <?php if ($row['premium_amount'] > 2000): ?>
                            <span> (High)</span>
                        <?php elseif ($row['premium_amount'] > 1000): ?>
                            <span> (Medium)</span>
                        <?php else: ?>
                            <span> (Low)</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['start_date']) ?></td>
                    <td><?= htmlspecialchars($row['end_date']) ?></td>
                    <td>
                        <?php if ($row['status'] === 'active'): ?>
                            <span class="status-active">Active</span>
                        <?php elseif ($row['status'] === 'expired'): ?>
                            <span class="status-pending">Expired</span>
                        <?php else: ?>
                            <span class="status-rejected">Cancelled</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No policy data found.</p>
    <?php endif; ?>

    <!-- Claims Section -->
    <h2>Claim Information</h2>
    <?php if ($claims_result && $claims_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Claim #</th>
                <th>Customer</th>
                <th>Policy #</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Description</th>
            </tr>
            <?php while($row = $claims_result->fetch_assoc()): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($row['claim_number']) ?></strong></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['policy_number']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($row['claim_type'])) ?></td>
                    <td class="<?= $row['claim_amount'] > 10000 ? 'high-premium' : ($row['claim_amount'] > 5000 ? 'medium-premium' : 'low-premium') ?>">
                        $<?= number_format($row['claim_amount'], 2) ?>
                    </td>
                    <td><?= htmlspecialchars($row['claim_date']) ?></td>
                    <td>
                        <?php if ($row['status'] === 'approved'): ?>
                            <span class="status-active">Approved</span>
                        <?php elseif ($row['status'] === 'pending'): ?>
                            <span class="status-pending">Pending</span>
                        <?php elseif ($row['status'] === 'paid'): ?>
                            <span class="status-paid">Paid</span>
                        <?php else: ?>
                            <span class="status-rejected">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No claim data found.</p>
    <?php endif; ?>

    <!-- Payments Section -->
    <h2>Payment Information</h2>
    <?php if ($payments_result && $payments_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Payment #</th>
                <th>Customer</th>
                <th>Policy #</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Method</th>
                <th>Status</th>
            </tr>
            <?php while($row = $payments_result->fetch_assoc()): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($row['payment_number']) ?></strong></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['policy_number']) ?></td>
                    <td><?= ucfirst(htmlspecialchars($row['payment_type'])) ?></td>
                    <td class="<?= $row['amount'] > 3000 ? 'high-premium' : ($row['amount'] > 1500 ? 'medium-premium' : 'low-premium') ?>">
                        $<?= number_format($row['amount'], 2) ?>
                    </td>
                    <td><?= htmlspecialchars($row['payment_date']) ?></td>
                    <td><?= ucfirst(str_replace('_', ' ', htmlspecialchars($row['payment_method']))) ?></td>
                    <td>
                        <?php if ($row['status'] === 'completed'): ?>
                            <span class="status-completed">Completed</span>
                        <?php elseif ($row['status'] === 'pending'): ?>
                            <span class="status-pending">Pending</span>
                        <?php else: ?>
                            <span class="status-failed">Failed</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No payment data found.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html> 