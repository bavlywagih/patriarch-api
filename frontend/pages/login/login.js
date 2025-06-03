// document.getElementById("loginForm").addEventListener("submit", function(e) {
//     e.preventDefault();
//     const email = document.getElementById("email").value;
//     const password = document.getElementById("password").value;

//     // مثال على التعامل مع البيانات
//     console.log("تم إرسال البيانات:", { email, password });

//     alert("تم تسجيل الدخول بنجاح (وهمي)!");
//   });

// document.getElementById("loginForm").addEventListener("submit", function (e) {
//     e.preventDefault(); // منع إعادة تحميل الصفحة

//     const email = document.getElementById("typeEmailX-2").value;
//     const password = document.getElementById("typePasswordX-2").value;

//     const data = {
//       email: email,
//       password: password
//     };

//     fetch("http://localhost:8080/patriarch-api/backend/login/login.php", { // عدّل المسار حسب موقع ملف PHP
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json"
//       },
//       body: JSON.stringify(data)
//     })
//     .then(response => response.json())
//     .then(result => {
//       console.log("الرد من السيرفر:", result);
//       alert(`Email: ${result.email}\nPassword: ${result.password}`);
//     })
//     .catch(error => {
//       console.error("خطأ:", error);
//       alert("حدث خطأ أثناء الإرسال.");
//     });
//   });
// =========================================================================
document.addEventListener("DOMContentLoaded", function() {
    const toastEl = document.getElementById("loginToast");
    const toastMsg = document.getElementById("toastMessage");
    const toast = toastEl ? new bootstrap.Toast(toastEl, { delay: 3000 }) : null;
    const BASE_URL = "http://localhost:8080/patriarch-api/frontend"; // عرّفه حسب مشروعك
  
    const secretKey = "patriarchkeysecret123!@#";
  
    function encryptData(data) {
      return CryptoJS.AES.encrypt(data, secretKey).toString();
    }
  
    function decryptData(ciphertext) {
      const bytes = CryptoJS.AES.decrypt(ciphertext, secretKey);
      return bytes.toString(CryptoJS.enc.Utf8);
    }
  
    function showToast(message, type = "success") {
      if (!toastEl || !toastMsg) return;
      toastEl.classList.remove("bg-success", "bg-danger");
      toastEl.classList.add(`bg-${type}`);
      toastMsg.textContent = message;
      toast?.show();
    }
  
    const form = document.getElementById("loginForm");
    if (form) {
      form.addEventListener("submit", function (e) {
        e.preventDefault();
  
        const emailInput = document.getElementById("typeEmailX-2");
        const passwordInput = document.getElementById("typePasswordX-2");
  
        if (!emailInput || !passwordInput) {
          showToast("❌ لم يتم العثور على حقول الإدخال", "danger");
          return;
        }
  
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
  
        if (!email || !password) {
          showToast("❌ يرجى إدخال البريد الإلكتروني وكلمة المرور", "danger");
          return;
        }
  
        const data = { email, password };
  
        fetch("http://localhost:8080/patriarch-api/backend/login/login.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(data),
        })
          .then(response => {
            if (!response.ok) throw new Error("فشل في الاتصال بالسيرفر");
            return response.json();
          })
          .then(result => {
            if (result.success) {
              localStorage.setItem("id", encryptData(result.id.toString()));
              localStorage.setItem("name", encryptData(result.name));
              localStorage.setItem("group_id", encryptData(result.group_id.toString()));
  
              const decryptedName = decryptData(localStorage.getItem("name"));
              showToast(`✅ مرحباً بك ${decryptedName}`, "success");
  
              setTimeout(() => {
                window.location.href = BASE_URL + "/home";
              }, 1000);
            } else {
              showToast(`❌ ${result.error}`, "danger");
            }
          })
          .catch(error => {
            console.error("خطأ:", error);
            showToast("❌ حدث خطأ أثناء الاتصال بالسيرفر", "danger");
          });
      });
    }
  });
  