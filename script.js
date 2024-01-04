let div_conjugation = document.getElementById('conjugation');
let bt1 = document.getElementById('bt1');

bt1.addEventListener("click", function() {
    inviaRichiesta(stampaDati);
});

function stampaDati(coniugazione) {
    if (coniugazione === "ERRORE") {
        var errorMessage = "Si è verificato un errore!";
        document.getElementById("error-message").innerText = errorMessage;
    } else {
        div_conjugation.innerHTML = coniugazione;
    }
}

function controlloInputValido() {
    let input_verbo = document.getElementById('verbo-input').value;
    let ultimi3Caratteri = input_verbo.substr(-3);
    let ultimi4Caratteri = input_verbo.substr(-4);

    // Controllo sulla lunghezza e sulla presenza di spazi
    if (input_verbo.length >= 3 && !input_verbo.includes(" ") && (controlloDesinenzaGiusta())) {
        return true;
    }

    return false;
}

function controlloDesinenzaGiusta() {
    let input_verbo = document.getElementById('verbo-input').value;
    let ultimi3Caratteri = input_verbo.substr(-3);
    let ultimi4Caratteri = input_verbo.substr(-4);
    if (ultimi3Caratteri === "are" || ultimi3Caratteri === "ere" || ultimi3Caratteri === "ire"
        || ultimi4Caratteri === "arre" || ultimi4Caratteri === "orre" || ultimi4Caratteri === "urre") {
        return true;
    }
    return false;
}


// Funzione per eseguire la richiesta XMLHttpRequest
function inviaRichiesta(callback) {
    let input_verbo = document.getElementById('verbo-input').value;
    if (!controlloInputValido()) {
        callback("ERRORE");
        return;
    }

    // Crea un oggetto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Definisci la funzione di gestione dell'evento
    xhr.onreadystatechange = function() {
        // Controlla se la richiesta è stata completata (readyState 4) e se lo stato è "OK" (status 200)
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Gestisci la risposta
            let risposta = xhr.responseText;
            callback(risposta);
        }
    };

    // Definisci il tipo di richiesta (GET o POST) e l'URL di destinazione
    var metodo = "GET"; // Può essere anche "POST" se necessario
    var url = "main.php?verbo=" + encodeURIComponent(input_verbo);

    // Apri la connessione
    xhr.open(metodo, url, true);

    // Invia la richiesta
    xhr.send();
}
