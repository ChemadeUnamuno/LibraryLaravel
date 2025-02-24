<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Report - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<h1>{{ __('Loan Report - Admin') }}</h1>
<table>
    <thead>
    <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Surname') }}</th>
        <th>{{ __('Book Title') }}</th>
        <th>{{ __('Author') }}</th>
        <th>{{ __('Publisher') }}</th>
        <th>{{ __('Loan Date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->user->name }}</td>
            <td>{{ $loan->user->surname }}</td>
            <td>{{ $loan->book->titulo }}</td>
            <td>{{ $loan->book->autor }}</td>
            <td>{{ $loan->book->editorial }}</td>
            <td>{{ $loan->fecha_prestamo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
