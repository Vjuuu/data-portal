<!-- Load Dashboard Specific Stylesheet -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Premium Dynamic Background elements -->
<div class="bg-glow bg-glow-1"></div>
<div class="bg-glow bg-glow-2"></div>

<div class="container" style="margin-top: 120px; margin-bottom: 60px; position: relative; z-index: 1;">
    <div class="dashboard-container animate-slide-up py-4">

    <?php 
    $dynPrice = $this->User_model->get_setting('plan_price', '5999');
    ?>

    <!-- Membership Status Banner -->
    <?php if (!empty($is_paid)): ?>
        <div class="alert alert-success d-flex align-items-center justify-content-between flex-wrap gap-3 shadow-sm rounded-4 border-0 p-3 mb-4" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-4">👑</span>
                <div>
                    <strong class="text-success">आजीवन प्रीमियम सदस्य (Lifetime Premium Member)</strong>
                    <div class="text-secondary small">आपले ₹<?php echo number_format($dynPrice, 0); ?> चे पेमेंट सत्यापित झाले आहे. सर्व वैशिष्ट्ये सक्रिय आहेत.</div>
                </div>
            </div>
            <div>
                <a href="<?php echo base_url('payment/success'); ?>" class="btn btn-sm btn-outline-success rounded-pill px-3">
                    <i class="bi bi-receipt me-1"></i> पावती पहा (Receipt)
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning d-flex align-items-center justify-content-between flex-wrap gap-3 shadow-sm rounded-4 border-0 p-3 mb-4" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border-left: 5px solid #f59e0b !important;">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-4">⚠️</span>
                <div>
                    <strong class="text-dark">सदस्यत्व प्रलंबित (Payment Pending)</strong>
                    <div class="text-secondary small">सर्व संपर्क क्रमांक, फोटो आणि जुळवणी तपशील पाहण्यासाठी कृपया ₹<?php echo number_format($dynPrice, 0); ?> चे एकवेळ पेमेंट पूर्ण करा.</div>
                </div>
            </div>
            <div>
                <a href="<?php echo base_url('pricing'); ?>" class="btn btn-sm text-white rounded-pill px-4 py-2 fw-bold" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);">
                    ₹<?php echo number_format($dynPrice, 0); ?> आता भरा (Pay Now) ➔
                </a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content Cards Grid -->
    <div class="row g-4">
        <!-- Self Information Section -->
        <div class="col-lg-6">
            <div class="dashboard-card main-card h-100">
                <div class="card-title-bar">
                    <h3>My Details (Self)</h3>
                    <?php if ($self_info): ?>
                        <a href="<?php echo base_url('member/self'); ?>" class="btn-icon-text btn-edit-self text-decoration-none">
                            ✎ Edit Profile
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ($self_info): ?>
                    <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-3" style="background: rgba(15, 23, 42, 0.02); border: 1px solid rgba(15, 23, 42, 0.05);">
                        <div style="position: relative; width: 80px; height: 80px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1.8rem; border: 3px solid #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; flex-shrink: 0;">
                            <?php if (!empty($self_info['profile_photo'])): ?>
                                <img src="<?php echo base_url($self_info['profile_photo']); ?>" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <?php 
                                $initials = strtoupper(substr($self_info['first_name'], 0, 1) . substr($self_info['last_name'], 0, 1));
                                echo htmlspecialchars($initials);
                                ?>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="mb-1" style="font-weight: 700; color: var(--text-primary);"><?php echo htmlspecialchars($self_info['first_name'] . ' ' . $self_info['last_name']); ?></h4>
                            <span class="status-badge" style="font-size: 0.75rem;"><span class="badge-dot"></span> Active Profile</span>
                        </div>
                    </div>
                    <div class="profile-details-grid">
                        <div class="detail-item">
                            <label>Full Name</label>
                            <span><?php echo htmlspecialchars($self_info['first_name'] . ' ' . $self_info['middle_name'] . ' ' . $self_info['last_name']); ?></span>
                        </div>
                        <div class="detail-item">
                            <label>Gender</label>
                            <span><?php echo htmlspecialchars($self_info['gender']); ?></span>
                        </div>
                        <div class="detail-item">
                            <label>Education</label>
                            <span><?php echo htmlspecialchars($self_info['education']); ?></span>
                        </div>
                        <div class="detail-item">
                            <label>Occupation</label>
                            <span><?php echo htmlspecialchars($self_info['occupation']); ?></span>
                        </div>
                        <?php if ($self_info['occupation'] === 'Service'): ?>
                            <div class="detail-item full-width">
                                <label>Company Name</label>
                                <span><?php echo htmlspecialchars($self_info['company_name']); ?></span>
                            </div>
                        <?php elseif ($self_info['occupation'] === 'Business'): ?>
                            <div class="detail-item full-width">
                                <label>Business Details</label>
                                <span class="business-details-block">
                                    <strong>Name:</strong> <?php echo htmlspecialchars($self_info['business_name']); ?><br>
                                    <strong>Nature:</strong> <?php echo htmlspecialchars($self_info['business_nature']); ?><br>
                                    <strong>Address:</strong> <?php echo nl2br(htmlspecialchars($self_info['business_address'])); ?><br>
                                    <strong>Email:</strong> <?php echo htmlspecialchars($self_info['business_email'] ?? 'N/A'); ?><br>
                                    <strong>Phone:</strong> <?php echo htmlspecialchars($self_info['business_phone'] ?? 'N/A'); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="detail-item">
                            <label>Phone Number</label>
                            <span><?php echo htmlspecialchars($self_info['phone_number']); ?></span>
                        </div>
                        <div class="detail-item full-width">
                            <label>Current Address</label>
                            <span>
                                <?php echo nl2br(htmlspecialchars($self_info['address'] ?? 'N/A')); ?><br>
                                <small style="color: var(--text-secondary);">
                                    <strong>City:</strong> <?php echo htmlspecialchars($self_info['city'] ?? 'N/A'); ?> | 
                                    <strong>State:</strong> <?php echo htmlspecialchars($self_info['state'] ?? 'N/A'); ?> | 
                                    <strong>Pin Code:</strong> <?php echo htmlspecialchars($self_info['pin_code'] ?? 'N/A'); ?>
                                </small>
                            </span>
                        </div>
                        <div class="detail-item full-width">
                            <label>Permanent Address</label>
                            <span><?php echo nl2br(htmlspecialchars($self_info['permanent_address'] ?? 'N/A')); ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="profile-incomplete">
                        <div class="warning-icon">⚠</div>
                        <p>You have not added your personal details yet.</p>
                        <a href="<?php echo base_url('member/self'); ?>" class="btn btn-primary text-decoration-none d-inline-flex">
                            <span>Add Self Details</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Family Information Section -->
        <div class="col-lg-6">
            <div class="dashboard-card main-card h-100">
                <div class="card-title-bar">
                    <h3>Family Details</h3>
                    <a href="<?php echo base_url('member/add'); ?>" class="btn-icon-text btn-add-family text-decoration-none">
                        + Add Family Member
                    </a>
                </div>

                <div class="family-list-container">
                    <?php 
                    $family_members = array_filter($members, function($m) {
                        return $m['relation'] !== 'Self';
                    });
                    ?>
                    
                    <?php if (!empty($family_members)): ?>
                        <div class="family-cards">
                            <?php foreach ($family_members as $member): ?>
                                <div class="family-card-item">
                                    <div class="family-card-header d-flex align-items-center gap-3">
                                        <div style="position: relative; width: 45px; height: 45px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1.1rem; border: 2px solid #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; flex-shrink: 0;">
                                            <?php if (!empty($member['profile_photo'])): ?>
                                                <img src="<?php echo base_url($member['profile_photo']); ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                                            <?php else: ?>
                                                <?php 
                                                $initials = strtoupper(substr($member['first_name'], 0, 1) . substr($member['last_name'], 0, 1));
                                                echo htmlspecialchars($initials);
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                        <h4 class="m-0 flex-grow-1">
                                            <?php echo htmlspecialchars($member['first_name'] . ' ' . $member['last_name']); ?>
                                            <span class="relation-tag"><?php echo htmlspecialchars($member['relation']); ?></span>
                                        </h4>
                                        <div class="family-card-actions">
                                            <a href="<?php echo base_url('member/edit/' . $member['id']); ?>" class="btn-action btn-edit text-decoration-none" title="Edit">✎</a>
                                            <a href="javascript:void(0);" 
                                               onclick="confirmDelete('<?php echo base_url('auth/delete_member/' . $member['id']); ?>')"
                                               class="btn-action btn-delete text-decoration-none" 
                                               title="Delete">✕</a>
                                        </div>
                                    </div>
                                    <div class="family-card-body">
                                        <div class="family-meta"><strong>Gender:</strong><?php echo htmlspecialchars($member['gender']); ?></div>
                                        <div class="family-meta"><strong>Education:</strong><?php echo htmlspecialchars($member['education']); ?></div>
                                        <div class="family-meta"><strong>Phone:</strong><?php echo htmlspecialchars($member['phone_number']); ?></div>
                                        <div class="family-meta"><strong>Occupation:</strong>
                                            <?php echo htmlspecialchars($member['occupation']); ?>
                                            <?php if ($member['occupation'] === 'Service'): ?>
                                                (<?php echo htmlspecialchars($member['company_name']); ?>)
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php if ($member['occupation'] === 'Business'): ?>
                                            <div class="family-meta" style="grid-column: span 2; background: rgba(15, 23, 42, 0.01); padding: 8px; border-radius: 6px; border: 1px solid rgba(15, 23, 42, 0.04);">
                                                <strong>Business Details:</strong>
                                                <div class="ps-2 mt-1" style="font-size: 0.8rem; line-height: 1.4;">
                                                    Name: <?php echo htmlspecialchars($member['business_name']); ?><br>
                                                    Nature: <?php echo htmlspecialchars($member['business_nature']); ?><br>
                                                    Address: <?php echo htmlspecialchars($member['business_address']); ?><br>
                                                    Email: <?php echo htmlspecialchars($member['business_email'] ?? 'N/A'); ?><br>
                                                    Phone: <?php echo htmlspecialchars($member['business_phone'] ?? 'N/A'); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="family-meta" style="grid-column: span 2; border-top: 1px dashed rgba(15, 23, 42, 0.08); padding-top: 8px; margin-top: 4px;">
                                            <strong>Address:</strong>
                                            <div class="ps-2 mt-1" style="font-size: 0.8rem; line-height: 1.4; color: var(--text-secondary);">
                                                Current: <?php echo htmlspecialchars($member['address'] ?? 'N/A'); ?>, <?php echo htmlspecialchars($member['city'] ?? 'N/A'); ?>, <?php echo htmlspecialchars($member['state'] ?? 'N/A'); ?> - <?php echo htmlspecialchars($member['pin_code'] ?? 'N/A'); ?><br>
                                                Permanent: <?php echo htmlspecialchars($member['permanent_address'] ?? 'N/A'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="profile-incomplete">
                            <div class="warning-icon" style="color: #64748b;">ℹ</div>
                            <p>No family details added yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- .container -->

<!-- JavaScript for Delete Confirmation via SweetAlert2 -->
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this family member's details!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete them!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
