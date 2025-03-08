function toggleEdit(userId) {
    const userRow = document.getElementById('user-' + userId);
    const inputs = userRow.querySelectorAll('.editable input, .editable select');

    inputs.forEach(input => {
        input.removeAttribute('disabled');  // Uklanja disabled
    });

    // Sakrij dugme "Uredi" i prikaži dugme "Spasi promene"
    userRow.querySelector('.btn-warning').style.display = 'none';
    userRow.querySelector('.btn-save').style.display = 'inline-block';
}

// Funkcija za potvrdu brisanja
function confirmDelete(userId) {
    console.log("Potvrda za brisanje korisnika sa ID: " + userId); 
    if (confirm('Da li ste sigurni da želite da obrišete ovog korisnika?')) {
        deleteUser(userId);
    }
}

// Funkcija za brisanje korisnika
function deleteUser(userId) {
    console.log("Brisanje korisnika sa ID: " + userId);  

    $.ajax({
        url: 'wbp/admin/control/deleteUser.php?id=' + userId,  
        type: 'GET',
        success: function(response) {
            console.log("Odgovor od servera: " + response);
            if (response === 'success') {
                $('#user-' + userId).remove();  
                alert('Korisnik je uspešno obrisan');
            } else {
                alert('Došlo je do greške prilikom brisanja korisnika');
            }
        },
        error: function(xhr, status, error) {
            console.error("Greška u komunikaciji: " + status + " " + error);
            alert('Greška u komunikaciji sa serverom');
        }
    });
}

$(document).ready(function() {
    $('button.btn-danger').on('click', function() {
        var userId = $(this).data('id');
        confirmDelete(userId);  // Pozovi funkciju confirmDelete
    });
});

function saveChanges(userId) {
    const userRow = document.getElementById('user-' + userId);
    const inputs = userRow.querySelectorAll('.editable input, .editable select');
    const updatedData = {};

    // Prikupljamo sve nove podatke sa forme
    inputs.forEach(input => {
        const column = input.parentElement.getAttribute('data-column');
        updatedData[column] = input.value;
    });
    
    console.log(updatedData);  // Prikazivanje podataka koji se šalju

    // Kreiramo AJAX zahtev za slanje podataka serveru
    $.ajax({
        url: 'wbp/admin/control/updateUser.php',  // Putanja do skripte koja će obraditi promene
        type: 'POST',
        data: {
            id: userId,
            ime: updatedData.ime,
            prezime: updatedData.prezime,
            username: updatedData.username,
            role: updatedData.role
        },
        success: function(response) {
            console.log(response);  // Logovanje odgovora sa servera
            if (response === 'Podaci su uspešno ažurirani!') {
                alert('Podaci su uspešno ažurirani');
                location.reload();  // Osvježava stranicu da bi prikazao nove podatke
            } else {
                alert('Došlo je do greške prilikom ažuriranja');
            }
        },
        error: function(xhr, status, error) {
            console.error("Greška u komunikaciji: " + status + " " + error);  // Detaljan log greške
            alert('Greška u komunikaciji sa serverom');
        }
    });
}
