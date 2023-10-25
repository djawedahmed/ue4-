var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function(){
    document.querySelector("body").classList.toggle("active");
})
var hamburger = document.querySelector(".hamburger1");
hamburger.addEventListener("click", function(){
    document.querySelector("body").classList.toggle("active");
})

function openmenu() {
    var element = document.getElementById("tags");
    element.classList.add("mystyle");
    var element = document.getElementById("angle-down");
    element.classList.add("angle-down");
    var element = document.getElementById("angle-up");
    element.classList.remove("angle-up");
}
function closemenu() {
    var element = document.getElementById("tags");
    element.classList.remove("mystyle");
    var element = document.getElementById("angle-down");
    element.classList.remove("angle-down");
    var element = document.getElementById("angle-up");
    element.classList.add("angle-up");
}