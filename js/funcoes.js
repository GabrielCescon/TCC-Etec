//Função menu-slide
function menuhalf() {
    var slider = document.getElementById("menu-slide");
    slider.style.height = window.innerHeight - 60 + "px";
    if (slider.style.left == "0px") {
        slider.style.left = "-250px";
    }
    else {
        slider.style.left = "0px";
    }
}
//Função loginbox
function loginbox() {
    var log = document.getElementById("login-box");
    //log.style.visibility = "hidden";
    //log.style.height = window.innerHeight - 60 + "px";
    if (log.style.visibility == "hidden") {
        log.style.visibility = "visible";
    }
    else {
        log.style.visibility = "hidden";
    }
}
//Função contabox
function contabox() {
    var log2 = document.getElementById("conta-box");
    if (log2.style.visibility == "hidden") {
        log2.style.visibility = "visible";
    }
    else {
        log2.style.visibility = "hidden";
    }
}