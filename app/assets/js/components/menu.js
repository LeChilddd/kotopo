require('@assets/styles/menu.scss')

document.addEventListener('DOMContentLoaded', function () {
    document.getElementsByTagName("html")[0].style.visibility = "visible";
    document.querySelectorAll(".dropdown-menu").forEach(li => {
        setTimeout(()=>{
                li.classList.remove("opacity-0")
        }, 150)

    });
});


