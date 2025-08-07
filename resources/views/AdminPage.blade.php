<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            grid-template-rows: 60px 1fr;
            grid-template-areas: 
                "sidebar header"
                "sidebar main";
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            grid-area: sidebar;
            background: linear-gradient(180deg, #1e40af 0%, #1d4ed8 100%);
            color: white;
            padding: 0;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #60a5fa;
        }

        .nav-item::before {
            content: "▸ ";
            margin-right: 8px;
        }

        /* Header */
        .header {
            grid-area: header;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e40af;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .notification-badge {
            position: relative;
            background: #f1f5f9;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .notification-badge:hover {
            background: #e2e8f0;
        }

        .notification-badge::after {
            content: "3";
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Content */
        .main {
            grid-area: main;
            padding: 30px;
            overflow-y: auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-icon.users { background: linear-gradient(45deg, #3b82f6, #60a5fa); color: white; }
        .stat-icon.revenue { background: linear-gradient(45deg, #10b981, #34d399); color: white; }
        .stat-icon.orders { background: linear-gradient(45deg, #f59e0b, #fbbf24); color: white; }
        .stat-icon.growth { background: linear-gradient(45deg, #8b5cf6, #a78bfa); color: white; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stat-change.positive { color: #10b981; }
        .stat-change.negative { color: #ef4444; }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #2563eb, #1d4ed8);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        /* Chart Placeholder */
        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.1rem;
            border: 2px dashed #cbd5e1;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tr:hover {
            background: #f8fafc;
        }

        .status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status.active {
            background: #dcfce7;
            color: #166534;
        }

        .status.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status.inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.875rem;
            color: #475569;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
                grid-template-rows: 60px auto 1fr;
                grid-template-areas: 
                    "header"
                    "sidebar"
                    "main";
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .sidebar-nav {
                display: flex;
                overflow-x: auto;
                padding: 10px;
            }

            .nav-item {
                white-space: nowrap;
                border-left: none;
                border-bottom: 3px solid transparent;
            }

            .nav-item:hover,
            .nav-item.active {
                border-left: none;
                border-bottom-color: #60a5fa;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>AdminPanel</h2>
            </div>
            <div class="sidebar-nav">
                <a href="#" class="nav-item active">Dashboard</a>
                <a href="#" class="nav-item">Users</a>
                <a href="#" class="nav-item">Pets</a>
                <a href="#" class="nav-item">Appointments</a>
                <a href="#" class="nav-item">Billing and Payment</a>
                <a href="#" class="nav-item">Blog</a>
                <a href="#" class="nav-item">Notifications</a>
                <a href="#" class="nav-item">Reports</a>
                <a href="#" class="nav-item">Settings</a>
                <a href="#" class="nav-item">Logout</a>
            </div>
        </nav>

        <!-- Header -->
        <header class="header">
            <h1 class="header-title">Dashboard Overview</h1>
            <div class="header-user">
                <button class="notification-badge">🔔</button>
                <div class="user-avatar">JD</div>
                <span>John Doe</span>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Users</div>
                        <div class="stat-icon users">👥</div>
                    </div>
                    <div class="stat-value">12,543</div>
                    <div class="stat-change positive">+12.5% from last month</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Revenue</div>
                        <div class="stat-icon revenue">💰</div>
                    </div>
                    <div class="stat-value">$45,678</div>
                    <div class="stat-change positive">+8.2% from last month</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Orders</div>
                        <div class="stat-icon orders">📦</div>
                    </div>
                    <div class="stat-value">1,234</div>
                    <div class="stat-change negative">-3.1% from last month</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Growth</div>
                        <div class="stat-icon growth">📈</div>
                    </div>
                    <div class="stat-value">23.5%</div>
                    <div class="stat-change positive">+5.4% from last month</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Chart Section -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sales Analytics</h3>
                        <button class="btn btn-secondary">View Details</button>
                    </div>
                    <div class="chart-placeholder">
                        📊 Chart visualization would go here
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Activity</h3>
                        <a href="#" class="btn btn-primary">View All</a>
                    </div>
                    <div class="activity-feed">
                        <div class="activity-item">
                            <div class="activity-avatar">JD</div>
                            <div class="activity-content">
                                <div class="activity-text">John Doe created a new user account</div>
                                <div class="activity-time">2 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar">SM</div>
                            <div class="activity-content">
                                <div class="activity-text">Sarah Miller updated product inventory</div>
                                <div class="activity-time">15 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar">RJ</div>
                            <div class="activity-content">
                                <div class="activity-text">Robert Johnson processed 5 orders</div>
                                <div class="activity-time">1 hour ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar">AL</div>
                            <div class="activity-content">
                                <div class="activity-text">Anna Lee generated monthly report</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                    <button class="btn btn-primary">Add New Order</button>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-001</td>
                                <td>Alice Johnson</td>
                                <td>Premium Package</td>
                                <td>$299.00</td>
                                <td><span class="status active">Active</span></td>
                                <td>2024-01-15</td>
                            </tr>
                            <tr>
                                <td>#ORD-002</td>
                                <td>Bob Smith</td>
                                <td>Basic Plan</td>
                                <td>$99.00</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>2024-01-14</td>
                            </tr>
                            <tr>
                                <td>#ORD-003</td>
                                <td>Carol Davis</td>
                                <td>Enterprise Suite</td>
                                <td>$599.00</td>
                                <td><span class="status active">Active</span></td>
                                <td>2024-01-13</td>
                            </tr>
                            <tr>
                                <td>#ORD-004</td>
                                <td>David Wilson</td>
                                <td>Starter Kit</td>
                                <td>$49.00</td>
                                <td><span class="status inactive">Inactive</span></td>
                                <td>2024-01-12</td>
                            </tr>
                            <tr>
                                <td>#ORD-005</td>
                                <td>Eva Martinez</td>
                                <td>Pro Version</td>
                                <td>$199.00</td>
                                <td><span class="status active">Active</span></td>
                                <td>2024-01-11</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>