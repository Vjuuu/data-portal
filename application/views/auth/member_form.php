<!-- Load Dashboard Specific Stylesheet -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Premium Dynamic Background elements -->
<div class="bg-glow bg-glow-1"></div>
<div class="bg-glow bg-glow-2"></div>

<div class="container" style="margin-top: 120px; margin-bottom: 60px; max-width: 800px; position: relative; z-index: 1;">
    <div class="auth-card animate-slide-up">
        <div class="auth-header">
            <h2><?php echo $title; ?></h2>
            <p>Please enter the details below securely</p>
        </div>

        <?php echo form_open_multipart('auth/save_member', array('id' => 'memberForm', 'class' => 'auth-form')); ?>
            <input type="hidden" name="member_id" id="form_member_id" value="<?php echo set_value('member_id', isset($member['id']) ? $member['id'] : ''); ?>">
            <input type="hidden" name="is_self" id="form_is_self" value="<?php echo set_value('is_self', $is_self); ?>">

            <?php if ($is_self == 1): ?>
                <!-- ==========================================
                     STEP-BY-STEP LAYOUT: MY DETAILS (SELF)
                     ========================================== -->
                <input type="hidden" name="relation" value="Self">

                <!-- Step 1: Name -->
                <div class="form-step-section">
                    <div class="form-row-3">
                        <div class="form-group">
                            <label for="form_first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="form_first_name" class="form-control" required placeholder="John" value="<?php echo set_value('first_name', isset($member['first_name']) ? $member['first_name'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="form_middle_name" class="form-control" placeholder="M." value="<?php echo set_value('middle_name', isset($member['middle_name']) ? $member['middle_name'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="form_last_name" class="form-control" required placeholder="Doe" value="<?php echo set_value('last_name', isset($member['last_name']) ? $member['last_name'] : ''); ?>">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Profile Image -->
                <div class="form-step-section">
                    <div class="profile-upload-container d-flex flex-column flex-sm-row align-items-center gap-4">
                        <div class="profile-preview-wrapper" style="position: relative; width: 100px; height: 100px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 2.2rem; border: 3px solid #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.12); overflow: hidden; flex-shrink: 0;">
                            <?php if (!empty($member['profile_photo'])): ?>
                                <img id="profile_photo_preview" src="<?php echo base_url($member['profile_photo']); ?>" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <span id="profile_photo_placeholder">
                                    <?php 
                                    $initials = '';
                                    if (!empty($member['first_name'])) {
                                        $initials = strtoupper(substr($member['first_name'], 0, 1));
                                    }
                                    if (!empty($member['last_name'])) {
                                        $initials .= strtoupper(substr($member['last_name'], 0, 1));
                                    }
                                    echo htmlspecialchars($initials ? $initials : 'U');
                                    ?>
                                </span>
                                <img id="profile_photo_preview" src="" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <?php endif; ?>
                        </div>
                        
                        <div class="profile-upload-controls flex-grow-1 w-100">
                            <label for="profile_photo" class="form-label">Select Image File</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <div class="form-text mt-2" style="font-size: 0.8rem; color: var(--text-secondary);">
                                Supports JPG, PNG, GIF. Max file size 2MB.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Gender -->
                <div class="form-step-section">
                    <div class="form-group">
                        <label for="form_gender" class="form-label">Gender</label>
                        <select name="gender" id="form_gender" class="form-select" required>
                            <?php 
                            $selected_gender = set_value('gender', isset($member['gender']) ? $member['gender'] : 'Male');
                            $genders = array('Male', 'Female', 'Other');
                            foreach ($genders as $gen):
                                $selected = ($selected_gender === $gen) ? 'selected' : '';
                                echo "<option value=\"$gen\" $selected>$gen</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Step 4: Education & Contact -->
                <div class="form-step-section">
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="form_education" class="form-label">Education</label>
                            <input type="text" name="education" id="form_education" class="form-control" required placeholder="e.g. Graduate" value="<?php echo set_value('education', isset($member['education']) ? $member['education'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="form_phone_number" class="form-control" required placeholder="e.g. 9876543210" value="<?php echo set_value('phone_number', isset($member['phone_number']) ? $member['phone_number'] : ''); ?>">
                        </div>
                    </div>
                </div>

                <!-- Step 5: Address Details -->
                <div class="form-step-section">
                    <div class="form-group mb-3">
                        <label for="form_address" class="form-label">Current Address</label>
                        <textarea name="address" id="form_address" class="form-control" rows="2" required placeholder="Street Address, Area, etc."><?php echo set_value('address', isset($member['address']) ? $member['address'] : ''); ?></textarea>
                    </div>
                    <div class="form-row-3">
                        <div class="form-group">
                            <label for="form_city" class="form-label">City</label>
                            <input type="text" name="city" id="form_city" class="form-control" required placeholder="e.g. Pune" value="<?php echo set_value('city', isset($member['city']) ? $member['city'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_state" class="form-label">State</label>
                            <input type="text" name="state" id="form_state" class="form-control" required placeholder="e.g. Maharashtra" value="<?php echo set_value('state', isset($member['state']) ? $member['state'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_pin_code" class="form-label">Pin Code</label>
                            <input type="text" name="pin_code" id="form_pin_code" class="form-control" required placeholder="e.g. 411001" value="<?php echo set_value('pin_code', isset($member['pin_code']) ? $member['pin_code'] : ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group mt-3 mb-2 d-flex align-items-center gap-2">
                        <input type="checkbox" id="same_address_check" onchange="copyAddress()" style="width: auto; cursor: pointer;">
                        <label for="same_address_check" style="font-size: 0.85rem; font-weight: 600; color: var(--text-secondary); cursor: pointer; text-transform: none; margin: 0;">Permanent address same as current address</label>
                    </div>

                    <div class="form-group">
                        <label for="form_permanent_address" class="form-label">Permanent Address</label>
                        <textarea name="permanent_address" id="form_permanent_address" class="form-control" rows="2" required placeholder="Permanent Street Address, Area, etc."><?php echo set_value('permanent_address', isset($member['permanent_address']) ? $member['permanent_address'] : ''); ?></textarea>
                    </div>
                </div>

                <!-- Step 6: Professional Background -->
                <div class="form-step-section">
                    <div class="form-group mb-3">
                        <label for="form_occupation" class="form-label">Occupation</label>
                        <select name="occupation" id="form_occupation" class="form-select" onchange="toggleOccupationFields()" required>
                            <?php 
                            $selected_occ = set_value('occupation', isset($member['occupation']) ? $member['occupation'] : 'Retired');
                            $occupations = array('Retired', 'Housewife', 'Service', 'Business');
                            foreach ($occupations as $occ):
                                $selected = ($selected_occ === $occ) ? 'selected' : '';
                                echo "<option value=\"$occ\" $selected>$occ</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <!-- Conditional Service Field -->
                    <div class="form-group mb-3" id="service_fields" style="display: none;">
                        <label for="form_company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" id="form_company_name" class="form-control" placeholder="Company Corp Inc." value="<?php echo set_value('company_name', isset($member['company_name']) ? $member['company_name'] : ''); ?>">
                    </div>

                    <!-- Conditional Business Fields -->
                    <div id="business_fields" style="display: none;">
                        <div class="form-row-2 mb-3">
                            <div class="form-group">
                                <label for="form_business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" id="form_business_name" class="form-control" placeholder="Business Name" value="<?php echo set_value('business_name', isset($member['business_name']) ? $member['business_name'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="form_business_nature" class="form-label">Business Type/Nature</label>
                                <input type="text" name="business_nature" id="form_business_nature" class="form-control" placeholder="Retail / IT Services" value="<?php echo set_value('business_nature', isset($member['business_nature']) ? $member['business_nature'] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-row-2 mb-3">
                            <div class="form-group">
                                <label for="form_business_email" class="form-label">Business Email</label>
                                <input type="email" name="business_email" id="form_business_email" class="form-control" placeholder="business@example.com" value="<?php echo set_value('business_email', isset($member['business_email']) ? $member['business_email'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="form_business_phone" class="form-label">Business Phone No</label>
                                <input type="text" name="business_phone" id="form_business_phone" class="form-control" placeholder="e.g. 0221234567" value="<?php echo set_value('business_phone', isset($member['business_phone']) ? $member['business_phone'] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form_business_address" class="form-label">Business Address</label>
                            <textarea name="business_address" id="form_business_address" class="form-control" rows="2" placeholder="Street, City, State, Country"><?php echo set_value('business_address', isset($member['business_address']) ? $member['business_address'] : ''); ?></textarea>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- ==========================================
                     STEP-BY-STEP LAYOUT: FAMILY MEMBER
                     ========================================== -->
                <!-- Step 1: Relation and Gender -->
                <div class="form-step-section">
                    <div class="form-row-2">
                        <div class="form-group" id="relation_group">
                            <label for="form_relation" class="form-label">Relation</label>
                            <select name="relation" id="form_relation" class="form-select">
                                <?php 
                                $selected_rel = set_value('relation', isset($member['relation']) ? $member['relation'] : 'Wife');
                                $relations = array('Wife', 'Son', 'Daughter', "Son's Wife", 'Grandson', 'Husband', 'Father', 'Mother');
                                foreach ($relations as $rel):
                                    $selected = ($selected_rel === $rel) ? 'selected' : '';
                                    echo "<option value=\"$rel\" $selected>$rel</option>";
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="form_gender" class="form-label">Gender</label>
                            <select name="gender" id="form_gender" class="form-select" required>
                                <?php 
                                $selected_gender = set_value('gender', isset($member['gender']) ? $member['gender'] : 'Male');
                                $genders = array('Male', 'Female', 'Other');
                                foreach ($genders as $gen):
                                    $selected = ($selected_gender === $gen) ? 'selected' : '';
                                    echo "<option value=\"$gen\" $selected>$gen</option>";
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Name -->
                <div class="form-step-section">
                    <div class="form-row-3">
                        <div class="form-group">
                            <label for="form_first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="form_first_name" class="form-control" required placeholder="John" value="<?php echo set_value('first_name', isset($member['first_name']) ? $member['first_name'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="form_middle_name" class="form-control" placeholder="M." value="<?php echo set_value('middle_name', isset($member['middle_name']) ? $member['middle_name'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="form_last_name" class="form-control" required placeholder="Doe" value="<?php echo set_value('last_name', isset($member['last_name']) ? $member['last_name'] : ''); ?>">
                        </div>
                    </div>
                </div>

                <!-- Profile Photo Upload -->
                <div class="form-step-section">
                    <div class="profile-upload-container d-flex flex-column flex-sm-row align-items-center gap-4">
                        <div class="profile-preview-wrapper" style="position: relative; width: 100px; height: 100px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 2.2rem; border: 3px solid #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.12); overflow: hidden; flex-shrink: 0;">
                            <?php if (!empty($member['profile_photo'])): ?>
                                <img id="profile_photo_preview" src="<?php echo base_url($member['profile_photo']); ?>" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <span id="profile_photo_placeholder">
                                    <?php 
                                    $initials = '';
                                    if (!empty($member['first_name'])) {
                                        $initials = strtoupper(substr($member['first_name'], 0, 1));
                                    }
                                    if (!empty($member['last_name'])) {
                                        $initials .= strtoupper(substr($member['last_name'], 0, 1));
                                    }
                                    echo htmlspecialchars($initials ? $initials : 'U');
                                    ?>
                                </span>
                                <img id="profile_photo_preview" src="" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <?php endif; ?>
                        </div>
                        
                        <div class="profile-upload-controls flex-grow-1 w-100">
                            <label for="profile_photo" class="form-label">Select Image File</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <div class="form-text mt-2" style="font-size: 0.8rem; color: var(--text-secondary);">
                                Supports JPG, PNG, GIF. Max file size 2MB.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Education & Contact -->
                <div class="form-step-section">
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="form_education" class="form-label">Education</label>
                            <input type="text" name="education" id="form_education" class="form-control" required placeholder="e.g. Graduate" value="<?php echo set_value('education', isset($member['education']) ? $member['education'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="form_phone_number" class="form-control" required placeholder="e.g. 9876543210" value="<?php echo set_value('phone_number', isset($member['phone_number']) ? $member['phone_number'] : ''); ?>">
                        </div>
                    </div>
                </div>

                <!-- Step 4: Address Details -->
                <div class="form-step-section">
                    <div class="form-group mb-3">
                        <label for="form_address" class="form-label">Current Address</label>
                        <textarea name="address" id="form_address" class="form-control" rows="2" required placeholder="Street Address, Area, etc."><?php echo set_value('address', isset($member['address']) ? $member['address'] : ''); ?></textarea>
                    </div>
                    <div class="form-row-3">
                        <div class="form-group">
                            <label for="form_city" class="form-label">City</label>
                            <input type="text" name="city" id="form_city" class="form-control" required placeholder="e.g. Pune" value="<?php echo set_value('city', isset($member['city']) ? $member['city'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_state" class="form-label">State</label>
                            <input type="text" name="state" id="form_state" class="form-control" required placeholder="e.g. Maharashtra" value="<?php echo set_value('state', isset($member['state']) ? $member['state'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_pin_code" class="form-label">Pin Code</label>
                            <input type="text" name="pin_code" id="form_pin_code" class="form-control" required placeholder="e.g. 411001" value="<?php echo set_value('pin_code', isset($member['pin_code']) ? $member['pin_code'] : ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group mt-3 mb-2 d-flex align-items-center gap-2">
                        <input type="checkbox" id="same_address_check" onchange="copyAddress()" style="width: auto; cursor: pointer;">
                        <label for="same_address_check" style="font-size: 0.85rem; font-weight: 600; color: var(--text-secondary); cursor: pointer; text-transform: none; margin: 0;">Permanent address same as current address</label>
                    </div>

                    <div class="form-group">
                        <label for="form_permanent_address" class="form-label">Permanent Address</label>
                        <textarea name="permanent_address" id="form_permanent_address" class="form-control" rows="2" required placeholder="Permanent Street Address, Area, etc."><?php echo set_value('permanent_address', isset($member['permanent_address']) ? $member['permanent_address'] : ''); ?></textarea>
                    </div>
                </div>

                <!-- Step 5: Professional Background -->
                <div class="form-step-section">
                    <div class="form-group mb-3">
                        <label for="form_occupation" class="form-label">Occupation</label>
                        <select name="occupation" id="form_occupation" class="form-select" onchange="toggleOccupationFields()" required>
                            <?php 
                            $selected_occ = set_value('occupation', isset($member['occupation']) ? $member['occupation'] : 'Retired');
                            $occupations = array('Retired', 'Housewife', 'Service', 'Business');
                            foreach ($occupations as $occ):
                                $selected = ($selected_occ === $occ) ? 'selected' : '';
                                echo "<option value=\"$occ\" $selected>$occ</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <!-- Conditional Service Field -->
                    <div class="form-group mb-3" id="service_fields" style="display: none;">
                        <label for="form_company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" id="form_company_name" class="form-control" placeholder="Company Corp Inc." value="<?php echo set_value('company_name', isset($member['company_name']) ? $member['company_name'] : ''); ?>">
                    </div>

                    <!-- Conditional Business Fields -->
                    <div id="business_fields" style="display: none;">
                        <div class="form-row-2 mb-3">
                            <div class="form-group">
                                <label for="form_business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" id="form_business_name" class="form-control" placeholder="Business Name" value="<?php echo set_value('business_name', isset($member['business_name']) ? $member['business_name'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="form_business_nature" class="form-label">Business Type/Nature</label>
                                <input type="text" name="business_nature" id="form_business_nature" class="form-control" placeholder="Retail / IT Services" value="<?php echo set_value('business_nature', isset($member['business_nature']) ? $member['business_nature'] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-row-2 mb-3">
                            <div class="form-group">
                                <label for="form_business_email" class="form-label">Business Email</label>
                                <input type="email" name="business_email" id="form_business_email" class="form-control" placeholder="business@example.com" value="<?php echo set_value('business_email', isset($member['business_email']) ? $member['business_email'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="form_business_phone" class="form-label">Business Phone No</label>
                                <input type="text" name="business_phone" id="form_business_phone" class="form-control" placeholder="e.g. 0221234567" value="<?php echo set_value('business_phone', isset($member['business_phone']) ? $member['business_phone'] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form_business_address" class="form-label">Business Address</label>
                            <textarea name="business_address" id="form_business_address" class="form-control" rows="2" placeholder="Street, City, State, Country"><?php echo set_value('business_address', isset($member['business_address']) ? $member['business_address'] : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-end mt-4 gap-2">
                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary w-auto px-4" style="background: rgba(15, 23, 42, 0.05); color: var(--text-primary); border: 1px solid rgba(15, 23, 42, 0.1);">Cancel</a>
                <button type="submit" class="btn btn-primary w-auto px-4" style="background: var(--primary-gradient); color: #fff;">Save Details</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    function toggleOccupationFields() {
        const occ = document.getElementById('form_occupation').value;
        const serviceBlock = document.getElementById('service_fields');
        const businessBlock = document.getElementById('business_fields');
        
        const compInput = document.getElementById('form_company_name');
        const bizNameInput = document.getElementById('form_business_name');
        const bizNatureInput = document.getElementById('form_business_nature');
        const bizAddrInput = document.getElementById('form_business_address');
        const bizEmailInput = document.getElementById('form_business_email');
        const bizPhoneInput = document.getElementById('form_business_phone');

        // Reset display
        if (serviceBlock) serviceBlock.style.display = 'none';
        if (businessBlock) businessBlock.style.display = 'none';
        
        // Remove required attributes by default
        if (compInput) compInput.removeAttribute('required');
        if (bizNameInput) bizNameInput.removeAttribute('required');
        if (bizNatureInput) bizNatureInput.removeAttribute('required');
        if (bizAddrInput) bizAddrInput.removeAttribute('required');
        if (bizEmailInput) bizEmailInput.removeAttribute('required');
        if (bizPhoneInput) bizPhoneInput.removeAttribute('required');

        if (occ === 'Service') {
            if (serviceBlock) serviceBlock.style.display = 'block';
            if (compInput) compInput.setAttribute('required', 'required');
        } else if (occ === 'Business') {
            if (businessBlock) businessBlock.style.display = 'block';
            if (bizNameInput) bizNameInput.setAttribute('required', 'required');
            if (bizNatureInput) bizNatureInput.setAttribute('required', 'required');
            if (bizAddrInput) bizAddrInput.setAttribute('required', 'required');
            if (bizEmailInput) bizEmailInput.setAttribute('required', 'required');
            if (bizPhoneInput) bizPhoneInput.setAttribute('required', 'required');
        }
    }

    function copyAddress() {
        const checkbox = document.getElementById('same_address_check');
        const currentAddr = document.getElementById('form_address').value;
        const permAddr = document.getElementById('form_permanent_address');
        
        if (checkbox && checkbox.checked && permAddr) {
            permAddr.value = currentAddr;
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('profile_photo_preview');
        const placeholder = document.getElementById('profile_photo_placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.style.width = '100%';
                    preview.style.height = '100%';
                    preview.style.objectFit = 'cover';
                }
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Run on load to set initial state of fields
    window.addEventListener('DOMContentLoaded', () => {
        toggleOccupationFields();
        
        // Add dynamic address syncing when typing
        const currentAddrInput = document.getElementById('form_address');
        if (currentAddrInput) {
            currentAddrInput.addEventListener('input', function() {
                const checkbox = document.getElementById('same_address_check');
                const permAddr = document.getElementById('form_permanent_address');
                if (checkbox && checkbox.checked && permAddr) {
                    permAddr.value = this.value;
                }
            });
        }
    });
</script>
