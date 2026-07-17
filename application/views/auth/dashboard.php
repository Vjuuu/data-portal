<!-- Load Dashboard Specific Stylesheet -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Premium Dynamic Background elements -->
<div class="bg-glow bg-glow-1"></div>
<div class="bg-glow bg-glow-2"></div>

<div class="container" style="margin-top: 120px; margin-bottom: 60px; position: relative; z-index: 1;">
    <div class="dashboard-container animate-slide-up py-4">
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
                                    <strong>Address:</strong> <?php echo nl2br(htmlspecialchars($self_info['business_address'])); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="detail-item">
                            <label>Phone Number</label>
                            <span><?php echo htmlspecialchars($self_info['phone_number']); ?></span>
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
                                    <div class="family-card-header">
                                        <h4>
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
                                            <?php elseif ($member['occupation'] === 'Business'): ?>
                                                - <?php echo htmlspecialchars($member['business_name']); ?>
                                            <?php endif; ?>
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
