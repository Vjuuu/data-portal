<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$activeMenu = isset($active_menu) ? $active_menu : 'dashboard';
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - Super Admin Panel' : 'Super Admin Portal'; ?></title>
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --admin-sidebar-bg: #0f172a;
            --admin-sidebar-active: #1e293b;
            --admin-primary: #f97316;
            --admin-primary-hover: #ea580c;
            --admin-bg: #f8fafc;
            --admin-card-bg: #ffffff;
            --admin-text: #1e293b;
            --admin-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text);
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--admin-sidebar-bg);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .admin-brand {
            padding: 24px 20px;
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .admin-brand span.badge-admin {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .admin-nav {
            padding: 20px 12px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .admin-nav-item:hover {
            color: #fff;
            background: rgba(255,255,255,0.06);
        }

        .admin-nav-item.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(249,115,22,0.2) 0%, rgba(234,88,12,0.25) 100%);
            border-left: 3px solid #f97316;
            font-weight: 600;
        }

        .admin-nav-item i {
            font-size: 1.2rem;
        }

        .admin-sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Main Content Wrapper */
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .admin-topbar {
            background: #ffffff;
            height: 70px;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-content {
            padding: 30px;
            flex-grow: 1;
        }

        /* Metric Cards */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px -5px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.08);
        }

        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Custom Switch */
        .form-switch .form-check-input {
            width: 2.8em;
            height: 1.4em;
            cursor: pointer;
        }
        .form-switch .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                left: -260px;
            }
            .admin-sidebar.show {
                left: 0;
            }
            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- SweetAlert Flash Notifications -->
<?php if ($this->session->flashdata('success')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'यशस्वी!',
                text: '<?php echo htmlspecialchars($this->session->flashdata('success')); ?>',
                icon: 'success',
                confirmButtonColor: '#f97316'
            });
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'त्रुटी!',
                text: '<?php echo htmlspecialchars($this->session->flashdata('error')); ?>',
                icon: 'error',
                confirmButtonColor: '#dc2626'
            });
        });
    </script>
<?php endif; ?>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <a href="<?php echo base_url('admin'); ?>" class="admin-brand">
        <span>मराठी विवाह</span>
        <span class="badge-admin">SUPER ADMIN</span>
    </a>

    <div class="admin-nav">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="admin-nav-item <?php echo ($activeMenu === 'dashboard') ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>डॅशबोर्ड (Dashboard)</span>
        </a>

        <a href="<?php echo base_url('admin/users'); ?>" class="admin-nav-item <?php echo ($activeMenu === 'users') ? 'active' : ''; ?>">
            <i class="bi bi-people-fill"></i>
            <span>वापरकर्ते (Users)</span>
        </a>

        <a href="<?php echo base_url('admin/payments'); ?>" class="admin-nav-item <?php echo ($activeMenu === 'payments') ? 'active' : ''; ?>">
            <i class="bi bi-credit-card-2-front-fill"></i>
            <span>पेमेंट व्यवहार (Payments)</span>
        </a>

        <a href="<?php echo base_url('admin/settings'); ?>" class="admin-nav-item <?php echo ($activeMenu === 'settings') ? 'active' : ''; ?>">
            <i class="bi bi-gear-fill"></i>
            <span>किंमत सेटिंग्ज (Set Price)</span>
        </a>

        <a href="<?php echo base_url('pricing'); ?>" target="_blank" class="admin-nav-item">
            <i class="bi bi-tag-fill"></i>
            <span>किंमत योजना (Pricing Page) ↗</span>
        </a>
    </div>

    <div class="admin-sidebar-footer">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 34px; height: 34px; border-radius: 50%; background: #f97316; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                    SA
                </div>
                <div style="line-height: 1.2;">
                    <div style="font-weight: 600; font-size: 0.85rem; color: #fff;">Super Admin</div>
                    <div style="font-size: 0.75rem; color: #94a3b8;">Administrator</div>
                </div>
            </div>
            <a href="<?php echo base_url('admin/logout'); ?>" class="text-danger fs-5" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</aside>

<!-- Main Wrapper -->
<div class="admin-main">
    <!-- Topbar -->
    <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light d-lg-none" id="sidebarToggleBtn">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h5 class="mb-0 fw-bold text-dark"><?php echo isset($title) ? $title : 'Super Admin Dashboard'; ?></h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                <i class="bi bi-shield-lock-fill me-1"></i> सुरक्षित ॲडमिन सत्र
            </span>
            <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                <i class="bi bi-box-arrow-right me-1"></i> लॉग आउट
            </a>
        </div>
    </header>

    <!-- Content Area -->
    <main class="admin-content">
