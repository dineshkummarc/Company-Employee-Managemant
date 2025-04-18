document.addEventListener('DOMContentLoaded', function() {
    // Header scroll effect
    const header = document.querySelector('.header');
    const headerWrapper = document.querySelector('.header-wrapper');
    
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        headerWrapper.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
      } else {
        headerWrapper.style.background = 'transparent';
        header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
      }
    });
    
    // Play button click event
    const playButton = document.querySelector('.play-button');
    if (playButton) {
      playButton.addEventListener('click', function(e) {
        e.preventDefault();
        // Here you would typically open a video modal
        alert('Video would play here.');
      });
    }
    
    // Contact side button hover effect
    const contactSideButton = document.querySelector('.contact-side-button');
    if (contactSideButton) {
      contactSideButton.addEventListener('mouseenter', function() {
        this.style.right = '-25px';
      });
      
      contactSideButton.addEventListener('mouseleave', function() {
        this.style.right = '-35px';
      });
      
      contactSideButton.addEventListener('click', function() {
        // Here you would typically open contact form or redirect to contact page
        alert('Contact form would open here.');
      });
    }
    
    // Add animations for smoother page loading
    const heroText = document.querySelector('.hero-text');
    const heroImage = document.querySelector('.hero-image');
    const featureItems = document.querySelectorAll('.feature-item');
    
    if (heroText) heroText.style.opacity = '0';
    if (heroImage) heroImage.style.opacity = '0';
    
    featureItems.forEach(item => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(20px)';
    });
    
    setTimeout(() => {
      if (heroText) {
        heroText.style.transition = 'opacity 0.8s ease-out';
        heroText.style.opacity = '1';
      }
    }, 200);
    
    setTimeout(() => {
      if (heroImage) {
        heroImage.style.transition = 'opacity 0.8s ease-out';
        heroImage.style.opacity = '1';
      }
    }, 500);
    
    setTimeout(() => {
      featureItems.forEach((item, index) => {
        item.style.transition = 'all 0.6s ease-out';
        setTimeout(() => {
          item.style.opacity = '1';
          item.style.transform = 'translateY(0)';
        }, index * 150);
      });
    }, 800);
  });