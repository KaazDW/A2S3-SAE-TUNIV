// function checkboxLogin() {
//     var checkBox = document.getElementById("header-login");
//     var div = document.getElementById("header-login-panel");
//     if (checkBox.checked == true){
//       div.style.display = "block";
//     } else {
//        div.style.display = "none";
//     }
// }
console.log(">> app.js open");
function MobileMenu(){
    var menu_checkbox = document.getElementById("mobile-menu-id");
    var menu_display = document.getElementById("menu-display");

    console.log("checkbox mobile_menu stat : " + menu_checkbox.value);

    // navIcon.classList.remove('fa-xmark');
    // navIcon.classList.add('fa-bars');

    if (menu_checkbox.checked == true){
        // menu_display.style.display = "block";
        menu_display.classList.remove("mobilemenu-closed");
        menu_display.classList.add("mobilemenu-open");

    } else {
        // menu_display.style.display = "none";
        menu_display.classList.add("mobilemenu-closed");
        menu_display.classList.remove("mobilemenu-open");
    }
}

