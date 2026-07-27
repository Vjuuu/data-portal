<!-- Load Dashboard Specific Stylesheet for cards -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Premium Dynamic Background elements -->
<div class="bg-glow bg-glow-1"></div>
<div class="bg-glow bg-glow-2"></div>

<div class="container" style="margin-top: 120px; margin-bottom: 80px; position: relative; z-index: 1;">
    <!-- Back button & search header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <a href="<?php echo base_url(); ?>" class="text-decoration-none d-inline-flex align-items-center gap-1 mb-2" style="color: var(--primary-orange); font-weight: 600; font-size: 0.95rem;">
                ← मुख्यपृष्ठ (Back to Home)
            </a>
            <h2 style="font-weight: 800; font-size: 1.85rem; color: var(--text-primary); margin: 0;">
                शोध निकाल (Search Results)
            </h2>
            <p class="text-secondary m-0" style="font-size: 0.95rem;">
                "<?php echo htmlspecialchars($search_query); ?>" साठी शोधलेले निकाल
            </p>
        </div>
        
        <!-- Quick Search Bar -->
        <div class="search-bar-mini" style="max-width: 400px; width: 100%;">
            <?php echo form_open('search', array('method' => 'get', 'class' => 'd-flex gap-2')); ?>
                <input type="text" name="query" placeholder="पुन्हा शोधा..." required class="form-control" style="height: 42px; font-size: 0.9rem; border-radius: 8px;" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="btn btn-primary px-3" style="height: 42px; border-radius: 8px; background: var(--primary-gradient); border: none; white-space: nowrap; font-weight: 600; color: #fff;">
                    शोध
                </button>
            <?php echo form_close(); ?>
        </div>
    </div>

    <!-- Search count and listing -->
    <?php if (!empty($results)): ?>
        <div class="alert alert-success d-flex align-items-center mb-4 py-2 px-3 border-0" style="background: rgba(16, 185, 129, 0.08); color: var(--success-color); border-radius: 8px; font-size: 0.9rem;">
            <span>🎉 एकूण <strong><?php echo count($results); ?></strong> उमेदवार सापडले.</span>
        </div>

        <div class="row g-4">
            <?php foreach ($results as $member): ?>
                <div class="col-md-6 col-lg-6">
                    <div class="dashboard-card h-100" style="max-width: 100%; padding: 24px; border-radius: 16px; border: 1px solid rgba(15, 23, 42, 0.06); background: #ffffff; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04); transition: var(--transition-smooth);">
                        <!-- Header with Photo and Title -->
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3" style="border-bottom: 1px solid rgba(15, 23, 42, 0.06);">
                            <div style="position: relative; width: 65px; height: 65px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1.4rem; border: 2px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; flex-shrink: 0;">
                                <?php if (!empty($member['profile_photo'])): ?>
                                    <img src="<?php echo base_url($member['profile_photo']); ?>" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <?php 
                                    $initials = strtoupper(substr($member['first_name'], 0, 1) . substr($member['last_name'], 0, 1));
                                    echo htmlspecialchars($initials);
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="m-0" style="font-weight: 700; color: var(--text-primary); font-size: 1.25rem;">
                                    <?php echo htmlspecialchars($member['first_name'] . ' ' . $member['middle_name'] . ' ' . $member['last_name']); ?>
                                </h4>
                                <span class="badge bg-light text-secondary border mt-1" style="font-size: 0.75rem; font-weight: 600;">
                                    <?php echo htmlspecialchars($member['relation']); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Candidate info grid -->
                        <div class="profile-details-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px 16px; font-size: 0.88rem;">
                            <div class="detail-item">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Gender</label>
                                <span style="font-weight: 500; color: var(--text-primary);"><?php echo htmlspecialchars($member['gender']); ?></span>
                            </div>
                            <div class="detail-item">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Phone Number</label>
                                <span style="font-weight: 500; color: var(--text-primary);"><?php echo htmlspecialchars($member['phone_number']); ?></span>
                            </div>
                            <div class="detail-item">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Education</label>
                                <span style="font-weight: 500; color: var(--text-primary);"><?php echo htmlspecialchars($member['education']); ?></span>
                            </div>
                            <div class="detail-item">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Occupation</label>
                                <span style="font-weight: 500; color: var(--text-primary);"><?php echo htmlspecialchars($member['occupation']); ?></span>
                            </div>

                            <!-- Conditional occupation details -->
                            <?php if ($member['occupation'] === 'Service'): ?>
                                <div class="detail-item" style="grid-column: span 2;">
                                    <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Company Name</label>
                                    <span style="font-weight: 500; color: var(--text-primary);"><?php echo htmlspecialchars($member['company_name']); ?></span>
                                </div>
                            <?php elseif ($member['occupation'] === 'Business'): ?>
                                <div class="detail-item" style="grid-column: span 2; background: rgba(15, 23, 42, 0.01); padding: 8px; border-radius: 6px; border: 1px solid rgba(15, 23, 42, 0.04);">
                                    <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 4px;">Business Details</label>
                                    <div style="font-size: 0.8rem; color: var(--text-primary); line-height: 1.4;">
                                        <strong>Name:</strong> <?php echo htmlspecialchars($member['business_name']); ?><br>
                                        <strong>Type:</strong> <?php echo htmlspecialchars($member['business_nature']); ?><br>
                                        <strong>Address:</strong> <?php echo htmlspecialchars($member['business_address']); ?><br>
                                        <strong>Email:</strong> <?php echo htmlspecialchars($member['business_email'] ?? 'N/A'); ?><br>
                                        <strong>Phone:</strong> <?php echo htmlspecialchars($member['business_phone'] ?? 'N/A'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Address info -->
                            <div class="detail-item" style="grid-column: span 2; border-top: 1px dashed rgba(15, 23, 42, 0.08); padding-top: 8px; margin-top: 4px;">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Current Address</label>
                                <span style="color: var(--text-primary);">
                                    <?php echo htmlspecialchars($member['address'] ?? 'N/A'); ?>, 
                                    <?php echo htmlspecialchars($member['city'] ?? 'N/A'); ?>, 
                                    <?php echo htmlspecialchars($member['state'] ?? 'N/A'); ?> - 
                                    <?php echo htmlspecialchars($member['pin_code'] ?? 'N/A'); ?>
                                </span>
                            </div>
                            
                            <div class="detail-item" style="grid-column: span 2;">
                                <label style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 600; display: block; margin-bottom: 2px;">Permanent Address</label>
                                <span style="color: var(--text-primary);"><?php echo htmlspecialchars($member['permanent_address'] ?? 'N/A'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <!-- No results layout -->
        <div class="text-center py-5 px-4 rounded-4" style="background: #ffffff; border: 1px solid rgba(15, 23, 42, 0.06); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.02);">
            <div style="font-size: 3rem; margin-bottom: 16px;">🔍</div>
            <h3 style="font-weight: 700; color: var(--text-primary);">कोणताही उमेदवार सापडला नाही</h3>
            <p class="text-secondary mb-4" style="max-width: 480px; margin: 0 auto 24px auto;">
                आम्हाला "<strong><?php echo htmlspecialchars($search_query); ?></strong>" साठी जुळणारे कोणतेही प्रोफाइल सापडले नाही. कृपया वेगळा शब्द किंवा दुसरा पर्याय लिहून पुन्हा शोधून पहा.
            </p>
            <a href="<?php echo base_url(); ?>" class="btn-premium-orange text-decoration-none d-inline-flex" style="padding: 10px 24px;">मुख्यपृष्ठावर जा</a>
        </div>
    <?php endif; ?>
</div>
