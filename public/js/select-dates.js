function disablePastDates() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start-date').setAttribute('min', today);
}


function updateCheckOutMinDate() {
    const checkInDateValue = document.getElementById('start-date').value;
    const checkOutDateInput = document.getElementById('end-date');

    if (checkInDateValue) {
        checkOutDateInput.setAttribute('min', checkInDateValue);
    } else {
        checkOutDateInput.removeAttribute('min');
    }
}

function initializeDatePickers() {
    const checkInDateValue = document.getElementById('start-date').value;
    if (checkInDateValue) {
        document.getElementById('end-date').setAttribute('min', checkInDateValue);
    }
}

document.getElementById('start-date').addEventListener('focus', disablePastDates);
document.getElementById('start-date').addEventListener('change', updateCheckOutMinDate);
document.addEventListener('DOMContentLoaded', initializeDatePickers);








