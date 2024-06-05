<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Make Reservation</title>

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
                        <h2 class="form-title">Make Reservation</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('insert.reservation') }}">
                            @csrf
                            <div class="form-group">
                                <p>Select Class</p>
                                <select name="class_id" id="class-id" required style="width: 100%; box-sizing: border-box; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; background-color: #fff;">
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservation-date"><i class="zmdi zmdi-calendar-check"></i></label>
                                <input type="datetime-local" name="reservation_date" id="reservation-date" required/>
                                <span class="error" id="reservation-date-error"></span>
                            </div>  
                            <div class="form-group form-button">
                                <input type="submit" name="insert" id="insert" class="form-submit" value="Make"/>
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
