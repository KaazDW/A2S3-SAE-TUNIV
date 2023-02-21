console.log(">> APP.JS FILE LOAD");

// SCROLL STYLE
window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("scroll-style", window.scrollY > 50);
})

// MOIBLE RESPONSIV STYLE
var nav = document.getElementById("mobilenav");
act = false;
nav.style.display = 'none'

function mobilemenu() {
    if (act === false){
        nav.style.display = 'flex'
        act = true;
        console.log("menu open ", act);
    } else{
        nav.style.display = 'none'
        act = false;
        console.log("menu close ", act);
    }
}

function fnBrowserDetect(){
             
    let userAgent = navigator.userAgent;
    let browserName;
    
    if(userAgent.match(/chrome|chromium|crios/i)){
        browserName = "chrome";
    }else if(userAgent.match(/firefox|fxios/i)){
        browserName = "firefox";
    }else if(userAgent.match(/safari/i)){
        browserName = "safari";
    }else if(userAgent.match(/opr\//i)){
        browserName = "opera";
    } else if(userAgent.match(/edg/i)){
        browserName = "edge";
    }else{
        browserName="No browser detection";
    }
    console.log(userAgent)
    console.log("You are using", browserName, "browser")
}
fnBrowserDetect()