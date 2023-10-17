<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Inquiry</title>
</head>
<body>

    <h1>New Inquiry</h1>
    <table>
        <tr>
            <td>Name</td>
            <td>{{ $inquiry->first_name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $inquiry->email }}</td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>{{ $inquiry->phone }}</td>
        </tr>
        <tr>
            <td>Company</td>
            <td>{{ $inquiry->company_name }}</td>
        </tr>
        <tr>
            <td>Requirements</td>
            <td>{{ $inquiry->requirements }}</td>
        </tr>
        <tr>
            <td>Budget</td>
            <td>{{ $inquiry->budget }}</td>
        </tr>
    </table>
    
</body>
</html>