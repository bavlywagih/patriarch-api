<!DOCTYPE html>
<html lang="ar" dir="rtl">
<!-- data-bs-theme="dark" -->

<head>

    <?php
    $request = $_SERVER['REQUEST_URI'];
    $request = str_replace('/patriarch/frontend/', '', $request);
    include "header/header.php";
    $mainurl = "/patriarch/frontend";
    // $mainurl = "";  server
    ?>
</head>

<body>
    <?php
    include "components/navbar/navbar.php";
    ?>
    <div id="app"></div>

    <script>
        // Function to load pages dynamically
        function navigate(event, page) {
            event.preventDefault();

            // Change URL in the browser without refreshing
            const url = `<?php echo $mainurl ?>/${page}`;
            history.pushState({}, "", url);
            updateTitle(page);
            updateNavbarActive(page); // Update navbar active page


            // Load page content dynamically
            fetch(`pages/${page}/${page}.php`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("app").innerHTML = html;
                })
                .catch(() => {
                    document.getElementById("app").innerHTML = "<h2>Page Not Found</h2>";
                });
        }



        // Handle browser back/forward buttons
        window.onpopstate = () => {
            const path = window.location.pathname.replace('<?php echo $mainurl ?>/', '');
            const page = path.split('/')[0] || '/';

            // Load the page based on the URL
            fetch(`pages/${page}/${page}.php`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("app").innerHTML = html;
                })
                .catch(() => {
                    document.getElementById("app").innerHTML = "<h2>Page Not Found</h2>";
                });
        };

        function updateTitle(page) {
            if (page === "home") {
                document.title = "home";
            } else if (page === "about") {
                document.title = "about";
            } else {
                document.title = "ah yaniii";
            }
        }

        // Initial page load based on URL when the page first loads
        window.addEventListener("DOMContentLoaded", () => {
            const path = window.location.pathname.replace('<?php echo $mainurl ?>/', '');
            const page = path.split('/')[0] || 'home'; // Default to 'home' if no path is present

            // Dynamically load the page based on the URL
            fetch(`pages/${page}/${page}.php`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("app").innerHTML = html;
                })
                .catch(() => {
                    document.getElementById("app").innerHTML = "<h2>Page Not Found</h2>";
                });
            updateTitle(page); // Update the title based on the current page
            updateNavbarActive(page); // Update navbar active page


        });

        function updateNavbarActive(page) {
            // Reset all navbar links
            const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navbarLinks.forEach(link => link.classList.remove('active'));

            // Add active class to the link corresponding to the current page
            const activeLink = document.querySelector(`.navbar-nav .nav-link[href*='${page}']`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
        }
    </script>
    <script>
        // استرجاع الثيم من session عند تحميل الصفحة
        window.addEventListener("DOMContentLoaded", () => {
            const savedTheme = sessionStorage.getItem("theme");
            const html = document.documentElement;
            const icon = document.getElementById("theme-toggle");

            if (savedTheme === "dark") {
                html.setAttribute("data-bs-theme", "dark");
                icon.classList.remove("fa-moon");
                icon.classList.add("fa-sun");
            } else {
                html.setAttribute("data-bs-theme", "light");
                icon.classList.remove("fa-sun");
                icon.classList.add("fa-moon");
            }
        });

        // عند الضغط على الأيقونة
        document.getElementById("theme-toggle").addEventListener("click", () => {
            const html = document.documentElement;
            const icon = document.getElementById("theme-toggle");
            const currentTheme = html.getAttribute("data-bs-theme");

            if (currentTheme === "dark") {
                html.setAttribute("data-bs-theme", "light");
                icon.classList.remove("fa-sun");
                icon.classList.add("fa-moon");
                sessionStorage.setItem("theme", "light");
            } else {
                html.setAttribute("data-bs-theme", "dark");
                icon.classList.remove("fa-moon");
                icon.classList.add("fa-sun");
                sessionStorage.setItem("theme", "dark");
            }
        });
    </script>



    <?php


    // }

    // switch ($request) {
    //     case '':
    //     case '/':
    //     case 'about':
    //         include 'pages/about/about.php';
    //         break;
    //     default:
    //         http_response_code(404);
    //         include 'pages/error/404.php';
    //         break;
    // }
    include "footer/footer.php";

    ?>