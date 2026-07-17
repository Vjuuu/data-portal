<div class="auth-page-wrapper animate-slide-up">
    <div class="auth-container-split">
        <div class="auth-card-split">
            <div class="row g-0">
                <!-- Left Side: Form -->
                <div class="col-lg-6 auth-form-side">
                    <div class="auth-header text-start mb-4">
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

                    <div class="auth-footer text-start mt-4">
                        <p>Don't have an account yet? <a href="<?php echo base_url('register'); ?>">Register Here</a></p>
                    </div>
                </div>

                <!-- Right Side: Matrimony Info (Marathi) -->
                <div class="col-lg-6 d-none d-lg-flex auth-info-side">
                    <div class="auth-info-content">
                        <div class="auth-info-brand">
                            <span class="brand-dot"></span> मराठीविवाह
                        </div>
                        <h3>मराठी विवाह संस्था</h3>
                        <p class="auth-info-tagline">रेशीमगाठी जुळवणारे विश्वसनीय आणि सुरक्षित माध्यम</p>
                        
                        <div class="auth-info-features">
                            <div class="feature-item">
                                <span class="feature-icon">✓</span>
                                <div class="feature-text">१००% पडताळणी केलेले प्रोफाईल्स</div>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">✓</span>
                                <div class="feature-text">सुरक्षित आणि गोपनीय माहिती व्यवस्थापन</div>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">✓</span>
                                <div class="feature-text">तुमच्या आवडीनुसार योग्य जोडीदार शोधण्याची सुविधा</div>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">✓</span>
                                <div class="feature-text">सोपी आणि विनामूल्य नोंदणी प्रक्रिया</div>
                            </div>
                        </div>
                        
                        <div class="auth-info-footer">
                            <p>हजारो यशस्वी विवाहगाठी! आजच सामील व्हा आणि आपल्या योग्य जीवनसाथीचा शोध सुरू करा.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
