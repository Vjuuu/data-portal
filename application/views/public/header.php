<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - मराठी विवाह संस्था' : 'मराठी विवाह - सर्वात विश्वसनीय विवाह संस्था'; ?></title>
    
    <!-- Premium Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Main Public Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/public.css'); ?>">
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Scroll Progress Indicator -->
    <div id="scroll-progress"></div>

    <!-- SweetAlert2 Session Notification Flashers -->
    <?php if ($this->session->flashdata('success')): ?>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'यशस्वी!',
                    text: '<?php echo htmlspecialchars($this->session->flashdata('success'), ENT_QUOTES, 'UTF-8'); ?>',
                    icon: 'success',
                    confirmButtonColor: '#f97316'
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'त्रुटी!',
                    text: '<?php echo htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8'); ?>',
                    icon: 'error',
                    confirmButtonColor: '#dc2626'
                });
            });
        </script>
    <?php endif; ?>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-premium fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand-custom" href="<?php echo base_url(); ?>">
                <span class="brand-dot"></span> मराठीविवाह
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1" id="navLinksList">
                    <li class="nav-item">
                        <a class="nav-link-custom active" href="<?php echo base_url('#home'); ?>">मुख्यपृष्ठ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="<?php echo base_url('#features'); ?>">वैशिष्ट्ये</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="<?php echo base_url('#gallery'); ?>">यशोगाथा</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="<?php echo base_url('#contact'); ?>">संपर्क</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="<?php echo base_url('#map'); ?>">कार्यालय</a>
                    </li>
                    <?php 
                    $CI =& get_instance();
                    $CI->load->model('User_model');
                    $dynPrice = $CI->User_model->get_setting('plan_price', '5999');
                    ?>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="<?php echo base_url('pricing'); ?>" style="font-weight: 700; color: var(--primary-orange);">
                            <span class="badge bg-warning text-dark me-1" style="font-size: 0.7rem; font-weight: 700;">₹<?php echo number_format($dynPrice, 0); ?></span>किंमत योजना
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <?php 
                        $name = $this->session->userdata('name');
                        $initials = '';
                        if (!empty($name)) {
                            $parts = explode(' ', $name);
                            $initials .= strtoupper(substr($parts[0], 0, 1));
                            if (count($parts) > 1) {
                                $initials .= strtoupper(substr($parts[count($parts) - 1], 0, 1));
                            }
                        }
                        
                        $userId = $CI->session->userdata('user_id');
                        $self_info = $CI->User_model->get_member_by_relation($userId, 'Self');
                        $profile_photo_url = '';
                        if ($self_info && !empty($self_info['profile_photo'])) {
                            $profile_photo_url = base_url($self_info['profile_photo']);
                        }
                        ?>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle hide-toggle-arrow" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-glow-nav me-2" style="position: relative; width: 40px; height: 40px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.95rem; border: 2px solid #ffffff; box-shadow: 0 4px 10px rgba(249, 115, 22, 0.2); overflow: hidden;">
                                    <?php if ($profile_photo_url): ?>
                                        <img src="<?php echo $profile_photo_url; ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <?php echo htmlspecialchars($initials); ?>
                                    <?php endif; ?>
                                </div>
                                <span class="d-none d-sm-inline" style="color: var(--text-primary); font-weight: 600; font-size: 0.95rem;"><?php echo htmlspecialchars($name); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2 mt-2" aria-labelledby="userMenuDropdown" style="border-radius: 12px; min-width: 200px;">
                                <li>
                                    <div class="px-3 py-2 border-bottom mb-1" style="font-size: 0.85rem; color: var(--text-secondary);">
                                        <span class="d-block text-truncate" style="font-weight: 600; color: var(--text-primary);"><?php echo htmlspecialchars($name); ?></span>
                                        <span class="d-block text-truncate"><?php echo htmlspecialchars($CI->session->userdata('email')); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="<?php echo base_url('dashboard'); ?>" style="font-weight: 500; font-size: 0.9rem; color: var(--text-primary);">
                                        <span style="font-size: 1.1rem;">📊</span> डॅशबोर्ड (Dashboard)
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="<?php echo base_url('pricing'); ?>" style="font-weight: 500; font-size: 0.9rem; color: var(--text-primary);">
                                        <span style="font-size: 1.1rem;">💎</span> सदस्यत्व (₹<?php echo number_format($dynPrice, 0); ?>)
                                    </a>
                                </li>
                                <?php if ($self_info): ?>
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="<?php echo base_url('member/self'); ?>" style="font-weight: 500; font-size: 0.9rem; color: var(--text-primary);">
                                        <span style="font-size: 1.1rem;">👤</span> माझा प्रोफाईल (Profile)
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 text-danger" href="<?php echo base_url('logout'); ?>" style="font-weight: 600; font-size: 0.9rem;">
                                        <span style="font-size: 1.1rem;">🚪</span> लॉग आउट (Logout)
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo base_url('login'); ?>" class="btn-outline-premium text-decoration-none">लॉग इन</a>
                        <a href="<?php echo base_url('register'); ?>" class="btn-premium-orange text-decoration-none">नोंदणी करा</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
