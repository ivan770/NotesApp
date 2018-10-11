function deleteNote(id){
    document.getElementById('loader').style.display = "inline-block";
    var xhr = new XMLHttpRequest();
    var body = 'id=' + encodeURIComponent(id) +
    '&_token=' + document.getElementsByName('csrf-token')[0].content;
    xhr.open("POST", '/delete', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('loader').style.display = "none";
            getNote()
        };
    };
    xhr.send(body);
}

function newNote(title, body, publiccheck){
    document.getElementById('loader').style.display = "inline-block";
    var xhr = new XMLHttpRequest();
    var body = 'title=' + encodeURIComponent(title) +
    '&body=' + encodeURIComponent(body) +
    '&public=' + encodeURIComponent(publiccheck) +
    '&_token=' + document.getElementsByName('csrf-token')[0].content;
    xhr.open("POST", '/new', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('loader').style.display = "none";
            document.getElementById('new-form').reset();
            getNote()
        };
    };
    xhr.send(body);
}

function getNote(){
    while (cards.firstChild) {
        cards.removeChild(cards.firstChild);
    }
    document.getElementById('loader').style.display = "inline-block";
    var xhr = new XMLHttpRequest();
    var body = '_token=' + document.getElementsByName('csrf-token')[0].content;
    xhr.open("POST", '/get', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            JSON.parse(xhr.response).forEach(function(item, i, arr) {
                var div = document.createElement('div');
                div.className = "siimple-card";
                div.setAttribute("id", "card-" + item["id"]);
                if(item["public"] == "true"){
                    div.innerHTML = "<div class=\"siimple-card-header\"> <div class=\"siimple-btn siimple-btn--primary\" onclick=\"copyLink(" + item["id"] + ")\">Copy link</div> <div class=\"siimple-btn siimple-btn--light\" onclick=\"editNote(" + item["id"] + ")\">Edit</div> <div class=\"siimple-btn siimple-btn--light\" onclick=\"deleteNote(" + item["id"] + ")\">Delete</div> </div> <div class=\"siimple-card-body\"> <div class=\"siimple-card-title\">" + item["title"].replace(/\n/g, "<br />") + "</div>" + item["body"].replace(/\n/g, "<br />") + "</div>";
                } else {
                    div.innerHTML = "<div class=\"siimple-card-header\"> <div class=\"siimple-btn siimple-btn--light\" onclick=\"editNote(" + item["id"] + ")\">Edit</div> <div class=\"siimple-btn siimple-btn--light\" onclick=\"deleteNote(" + item["id"] + ")\">Delete</div> </div> <div class=\"siimple-card-body\"> <div class=\"siimple-card-title\">" + item["title"].replace(/\n/g, "<br />") + "</div>" + item["body"].replace(/\n/g, "<br />") + "</div>";
                }
                cards.appendChild(div);
            });
            document.getElementById('loader').style.display = "none";
        };
    };
    xhr.send(body);
}

function editNote(id){
    location.href = "/edit/" + id;
}

function copyLink(id){
    window.prompt("Use CTRL+C to copy", "https://notesapp.ga/public/" + id);
}