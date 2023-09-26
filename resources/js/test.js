//When start scrolling the webpage, a class was add which is s "sticky"
window.addEventListener("scroll", function(){
    var header = this.document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
})