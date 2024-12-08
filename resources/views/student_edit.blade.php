<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-dark p-2">
            <h3 class="text-white">Laravel Project</h3>
        </div>
        <div class="row bg-info py-5">
            <div class="col-6">
                <h2>Registration</h2>
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               <form action="{{ route('update_student', $student->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" value="{{ $student->name }}" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control"  value="{{ $student->email }}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="tel" class="form-control"  value="{{ $student->phone }}" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" name="address" rows="3" required>{{ $student->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Gender:</label>
                        <select class="form-control" name="gender" required>
                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Others" {{ $student->gender == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" name="department"  value="{{ $student->department }}" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" {{ $student->parttime ? 'checked' : '' }} name="parttime">
                        <label class="form-check-label" for="parttime">Part-time Student</label>
                    </div>

                    <div class="form-group">
                        <label for="doj" class="form-label">Joined Date:</label>
                        <input type="date" class="form-control" name="doj"  value="{{ $student->doj }}" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>