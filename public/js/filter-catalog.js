document.addEventListener('DOMContentLoaded', function () {
    const certifiedYesCheckbox = document.getElementById('certifiedYes');
    const certifiedNoCheckbox = document.getElementById('certifiedNo');
    const filterButton = document.getElementById('filter-btn');
    const stampCards = document.querySelectorAll('.card__news');

    function filterStamps() {
        stampCards.forEach(card => {
            const certifiedSpan = card.querySelector('.certified-span');

            // Ensure the certified span exists
            if (!certifiedSpan) {
                return;
            }

            const certifiedValue = certifiedSpan.textContent.trim();
            let showCard = true;

            // Apply filtering logic
            if (certifiedYesCheckbox.checked && certifiedNoCheckbox.checked) {
                showCard = true; // Show all if both checkboxes are checked
            } else if (certifiedYesCheckbox.checked && certifiedValue === 'Oui') {
                showCard = true;
            } else if (certifiedNoCheckbox.checked && certifiedValue === 'Non') {
                showCard = true;
            } else if (!certifiedYesCheckbox.checked && !certifiedNoCheckbox.checked) {
                showCard = true; // Show all if neither checkbox is checked
            } else {
                showCard = false;
            }

            // Toggle the card's display based on the filtering logic
            card.style.display = showCard ? '' : 'none';
        });
    }

    // Attach event listeners
    if (filterButton) {
        filterButton.addEventListener('click', filterStamps);
    }
});
