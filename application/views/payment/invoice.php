<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'पेमेंट पावती'; ?></title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            padding: 40px 0;
        }
        .invoice-card {
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
        }
        .brand-logo {
            font-size: 24px;
            font-weight: 800;
            color: #f97316;
        }
        .badge-paid {
            background-color: #d1fae5;
            color: #065f46;
            font-size: 14px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 20px;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .invoice-card {
                box-shadow: none;
                border: none;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="container">
    
    <!-- Action Bar (Print / Back) -->
    <div class="d-flex justify-content-between align-items-center max-w-800 mx-auto mb-4 no-print" style="max-width: 800px;">
        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-outline-secondary btn-sm">
            ← डॅशबोर्डवर परत जा
        </a>
        <button onclick="window.print()" class="btn btn-primary btn-sm" style="background: #f97316; border-color: #f97316;">
            🖨️ पावती प्रिंट करा (Print Receipt)
        </button>
    </div>

    <div class="invoice-card">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
            <div>
                <div class="brand-logo mb-1">मराठी विवाह संस्था</div>
                <p class="text-secondary small mb-0">सर्वोत्तम आणि विश्वसनीय विवाह जुळवणी पोर्टल</p>
                <p class="text-secondary small mb-0">संपर्क: +91 91685 85280 | help@marathivivah.com</p>
            </div>
            <div class="text-end">
                <span class="badge-paid mb-2 d-inline-block">✓ PAID / भरणा केला</span>
                <div class="text-muted small">पावती क्र. #<?php echo str_pad($payment['id'], 6, '0', STR_PAD_LEFT); ?></div>
                <div class="text-muted small">तारीख: <?php echo date('d-m-Y', strtotime($payment['created_at'])); ?></div>
            </div>
        </div>

        <!-- Customer & Payment Summary -->
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="text-muted text-uppercase fw-bold small mb-2">बिल प्राप्तकर्ता (Billed To):</h6>
                <div class="fw-bold text-dark"><?php echo htmlspecialchars($user['name']); ?></div>
                <div class="text-secondary small"><?php echo htmlspecialchars($user['email']); ?></div>
                <div class="text-secondary small"><?php echo htmlspecialchars($user['phone']); ?></div>
            </div>
            <div class="col-6 text-end">
                <h6 class="text-muted text-uppercase fw-bold small mb-2">पेमेंट तपशील (Payment Details):</h6>
                <div class="small"><strong class="text-dark">गेटवे:</strong> Razorpay Payment Gateway</div>
                <?php if (!empty($payment['payment_id'])): ?>
                    <div class="small"><strong class="text-dark">Payment ID:</strong> <?php echo htmlspecialchars($payment['payment_id']); ?></div>
                <?php endif; ?>
                <?php if (!empty($payment['order_id'])): ?>
                    <div class="small"><strong class="text-dark">Order ID:</strong> <?php echo htmlspecialchars($payment['order_id']); ?></div>
                <?php endif; ?>
                <div class="small"><strong class="text-dark">पद्धत:</strong> <?php echo htmlspecialchars($payment['payment_method'] ?: 'Online / UPI'); ?></div>
            </div>
        </div>

        <!-- Invoice Table -->
        <table class="table table-bordered mb-4">
            <thead class="table-light">
                <tr>
                    <th>अ.क्र.</th>
                    <th>वर्णन (Description)</th>
                    <th>वैधता (Validity)</th>
                    <th class="text-end">रक्कम (Amount)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>आजीवन प्रीमियम सदस्यत्व नोंदणी शुल्क</strong>
                        <div class="text-muted small">Lifetime Matrimony Portal Access & Unlimited Profile Connects</div>
                    </td>
                    <td>आजीवन (Lifetime)</td>
                    <td class="text-end fw-semibold">₹5,083.90</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end text-muted small">GST (18%):</td>
                    <td class="text-end text-muted small">₹915.10</td>
                </tr>
                <tr class="table-light">
                    <td colspan="3" class="text-end fw-bold">एकूण भरलेली रक्कम (Total Paid):</td>
                    <td class="text-end fw-bold text-dark fs-5">₹5,999.00</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer Notice -->
        <div class="border-top pt-3 text-center text-muted small">
            <p class="mb-1">ही संगणक निर्मित अधिकृत पावती आहे. स्वाक्षरीची आवश्यकता नाही.</p>
            <p class="mb-0">आमच्यासोबत जोडल्याबद्दल धन्यवाद! मराठी विवाह संस्था, महाराष्ट्र.</p>
        </div>
    </div>
</div>

</body>
</html>
