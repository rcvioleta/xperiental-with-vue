<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create - Instructor</title>
</head>
<body>
    <h1>Add - Instructors</h1>

    <form action="{{ route('instructor.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" name="id_num" placeholder="ID Number"><br><br>
        <input type="file" name="image"><br><br>
        <input type="text" name="first_name" placeholder="First Name"><br><br>
        <input type="text" name="middle_name" placeholder="Middle Name"><br><br>
        <input type="text" name="last_name" placeholder="Last Name"><br><br>
        <input type="text" name="position" placeholder="Position"><br><br>
        Male: <input type="radio" name="gender" value="male">
        Female: <input type="radio" name="gender" value="female"><br><br>
        <span>Birth Date</span><br>
        <input type="date" name="bday"><br><br>
        <input type="text" name="contact_num" placeholder="Contact Number"><br><br>
        <input type="text" name="address" placeholder="Address"><br><br>
        <span>Hired Date</span><br>
        <input type="date" name="hired_date"><br><br>
        <select name="status" id="">
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
        </select><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>