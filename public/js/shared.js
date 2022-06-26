function msg(type, text) {
    var p = document.getElementById("msg");
    p.innerHTML = text;
}

msg(1, "This is working");