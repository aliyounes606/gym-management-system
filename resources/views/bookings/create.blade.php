<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create Booking</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <label for="booking_type">Booking Type:</label>
        <select name="booking_type" id="booking_type" required>
            <option value="single">Single</option>
            <option value="group">Group</option>
        </select><br>

        <label for="amount_paid">Amount Paid:</label>
        <input type="number" step="0.01" name="amount_paid" id="amount_paid" required><br>

        <button type="submit">Create Booking</button>
    </form>
</body>
</html>