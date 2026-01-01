/* JAVASCRIPT LOGIC 
 * Reference: W3Schools JavaScript Tutorial
 * Simple DOM manipulation.
 */

// Function to move focus to the next input field
function moveToNext(currentInput, nextInputId) {
    // Ensure only numbers are entered (simple validation)
    currentInput.value = currentInput.value.replace(/[^0-9]/g, '');

    // If a value is entered and there is a next field, focus on it
    if (currentInput.value.length >= 1 && nextInputId) {
        document.getElementById(nextInputId).focus();
    }
}

// Function to handle backspace key
function handleBackspace(event, currentInput, prevInputId) {
    // Check if the key pressed is "Backspace"
    if (event.key === "Backspace") {
        // If the current field is empty and there is a previous field
        if (currentInput.value === "" && prevInputId) {
            document.getElementById(prevInputId).focus();
        }
    }
}

// Function to handle form submission
function verifyOTP(event) {
    event.preventDefault(); // Stop page reload

    let otpCode = "";
    let isValid = true;

    // Loop through IDs 1 to 6 to gather the code
    for (let i = 1; i <= 6; i++) {
        let inputVal = document.getElementById('otp-' + i).value;
        if (inputVal === "") {
            isValid = false;
        }
        otpCode += inputVal;
    }

    if (isValid && otpCode.length === 6) {
        console.log("Verifying OTP: " + otpCode);
        
        // Show loading state
        showMessage("Verifying OTP...", "loading");
        
        // Here you would add AJAX or Fetch to send data to your PHP backend
        // Example using Fetch API:
        /*
        fetch('verify_otp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ otp: otpCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage("OTP verified successfully!", "success");
                // Redirect to reset password page
                setTimeout(() => {
                    window.location.href = "reset_password.php";
                }, 1500);
            } else {
                showMessage("Invalid OTP. Please try again.", "error");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage("Network error. Please try again.", "error");
        });
        */
        
        // For demo purposes, simulate server response
        setTimeout(() => {
            // Mock successful verification
            showMessage("OTP verified successfully! Redirecting...", "success");
            
            // Redirect to reset password page after 1.5 seconds
            setTimeout(() => {
                window.location.href = "reset_password.php";
            }, 1500);
        }, 1000);
        
    } else {
        showMessage("Please enter the complete 6-digit OTP.", "error");
    }
}

// Function to show success/error messages
function showMessage(message, type) {
    // Remove existing message box if any
    const existingMsg = document.querySelector('.message-box');
    if (existingMsg) {
        existingMsg.remove();
    }
    
    // Create message element
    const messageBox = document.createElement('div');
    messageBox.className = `message-box ${type}-message`;
    messageBox.textContent = message;
    
    // Insert after info-box
    const infoBox = document.querySelector('.info-box');
    infoBox.insertAdjacentElement('afterend', messageBox);
    
    // Show the message
    messageBox.style.display = 'block';
    
    // Auto-hide error messages after 5 seconds
    if (type === 'error') {
        setTimeout(() => {
            messageBox.style.display = 'none';
        }, 5000);
    }
}

// Function to simulate navigation back
function goBack() {
    console.log("Navigating back...");
    window.location.href = "../PHP/forgetPass.php"; 
}

// Function to simulate resending OTP
function resendOTP() {
    console.log("Resending OTP...");
    
    // Disable resend button temporarily
    const resendBtn = document.querySelector('.resend-btn');
    const originalText = resendBtn.innerHTML;
    resendBtn.disabled = true;
    resendBtn.innerHTML = 'Resending...';
    
    // Here you would add AJAX call to resend OTP
    /*
    fetch('resend_otp.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage("OTP has been resent to your email!", "success");
        } else {
            showMessage("Failed to resend OTP. Please try again.", "error");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage("Network error. Please try again.", "error");
    });
    */
    
    // For demo purposes, simulate server response
    setTimeout(() => {
        showMessage("OTP has been resent to your email!", "success");
        resendBtn.disabled = false;
        resendBtn.innerHTML = originalText;
    }, 1000);
}

// Add Paste Event Listener to the first input for user convenience
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('otp-1').addEventListener('paste', function(event) {
        event.preventDefault();
        // Get pasted data via clipboard API
        let pastedData = (event.clipboardData || window.clipboardData).getData('text');
        pastedData = pastedData.trim();

        // Check if it is a number
        if (!/^\d+$/.test(pastedData)) {
            showMessage("Please paste only numbers.", "error");
            return;
        }

        // Distribute the characters to inputs
        let inputs = document.querySelectorAll('.otp-input');
        for (let i = 0; i < inputs.length; i++) {
            if (i < pastedData.length) {
                inputs[i].value = pastedData[i];
            } else {
                inputs[i].value = ''; // Clear any extra inputs
            }
        }
        
        // Focus on the last filled input or the next empty one
        let focusIndex = Math.min(pastedData.length, 6) - 1;
        if (focusIndex >= 0 && focusIndex < 6) {
           inputs[focusIndex].focus(); 
        }
    });
    
    // Auto-focus first OTP input on page load
    document.getElementById('otp-1').focus();
});