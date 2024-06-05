<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('update');
            form.addEventListener('submit', function(event) {
                // Menghentikan pengiriman form
                event.preventDefault();

                // Ambil nilai dari form
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const passwordConfirm = document.getElementById('password-confirm').value;

                // Reset pesan error
                const errorElements = document.querySelectorAll('.error');
                errorElements.forEach(function(el) {
                    el.textContent = '';
                });

                let isValid = true;

                // Validasi nama
                if (name.trim() === '') {
                    document.getElementById('name-error').textContent = 'Name is required.';
                    isValid = false;
                }

                // Validasi email
                const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
                if (email.trim() === '') {
                    document.getElementById('email-error').textContent = 'Email is required.';
                    isValid = false;
                } else if (!email.match(emailPattern)) {
                    document.getElementById('email-error').textContent = 'Invalid email format.';
                    isValid = false;
                }

                // Validasi password
                if (password.trim() === '') {
                    document.getElementById('password-error').textContent = 'Password is required.';
                    isValid = false;
                } else if (password.length < 8) {
                    document.getElementById('password-error').textContent = 'Password must be at least 8 characters.';
                    isValid = false;
                }

                // Validasi konfirmasi password
                if (passwordConfirm.trim() === '') {
                    document.getElementById('password-confirm-error').textContent = 'Confirm Password is required.';
                    isValid = false;
                } else if (password !== passwordConfirm) {
                    document.getElementById('password-confirm-error').textContent = 'Passwords do not match.';
                    isValid = false;
                }

                // Jika validasi lolos, submit form
                if (isValid) {
                    form.submit();
                }
            });
        });
    </script>

</head>
<body>

    <div class="main">

        <!-- Sign up Form -->
        <section class="sign-up">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-image">
                        <figure><img src="{{ asset('images/energizer.svg') }}" alt="sign up image"></figure>
                    </div>
    
                    <div class="signup-form">
                        <h2 class="form-title">Update Data User</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('admin.update_user', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" placeholder="Name" required/>
                                <span class="error" id="name-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" value="{{ old('name', $user->email) }}" id="email" placeholder="Email" required/>
                                <span class="error" id="email-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="role"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="role" value="{{ old('name', $user->role) }}" placeholder="Role" required/>
                                <span class="error" id="email-error"></span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="update" id="update" class="form-submit" value="Update"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
    </div>
    

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
