const menuBtn = document.querySelector('#menu-btn')


document.addEventListener("DOMContentLoaded", function() {
    // JavaScript for dropdown menu
    document.addEventListener("click", function(e) {
        var dropdown = document.querySelector(".dropdown");
        if (!dropdown.contains(e.target)) {
            var dropdownContent = dropdown.querySelector(".dropdown-content");
            dropdownContent.classList.remove("show");
        }
    });

    document.querySelector(".dropbtn").addEventListener("click", function() {
        var dropdownContent = document.querySelector(".dropdown-content");
        dropdownContent.classList.toggle("show");
    });
});





menuBtn.addEventListener('click', ()=>{
    navbar.classList.toggle('active');
    document.addEventListener('click', (e)=>{
        if(!e.composedPath().includes(navbar) && !e.composedPath().includes(menuBtn) ){
            navbar.classList.remove('active');
        }
    })
})

