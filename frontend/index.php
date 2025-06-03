<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php
    $request = $_SERVER['REQUEST_URI'];
    $mainurl = "/patriarch-api/frontend";
    $request = str_replace($mainurl . '/', '', $request);

    // معالجة الدخول المباشر وعرض الصفحة المناسبة داخل #app
    $page = explode('/', $request)[0];
    $page = $page === '' ? 'home' : $page;
    $pageFile = __DIR__ . "/pages/$page/$page.php";

    ob_start();
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        http_response_code(404);
        include __DIR__ . '/pages/error/404.php';
    }
    $pageContent = ob_get_clean();

    include "header/header.php";
    ?>
</head>

<body>
    <?php include "components/navbar/navbar.php"; ?>

    <div id="app">
        <?php echo $pageContent; ?>
    </div>
    <?php include "components/toast/toast.php"; ?>


    <script>
        // دالة التنقل الديناميكي عبر JavaScript داخل الموقع
        function navigate(event, page) {
            event.preventDefault();

            const url = `<?php echo $mainurl ?>/${page}`;
            history.pushState({}, "", url);
            updateTitle(page);
            updateNavbarActive(page);

            fetch(`pages/${page}/${page}.php`)
                .then(res => {
                    if (!res.ok) throw new Error('Page not found');
                    return res.text();
                })
                .then(html => {
                    document.getElementById("app").innerHTML = html;
                })
                .catch(() => {
                    fetch(`pages/error/404.php`)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("app").innerHTML = html;
                        });
                });
        }

        // التعامل مع أزرار الرجوع والتقدم في المتصفح
        window.onpopstate = () => {
            const path = window.location.pathname.replace('<?php echo $mainurl ?>/', '');
            const page = path.split('/')[0] || 'home';

            fetch(`pages/${page}/${page}.php`)
                .then(res => {
                    if (!res.ok) throw new Error('Page not found');
                    return res.text();
                })
                .then(html => {
                    document.getElementById("app").innerHTML = html;
                    updateNavbarActive(page);
                    updateTitle(page);
                })
                .catch(() => {
                    fetch(`pages/error/404.php`)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("app").innerHTML = html;
                            updateTitle('404');
                        });
                });
        };

        // تحديث عنوان الصفحة بناء على الصفحة الحالية
        function updateTitle(page) {
            if (page === "home") {
                document.title = "الصفحة الرئيسية";
            } else if (page === "patriarchs") {
                document.title = "الآباء الأساقفة";
            } else if (page === "404") {
                document.title = "صفحة غير موجودة - خطأ 404";
            } else {
                document.title = page;
            }
        }

        // تحديث حالة العنصر النشط في شريط التنقل
        function updateNavbarActive(page) {
            const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navbarLinks.forEach(link => link.classList.remove('active'));

            const activeLink = document.querySelector(`.navbar-nav .nav-link[href*='${page}']`);
            if (activeLink) activeLink.classList.add('active');
        }

        // عند تحميل الصفحة لأول مرة، ضبط العنوان والـ Navbar
        window.addEventListener("DOMContentLoaded", () => {
            const path = window.location.pathname.replace('<?php echo $mainurl ?>/', '');
            const page = path.split('/')[0] || 'home';
            updateNavbarActive(page);
            updateTitle(page);
        });
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

        // عند الضغط على أيقونة تغيير الثيم
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




    <?php include "footer/footer.php"; ?>
</body>

</html>