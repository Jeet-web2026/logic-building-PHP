<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Logout</title>

    <!-- boootstrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- custom css cdn -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section id="form">
        <div class="container d-flex justify-content-center align-items-center">
            <form id="login-form" action="" class="w-50 border p-5 rounded rounded-4" method="POST">
                <div id="error-message"></div>
                <div class="mb-3">
                    <label for="login-email" class="form-label">From</label>
                    <input type="email" class="form-control" id="login-email" name="login-email" autocomplete="off">
                </div>
                <div class="mb-4">
                    <label for="login-password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="login-password" name="login-password">
                </div>
                <center>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </center>
                <p class="mb-0 mt-3 text-center">New here? <span class="open-signup text-primary">Signup</span></p>
            </form>
            <form id="signup-form" action="verification/signup-verification.php" class="w-50 border p-5 rounded rounded-4" method="POST">
                <div id="alert"></div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full name</label>
                    <input type="text" class="form-control" id="fullname" name="signname">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="signemail">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="signpassword">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#login-form').siblings().hide();
            $('.open-signup').css({
                'cursor': 'pointer',
            });
            $('.open-signup').on('click', function() {
                $('#signup-form').show();
                $('#signup-form').siblings().hide();
            });
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                $.ajax({
                    url: "verification/login-verify.php",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response === 'You are logged in successfully!') {
                            $('#error-message').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ${response}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);

                            setTimeout(function() {
                                window.location.href = '/login-logout-system/admin-dashboard.php';
                            }, 2000);

                        } else {
                            $('#error-message').html(`
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    ${response}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#error-message').text('An error occurred. Please try again later.');
                    }
                });
            });

            $('#signup-form').on('submit', function(e) {
                e.preventDefault();
                let signupData = $(this).serialize();
                $.ajax({
                    url: "verification/signup-verification.php",
                    method: "POST",
                    data: signupData,
                    success: function(response) {
                        $('#alert').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${response}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        $('#alert').text('An error occurred. Please try again later.');
                    }
                });
            });



        });
    </script>

</body>

</html>