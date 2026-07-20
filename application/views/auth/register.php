<div class="auth-page-wrapper animate-slide-up">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header text-center mb-4">
                <h2>Create Account</h2>
                <p class="text-secondary">Join the portal and manage your data securely</p>
            </div>

            <?php echo form_open('register', array('class' => 'auth-form')); ?>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe" value="<?php echo set_value('name'); ?>" class="form-control <?php echo form_error('name') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('name'); ?>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="9876543210" value="<?php echo set_value('phone'); ?>" class="form-control <?php echo form_error('phone') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('phone'); ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="john.doe@example.com" value="<?php echo set_value('email'); ?>" class="form-control <?php echo form_error('email') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('email'); ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="form-control <?php echo form_error('password') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('password'); ?>
                </div>

                <div class="mb-4">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirm" id="password_confirm" placeholder="••••••••" class="form-control <?php echo form_error('password_confirm') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('password_confirm'); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <span>Register Securely</span>
                </button>

            <?php echo form_close(); ?>

            <div class="auth-footer text-center mt-4">
                <p>Already have an account? <a href="<?php echo base_url('login'); ?>">Sign In</a></p>
            </div>
        </div>
    </div>
</div>

