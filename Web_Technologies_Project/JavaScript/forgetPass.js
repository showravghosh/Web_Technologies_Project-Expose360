// Wait for page to load
document.addEventListener('DOMContentLoaded', function() {
    // Get form and buttons
    const form = document.getElementById('forgotPasswordForm');
    const backButton = document.getElementById('backButton');
    const emailInput = document.getElementById('email');
    
    // Handle back button click - redirect to Login.php
    backButton.addEventListener('click', function() {
        window.location.href = '../PHP/Login.php';
    });
    
    // Handle form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent page reload
        
        // Get email value
        const email = emailInput.value.trim();
        
        // Simple email validation
        if (!email) {
            alert('Please enter your email address');
            emailInput.focus();
            return;
        }
        
        if (!isValidEmail(email)) {
            alert('Please enter a valid email address');
            emailInput.focus();
            return;
        }
        
        // Show sending message
        const submitBtn = form.querySelector('.submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending OTP...';
        submitBtn.disabled = true;
        
        // Simulate API call delay
        setTimeout(function() {
            // Show success message
            alert('OTP sent successfully to ' + email + '\nIn a real app, this would redirect to OTP verification page.');
            
            // Reset button
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            
            // Clear form
            form.reset();
            
            // In real app, redirect to OTP verification page:
            // window.location.href = '../PHP/VerifyOTP.php?email=' + encodeURIComponent(email);
        }, 1500);
    });
    
    // Simple email validation function
    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    
    // Add focus effect to input
    emailInput.addEventListener('focus', function() {
        this.style.backgroundColor = '#0f172a';
    });
    
    emailInput.addEventListener('blur', function() {
        this.style.backgroundColor = '#1e293b';
    });
});