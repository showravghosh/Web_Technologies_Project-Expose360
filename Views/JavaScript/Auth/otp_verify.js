
function moveToNext(current, nextId) {
    if (current.value.length === 1 && nextId) {
        document.getElementById(nextId).focus();
    }
}

function handleBackspace(event, current, prevId) {
    if (event.key === 'Backspace' && current.value === '' && prevId) {
        document.getElementById(prevId).focus();
    }
}

function resendOTP() {
    alert('Please go back and request OTP again.');
}

// Before submit, join 6 digits into hidden field
document.getElementById('otpForm').onsubmit = function () {
    var code = '';
    for (var i = 1; i <= 6; i++) {
        var v = document.getElementById('otp-' + i).value;
        code += v;
    }
    document.getElementById('otp_code').value = code;
    return true;
};

