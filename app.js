console.log(">> APP.JS FILE LOAD");
var nav = document.getElementById("nav");
act = false;

function mobilemenu() {
    if (act === false){
        nav.classList.remove("nonactive");
        nav.classList.add("active");
        act = true;
        console.log("menu : " + act);
    } else{
        nav.classList.remove("active");
        nav.classList.add("nonactive");
        act = false;
        console.log("menu : " + act);
    }
}
