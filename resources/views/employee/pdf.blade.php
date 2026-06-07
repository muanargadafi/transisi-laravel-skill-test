<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Employee</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header h2 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th {
            color: black;
            font-weight: bold;
            padding: 8px;
            border: 1px solid black;
            text-align: left;
        }
        td {
            padding: 8px;
            border: 1px solid black;
        }
        tr:nth-child(even) {
            background-color: black;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Data Employee</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No.</th>
                <th style="width: 20%">Name</th>
                <th style="width: 45%">Email</th>
                <th style="width: 30%">Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td scope="row" align="center">{{ $loop->iteration }}</td>
                    <td>{{ @$data->name }}</td>
                    <td>{{ @$data?->company?->name }}</td>
                    <td>{{ @$data->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
