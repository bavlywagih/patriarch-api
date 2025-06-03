<!-- Toast Container (Bottom-Left) -->







<form id="loginForm" name="loginForm">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">تسجيل الدخول</h3>

                        <div class="form-outline mb-4 form-d-flex">
                            <label class="form-label form-login-input" for="typeEmailX-2">البريد الالكتروني :</label>
                            <input type="email" id="typeEmailX-2" name="email" placeholder="اكتب البريد الالكتروني هنا " class="form-control form-control-lg form-login-input" />
                        </div>

                        <div class="form-outline mb-4 form-d-flex ">
                            <label class="form-label" for="typePasswordX-2">كلمة المرور :</label>
                            <input type="password" id="typePasswordX-2" name="password" placeholder="اكتب كلمه المرور هنا " class="form-control form-control-lg" />
                        </div>

                        <button class="btn btn-primary btn-lg w-100 btn-block" type="submit">تسجيل الدخول</button>

                        <hr class="my-4">

                        <button class="btn btn-lg btn-block " style="background-color: #dd4b39;" type="submit"><i class="fab fa-google me-2"></i> تسجيل الدخول بواسطه جوجل</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    const BASE_URL = "<?php echo $mainurl ?>";
</script>