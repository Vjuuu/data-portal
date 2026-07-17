    </div> <!-- .container -->
    
    <div class="footer-credit">
        &copy; <?php echo date('Y'); ?> Secure Data Portal. All rights reserved. Designed with premium security standards.
    </div>

    <!-- Alert closing logic -->
    <script>
        function closeAlert() {
            var alertEl = document.getElementById('alert-notification');
            if (alertEl) {
                alertEl.style.opacity = '0';
                setTimeout(function() {
                    alertEl.remove();
                }, 400);
            }
        }
        
        // Auto-dismiss alert notification after 6 seconds
        window.addEventListener('DOMContentLoaded', (event) => {
            var alertEl = document.getElementById('alert-notification');
            if (alertEl) {
                setTimeout(function() {
                    if (alertEl) {
                        alertEl.style.opacity = '0';
                        setTimeout(function() {
                            alertEl.remove();
                        }, 400);
                    }
                }, 6000);
            }
        });
    </script>
    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
