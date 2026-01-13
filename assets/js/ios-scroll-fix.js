document.addEventListener('DOMContentLoaded', function() {
    // Check if the device is iOS
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    
    // Only apply the fix for iOS devices
    if (isIOS) {
        // Add a class to the html element to target iOS specifically
        document.documentElement.classList.add('ios-device');
        
        // Handle all anchor link clicks
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href^="#"]');
            
            if (link && link.getAttribute('href') !== '#') {
                e.preventDefault();
                const targetId = link.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Use a small timeout to ensure the click is fully processed
                    setTimeout(() => {
                        // Get the header height for offset
                        const header = document.querySelector('.nk-navbar');
                        const headerHeight = header ? header.offsetHeight : 0;
                        
                        // Calculate the target position
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                        
                        // Smooth scroll using requestAnimationFrame
                        const startPosition = window.pageYOffset;
                        const distance = targetPosition - startPosition;
                        const duration = 500; // milliseconds
                        let start = null;
                        
                        function step(timestamp) {
                            if (!start) start = timestamp;
                            const progress = timestamp - start;
                            const percentage = Math.min(progress / duration, 1);
                            
                            // Easing function (easeInOutQuad)
                            const easeInOutQuad = t => t<.5 ? 2*t*t : -1+(4-2*t)*t;
                            
                            window.scrollTo(0, startPosition + (distance * easeInOutQuad(percentage)));
                            
                            if (progress < duration) {
                                window.requestAnimationFrame(step);
                            }
                        }
                        
                        window.requestAnimationFrame(step);
                        
                        // Update URL without scrolling
                        if (history.pushState) {
                            history.pushState(null, null, targetId);
                        } else {
                            window.location.hash = targetId;
                        }
                    }, 50);
                }
            }
        });
    }
});
