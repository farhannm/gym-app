<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Class</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('class-registration-form');
            form.addEventListener('submit', function(event) {
                // Prevent form submission
                event.preventDefault();

                // Get form values
                const trainerId = document.getElementById('trainer-id').value;
                const className = document.getElementById('class-name').value;
                const classDescription = document.getElementById('class-description').value;
                const startTime = document.getElementById('start-time').value;
                const endTime = document.getElementById('end-time').value;

                // Reset error messages
                const errorElements = document.querySelectorAll('.error');
                errorElements.forEach(function(el) {
                    el.textContent = '';
                });

                let isValid = true;

                // Validate trainer
                if (!trainerId) {
                    document.getElementById('trainer-id-error').textContent = 'Trainer is required.';
                    isValid = false;
                }

                // Validate class name
                if (className.trim() === '') {
                    document.getElementById('class-name-error').textContent = 'Class name is required.';
                    isValid = false;
                }

                // Validate class description
                if (classDescription.trim() === '') {
                    document.getElementById('class-description-error').textContent = 'Description is required.';
                    isValid = false;
                }

                // Validate start time
                if (!startTime) {
                    document.getElementById('start-time-error').textContent = 'Start time is required.';
                    isValid = false;
                }

                // Validate end time
                if (!endTime) {
                    document.getElementById('end-time-error').textContent = 'End time is required.';
                    isValid = false;
                } else if (new Date(startTime) >= new Date(endTime)) {
                    document.getElementById('end-time-error').textContent = 'End time must be after start time.';
                    isValid = false;
                }

                // Submit the form if validation passes
                if (isValid) {
                    form.submit();
                }
            });
        });
    </script>

</head>
<body>

    <div class="main">

        <section class="class-registration">
            <div class="container">
                <div class="registration-content">
                    <div class="registration-image">
                        <figure><img src="{{ asset('images/energizer.svg') }}" style="width: 100px; margin-top: 40px;" alt="class registration image"></figure>
                    </div>
    
                    <div class="registration-form">
                        <h2 class="form-title">Update Data Class</h2>
                        <form method="POST" class="register-form" id="class-registration-form" action="{{ route('admin.update_class', $classes->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <p>Select Trainer</p>
                                <select name="trainer_id" id="trainer-id" required style="width: 100%; box-sizing: border-box; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; background-color: #fff;">
                                    @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}" {{ old('trainer_id', $classes->trainer_id) == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                                    @endforeach
                                </select>
                                <span class="error" id="trainer-id-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="class-name"><i class="zmdi zmdi-collection-bookmark"></i></label>
                                <input type="text" name="name" id="class-name" value="{{ old('name', $classes->name) }}" placeholder="Class Name" required/>
                                <span class="error" id="class-name-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="class-description"><i class="zmdi zmdi-file-text"></i></label>
                                <input type="text" name="description" id="class-description" value="{{ old('description', $classes->description) }}" placeholder="Description" required/>
                                <span class="error" id="class-description-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="start-time"><i class="zmdi zmdi-time"></i></label>
                                <input type="datetime-local" name="start_time" value="{{ old('start_time', $classes->start_time) }}" id="start-time" required/>
                                <span class="error" id="start-time-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="end-time"><i class="zmdi zmdi-time"></i></label>
                                <input type="datetime-local" name="end_time" value="{{ old('end_time', $classes->end_time) }}" id="end-time" required/>
                                <span class="error" id="end-time-error"></span>
                            </div>                            
                            <div class="form-group form-button">
                                <input type="submit" name="register" id="update" class="form-submit" value="Update"/>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </section>
    
    </div>
    
</body>
</html>
