$(document).ready(function () {
    // Lorsqu'un utilisateur est cliqué
    $('.user-row').click(function () {
        // Récupérer la valeur de l'email dans la colonne correspondante
        var email_user = $(this).find('td:first').text();

        // Mettre à jour la valeur du champ d'email dans le formulaire
        $('#email_user').val(email_user);
    });
});