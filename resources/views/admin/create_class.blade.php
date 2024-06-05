<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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
                        <h2 class="form-title">Add New Class</h2>
                        <form method="POST" class="register-form" id="class-registration-form" action="{{ route('admin.insert_class') }}">
                            @csrf
                            <div class="form-group">
                                <p>Select Trainer</p>
                                <select name="trainer_id" id="trainer-id" required style="width: 100%; box-sizing: border-box; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; background-color: #fff;">
                                    <option value=""></option>
                                    @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="class-name"><i class="zmdi zmdi-collection-bookmark"></i></label>
                                <input type="text" name="name" id="class-name" placeholder="Class Name" required/>
                                <span class="error" id="class-name-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="class-description"><i class="zmdi zmdi-file-text"></i></label>
                                <input type="text" name="description" id="class-description" placeholder="Description" required></input>
                                <span class="error" id="class-description-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="start-time"><i class="zmdi zmdi-time"></i></label>
                                <input type="datetime-local" name="start_time" id="start-time" required/>
                                <span class="error" id="start-time-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="end-time"><i class="zmdi zmdi-time"></i></label>
                                <input type="datetime-local" name="end_time" id="end-time" required/>
                                <span class="error" id="end-time-error"></span>
                            </div>                            
                            <div style="padding-bottom: 40px;" class="form-group form-button">
                                <input type="submit" name="register" id="register" class="form-submit" value="Create"/>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </section>
    
    </div>
    
</body>
</html>
