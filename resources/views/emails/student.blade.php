<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blast Email</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            padding: 10px;
            text-align: center;
            background-color: #f4f4f4;
            color: #999999;
            font-size: 12px;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0; padding: 0;">
    <div class="container">
        <div class="header">
            <h1>Halo, {{ $student->name }}</h1>
        </div>

        <div class="content">
            <p>{{ $messageText }}</p>

            <table class="table">
                <tr>
                    <th>Gender</th>
                    <td>{{ $student->gender }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $student->phone }}</td>
                </tr>
                <tr>
                    <th>University</th>
                    <td>{{ $student->university }}</td>
                </tr>
                <tr>
                    <th>Major</th>
                    <td>{{ $student->major }}</td>
                </tr>
                <tr>
                    <th>GPA</th>
                    <td>{{ $student->gpa }}</td>
                </tr>
                <tr>
                    <th>Year of Graduation</th>
                    <td>{{ $student->year_of_graduation }}</td>
                </tr>
                <tr>
                    <th>Domicile</th>
                    <td>{{ $student->domicile }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $student->date_of_birth }}</td>
                </tr>
            </table>

            <a href="{{ config('app.url') }}" class="btn-primary">Kunjungi Situs Kami</a>
        </div>

        <div class="footer">
            <p>Terima kasih,</p>
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
