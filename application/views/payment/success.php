<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="py-5" style="background: linear-gradient(180deg, #f0fdf4 0%, #f8fafc 100%); min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card border-0 shadow-xl rounded-4 overflow-hidden text-center bg-white p-4 p-md-5">
                    
                    <!-- Success Animated Icon -->
                    <div class="mb-4">
                        <div class="success-icon-wrapper mx-auto d-flex align-items-center justify-content-center">
                            <span class="fs-1 text-white">✓</span>
                        </div>
                    </div>

                    <span class="badge bg-success-subtle text-success fw-bold px-3 py-2 rounded-pill mb-2">
                        PAYMENT CONFIRMED
                    </span>

                    <h2 class="fw-extrabold text-dark mb-2">पेमेंट यशस्वीरीत्या पूर्ण झाले!</h2>
                    <p class="text-secondary fs-6 mb-4">
                        आपले <strong>₹5,999</strong> चे एकवेळ पेमेंट यशस्वी झाले असून आपले <strong>आजीवन प्रीमियम सदस्यत्व</strong> सक्रिय झाले आहे.
                    </p>

                    <!-- Receipt Details Box -->
                    <div class="receipt-box text-start p-4 rounded-4 bg-light border mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <span class="text-muted small">व्यवहार स्थिती (Status):</span>
                            <span class="badge bg-success">यशस्वी (Paid)</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">रक्कम (Amount):</span>
                            <span class="fw-bold text-dark fs-5">₹5,999.00</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">योजना (Plan):</span>
                            <span class="fw-semibold text-dark">आजीवन सदस्यत्व (Lifetime)</span>
                        </div>
                        <?php if (!empty($payment['payment_id'])): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Razorpay Payment ID:</span>
                                <code class="text-primary"><?php echo htmlspecialchars($payment['payment_id']); ?></code>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($payment['order_id'])): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Order ID:</span>
                                <code class="text-secondary"><?php echo htmlspecialchars($payment['order_id']); ?></code>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">तारीख व वेळ:</span>
                            <span class="text-secondary"><?php echo !empty($payment['created_at']) ? date('d M Y, h:i A', strtotime($payment['created_at'])) : date('d M Y, h:i A'); ?></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary btn-lg rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-speedometer2 me-2"></i> डॅशबोर्डवर जा (Go to Dashboard)
                        </a>
                        <?php if (!empty($payment['id'])): ?>
                            <a href="<?php echo base_url('payment/invoice/' . $payment['id']); ?>" target="_blank" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-2 fw-semibold">
                                <i class="bi bi-printer me-2"></i> अधिकृत पावती प्रिंट करा
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes scaleIn {
    0% { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>
