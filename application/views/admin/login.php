<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login - मराठी विवाह</title>
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 440px;
            width: 100%;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #f97316 0%, #ea580c 100%);
        }
        .btn-admin-login {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: #fff !important;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-admin-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
        }
    </style>
</head>
<body>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'त्रुटी!',
                text: '<?php echo htmlspecialchars($this->session->flashdata('error')); ?>',
                icon: 'error',
                confirmButtonColor: '#ea580c'
            });
        });
    </script>
<?php endif; ?>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center bg-orange-light rounded-circle mb-3" style="width: 60px; height: 60px; background: #ffedd5; color: #ea580c; font-size: 1.8rem;">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <h3 class="fw-bold text-dark mb-1">Super Admin</h3>
        <p class="text-muted small">मराठी विवाह पोर्टल - ॲडमिन नियंत्रण कक्ष</p>
    </div>

    <?php echo form_open('admin/login'); ?>
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-secondary small">ॲडमिन ईमेल (Admin Email)</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                <input type="email" name="email" id="email" class="form-control border-start-0" placeholder="admin@dataportal.com" value="<?php echo set_value('email', 'admin@dataportal.com'); ?>" required autofocus>
            </div>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-semibold text-secondary small">पासवर्ड (Password)</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn btn-admin-login w-100 mb-3">
            <i class="bi bi-box-arrow-in-right me-2"></i> सुरक्षित लॉगिन करा (Login to Admin)
        </button>
    <?php echo form_close(); ?>

    <div class="text-center border-top pt-3 mt-3">
        <a href="<?php echo base_url(); ?>" class="text-muted small text-decoration-none">
            ← मुख्य पोर्टलवर परत जा
        </a>
    </div>
</div>

</body>
</html>
