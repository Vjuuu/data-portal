    <!-- Footer Section -->
    <footer class="footer-premium">
        <div class="container">
            <div class="row g-4">
                <!-- Column 1: Brand details -->
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand-custom mb-3" href="#" style="color: #ffffff;">
                        <span class="brand-dot"></span> मराठीविवाह
                    </a>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 15px; max-width: 320px;">
                        महाराष्ट्रातील सर्वात विश्वसनीय आणि सुरक्षित विवाह नोंदणी प्लॅटफॉर्म. सुयोग्य आणि अनुरूप जोडीदाराचा शोध आता अगदी सोपा.
                    </p>
                    <div class="contact-socials mt-4">
                        <a href="#" class="social-btn">𝕏</a>
                        <a href="#" class="social-btn">f</a>
                        <a href="#" class="social-btn">in</a>
                        <a href="#" class="social-btn">ig</a>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-widget-title">जलद लिंक्स</h5>
                    <ul class="footer-links">
                        <li><a href="<?php echo base_url('#home'); ?>">मुख्यपृष्ठ</a></li>
                        <li><a href="<?php echo base_url('#features'); ?>">वैशिष्ट्ये</a></li>
                        <li><a href="<?php echo base_url('#gallery'); ?>">यशोगाथा</a></li>
                        <li><a href="<?php echo base_url('#contact'); ?>">संपर्क</a></li>
                        <li><a href="<?php echo base_url('#map'); ?>">कार्यालय</a></li>
                    </ul>
                </div>

                <!-- Column 3: Secure Services -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-widget-title">वापरकर्ता प्रवेश</h5>
                    <ul class="footer-links">
                        <li><a href="<?php echo base_url('login'); ?>">लॉग इन</a></li>
                        <li><a href="<?php echo base_url('register'); ?>">नोंदणी करा</a></li>
                        <li><a href="<?php echo base_url('dashboard'); ?>">डॅशबोर्ड</a></li>
                        <li><a href="#">गोपनीयता धोरण</a></li>
                        <li><a href="#">वापराच्या अटी</a></li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-widget-title">अपडेट्स मिळवा</h5>
                    <p style="color: #94a3b8; font-size: 0.95rem; mb-3">नवीन प्रोफाईल्स आणि विवाह मार्गदर्शनाचे अपडेट्स मिळवण्यासाठी आजच नोंदणी करा.</p>
                    <form action="javascript:void(0);" onsubmit="subscribeAlert()" class="mt-3">
                        <div class="d-flex gap-2">
                            <input type="email" placeholder="तुमचा ईमेल पत्ता" required class="form-control-custom" style="padding: 10px 14px; background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.1); color: #ffffff;">
                            <button type="submit" class="btn-premium-orange" style="padding: 10px 20px;">जॉइन</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="row footer-bottom">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="footer-copyright">
                        &copy; <?php echo date('Y'); ?> मराठीविवाह. सर्व हक्क राखीव. सुयोग्य आणि सुरक्षित सोबती शोध.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p style="color: #64748b; font-size: 0.9rem; margin: 0;">
                        सुरक्षितता: SSL/TLS द्वारे कूटबद्ध (Encrypted)
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Public Page Animations and Actions Script -->
    <script>
        // Scroll progress bar logic
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('scroll-progress').style.width = scrolled + '%';

            // Navbar shadow & size shrink on scroll
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Scroll spy highlighting
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link-custom');
            
            let currentSectionId = 'home';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                if (window.pageYOffset >= sectionTop) {
                    currentSectionId = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href && (href === '#' + currentSectionId || href.endsWith('#' + currentSectionId))) {
                    link.classList.add('active');
                }
            });
        });

        // Newsletter subscription alert
        function subscribeAlert() {
            Swal.fire({
                title: 'सबस्क्राईब केले!',
                text: 'अपडेट्स मिळवण्यासाठी सबस्क्राईब केल्याबद्दल धन्यवाद.',
                icon: 'success',
                confirmButtonColor: '#f97316'
            });
        }
    </script>
</body>
</html>
