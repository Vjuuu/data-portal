<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - Secure Data Portal' : 'Secure Data Portal'; ?></title>
    <!-- Premium Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Main Premium Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="auth-template">
    <!-- Premium Dynamic Background elements -->
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <div class="container">
        <!-- SweetAlert2 Notification Handler -->
        <?php if ($this->session->flashdata('success')): ?>
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Success!',
                        text: '<?php echo htmlspecialchars($this->session->flashdata('success')); ?>',
                        icon: 'success',
                        confirmButtonColor: '#0ea5e9'
                    });
                });
            </script>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Error!',
                        text: '<?php echo htmlspecialchars($this->session->flashdata('error')); ?>',
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                });
            </script>
        <?php endif; ?>
