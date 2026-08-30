<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-0">
                <i class="bi bi-credit-card-2-front-fill text-orange me-2"></i> सर्व पेमेंट व्यवहार (Razorpay Transactions)
            </h5>
            <small class="text-muted">एकूण व्यवहार: <strong><?php echo count($payments); ?></strong></small>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">व्यवहार क्र.</th>
                    <th>वापरकर्ता (User)</th>
                    <th>Razorpay Order ID</th>
                    <th>Payment ID</th>
                    <th>रक्कम (Amount)</th>
                    <th>पद्धत (Method)</th>
                    <th>तारीख व वेळ (Date)</th>
                    <th class="text-end pe-4">स्थिती (Status)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payments)): ?>
                    <?php foreach ($payments as $p): ?>
                        <tr>
                            <td class="ps-4 text-muted small">#<?php echo $p['id']; ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?php echo htmlspecialchars($p['user_name'] ?: 'User #' . $p['user_id']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($p['user_email']); ?></small>
                            </td>
                            <td class="font-monospace small"><?php echo htmlspecialchars($p['order_id']); ?></td>
                            <td class="font-monospace small text-primary"><?php echo htmlspecialchars($p['payment_id'] ?: '-'); ?></td>
                            <td class="fw-bold text-dark fs-6">
                                ₹<?php echo number_format($p['amount'], 2); ?>
                            </td>
                            <td class="small text-secondary">
                                <?php echo htmlspecialchars($p['payment_method'] ?: 'Online / UPI'); ?>
                            </td>
                            <td class="text-muted small">
                                <?php echo !empty($p['created_at']) ? date('d M Y, h:i A', strtotime($p['created_at'])) : '-'; ?>
                            </td>
                            <td class="text-end pe-4">
                                <?php if ($p['status'] === 'paid'): ?>
                                    <span class="badge bg-success">✓ Paid</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($p['status']); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-1 d-block mb-2 text-muted opacity-50"></i>
                            कोणतेही पेमेंट व्यवहार सापडले नाहीत.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
