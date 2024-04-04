<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./dangnhap/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="top_link"></div>
                <div class="contact">
                    <form action="">
                        <h3>SIGN IN</h3>
                        <div class="google">
                            <div class="google-icon-wrapper">
                                <img class="google-icon"
                                    src="https://www.google.com/images/hpp/ic_wahlberg_product_core_48.png8.png" />
                            </div>
                            <a class="btn-text" href='/auth/google'><b>Sign in with google</b></a>
                        </div>
                        <input type="text" placeholder="EMAIL" id="email">
                        <input type="text" placeholder="PASSWORD" id="password">
                        <button class="submit" id="login">Đăng nhập</button>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="right-text">
                    <h2>WELCOME !!!</h2>
                    <h5>Đăng nhập để tiếp tục</h5>
                </div>
                <div class="right-inductor"><img
                        src="https://lh3.googleusercontent.com/fife/ABSRlIoGiXn2r0SBm7bjFHea6iCUOyY0N2SrvhNUT-orJfyGNRSMO2vfqar3R-xs5Z4xbeqYwrEMq2FXKGXm-l_H6QAlwCBk9uceKBfG-FjacfftM0WM_aoUC_oxRSXXYspQE3tCMHGvMBlb2K1NAdU6qWv3VAQAPdCo8VwTgdnyWv08CmeZ8hX_6Ty8FzetXYKnfXb0CTEFQOVF4p3R58LksVUd73FU6564OsrJt918LPEwqIPAPQ4dMgiH73sgLXnDndUDCdLSDHMSirr4uUaqbiWQq-X1SNdkh-3jzjhW4keeNt1TgQHSrzW3maYO3ryueQzYoMEhts8MP8HH5gs2NkCar9cr_guunglU7Zqaede4cLFhsCZWBLVHY4cKHgk8SzfH_0Rn3St2AQen9MaiT38L5QXsaq6zFMuGiT8M2Md50eS0JdRTdlWLJApbgAUqI3zltUXce-MaCrDtp_UiI6x3IR4fEZiCo0XDyoAesFjXZg9cIuSsLTiKkSAGzzledJU3crgSHjAIycQN2PH2_dBIa3ibAJLphqq6zLh0qiQn_dHh83ru2y7MgxRU85ithgjdIk3PgplREbW9_PLv5j9juYc1WXFNW9ML80UlTaC9D2rP3i80zESJJY56faKsA5GVCIFiUtc3EewSM_C0bkJSMiobIWiXFz7pMcadgZlweUdjBcjvaepHBe8wou0ZtDM9TKom0hs_nx_AKy0dnXGNWI1qftTjAg=w1920-h979-ft"
                        alt=""></div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            login();
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });


        function login() {
            $('#login').click(function(e) {
                e.preventDefault();
                var email = $('#email').val().trim();
                var password = $('#password').val().trim();
                if (email == '') {
                    Toast.fire({
                        icon: "error",
                        title: "Chưa nhập email"
                    });
                } else if (password == '') {
                    Toast.fire({
                        icon: "error",
                        title: "Chưa nhập mật khẩu"
                    });
                } else {
                    $.ajax({
                        type: "post",
                        url: "/login",
                        data: {
                            email: email,
                            password: password
                        },
                        dataType: "JSON",
                        success: function(res) {
                            if (res.check == true) {
                                Toast.fire({
                                    icon: "success",
                                    title: "Đăng nhập thành công"
                                }).then(() => {
                                    window.location.replace('/role');
                                })
                            } else if (res.msg.email) {
                                Toast.fire({
                                    icon: "error",
                                    title: res.msg.email
                                });
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: res.msg
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>
