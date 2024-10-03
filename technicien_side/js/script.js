document.querySelector("form").addEventListener("submit", function(event) {
    // Empêche l'envoi du formulaire pour permettre la mise à jour du champ de date
    event.preventDefault();

    var dateField = document.getElementById("incidentDate");
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var hours = String(today.getHours()).padStart(2, '0');
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var seconds = String(today.getSeconds()).padStart(2, '0');

    // Met à jour la valeur du champ de date avec l'heure
    dateField.value = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

    // Soumet le formulaire après la mise à jour du champ de date
    event.target.submit();
});



document.querySelector("form").addEventListener("submit", function(event) {
    var status = document.getElementById("incidentStatus");
    status.value = "en cours";
})

