document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.getElementById("navbarDropdown");
    var dropdownMenu = document.querySelector(".dropdown-menu");

    dropdownToggle.addEventListener("click", function() {
        dropdownMenu.classList.toggle("show");
    });

    window.addEventListener("click", function(event) {
        if (!dropdownToggle.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});

function open_sidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("open");

    var navbar = document.querySelector(".navbar");
    navbar.classList.toggle("sidebar-open");

    toggleSidebar();
}

function close_sidebar() {
    document.getElementById("sidebar").style.display = "none";
}

function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var rabContainer = document.querySelector(".rab-container");
    rabContainer.classList.toggle("add-margin");
}