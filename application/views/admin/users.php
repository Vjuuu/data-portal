<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Filter & Search Card -->
<div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
    <form method="GET" action="<?php echo base_url('admin/users'); ?>" class="row g-3 align-items-end">
        
        <div class="col-md-4">
            <label class="form-label fw-semibold small text-secondary">नाव / ईमेल / फोन शोधा (Search User)</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="उदा. Sudarshan, 9876543210..." value="<?php echo htmlspecialchars($search); ?>">
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold small text-secondary">पेमेंट स्थिती (Payment Status)</label>
            <select name="status" class="form-select">
                <option value="">सर्व स्थिती (All)</option>
                <option value="paid" <?php echo ($status === 'paid') ? 'selected' : ''; ?>>✓ फक्त Paid (₹5999)</option>
                <option value="unpaid" <?php echo ($status === 'unpaid') ? 'selected' : ''; ?>>⏳ फक्त Unpaid</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold small text-secondary">सर्च बॉक्स दृश्यमानता (Search Visibility)</label>
            <select name="visibility" class="form-select">
                <option value="">सर्व दृश्यमानता (All)</option>
                <option value="1" <?php echo ($visibility === '1') ? 'selected' : ''; ?>>🟢 फक्त दृश्यमान (Visible ON)</option>
                <option value="0" <?php echo ($visibility === '0') ? 'selected' : ''; ?>>🔴 फक्त लपवलेले (Hidden OFF)</option>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold" style="background: #f97316; border-color: #f97316;">
                <i class="bi bi-funnel-fill me-1"></i> फिल्टर
            </button>
            <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-light border rounded-pill px-3" title="Clear Filters">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>

    </form>
</div>

<!-- Users Table Card -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-0">वापरकर्त्यांची यादी (All Users)</h5>
            <small class="text-muted">एकूण वापरकर्ते: <strong><?php echo number_format($total_count); ?></strong></small>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">आयडी</th>
                    <th>वापरकर्ता (User Info)</th>
                    <th>फोन (Phone)</th>
                    <th>पेमेंट स्थिती (Payment)</th>
                    <th>सार्वजनिक सर्च दृश्यमानता (Public Visibility)</th>
                    <th>नोंदणीकृत स्थळे (Profiles)</th>
                    <th>नोंदणी तारीख (Registered)</th>
                    <th class="text-end pe-4">कृती (Actions)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td class="ps-4 text-muted small">#<?php echo $u['id']; ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.95rem; flex-shrink: 0;">
                                        <?php echo strtoupper(substr($u['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">
                                            <?php echo htmlspecialchars($u['name']); ?>
                                            <?php if (isset($u['role']) && $u['role'] === 'admin'): ?>
                                                <span class="badge bg-danger ms-1" style="font-size: 0.65rem;">ADMIN</span>
                                            <?php endif; ?>
                                        </div>
                                        <small class="text-muted"><?php echo htmlspecialchars($u['email']); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-secondary fw-semibold small">
                                <?php echo htmlspecialchars($u['phone']); ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ($u['payment_status'] === 'paid'): ?>
                                        <span class="badge bg-success-subtle text-success fw-bold px-2 py-1">✓ Paid (₹5999)</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning fw-bold px-2 py-1">⏳ Unpaid</span>
                                    <?php endif; ?>
                                    
                                    <!-- Toggle Payment Button -->
                                    <button type="button" class="btn btn-sm btn-link text-muted p-0 toggle-payment-btn" data-user-id="<?php echo $u['id']; ?>" data-current-status="<?php echo $u['payment_status']; ?>" title="Change payment status">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <!-- Live Public Search Visibility Switch -->
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input user-visibility-toggle" type="checkbox" role="switch" data-user-id="<?php echo $u['id']; ?>" <?php echo ($u['is_visible'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label small <?php echo ($u['is_visible'] == 1) ? 'text-success fw-semibold' : 'text-danger fw-semibold'; ?>">
                                        <?php echo ($u['is_visible'] == 1) ? '🟢 सर्चमध्ये दिसेल (Visible)' : '🔴 लपवलेले (Hidden)'; ?>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                    <i class="bi bi-people me-1"></i> <?php echo $u['members_count']; ?> स्थळे
                                </span>
                            </td>
                            <td class="text-muted small">
                                <?php echo !empty($u['created_at']) ? date('d M Y', strtotime($u['created_at'])) : '-'; ?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="<?php echo base_url('admin/user/' . $u['id']); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3" title="View Full Details">
                                    <i class="bi bi-eye me-1"></i> तपशील
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-muted opacity-50"></i>
                            कोणतेही वापरकर्ते सापडले नाहीत.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- AJAX Actions Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Handle Visibility Toggle
    const visibilityToggles = document.querySelectorAll('.user-visibility-toggle');
    visibilityToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const isVisible = this.checked ? 1 : 0;
            const label = this.nextElementSibling;

            // UI update
            if (isVisible) {
                label.textContent = '🟢 सर्चमध्ये दिसेल (Visible)';
                label.className = 'form-check-label small text-success fw-semibold';
            } else {
                label.textContent = '🔴 लपवलेले (Hidden)';
                label.className = 'form-check-label small text-danger fw-semibold';
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
                        timer: 2500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: isVisible ? 'success' : 'warning',
                        title: data.message
                    });
                } else {
                    Swal.fire({ title: 'त्रुटी', text: data.message, icon: 'error' });
                    toggle.checked = !isVisible;
                }
            })
            .catch(() => {
                Swal.fire({ title: 'त्रुटी', text: 'सर्व्हरशी संपर्क होऊ शकला नाही.', icon: 'error' });
                toggle.checked = !isVisible;
            });
        });
    });

    // 2. Handle Payment Status Quick Toggle
    const paymentBtns = document.querySelectorAll('.toggle-payment-btn');
    paymentBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const currentStatus = this.getAttribute('data-current-status');
            const newStatus = (currentStatus === 'paid') ? 'unpaid' : 'paid';

            Swal.fire({
                title: 'पेमेंट स्थिती बदलायची आहे का?',
                text: `या वापरकर्त्याची स्थिती "${newStatus === 'paid' ? 'Paid (₹5999)' : 'Unpaid'}" मध्ये बदलायची आहे का?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'हो, बदला',
                cancelButtonText: 'रद्द करा',
                confirmButtonColor: '#f97316'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new URLSearchParams();
                    formData.append('user_id', userId);
                    formData.append('payment_status', newStatus);

                    fetch('<?php echo base_url("admin/toggle_payment"); ?>', {
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
                            Swal.fire({
                                title: 'अपडेट झाले!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonColor: '#f97316'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({ title: 'त्रुटी', text: data.message, icon: 'error' });
                        }
                    });
                }
            });
        });
    });

});
</script>
