<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ __('Loan Report') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1>{{ __('Loan Report') }}</h1>
<table>
    <thead>
    <tr>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Author') }}</th>
        <th>{{ __('Publisher') }}</th>
        <th>{{ __('Loan Date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
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
