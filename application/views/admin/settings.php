<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5 mb-4">
            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: #fff7ed; color: #f97316; display: flex; align-items: center; justify-content: center; font-size: 1.6rem;">
                    <i class="bi bi-currency-rupee"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">योजना किंमत व सेटिंग्ज (Set Membership Price)</h4>
                    <p class="text-muted small mb-0">येथून आपण सदस्यत्व योजना किंमत व शीर्षक बदलू शकता.</p>
                </div>
            </div>

            <?php echo form_open('admin/settings'); ?>
                
                <div class="row g-4 mb-4">
                    <!-- Plan Price -->
                    <div class="col-md-6">
                        <label for="plan_price" class="form-label fw-bold text-dark">
                            सदस्यत्व किंमत (One-Time Plan Price ₹) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">₹</span>
                            <input type="number" step="1" name="plan_price" id="plan_price" class="form-control form-control-lg fw-bold text-success" placeholder="5999" value="<?php echo set_value('plan_price', $plan_price); ?>" required>
                        </div>
                        <small class="text-muted">ही किंमत वापरकर्त्यांना /pricing पेजवर दिसेल आणि Razorpay द्वारे आकारली जाईल.</small>
                    </div>

                    <!-- Original Strikethrough Price -->
                    <div class="col-md-6">
                        <label for="original_price" class="form-label fw-bold text-dark">
                            मूळ किंमत (Original Strikethrough Price ₹)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">₹</span>
                            <input type="number" step="1" name="original_price" id="original_price" class="form-control form-control-lg text-muted text-decoration-line-through" placeholder="12999" value="<?php echo set_value('original_price', $original_price); ?>">
                        </div>
                        <small class="text-muted">ऑफर व सूट दाखवण्यासाठी (उदा. <del>₹12,999</del>).</small>
                    </div>

                    <!-- Plan Title -->
                    <div class="col-12">
                        <label for="plan_title" class="form-label fw-bold text-dark">
                            योजनेचे नाव (Plan Title) <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="plan_title" id="plan_title" class="form-control" placeholder="उदा. आजीवन प्रीमियम सदस्यत्व" value="<?php echo set_value('plan_title', $plan_title); ?>" required>
                    </div>

                    <!-- Plan Subtitle -->
                    <div class="col-12">
                        <label for="plan_subtitle" class="form-label fw-bold text-dark">
                            योजनेचे उपशीर्षक (Plan Subtitle)
                        </label>
                        <input type="text" name="plan_subtitle" id="plan_subtitle" class="form-control" placeholder="उदा. एकदाच भरा आणि आयुष्यभर वापरा" value="<?php echo set_value('plan_subtitle', $plan_subtitle); ?>">
                    </div>
                </div>

                <!-- Live Preview Box -->
                <div class="p-4 rounded-4 mb-4" style="background: #fff7ed; border: 2px dashed #fed7aa;">
                    <span class="badge bg-orange-subtle text-orange fw-bold mb-2" style="background: #ffedd5; color: #ea580c;">LIVE PREVIEW</span>
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="fw-bold text-dark mb-0" id="previewTitle"><?php echo htmlspecialchars($plan_title); ?></h5>
                            <small class="text-muted" id="previewSubtitle"><?php echo htmlspecialchars($plan_subtitle); ?></small>
                        </div>
                        <div class="text-end">
                            <span class="text-decoration-line-through text-muted small d-block" id="previewOriginal">₹<?php echo number_format($original_price); ?></span>
                            <div class="display-6 fw-extrabold text-orange" style="color: #ea580c;" id="previewPrice">₹<?php echo number_format($plan_price); ?></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-light border rounded-pill px-4">
                        रद्द करा
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); border: none;">
                        <i class="bi bi-check2-circle me-1"></i> किंमत जतन करा (Save Price)
                    </button>
                </div>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- Real-time Preview Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const priceInput = document.getElementById('plan_price');
    const origInput = document.getElementById('original_price');
    const titleInput = document.getElementById('plan_title');
    const subtitleInput = document.getElementById('plan_subtitle');

    const previewPrice = document.getElementById('previewPrice');
    const previewOriginal = document.getElementById('previewOriginal');
    const previewTitle = document.getElementById('previewTitle');
    const previewSubtitle = document.getElementById('previewSubtitle');

    function updatePreview() {
        previewPrice.textContent = '₹' + (Number(priceInput.value || 0)).toLocaleString('en-IN');
        previewOriginal.textContent = origInput.value ? ('₹' + (Number(origInput.value)).toLocaleString('en-IN')) : '';
        previewTitle.textContent = titleInput.value || 'प्रीमियम सदस्यत्व';
        previewSubtitle.textContent = subtitleInput.value || '';
    }

    priceInput.addEventListener('input', updatePreview);
    origInput.addEventListener('input', updatePreview);
    titleInput.addEventListener('input', updatePreview);
    subtitleInput.addEventListener('input', updatePreview);
});
</script>
