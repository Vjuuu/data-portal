<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Razorpay Checkout SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="pricing-simple-wrapper py-5">
    <div class="container">
        
        <!-- Post-Registration Alert if just registered -->
        <?php if (!empty($just_registered)): ?>
            <div class="alert alert-success text-center border-0 rounded-3 p-3 mb-4 mx-auto" style="max-width: 540px; background: #ecfdf5; color: #065f46;">
                <strong>🎉 नोंदणी पूर्ण झाली!</strong> खाते सुरू करण्यासाठी खालील ₹<?php echo number_format($plan_amount, 0); ?> चे पेमेंट पूर्ण करा.
            </div>
        <?php endif; ?>

        <!-- Centered Clean Pricing Card -->
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white text-center">
                    
                    <div class="mb-3">
                        <span class="badge rounded-pill px-3 py-2 text-uppercase fw-bold" style="background: #ffedd5; color: #ea580c; font-size: 0.8rem;">
                            एकवेळ पेमेंट • Lifetime Access
                        </span>
                    </div>

                    <h3 class="fw-bold text-dark mb-1"><?php echo htmlspecialchars($plan_title_mr ?: 'प्रीमियम सदस्यत्व'); ?></h3>
                    <p class="text-muted small mb-4"><?php echo htmlspecialchars($plan_subtitle ?: 'एकदाच भरा आणि आयुष्यभर वापरा'); ?></p>

                    <!-- Price Box -->
                    <div class="price-box py-3 px-4 rounded-3 mb-4" style="background: #fff7ed; border: 1px solid #fed7aa;">
                        <?php if (!empty($original_price)): ?>
                            <span class="text-decoration-line-through text-muted small d-block mb-1">मूळ किंमत: ₹<?php echo number_format($original_price, 0); ?></span>
                        <?php endif; ?>
                        <div class="d-flex align-items-baseline justify-content-center gap-1">
                            <span class="display-5 fw-extrabold" style="color: #ea580c;">₹<?php echo number_format($plan_amount, 0); ?></span>
                            <span class="text-secondary fw-semibold">/ एकवेळ</span>
                        </div>
                        <small class="text-success fw-semibold">कोणतेही मासिक शुल्क नाही (No Renewal)</small>
                    </div>

                    <!-- Simple Features List -->
                    <div class="text-start mb-4">
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                            <li class="d-flex align-items-center gap-2">
                                <span class="badge rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="background: #ea580c; color: #fff; width: 20px; height: 20px; font-size: 11px;">✓</span>
                                <span class="text-dark">सर्व सत्यापित प्रोफाईल्स प्रवेश</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="badge rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="background: #ea580c; color: #fff; width: 20px; height: 20px; font-size: 11px;">✓</span>
                                <span class="text-dark">अमर्यादित फोन व WhatsApp संपर्क</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="badge rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="background: #ea580c; color: #fff; width: 20px; height: 20px; font-size: 11px;">✓</span>
                                <span class="text-dark">कुटुंबातील सदस्यांची संपूर्ण नोंदणी</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="badge rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="background: #ea580c; color: #fff; width: 20px; height: 20px; font-size: 11px;">✓</span>
                                <span class="text-dark">आजीवन वैधता (Lifetime Validity)</span>
                            </li>
                        </ul>
                    </div>

                    <?php if (!empty($is_paid)): ?>
                        <!-- Already Paid Button -->
                        <div class="alert alert-success p-2 small rounded-3 mb-3">
                            ✓ आपले ₹<?php echo number_format($plan_amount, 0); ?> चे सदस्यत्व आधीच सक्रिय आहे.
                        </div>
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-dark w-100 py-3 rounded-pill fw-bold">
                            डॅशबोर्डवर जा ➔
                        </a>
                    <?php else: ?>
                        <!-- Pay Button -->
                        <?php if ($this->session->userdata('logged_in')): ?>
                            <button type="button" id="payBtn" class="btn w-100 py-3 rounded-pill fw-bold fs-6 text-white shadow-sm" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); border: none;">
                                Razorpay द्वारे ₹<?php echo number_format($plan_amount, 0); ?> भरा ➔
                            </button>
                        <?php else: ?>
                            <a href="<?php echo base_url('register'); ?>" class="btn w-100 py-3 rounded-pill fw-bold fs-6 text-white shadow-sm" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); border: none;">
                                नोंदणी करा आणि ₹<?php echo number_format($plan_amount, 0); ?> भरा ➔
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="mt-3 text-muted small">
                        🔒 Razorpay द्वारे 100% सुरक्षित व्यवहार (UPI, Cards, NetBanking)
                    </div>

                </div>

                <!-- Test Mode Helper Guide (Visible when using rzp_test keys) -->
                <?php if (strpos($key_id, 'rzp_test_') === 0): ?>
                    <div class="card border-0 shadow-sm rounded-4 mt-4 p-4 text-start" style="background: #f8fafc; border: 1px dashed #cbd5e1 !important;">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-warning text-dark fw-bold px-2 py-1">🧪 TEST MODE GUIDE</span>
                            <span class="small fw-semibold text-secondary">कसे टेस्ट करावे (How to Test)</span>
                        </div>

                        <div class="small text-secondary mb-3">
                            <i class="bi bi-info-circle-fill text-primary me-1"></i>
                            <strong>महत्त्वाची टीप:</strong> हे टेस्ट मोड (Sandbox) आहे. PhonePe/GPay ॲपमधून खरा QR कोड स्कॅन केल्यास बँकेकडून <em>Technical Issue</em> येतो. त्याऐवजी खालील टेस्ट पद्धती वापरा:
                        </div>

                        <!-- Option 1: Test UPI (Fastest & Guaranteed) -->
                        <div class="mb-3 p-2 bg-white rounded-3 border">
                            <div class="fw-bold text-dark mb-1">
                                <i class="bi bi-phone text-success me-1"></i> १. टेस्ट UPI द्वारे (सर्वात सोपे - 100% Guaranteed)
                            </div>
                            <div class="text-muted small">
                                Razorpay पॉपअपमध्ये <strong>UPI</strong> निवडा ➔ <strong>UPI ID</strong> मध्ये टाका:
                                <div class="mt-1 d-flex align-items-center gap-2">
                                    <code class="p-1 px-2 bg-light border rounded text-danger fw-bold user-select-all">success@razorpay</code>
                                    <span class="badge bg-success-subtle text-success">झटपट यशस्वी</span>
                                </div>
                            </div>
                        </div>

                        <!-- Option 2: Indian Domestic RuPay Card (No International Error) -->
                        <div class="mb-3 p-2 bg-white rounded-3 border">
                            <div class="fw-bold text-dark mb-1">
                                <i class="bi bi-credit-card-2-front text-primary me-1"></i> २. भारतीय RuPay टेस्ट कार्ड (No International Error)
                            </div>
                            <div class="text-muted small">
                                "International cards not supported" त्रुटी टाळण्यासाठी हे भारतीय RuPay कार्ड वापरा:
                                <div class="mt-1">
                                    कार्ड क्र.: <code class="p-1 bg-light border rounded text-dark fw-bold user-select-all">6071520000000001</code><br>
                                    Expiry: <code class="p-1 bg-light border rounded text-dark">12/28</code> | CVV: <code class="p-1 bg-light border rounded text-dark">123</code><br>
                                    OTP स्क्रीनवर हिरव्या <strong>"Success"</strong> बटनावर क्लिक करा.
                                </div>
                            </div>
                        </div>

                        <!-- Option 3: NetBanking -->
                        <div class="mb-3 p-2 bg-white rounded-3 border">
                            <div class="fw-bold text-dark mb-1">
                                <i class="bi bi-bank text-orange me-1"></i> ३. नेट बँकिंग (NetBanking Simulation)
                            </div>
                            <div class="text-muted small">
                                <strong>Netbanking</strong> निवडून कोणतीही बँक (उदा. HDFC/SBI) निवडा ➔ पॉपअपवर <strong>"Success"</strong> क्लिक करा.
                            </div>
                        </div>

                        <!-- 1-Click Fast Sandbox Test Button -->
                        <?php if ($this->session->userdata('logged_in')): ?>
                            <div class="text-center pt-2">
                                <button type="button" id="mockFastTestBtn" class="btn btn-outline-warning btn-sm w-100 rounded-pill fw-bold text-dark">
                                    ⚡ 1-Click Test Payment Simulation (झटपट टेस्ट पेमेंट)
                                </button>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<!-- Razorpay Integration Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const payBtn = document.getElementById('payBtn');
    if (!payBtn) return;

    payBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const originalText = payBtn.innerHTML;
        payBtn.disabled = true;
        const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        const orderFormData = new URLSearchParams();
        orderFormData.append(csrfName, csrfHash);

        fetch('<?php echo base_url("payment/create_order"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: orderFormData.toString()
        })
        .then(async res => {
            const text = await res.text();
            try {
                return JSON.parse(text);
            } catch(e) {
                console.error("Non-JSON server response:", text);
                throw new Error("Server Error: " + (text.substring(0, 100) || res.statusText));
            }
        })
        .then(data => {
            if (data.status !== 'success') {
                Swal.fire({
                    title: 'त्रुटी',
                    text: data.message || 'ऑर्डर तयार करता आली नाही.',
                    icon: 'error'
                });
                payBtn.disabled = false;
                payBtn.innerHTML = originalText;
                return;
            }

            if (data.is_mock) {
                Swal.fire({
                    title: 'Razorpay Sandbox Test',
                    text: 'Amount: ₹5,999 - Complete mock payment?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Pay ₹5,999 (Test)',
                    confirmButtonColor: '#ea580c'
                }).then(res => {
                    if (res.isConfirmed) {
                        verifyPayment({
                            razorpay_order_id: data.order_id,
                            razorpay_payment_id: 'pay_mock_' + Date.now(),
                            razorpay_signature: 'mock_sig'
                        });
                    } else {
                        payBtn.disabled = false;
                        payBtn.innerHTML = originalText;
                    }
                });
                return;
            }

            const options = {
                "key": data.key_id,
                "amount": data.amount,
                "currency": data.currency || "INR",
                "name": data.company_name || "मराठी विवाह संस्था",
                "description": "Lifetime Membership - ₹5,999",
                "order_id": data.order_id,
                "prefill": {
                    "name": data.user_name || "",
                    "email": data.user_email || "",
                    "contact": data.user_phone || ""
                },
                "theme": { "color": "#ea580c" },
                "modal": {
                    "ondismiss": function() {
                        payBtn.disabled = false;
                        payBtn.innerHTML = originalText;
                    }
                },
                "handler": function (response) {
                    verifyPayment(response);
                }
            };

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response) {
                Swal.fire({
                    title: 'पेमेंट अयशस्वी',
                    text: response.error.description || 'पेमेंट पूर्ण होऊ शकले नाही.',
                    icon: 'error'
                });
                payBtn.disabled = false;
                payBtn.innerHTML = originalText;
            });

            rzp.open();
        })
        .catch(err => {
            console.error('Payment Error:', err);
            Swal.fire({ title: 'त्रुटी', text: err.message || 'सर्व्हरशी संपर्क होऊ शकला नाही.', icon: 'error' });
            payBtn.disabled = false;
            payBtn.innerHTML = originalText;
        });
    });

    function verifyPayment(payload) {
        Swal.fire({
            title: 'पेमेंट पडताळणी...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        const formData = new URLSearchParams();
        const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        formData.append(csrfName, csrfHash);
        for (const key in payload) {
            formData.append(key, payload[key]);
        }

        fetch('<?php echo base_url("payment/verify"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData.toString()
        })
        .then(res => res.json())
        .then(resData => {
            if (resData.status === 'success') {
                Swal.fire({
                    title: 'पेमेंट यशस्वी!',
                    text: 'आपले सदस्यत्व सक्रिय झाले आहे.',
                    icon: 'success',
                    confirmButtonColor: '#ea580c'
                }).then(() => {
                    window.location.href = resData.redirect_url || '<?php echo base_url("dashboard"); ?>';
                });
            } else {
                Swal.fire({ title: 'त्रुटी', text: resData.message || 'पडताळणी अयशस्वी.', icon: 'error' });
                payBtn.disabled = false;
                payBtn.innerHTML = originalText;
            }
        })
        .catch(() => {
            Swal.fire({ title: 'त्रुटी', text: 'पडताळणी दरम्यान त्रुटी आली.', icon: 'error' });
            payBtn.disabled = false;
            payBtn.innerHTML = originalText;
        });
    // 1-Click Fast Sandbox Test Button
    const mockFastTestBtn = document.getElementById('mockFastTestBtn');
    if (mockFastTestBtn) {
        mockFastTestBtn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '⚡ Sandbox 1-Click Test',
                text: 'आपण टेस्ट मोडमध्ये आहात. हे ₹<?php echo number_format($plan_amount, 0); ?> चे टेस्ट पेमेंट झटपट पूर्ण करायचे आहे का?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'हो, टेस्ट पेमेंट करा',
                cancelButtonText: 'रद्द करा',
                confirmButtonColor: '#f97316'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'ऑर्डर तयार करत आहे...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
                    const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    const orderFormData = new URLSearchParams();
                    orderFormData.append(csrfName, csrfHash);

                    fetch('<?php echo base_url("payment/create_order"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: orderFormData.toString()
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            verifyPayment({
                                razorpay_order_id: data.order_id,
                                razorpay_payment_id: 'pay_test_' + Date.now(),
                                razorpay_signature: 'test_simulation_sig'
                            });
                        } else {
                            Swal.fire({ title: 'त्रुटी', text: data.message, icon: 'error' });
                        }
                    })
                    .catch(err => {
                        Swal.fire({ title: 'त्रुटी', text: 'सर्व्हरशी संपर्क होऊ शकला नाही.', icon: 'error' });
                    });
                }
            });
        });
    }
});
</script>

<style>
.pricing-simple-wrapper {
    background: #f8fafc;
    min-height: 80vh;
    display: flex;
    align-items: center;
}
</style>
