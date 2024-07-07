document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre automatiquement

        // Récupérer les valeurs des champs
        const email = document.getElementById('email').value;
        const password = document.getElementById('mot_de_passe').value;
        const userTypeRadios = document.getElementsByName('type_utilisateur');
        let userType = '';

        // Vérifier si un type d'utilisateur est sélectionné
        for (let radio of userTypeRadios) {
            if (radio.checked) {
                userType = radio.value;
                break;
            }
        }

        // Valider les champs
        if (!validateEmail(email)) {
            displayErrorMessage("Veuillez entrer une adresse email valide.");
            return false;
        }

        if (password.length < 6) {
            displayErrorMessage("Le mot de passe doit comporter au moins 8 caractères.");
            return false;
        }

        if (userType === '') {
            displayErrorMessage("Veuillez sélectionner un type d'utilisateur.");
            return false;
        }

        // Envoyer les données à login.php
        fetch('http://localhost:8082/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                mot_de_passe: password,
                type_utilisateur: userType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                displayErrorMessage(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            displayErrorMessage('Une erreur est survenue. Veuillez réessayer.');
        });
    });
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function displayErrorMessage(message) {
    let errorDiv = document.getElementById('error-message');
    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.id = 'error-message';
        errorDiv.style.color = 'red';
        document.getElementById('loginForm').prepend(errorDiv);
    }
    errorDiv.textContent = message;
}
