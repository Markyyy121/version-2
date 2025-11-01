// Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuBtn.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.navbar-content')) {
                mobileMenuBtn.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });

        // Parallax effect for note canvases
        document.addEventListener('mousemove', (e) => {
            const canvases = document.querySelectorAll('.note-canvas');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            canvases.forEach((canvas, index) => {
                const speed = (index + 1) * 2;
                const xOffset = (x - 0.5) * speed;
                const yOffset = (y - 0.5) * speed;
                
                const baseRotation = canvas.classList.contains('canvas-1') ? -2 :
                                   canvas.classList.contains('canvas-2') ? 3 :
                                   canvas.classList.contains('canvas-3') ? 1 : -3;
                
                canvas.style.transform = `rotate(${baseRotation}deg) translate(${xOffset}px, ${yOffset}px)`;
            });
        });