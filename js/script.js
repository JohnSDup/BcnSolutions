// js/script.js

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Initialize all components
    initMobileMenu();
    initScrollEffects();
    initBackToTop();
    initNewsletterForm();
    initSmoothScrolling();
    initAnimations();
    initTracking();
}

// Mobile menu functionality
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
            
            // Track menu toggle
            trackInteraction('menu_toggle', mainNav.classList.contains('active') ? 'open' : 'close');
        });
        
        // Close menu when clicking on a link
        document.querySelectorAll('.main-nav a').forEach(link => {
            link.addEventListener('click', function() {
                if (mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    mobileMenuToggle.querySelector('i').classList.add('fa-bars');
                    mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                }
            });
        });
    }
}

// Scroll effects for header
function initScrollEffects() {
    const header = document.querySelector('.top-header');
    
    if (header) {
        let lastScroll = 0;
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            // Add/remove scrolled class based on scroll position
            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Hide header on scroll down (optional)
            if (currentScroll > lastScroll && currentScroll > 200) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });
    }
}

// Back to top button
function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            
            // Track back to top click
            trackInteraction('back_to_top', 'clicked');
        });
    }
}

// Newsletter form handling
function initNewsletterForm() {
    const newsletterForm = document.getElementById('newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const email = formData.get('email');
            const messageElement = document.getElementById('form-message');
            
            // Validate email
            if (!validateEmail(email)) {
                showMessage(messageElement, 'Por favor, introduce un email válido.', 'error');
                return;
            }
            
            // Show loading state
            showMessage(messageElement, 'Enviando...', 'info');
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Enviando...';
            submitButton.disabled = true;
            
            try {
                // Simulate API call - replace with actual endpoint
                const response = await simulateApiCall(email);
                
                if (response.success) {
                    showMessage(messageElement, '¡Gracias por suscribirte! Te hemos enviado un email de confirmación.', 'success');
                    this.reset();
                    
                    // Track successful subscription
                    trackInteraction('newsletter_signup', 'success', { email: email });
                } else {
                    throw new Error('Subscription failed');
                }
            } catch (error) {
                showMessage(messageElement, 'Error al procesar la suscripción. Por favor, intenta nuevamente.', 'error');
                trackInteraction('newsletter_signup', 'error', { email: email, error: error.message });
            } finally {
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            }
        });
    }
}

// Smooth scrolling for anchor links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if it's just "#"
            if (href === '#') return;
            
            e.preventDefault();
            
            const targetElement = document.querySelector(href);
            if (targetElement) {
                const headerHeight = document.querySelector('.top-header').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Track internal link clicks
                trackInteraction('internal_link_click', href);
            }
        });
    });
}

// Scroll animations
function initAnimations() {
    const animatedElements = document.querySelectorAll('.product-card, .demo-content > *, .about-content > *');
    
    // Set initial state
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    // Create intersection observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe elements
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// Enhanced tracking
function initTracking() {
    // Track demo button clicks
    const demoBtn = document.getElementById('demo-btn');
    if (demoBtn) {
        demoBtn.addEventListener('click', function() {
            trackInteraction('demo_request', 'clicked');
        });
    }
    
    // Track product card interactions
    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.addEventListener('click', function() {
            const productName = this.querySelector('h3').textContent;
            trackInteraction('product_click', productName, { position: index + 1 });
        });
    });
    
    // Track time on page
    let pageLoadTime = Date.now();
    window.addEventListener('beforeunload', function() {
        const timeSpent = Date.now() - pageLoadTime;
        trackInteraction('page_engagement', 'time_spent', { duration: Math.round(timeSpent / 1000) });
    });
}

// Helper functions
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showMessage(element, text, type) {
    if (!element) return;
    
    element.textContent = text;
    element.className = `form-message ${type}`;
    
    // Clear message after 5 seconds
    setTimeout(() => {
        element.textContent = '';
        element.className = 'form-message';
    }, 5000);
}

function simulateApiCall(email) {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve({ success: true, message: 'Subscription successful' });
        }, 1500);
    });
}

function trackInteraction(action, label, data = {}) {
    // Enhanced tracking function
    const trackingData = {
        action: action,
        label: label,
        timestamp: new Date().toISOString(),
        page: window.location.pathname,
        ...data
    };
    
    // Send to your tracking endpoint
    fetch('track_interaction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(trackingData)
    }).catch(error => {
        console.log('Tracking error:', error);
    });
    
    // Also log to console for development
    console.log('Tracked:', trackingData);
}

// Export functions for global access (if needed)
window.BcnSolutions = {
    trackInteraction,
    validateEmail,
    showMessage
};