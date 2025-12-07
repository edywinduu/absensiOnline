
function saveCurrentDate() {
    const today = new Date().toDateString();
    const storedDate = localStorage.getItem('lastAccessDate');
    
    if (storedDate !== today) {
        localStorage.setItem('lastAccessDate', today);
        clearDatabaseData();
    } else {
        localStorage.setItem('lastAccessDate', today);
    }
}

// Panggil fungsi saat halaman dimuat
saveCurrentDate();

function updateJam() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('jamDigital').innerText = now.toLocaleDateString('id-ID', options);
}
setInterval(updateJam, 1000);
updateJam(); 

function validasiForm() {
    const nama = document.getElementById('nama').value;
    if (nama.trim() === "") {
        alert("Nama tidak boleh kosong!");
        return false;
    }
    return true;
}

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

function clearDatabaseData() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'clear_data.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Data absensi harian telah dihapus otomatis');
            location.reload();
        }
    };
    
    xhr.send('action=clear');
}