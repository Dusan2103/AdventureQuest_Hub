function updateReaction(reactionType, destinationId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/wbp/model/like-dislike.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var data = "destination_id=" + destinationId + "&reaction_type=" + reactionType;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Dodajte ovo za debug
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Ažuriraj broj lajkova i dislajkova bez oduzimanja
                        var likeCountElem = document.getElementById('like-count-' + destinationId);
                        var dislikeCountElem = document.getElementById('dislike-count-' + destinationId);

                        if (likeCountElem && dislikeCountElem) {
                            // Ažuriraj oba broja bez oduzimanja
                            likeCountElem.textContent = response.new_like_count;
                            dislikeCountElem.textContent = response.new_dislike_count;
                        } else {
                            console.error('Elementi sa ID-jem "like-count-' + destinationId + '" ili "dislike-count-' + destinationId + '" nisu pronađeni.');
                        }
                    } else {
                        console.error('Neuspešno ažuriranje reakcije.');
                    }
                } catch (e) {
                    console.error('Neispravan JSON odgovor:', xhr.responseText);
                }
            } else {
                console.error('Greška prilikom slanja zahteva:', xhr.status);
            }
        }
    };

    xhr.send(data);
}
