var darkmod = true; console.log("var darkmod = " + darkmod);
var ebody = document.getElementById("body");
var eheader = document.getElementById("header");

function ColorMod() {
    if(darkmod){
        eheader.classList.remove("header-dark"); 
        eheader.classList.add("header-light");
        ebody.classList.remove("body-dark"); 
        ebody.classList.add("body-light");
        darkmod = false;
        console.log("light color-panel on");
    }
    else if(!darkmod){
        eheader.classList.remove("header-light"); 
        eheader.classList.add("header-dark");
        ebody.classList.remove("body-light"); 
        ebody.classList.add("body-dark");
        darkmod = true;
        console.log("dark color-panel on");

    }
}

var LPO = false; console.log("var LPO = " + LPO); //Login Panel Open ?
var elogin = document.getElementsById("header-login-panel");

function LoginPanel() {
    if(!LPO){
        // elogin.style.display = 'block';
        LPO = true; console.log("LPO = " + LPO);
    }
    else if(LPO){
        // elogin.style.display = 'none';
        LPO = false; console.log("LPO = " + LPO);
    }
}
const btn = document.getElementById('btn');

btn.addEventListener('click', () => {
  // 👇️ hide button
  btn.style.display = 'none';

  // 👇️ show div
  const box = document.getElementById('box');
  box.style.display = 'block';
});

function checkboxLogin() {
    var checkBox = document.getElementById("header-login");
    var div = document.getElementById("header-login-panel");
    if (checkBox.checked == true){
      div.style.display = "block";
    } else {
       div.style.display = "none";
    }
  }