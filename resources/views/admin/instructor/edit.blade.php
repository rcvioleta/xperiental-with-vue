<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instructor</title>
</head>
<body>
    <h1>Edit- Instructor</h1>

    <form action="{{ route('instructor.update', ['id' => $instructor->id]) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" name="id_num" value="{{ $instructor->id_num }}"><br><br>
        <span>Upload a new avatar or leave it as is</span><br>
        <input type="file" name="image"><br><br>
        <input type="text" name="first_name" value="{{ $instructor->first_name }}"><br><br>
        <input type="text" name="middle_name" value="{{ $instructor->middle_name }}"><br><br>
        <input type="text" name="last_name" value="{{ $instructor->last_name }}"><br><br>
        <input type="text" name="position" value="{{ $instructor->position }}"><br><br>
        <input type="text" name="gender" value="{{ $instructor->gender }}"><br><br>
        <input type="text" name="bday" value="{{ $instructor->bday }}"><br><br>
        <input type="text" name="contact_num" value="{{ $instructor->contact_num }}"><br><br>
        <input type="text" name="address" value="{{ $instructor->address }}"><br><br>
        <input type="text" name="hired_date" value="{{ $instructor->hired_date }}"><br><br>
        <select name="status" id="">
            <option value="{{ $instructor->status == 1 ? '1' : '0' }}" selected>
                {{ $instructor->status == 1 ? 'Active' : 'Inactive' }}
            </option>
            <option value="{{ $instructor->status == 1 ? '0' : '1' }}">
                {{ $instructor->status == 1 ? 'Inactive' : 'Active' }}
            </option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>