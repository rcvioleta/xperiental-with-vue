<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instructor</title>
</head>
<body>
    <h1>Index page - Instructor</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Avatar</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Hired Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->id_num }}</td>
                    <td><image src="{{ asset($instructor->image) }}" width="60px"></td>
                    <td>{{ $instructor->first_name }}</td>
                    <td>{{ $instructor->middle_name }}</td>
                    <td>{{ $instructor->last_name }}</td>
                    <td>{{ $instructor->gender }}</td>
                    <td>{{ $instructor->bday }}</td>
                    <td>{{ $instructor->contact_num }}</td>
                    <td>{{ $instructor->address }}</td>
                    <td>{{ $instructor->hired_date }}</td>
                    <td>
                        @if ($instructor->status == 1)
                            <span>Current: Active</span><br>
                            <a href="{{ route('instructor.deactivate', ['id' => $instructor->id]) }}">Deactivate</a>
                        @else
                            <span>Current: Inactive</span><br>
                            <a href="{{ route('instructor.activate', ['id' => $instructor->id]) }}">Activate</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('instructor.edit', ['id' => $instructor->id]) }}">Edit</a> | 
                        <a href="{{ route('instructor.destroy', ['id' => $instructor->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>