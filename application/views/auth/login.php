<div class="auth-page-wrapper animate-slide-up">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header text-center mb-4">
                <h2>Welcome Back</h2>
                <p class="text-secondary">Enter your details to log in to your dashboard</p>
            </div>

            <?php echo form_open('login', array('class' => 'auth-form')); ?>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="john.doe@example.com" value="<?php echo set_value('email'); ?>" class="form-control <?php echo form_error('email') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('email'); ?>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="form-control <?php echo form_error('password') ? 'input-error' : ''; ?>" required>
                    <?php echo form_error('password'); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <span>Access Portal</span>
                </button>

            <?php echo form_close(); ?>

            <div class="auth-footer text-center mt-4">
                <p>Don't have an account yet? <a href="<?php echo base_url('register'); ?>">Register Here</a></p>
            </div>
        </div>
    </div>
</div>

