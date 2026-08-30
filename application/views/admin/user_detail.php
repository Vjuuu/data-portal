<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline-secondary rounded-pill px-3">
        ← वापरकर्त्यांच्या यादीवर परत जा
    </a>
</div>

<div class="row g-4 mb-4">
    <!-- User Primary Account Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <div class="text-center mb-4">
                <div class="mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.8rem;">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <h5 class="fw-bold text-dark mb-1"><?php echo htmlspecialchars($user['name']); ?></h5>
                <span class="badge bg-secondary-subtle text-secondary small"><?php echo htmlspecialchars($user['email']); ?></span>
            </div>

            <hr class="opacity-10 my-3">

            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">फोन नंबर:</span>
                    <span class="fw-semibold text-dark"><?php echo htmlspecialchars($user['phone']); ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">पेमेंट स्थिती:</span>
                    <?php if ($user['payment_status'] === 'paid'): ?>
                        <span class="badge bg-success">✓ Paid (₹5999)</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">⏳ Unpaid</span>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">सर्च दृश्यमानता:</span>
                    <?php if ($user['is_visible'] == 1): ?>
                        <span class="badge bg-success-subtle text-success fw-bold">🟢 दृश्यमान (Visible)</span>
                    <?php else: ?>
                        <span class="badge bg-danger-subtle text-danger fw-bold">🔴 लपवलेले (Hidden)</span>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">नोंदणी तारीख:</span>
                    <span class="text-secondary"><?php echo !empty($user['created_at']) ? date('d M Y, h:i A', strtotime($user['created_at'])) : '-'; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Family Profiles List -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden h-100">
            <div class="card-header bg-white border-0 py-3 px-4">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-people-fill text-orange me-2"></i> नोंदणीकृत कौटुंबिक स्थळे / सदस्य (Family Profiles)
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">फोटो व नाव</th>
                            <th>नाते (Relation)</th>
                            <th>लिंग</th>
                            <th>शिक्षण व व्यवसाय</th>
                            <th>फोन</th>
                            <th class="text-end pe-4">पत्ता</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $m): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <?php if (!empty($m['profile_photo'])): ?>
                                                <img src="<?php echo base_url($m['profile_photo']); ?>" alt="Photo" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                            <?php else: ?>
                                                <div style="width: 38px; height: 38px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #475569;">
                                                    <?php echo strtoupper(substr($m['first_name'], 0, 1)); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-bold text-dark"><?php echo htmlspecialchars($m['first_name'] . ' ' . $m['last_name']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo ($m['relation'] === 'Self') ? 'bg-primary' : 'bg-light text-dark border'; ?>">
                                            <?php echo htmlspecialchars($m['relation']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($m['gender']); ?></td>
                                    <td>
                                        <div class="small fw-semibold"><?php echo htmlspecialchars($m['education']); ?></div>
                                        <small class="text-muted"><?php echo htmlspecialchars($m['occupation']); ?></small>
                                    </td>
                                    <td class="small"><?php echo htmlspecialchars($m['phone_number']); ?></td>
                                    <td class="text-end pe-4 small text-muted">
                                        <?php echo htmlspecialchars($m['city'] ?: $m['address']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">अद्याप प्रोफाइल जोडलेले नाहीत.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Payment History for this user -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-header bg-white border-0 py-3 px-4">
        <h6 class="fw-bold text-dark mb-0">
            <i class="bi bi-receipt text-success me-2"></i> पेमेंट इतिहास (Payment Receipts)
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Payment ID</th>
                    <th>रक्कम</th>
                    <th>तारीख</th>
                    <th class="text-end pe-4">स्थिती</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payments)): ?>
                    <?php foreach ($payments as $p): ?>
                        <tr>
                            <td class="ps-4 font-monospace small"><?php echo htmlspecialchars($p['order_id']); ?></td>
                            <td class="font-monospace small text-primary"><?php echo htmlspecialchars($p['payment_id'] ?: '-'); ?></td>
                            <td class="fw-bold text-dark">₹<?php echo number_format($p['amount']); ?></td>
                            <td class="small text-muted"><?php echo !empty($p['created_at']) ? date('d M Y, h:i A', strtotime($p['created_at'])) : '-'; ?></td>
                            <td class="text-end pe-4">
                                <span class="badge bg-success">Paid</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">कोणतेही पेमेंट व्यवहार उपलब्ध नाहीत.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
