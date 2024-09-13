// Function to generate a random future date
function getRandomFutureDate() {
    // Get the current date and time
    const now = new Date();
    
    // Set a maximum range for the future date (e.g., 30 days from now)
    const maxRangeInDays = 30;
    const randomDays = Math.floor(Math.random() * maxRangeInDays) + 1;
    
    // Calculate the future date
    const futureDate = new Date(now.getTime() + (randomDays * 24 * 60 * 60 * 1000));
    
    return futureDate.getTime();
}

// Initialize countdown for all timers
function initializeCountdowns() {
    // Select all timers on the page
    const timers = document.querySelectorAll(".timer");
    
    timers.forEach(timer => {
        // Get a random target date for this timer
        const countdownDate = getRandomFutureDate();

        // Update the countdown every second for this timer
        const interval = setInterval(function() {
            // Get the current time
            const now = new Date().getTime();

            // Calculate the difference between the target time and the current time
            const distance = countdownDate - now;

            // Time calculations for days, hours, minutes, and seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update the HTML elements with the calculated time
            timer.querySelector(".days").textContent = days < 10 ? `0${days}` : days;
            timer.querySelector(".hours").textContent = hours < 10 ? `0${hours}` : hours;
            timer.querySelector(".minutes").textContent = minutes < 10 ? `0${minutes}` : minutes;
            timer.querySelector(".seconds").textContent = seconds < 10 ? `0${seconds}` : seconds;

            // If the countdown is finished, stop the interval and display a message
            if (distance < 0) {
                clearInterval(interval);
                timer.innerHTML = "Expired";
            }
        }, 1000);
    });
}

// Initialize the countdowns when the document is ready
document.addEventListener("DOMContentLoaded", initializeCountdowns);
