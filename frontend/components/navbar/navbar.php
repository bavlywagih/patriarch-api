<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $mainurl ?>/home" onclick="navigate(event, 'home')">الاباء البطاركه</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navLinks">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo $mainurl ?>/home" onclick="navigate(event, 'home')">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $mainurl ?>/patriarchs" onclick="navigate(event, 'patriarchs')">الاباء البطاركة</a>
                </li>
                <!-- تسجيل الدخول وإنشاء حساب يظهران تلقائيًا بواسطة JS إذا لم يكن المستخدم مسجّل -->
                <li class="nav-item" id="loginNavItem">
                    <a class="nav-link" href="<?php echo $mainurl ?>/login.php" onclick="navigate(event, 'login')">تسجيل الدخول</a>
                </li>
                <li class="nav-item" id="signinNavItem">
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

<script>
    const secretKey = "patriarchkeysecret123!@#"; // نفس مفتاح التشفير المستخدم في تسجيل الدخول

    function decryptData(ciphertext) {
        try {
            const bytes = CryptoJS.AES.decrypt(ciphertext, secretKey);
            return bytes.toString(CryptoJS.enc.Utf8);
        } catch {
            return null;
        }
    }

    function showToast(message, type = "success") {
        const toastEl = document.getElementById("loginToast");
        const toastMsg = document.getElementById("toastMessage");
        if (!toastEl || !toastMsg) return;

        toastEl.classList.remove("bg-success", "bg-danger");
        toastEl.classList.add(`bg-${type}`);
        toastMsg.textContent = message;

        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000
        });
        toast.show();
    }

    function addLoginLinks() {
        const navLinks = document.getElementById("navLinks");

        // تحقق إن روابط تسجيل الدخول غير موجودة أصلاً
        if (!document.getElementById("loginNavItem")) {
            const loginLi = document.createElement("li");
            loginLi.classList.add("nav-item");
            loginLi.id = "loginNavItem";
            loginLi.innerHTML = `<a class="nav-link" href="<?php echo $mainurl ?>/login.php" onclick="navigate(event, 'login')">تسجيل الدخول</a>`;
            navLinks.appendChild(loginLi);
        }

        if (!document.getElementById("signinNavItem")) {
            const signinLi = document.createElement("li");
            signinLi.classList.add("nav-item");
            signinLi.id = "signinNavItem";
            signinLi.innerHTML = `<a class="nav-link" href="<?php echo $mainurl ?>/signin.php" onclick="navigate(event, 'signin')">انشاء حساب</a>`;
            navLinks.appendChild(signinLi);
        }
    }

    function addUserDropdown(name) {
        const navLinks = document.getElementById("navLinks");

        // إزالة روابط تسجيل الدخول وإنشاء حساب لو موجودة
        const loginNavItem = document.getElementById("loginNavItem");
        if (loginNavItem) loginNavItem.remove();

        const signinNavItem = document.getElementById("signinNavItem");
        if (signinNavItem) signinNavItem.remove();

        // إضافة دروب داون باسم المستخدم
        const li = document.createElement("li");
        li.classList.add("nav-item", "dropdown");
        li.id = "userDropdown";

        li.innerHTML = `
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          ${name}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#" id="logoutBtn">تسجيل خروج</a></li>
        </ul>
    `;

        navLinks.appendChild(li);

        // إضافة حدث تسجيل الخروج
        document.getElementById("logoutBtn").addEventListener("click", (e) => {
            e.preventDefault();
            logout();
        });
    }

    function logout() {
        // إزالة البيانات المشفرة من localStorage
        localStorage.removeItem("id");
        localStorage.removeItem("name");
        localStorage.removeItem("group_id");

        showToast("✅ تم تسجيل الخروج بنجاح", "success");

        // إزالة الدروب داون و إعادة روابط تسجيل الدخول وإنشاء حساب بدون ريفرش
        const userDropdown = document.getElementById("userDropdown");
        if (userDropdown) userDropdown.remove();

        addLoginLinks();
    }

    document.addEventListener("DOMContentLoaded", () => {
        // تحقق إذا كان هناك اسم مستخدم مشفر في localStorage
        const encryptedName = localStorage.getItem("name");
        const decryptedName = encryptedName ? decryptData(encryptedName) : null;

        if (decryptedName) {
            addUserDropdown(decryptedName);
        } else {
            addLoginLinks();
        }
    });
</script>