function offline(){
    document.getElementById('offline').style.display = "inline-block";
}

function online(){
    document.getElementById('offline').style.display = "none";
}

window.addEventListener('online',  online)
window.addEventListener('offline',  offline)