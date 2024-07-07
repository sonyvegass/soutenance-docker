document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#numero_telephone");
    var phoneInput = window.intlTelInput(input, {
        initialCountry: "fr",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    window.validateForm = function() {
        var email = document.getElementById("email").value;
        var confirmEmail = document.getElementById("confirm_email").value;
        var password = document.getElementById("mot_de_passe").value;
        var confirmPassword = document.getElementById("confirm_mot_de_passe").value;
        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var dateNaissance = document.getElementById("date_naissance").value;
        var numeroTelephone = document.getElementById("numero_telephone").value;
        var prestataire = document.getElementById("prestataire").checked;
        var bailleur = document.getElementById("bailleur").checked;
        var conditions = document.getElementById("conditions").checked;

        // Vérifier l'égalité des emails
        if (email !== confirmEmail) {
            alert("Les emails ne correspondent pas.");
            return false;
        }

        // Vérifier l'égalité des mots de passe
        if (password !== confirmPassword) {
            alert("Les mots de passe ne correspondent pas.");
            return false;
        }

        // Vérifier le format du mot de passe
        var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*\d)[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert("Le mot de passe doit contenir au moins 8 caractères, une majuscule, un caractère spécial et un chiffre.");
            return false;
        }

        // Vérifier que le nom et le prénom contiennent uniquement des lettres
        var namePattern = /^[A-Za-zÀ-ÿ]+$/;
        if (!namePattern.test(nom) || !namePattern.test(prenom)) {
            alert("Le nom et le prénom doivent contenir uniquement des lettres.");
            return false;
        }

        // Vérifier que l'utilisateur est majeur
        var today = new Date();
        var birthDate = new Date(dateNaissance);
        var age = today.getFullYear() - birthDate.getFullYear();
        var monthDifference = today.getMonth() - birthDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (age < 18) {
            alert("Vous devez avoir au moins 18 ans pour vous inscrire.");
            return false;
        }

        // Vérifier que le numéro de téléphone est valide
        if (!phoneInput.isValidNumber()) {
            alert("Le numéro de téléphone est incorrect.");
            return false;
        }

        // Vérifier que soit "je suis bailleur" soit "je suis prestataire" est coché, mais pas les deux
        if (prestataire && bailleur) {
            alert("Veuillez sélectionner soit 'Je suis prestataire' soit 'Je suis bailleur', mais pas les deux.");
            return false;
        }

        // Vérifier que les conditions d'utilisation sont cochées
        if (!conditions) {
            alert("Vous devez accepter les conditions de PCS.");
            return false;
        }

        // Si toutes les validations sont passées, envoyer les données via fetch
        var formData = new FormData(document.getElementById("signupForm"));
        
        // Ajouter l'indicatif téléphonique au formData
        formData.append('indicatif_telephonique', phoneInput.getSelectedCountryData().dialCode);

        console.log(formData);
        fetch('http://localhost:8082/signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log(response);
            return response.json()
        })
        .then(data => {
            if (data.success) {
                // Redirection vers login.php si l'inscription est réussie
                window.location.href = '../login/index.php';
            } else {
                alert(data.error); // Affiche l'erreur s'il y en a une
            }
        })
        .catch(error => {
            console.error('Erreur lors de la soumission du formulaire :', error);
        });

        return false; // Empêche la soumission du formulaire par défaut
    }
});
