<!-- Hero Carousel Section -->
<section id="home">
    <div id="heroCarousel" class="carousel slide carousel-fade carousel-premium" data-bs-ride="carousel" data-bs-interval="6000">
        <!-- Indicators -->
        <div class="carousel-indicators" style="margin-bottom: 24px; z-index: 12;">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 12px; height: 12px; border-radius: 50%; margin: 0 6px;"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2" style="width: 12px; height: 12px; border-radius: 50%; margin: 0 6px;"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3" style="width: 12px; height: 12px; border-radius: 50%; margin: 0 6px;"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active carousel-item-custom" style="background-image: url('<?php echo base_url('assets/images/carousel1.png'); ?>'); background-color: #0f172a;">
                <div class="carousel-overlay">
                    <div class="container">
                        <div class="carousel-content-box">
                            <span class="section-badge">अतूट नाते</span>
                            <h1 class="carousel-title">मराठी <span>विवाह संस्था</span></h1>
                            <p class="carousel-desc">तुमच्या मनासारखा आणि अनुरूप जीवनसाथी शोधण्यासाठी महाराष्ट्रातील सर्वात विश्वसनीय आणि सुरक्षित विवाह नोंदणी प्लॅटफॉर्म.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?php echo base_url('login'); ?>" class="btn-premium-orange text-decoration-none">वर-वधू शोध सुरू करा</a>
                                <a href="#features" class="btn-outline-premium text-decoration-none" style="color: #ffffff; border-color: rgba(255,255,255,0.3);">आमची वैशिष्ट्ये</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item carousel-item-custom" style="background-image: url('<?php echo base_url('assets/images/carousel2.png'); ?>'); background-color: #0f172a;">
                <div class="carousel-overlay">
                    <div class="container">
                        <div class="carousel-content-box">
                            <span class="section-badge">विश्वासू आणि सुरक्षित</span>
                            <h1 class="carousel-title">योग्य <span>वर-वधू शोध</span></h1>
                            <p class="carousel-desc">शिक्षण, नोकरी, व्यवसाय आणि कौटुंबिक पार्श्वभूमीनुसार काळजीपूर्वक पडताळणी केलेले हजारो मराठी प्रोफाईल्स उपलब्ध.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?php echo base_url('register'); ?>" class="btn-premium-orange text-decoration-none">आजच नोंदणी करा</a>
                                <a href="#gallery" class="btn-outline-premium text-decoration-none" style="color: #ffffff; border-color: rgba(255,255,255,0.3);">यशोगाथा पहा</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item carousel-item-custom" style="background-image: url('<?php echo base_url('assets/images/carousel3.png'); ?>'); background-color: #0f172a;">
                <div class="carousel-overlay">
                    <div class="container">
                        <div class="carousel-content-box">
                            <span class="section-badge">कौटुंबिक गोपनीयता</span>
                            <h1 class="carousel-title">सुरक्षित <span>माहिती व्यवस्थापन</span></h1>
                            <p class="carousel-desc">तुमची कौटुंबिक आणि वैयक्तिक माहिती आमच्या सुरक्षित सर्व्हरवर पूर्णपणे सुरक्षित आणि गोपनीय ठेवली जाते.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?php echo base_url('login'); ?>" class="btn-premium-orange text-decoration-none">सुरक्षित लॉग इन</a>
                                <a href="#contact" class="btn-outline-premium text-decoration-none" style="color: #ffffff; border-color: rgba(255,255,255,0.3);">मदत केंद्र</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev border-0 bg-transparent" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="left: 30px;">
            <div class="carousel-controls-custom">
                <span class="fs-4">←</span>
            </div>
            <span class="visually-hidden">मागील</span>
        </button>
        <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="right: 30px;">
            <div class="carousel-controls-custom">
                <span class="fs-4">→</span>
            </div>
            <span class="visually-hidden">पुढील</span>
        </button>
    </div>
</section>

<!-- Features Grid Section -->
<section id="features" class="section-padding">
    <div class="container">
        <div class="section-title-container text-center">
            <span class="section-badge">यशाचे ४ सोपे टप्पे</span>
            <h2 class="section-title">आमची खास वैशिष्ट्ये</h2>
            <p class="section-subtitle">आम्ही तुमच्या जीवनसाथीचा शोध सोपा, सुरक्षित आणि पारदर्शक बनवण्यासाठी कटिबद्ध आहोत.</p>
        </div>

        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <!-- User SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <h4>विनामूल्य नोंदणी</h4>
                    <p class="text-secondary" style="font-size: 0.95rem;">काही मिनिटांत आपले आणि आपल्या कुटुंबाचे प्रोफाइल तयार करा आणि शोध सुरू करा.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <!-- Check-Circle SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h4>पडताळलेले प्रोफाईल्स</h4>
                    <p class="text-secondary" style="font-size: 0.95rem;">प्रत्येक सदस्याची माहिती आणि कौटुंबिक पार्श्वभूमी सखोलपणे पडताळून पाहिली जाते.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <!-- Heart SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                    <h4>कौटुंबिक प्राधान्य</h4>
                    <p class="text-secondary" style="font-size: 0.95rem;">शिक्षण, नोकरी, व्यवसाय आणि कौटुंबिक मूल्यानुसार अचूक जुळणारे प्रोफाईल्स पहा.</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <!-- Shield SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <h4>१००% गोपनीयता</h4>
                    <p class="text-secondary" style="font-size: 0.95rem;">तुमचे फोटो आणि संपर्क क्रमांक कोणाला दाखवायचे याचे पूर्ण नियंत्रण तुमच्याकडे असते.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="section-padding" style="background-color: #ffffff;">
    <div class="container">
        <div class="section-title-container text-center">
            <span class="section-badge">आनंदी यशोगाथा</span>
            <h2 class="section-title">आमचे आनंदी जोडपे</h2>
            <p class="section-subtitle">आमच्या विवाह संस्थेच्या माध्यमातून रेशीमगाठी जुळलेले आणि आनंदी संसार करणारे मराठी जोडपे.</p>
        </div>

        <div class="gallery-grid">
            <!-- Gallery Item 1 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery1.png'); ?>', 'अमित आणि स्नेहल', 'पुणे - सॉफ्टवेअर इंजिनिअर जोडपे, लग्नाच्या हार्दिक शुभेच्छा!')">
                <img src="<?php echo base_url('assets/images/gallery1.png'); ?>" alt="यशोगाथा १" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Data+Analytics'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">पुणे</span>
                    <h4 class="gallery-title">अमित आणि स्नेहल</h4>
                    <p class="gallery-desc">सॉफ्टवेअर इंजिनिअर जोडपे</p>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery2.png'); ?>', 'राहुल आणि प्रियांका', 'मुंबई - व्यवसाय आणि शिक्षण क्षेत्रात कार्यरत जोडपे.')">
                <img src="<?php echo base_url('assets/images/gallery2.png'); ?>" alt="यशोगाथा २" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Security+Scanning'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">मुंबई</span>
                    <h4 class="gallery-title">राहुल आणि प्रियांका</h4>
                    <p class="gallery-desc">व्यवसायी आणि शिक्षिका</p>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery3.png'); ?>', 'रोहित आणि पूजा', 'नाशिक - आनंदी कौटुंबिक आयुष्याची नवी सुरुवात.')">
                <img src="<?php echo base_url('assets/images/gallery3.png'); ?>" alt="यशोगाथा ३" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Workspace+Setup'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">नाशिक</span>
                    <h4 class="gallery-title">रोहित आणि पूजा</h4>
                    <p class="gallery-desc">बँकिंग क्षेत्रात कार्यरत</p>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery4.png'); ?>', 'विकास आणि स्वाती', 'छत्रपती संभाजीनगर - एकाच क्षेत्रात काम करणारे जोडपे.')">
                <img src="<?php echo base_url('assets/images/gallery4.png'); ?>" alt="यशोगाथा ४" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Cloud+Server'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">संभाजीनगर</span>
                    <h4 class="gallery-title">विकास आणि स्वाती</h4>
                    <p class="gallery-desc">शासकीय सेवा अधिकारी</p>
                </div>
            </div>

            <!-- Gallery Item 5 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery5.png'); ?>', 'अभिषेक आणि सायली', 'नागपूर - सुंदर सहजीवनाची रेशीमगाठ.')">
                <img src="<?php echo base_url('assets/images/gallery5.png'); ?>" alt="यशोगाथा ५" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Mobile+UI+Dashboard'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">नागपूर</span>
                    <h4 class="gallery-title">अभिषेक आणि सायली</h4>
                    <p class="gallery-desc">वैद्यकीय डॉक्टर जोडपे</p>
                </div>
            </div>

            <!-- Gallery Item 6 -->
            <div class="gallery-card" onclick="openLightbox('<?php echo base_url('assets/images/gallery6.png'); ?>', 'मनोज आणि निकिता', 'कोल्हापूर - पारंपरिक मराठी विवाह सोहळा.')">
                <img src="<?php echo base_url('assets/images/gallery6.png'); ?>" alt="यशोगाथा ६" class="gallery-img" onerror="this.src='https://placehold.co/600x400/ff6b00/ffffff?text=Relational+Nodes'">
                <div class="gallery-overlay">
                    <span class="gallery-tag">कोल्हापूर</span>
                    <h4 class="gallery-title">मनोज आणि निकिता</h4>
                    <p class="gallery-desc">कृषी उद्योजक जोडपे</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="section-padding">
    <div class="container">
        <div class="section-title-container text-center">
            <span class="section-badge">मदत आणि सहकार्य</span>
            <h2 class="section-title">आमच्याशी संपर्क साधा</h2>
            <p class="section-subtitle">जोडीदार शोधताना येणाऱ्या अडचणींविषयी किंवा इतर चौकशीसाठी आमच्याशी संपर्क साधा.</p>
        </div>

        <div class="contact-container">
            <div class="row g-0">
                <!-- Info Panel -->
                <div class="col-lg-5">
                    <div class="contact-info-panel">
                        <div>
                            <h3 class="mb-4" style="font-weight: 800; color: #ffffff;">संपर्क माहिती</h3>
                            <p style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 40px;">
                                तुमच्या शंकांचे निरसन करण्यासाठी आमच्या ग्राहक सेवा केंद्राशी खालील पत्त्यावर किंवा फोनवर संपर्क साधा.
                            </p>

                            <!-- Address -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <!-- Map-pin SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="contact-info-text">
                                    <h5>कार्यालयाचा पत्ता</h5>
                                    <p>४५६ डेक्कन जिमखाना, संभाजी पार्क जवळ, पुणे - ४११००४</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <!-- Mail SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </div>
                                <div class="contact-info-text">
                                    <h5>ईमेल पत्ता</h5>
                                    <p>help@marathivivah.com</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <!-- Phone SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </div>
                                <div class="contact-info-text">
                                    <h5>फोन सपोर्ट</h5>
                                    <p>+91 ९८७६५४३२१०</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="contact-socials">
                                <a href="#" class="social-btn">𝕏</a>
                                <a href="#" class="social-btn">f</a>
                                <a href="#" class="social-btn">in</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="col-lg-7">
                    <div class="contact-form-panel">
                        <h3 class="mb-4" style="font-weight: 800;">संदेश पाठवा</h3>
                        
                        <?php echo form_open('home', ['id' => 'contactForm']); ?>
                            <!-- Full Name -->
                            <div class="form-floating-custom">
                                <label class="form-label-custom" for="contact_name">पूर्ण नाव</label>
                                <input type="text" name="name" id="contact_name" class="form-control-custom <?php echo form_error('name') ? 'border-danger' : ''; ?>" placeholder="अमित पाटील" value="<?php echo set_value('name'); ?>" required>
                                <?php echo form_error('name'); ?>
                            </div>

                            <!-- Email Address -->
                            <div class="form-floating-custom">
                                <label class="form-label-custom" for="contact_email">ईमेल पत्ता</label>
                                <input type="email" name="email" id="contact_email" class="form-control-custom <?php echo form_error('email') ? 'border-danger' : ''; ?>" placeholder="amit@email.com" value="<?php echo set_value('email'); ?>" required>
                                <?php echo form_error('email'); ?>
                            </div>

                            <!-- Subject -->
                            <div class="form-floating-custom">
                                <label class="form-label-custom" for="contact_subject">विषय</label>
                                <input type="text" name="subject" id="contact_subject" class="form-control-custom <?php echo form_error('subject') ? 'border-danger' : ''; ?>" placeholder="नोंदणी विषयी चौकशी" value="<?php echo set_value('subject'); ?>" required>
                                <?php echo form_error('subject'); ?>
                            </div>

                            <!-- Message Content -->
                            <div class="form-floating-custom">
                                <label class="form-label-custom" for="contact_message">तुमचा संदेश</label>
                                <textarea name="message" id="contact_message" rows="5" class="form-control-custom <?php echo form_error('message') ? 'border-danger' : ''; ?>" placeholder="तुमचा सविस्तर संदेश येथे टाईप करा..." style="resize: none;" required><?php echo set_value('message'); ?></textarea>
                                <?php echo form_error('message'); ?>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-premium-orange w-100 py-3 mt-2">संदेश पाठवा</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Map Section -->
<section id="map" class="section-padding" style="background-color: #ffffff; border-bottom: 1px solid rgba(15, 23, 42, 0.04);">
    <div class="container">
        <div class="section-title-container text-center">
            <span class="section-badge">आमचे कार्यालय</span>
            <h2 class="section-title">मुख्य कार्यालय नकाशा</h2>
            <p class="section-subtitle">महाराष्ट्राच्या सांस्कृतिक राजधानीत, डेक्कन जिमखाना पुणे येथे आम्हाला भेट द्या.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="map-card">
                    <div class="map-container">
                        <!-- OpenStreetMap Interactive Iframe Centered around Deccan Gymkhana, Pune -->
                        <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=73.8340%2C18.5100%2C73.8540%2C18.5280&amp;layer=mapnik&amp;marker=18.5190%2C73.8440" title="मराठी विवाह कार्यालय पुणे स्थान नकाशा"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal for Gallery Images -->
<script>
    function openLightbox(imgSrc, title, desc) {
        Swal.fire({
            title: `<span style="font-size: 1.5rem; font-weight:800; color:#0f172a;">${title}</span>`,
            html: `<div style="text-align: left; color:#475569; font-size:1rem; margin-top:8px;">${desc}</div>`,
            imageUrl: imgSrc,
            imageAlt: title,
            imageWidth: '100%',
            imageHeight: 'auto',
            confirmButtonText: 'बंद करा',
            confirmButtonColor: '#f97316',
            customClass: {
                popup: 'rounded-4 overflow-hidden border-0'
            }
        });
    }
</script>
