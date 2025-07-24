document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const contactModal = document.getElementById('contactModal');
    const contactForm = document.getElementById('contactForm');
    const loadingSpinner = document.getElementById('loading-spinner');
    const submitButton = document.getElementById('submitButton');
    const formStatusMessage = document.getElementById('form-status-message');

    // affiche le spinner à l'envoi
    contactForm.addEventListener('submit', function(event) {

        loadingSpinner.classList.remove('hidden');
        submitButton.disabled = true;
        submitButton.style.opacity = '0.5';

        // cache le précédent statut
        if (formStatusMessage) {
            formStatusMessage.classList.add('hidden');
        }
    });

    // affiche le modal
    if (status && window.location.hash === '#contactModal') {
        if (contactModal) {
            contactModal.classList.remove('hidden'); 

            loadingSpinner.classList.add('hidden');
            submitButton.disabled = false; 
            submitButton.style.opacity = '1';

            // vide le formulaire
            if (status === 'success' && contactForm) {
                contactForm.reset(); // Resets all form fields
            }

            // affiche le status d'envoie durant 7s
            setTimeout(() => {
                history.replaceState({}, document.title, window.location.pathname + window.location.hash);
                if (formStatusMessage) {
                    formStatusMessage.classList.add('hidden');
                }
            }, 7000);
        }
    } else {
        // s'assure que le spinner et le status sont invisibles
        loadingSpinner.classList.add('hidden');
        if (formStatusMessage) {
            formStatusMessage.classList.add('hidden');
        }
    }
});
