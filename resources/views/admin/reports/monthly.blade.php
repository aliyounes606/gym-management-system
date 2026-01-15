<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #fff;
            margin: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #1f2937;
            margin-bottom: 20px;
            font-size: 26px;
        }

        p.period {
            text-align: center;
            font-size: 15px;
            color: #374151;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #1f2937;
            font-weight: bold;
        }

        td.value {
            font-weight: bold;
            color: #1f2937;
            font-size: 16px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <h1> Monthly Gym Report</h1>
    <p class="period">Period: from {{ $start }} to {{ $end }}</p>

    <table>
        <tr>
            <th>Total Members</th>
            <td class="value">{{ $totalMembers }}</td>
        </tr>
        <tr>
            <th>Total Trainers</th>
            <td class="value">{{ $totalTrainers }}</td>
        </tr>
        <tr>
            <th>Monthly Revenue</th>
            <td class="value">{{ number_format($monthlyRevenue, 2) }}</td>
        </tr>
        <tr>
            <th>Pending Payments</th>
            <td class="value">{{ number_format($pendingPayments, 2) }}</td>
        </tr>
        <tr>
            <th>Pending Requests</th>
            <td class="value">{{ $pendingRequestsCount }}</td>
        </tr>
        <tr>
            <th>Active Sessions</th>
            <td class="value">{{ $activeSessions }}</td>
        </tr>
    </table>

    <div class="footer">
        Report generated on {{ $dateGenerated }}
    </div>
</body>

</html>
