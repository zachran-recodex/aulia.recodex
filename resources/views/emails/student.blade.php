<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blast Email</title>
</head>

<body>
    <h1>Halo, {{ $student->name }}</h1>

    <p>{{ $messageText }}</p>

    <h2>Informasi Mahasiswa</h2>
    <ul>
        <li><strong>Gender:</strong> {{ $student->gender }}</li>
        <li><strong>Phone:</strong> {{ $student->phone }}</li>
        <li><strong>University:</strong> {{ $student->university }}</li>
        <li><strong>Major:</strong> {{ $student->major }}</li>
        <li><strong>GPA:</strong> {{ $student->gpa }}</li>
        <li><strong>Year of Graduation:</strong> {{ $student->year_of_graduation }}</li>
        <li><strong>Domicile:</strong> {{ $student->domicile }}</li>
        <li><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</li>
    </ul>

    <p>
        <a href="{{ config('app.url') }}">Kunjungi Situs Kami</a>
    </p>

    <p>Terima kasih,</p>
    <p><strong>{{ config('app.name') }}</strong></p>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</body>

</html>
