<div class="auth-page-wrapper animate-slide-up py-4">
    <div class="container" style="max-width: 800px;">
        <div class="auth-card">
            <div class="auth-header">
                <h2><?php echo $title; ?></h2>
                <p>Please enter the details below securely</p>
            </div>

            <?php echo form_open_multipart('auth/save_member', array('id' => 'memberForm', 'class' => 'auth-form')); ?>
                <input type="hidden" name="member_id" id="form_member_id" value="<?php echo set_value('member_id', isset($member['id']) ? $member['id'] : ''); ?>">
                <input type="hidden" name="is_self" id="form_is_self" value="<?php echo set_value('is_self', $is_self); ?>">

                <!-- Relation and Gender -->
                <div class="form-row-2">
                    <?php if ($is_self == 0): ?>
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
                    <?php else: ?>
                        <input type="hidden" name="relation" value="Self">
                    <?php endif; ?>
                    
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
                
                <?php if ($is_self == 1): ?>
                    <!-- Profile Photo Upload -->
                    <div class="form-group mb-4">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">
                        <?php if (!empty($member['profile_photo'])): ?>
                            <div class="mt-3 d-flex align-items-center gap-3 p-2 rounded border" style="background: rgba(15, 23, 42, 0.02); max-width: max-content;">
                                <img src="<?php echo base_url($member['profile_photo']); ?>" alt="Current Photo" class="img-thumbnail" style="max-height: 80px; object-fit: cover;">
                                <div>
                                    <span style="font-size: 0.8rem; color: var(--text-secondary); display: block;">Current Profile Photo</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Names -->
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

                <!-- Education and Phone Number -->
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

                <!-- Occupation -->
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
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="form_business_name" class="form-label">Business Name</label>
                            <input type="text" name="business_name" id="form_business_name" class="form-control" placeholder="Business Name" value="<?php echo set_value('business_name', isset($member['business_name']) ? $member['business_name'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_business_nature" class="form-label">Business Type/Nature</label>
                            <input type="text" name="business_nature" id="form_business_nature" class="form-control" placeholder="Retail / IT Services" value="<?php echo set_value('business_nature', isset($member['business_nature']) ? $member['business_nature'] : ''); ?>">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="form_business_address" class="form-label">Business Address</label>
                        <textarea name="business_address" id="form_business_address" class="form-control" rows="2" placeholder="Street, City, State, Country"><?php echo set_value('business_address', isset($member['business_address']) ? $member['business_address'] : ''); ?></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary w-auto me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary w-auto">Save Details</button>
                </div>
            <?php echo form_close(); ?>
        </div>
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

        // Reset display
        serviceBlock.style.display = 'none';
        businessBlock.style.display = 'none';
        
        // Remove required attributes by default
        compInput.removeAttribute('required');
        bizNameInput.removeAttribute('required');
        bizNatureInput.removeAttribute('required');
        bizAddrInput.removeAttribute('required');

        if (occ === 'Service') {
            serviceBlock.style.display = 'block';
            compInput.setAttribute('required', 'required');
        } else if (occ === 'Business') {
            businessBlock.style.display = 'block';
            bizNameInput.setAttribute('required', 'required');
            bizNatureInput.setAttribute('required', 'required');
            bizAddrInput.setAttribute('required', 'required');
        }
    }

    // Run on load to set initial state of fields
    window.addEventListener('DOMContentLoaded', () => {
        toggleOccupationFields();
    });
</script>
