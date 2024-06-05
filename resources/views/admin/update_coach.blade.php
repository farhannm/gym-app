<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Coach</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('insert');
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

                // Validasi phone
                if (phone.trim() === '') {
                    document.getElementById('phone-error').textContent = 'Phone is required.';
                    isValid = false;
                }

                // Validasi specialization
                if (specialization.trim() === '') {
                    document.getElementById('specialization-error').textContent = 'Specialization is required.';
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
                        <h2 class="form-title">Update Data Coach</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('admin.update_coach', $trainer->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" value="{{ old('name', $trainer->name) }}" id="name" placeholder="Name" required/>
                                <span class="error" id="name-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" value="{{ old('email', $trainer->email) }}" id="email" placeholder="Email" required/>
                                <span class="error" id="email-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" value="{{ old('phone', $trainer->phone) }}" id="phone" placeholder="Phone" required/>
                                <span class="error" id="phone-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="specialization"><i class="zmdi zmdi-assignment"></i></label>
                                <input type="text" name="specialization" value="{{ old('specialization', $trainer->specialization) }}" id="specialization" placeholder="Specialization" required/>
                                <span class="error" id="specialization-error"></span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="insert" id="insert" class="form-submit" value="Update"/>
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
