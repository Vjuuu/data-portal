<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Dashboard Top Stats Grid -->
<div class="row g-4 mb-4">
    <!-- Stat 1: Total Users -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">एकूण वापरकर्ते (Total Users)</span>
                <div class="stat-icon-wrapper" style="background: #eff6ff; color: #3b82f6;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h2 class="fw-extrabold text-dark mb-0"><?php echo number_format($stats['total_users']); ?></h2>
                <span class="badge bg-primary-subtle text-primary small">नोंदणीकृत</span>
            </div>
        </div>
    </div>

    <!-- Stat 2: Paid Members -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">सक्रिय सदस्य (Paid ₹5999)</span>
                <div class="stat-icon-wrapper" style="background: #ecfdf5; color: #10b981;">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h2 class="fw-extrabold text-success mb-0"><?php echo number_format($stats['paid_users']); ?></h2>
                <span class="badge bg-success-subtle text-success small">आजीवन सदस्य</span>
            </div>
        </div>
    </div>

    <!-- Stat 3: Unpaid Members -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">प्रलंबित पेमेंट (Unpaid)</span>
                <div class="stat-icon-wrapper" style="background: #fffbeb; color: #f59e0b;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h2 class="fw-extrabold text-warning mb-0"><?php echo number_format($stats['unpaid_users']); ?></h2>
                <span class="badge bg-warning-subtle text-warning small">पेमेंट बाकी</span>
            </div>
        </div>
    </div>

    <!-- Stat 4: Total Revenue -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">एकूण महसूल (Total Revenue)</span>
                <div class="stat-icon-wrapper" style="background: #fff7ed; color: #f97316;">
                    <i class="bi bi-currency-rupee"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <h2 class="fw-extrabold text-orange mb-0" style="color: #f97316;">₹<?php echo number_format($stats['total_revenue']); ?></h2>
                <span class="badge bg-orange-subtle text-orange small" style="background: #ffedd5; color: #ea580c;">Razorpay</span>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats Bar -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper" style="background: #f1f5f9; color: #475569;">
                        <i class="bi bi-person-vcard-fill"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark fs-5"><?php echo number_format($stats['total_members']); ?> स्थळे (Profiles)</div>
                        <small class="text-muted">कुटुंबातील एकूण नोंदणीकृत सदस्य</small>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    सर्व पहा →
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="stat-card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper" style="background: #f0fdf4; color: #16a34a;">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark fs-5">
                            <span class="text-success"><?php echo $stats['visible_users']; ?> दृश्यमान</span> / 
                            <span class="text-danger"><?php echo $stats['hidden_users']; ?> लपवलेले</span>
                        </div>
                        <small class="text-muted">सार्वजनिक सर्च बॉक्स दृश्यमानता स्थिती</small>
                    </div>
                </div>
                <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    व्यवस्थापन करा →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users & Recent Payments Grid -->
<div class="row g-4">
    
    <!-- Recent Users Table -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="bi bi-person-plus-fill text-orange me-2"></i> अलीकडील वापरकर्ते (Recent Registrations)
                </h6>
                <a href="<?php echo base_url('admin/users'); ?>" class="text-decoration-none small fw-semibold" style="color: #f97316;">
                    सर्व वापरकर्ते पहा →
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">वापरकर्ता (User)</th>
                            <th>पेमेंट (Payment)</th>
                            <th>सर्च दृश्यमानता (Search Visibility)</th>
                            <th class="text-end pe-4">कृती (Action)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_users)): ?>
                            <?php foreach ($recent_users as $u): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                                                <?php echo strtoupper(substr($u['name'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark"><?php echo htmlspecialchars($u['name']); ?></div>
                                                <small class="text-muted"><?php echo htmlspecialchars($u['email']); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($u['payment_status'] === 'paid'): ?>
                                            <span class="badge bg-success-subtle text-success fw-bold px-2 py-1">✓ Paid (₹5999)</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-warning fw-bold px-2 py-1">Unpaid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Search Visibility Switch -->
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input visibility-switch" type="checkbox" role="switch" data-user-id="<?php echo $u['id']; ?>" <?php echo ($u['is_visible'] == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label small <?php echo ($u['is_visible'] == 1) ? 'text-success fw-semibold' : 'text-muted'; ?>">
                                                <?php echo ($u['is_visible'] == 1) ? 'सर्चमध्ये दिसेल' : 'लपवलेले'; ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?php echo base_url('admin/user/' . $u['id']); ?>" class="btn btn-sm btn-light border rounded-pill px-3" title="View details">
                                            तपशील
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">नोंदणीकृत वापरकर्ते सापडले नाहीत.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="bi bi-credit-card-fill text-success me-2"></i> अलीकडील पेमेंट (Transactions)
                </h6>
                <a href="<?php echo base_url('admin/payments'); ?>" class="text-decoration-none small fw-semibold" style="color: #10b981;">
                    सर्व व्यवहार →
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">तपशील</th>
                            <th>रक्कम</th>
                            <th class="text-end pe-4">स्थिती</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_payments)): ?>
                            <?php foreach ($recent_payments as $p): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-semibold text-dark"><?php echo htmlspecialchars($p['user_name'] ?: 'User #' . $p['user_id']); ?></div>
                                        <small class="text-muted"><?php echo !empty($p['created_at']) ? date('d M, h:i A', strtotime($p['created_at'])) : '-'; ?></small>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        ₹<?php echo number_format($p['amount']); ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <?php if ($p['status'] === 'paid'): ?>
                                            <span class="badge bg-success">यशस्वी</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo htmlspecialchars($p['status']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">पेमेंट रेकॉर्ड उपलब्ध नाही.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Interactive Search Visibility Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const switches = document.querySelectorAll('.visibility-switch');
    switches.forEach(sw => {
        sw.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const isVisible = this.checked ? 1 : 0;
            const label = this.nextElementSibling;

            // Optimistic UI update
            if (isVisible) {
                label.textContent = 'सर्चमध्ये दिसेल';
                label.className = 'form-check-label small text-success fw-semibold';
            } else {
                label.textContent = 'लपवलेले';
                label.className = 'form-check-label small text-muted';
            }

            const formData = new URLSearchParams();
            formData.append('user_id', userId);
            formData.append('is_visible', isVisible);

            fetch('<?php echo base_url("admin/toggle_visibility"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData.toString()
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: isVisible ? 'success' : 'info',
                        title: data.message
                    });
                } else {
                    Swal.fire({
                        title: 'त्रुटी!',
                        text: data.message || 'दृश्यमानता बदलता आली नाही.',
                        icon: 'error'
                    });
                    // Revert switch on error
                    sw.checked = !isVisible;
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire({ title: 'त्रुटी', text: 'सर्व्हरशी संपर्क होऊ शकला नाही.', icon: 'error' });
                sw.checked = !isVisible;
            });
        });
    });
});
</script>
