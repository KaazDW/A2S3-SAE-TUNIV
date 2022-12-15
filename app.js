console.log(">> APP.JS FILE LOAD");

// SCROLL STYLE
window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("scroll-style", window.scrollY > 50);
})


// MOIBLE RESPONSIV STYLE
// not finished
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

// THEME MOD FUNCTION
// not finished
var isdark = true;
var themeicon = document.getElementById("themebutton");
function theme(){
    if(isdark){
        isdark = false;
        console.log("dark theme OFF");
        themeicon.innerHTML="NUIT";

    } else{
        isdark = true;
        console.log("dark theme ON");
        themeicon.innerHTML="JOUR";
    }
}




