document.addEventListener('DOMContentLoaded', function() {
    const bigImg = document.getElementById('bigImg');
    const modal = document.getElementById('fullscreenModal');
    const modalImg = document.getElementById('modalImg');
    const closeModal = document.getElementById('closeModal');
    
    // Function to open the modal
    bigImg.onclick = function() {
        modal.style.display = "block";
        modalImg.src = bigImg.src;
    };

    // Function to close the modal
    closeModal.onclick = function() {
        modal.style.display = "none";
    };

    // Handle small image clicks
    const smallImages = document.querySelectorAll('.small-image');
    smallImages.forEach(img => {
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
        };
    });

    // Close the modal if the user clicks anywhere outside of the image
    modal.onclick = function(event) {
        if (event.target !== modalImg) {
            modal.style.display = "none";
        }
    };
});
