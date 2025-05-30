<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $mainurl ?>/home" onclick="navigate(event, 'home')">الاباء البطاركه</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo $mainurl ?>/home" onclick="navigate(event, 'home')">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainurl ?>/patriarchs" onclick="navigate(event, 'patriarchs')">الاباء البطاركة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainurl ?>/login.php" onclick="navigate(event, 'login')">تسجيل الدخول </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainurl ?>/signin.php" onclick="navigate(event, 'signin')">انشاء حساب</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <i class="fa-solid fa-moon p-2" id="theme-toggle" style="cursor: pointer;"></i>
        </div>
    </div>
</nav>