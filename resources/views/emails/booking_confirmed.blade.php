<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تأكيد الحجز</title>
</head>

<body style="font-family: Arial, sans-serif; text-align: right; direction: rtl; padding: 20px;">

    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
        <h2 style="color: #2d3748;">مرحباً {{ $booking->users->name ?? 'عزيزي المشترك' }} 👋</h2>

        <p style="font-size: 16px; color: #4a5568;">
            يسعدنا إبلاغك بأنه تم استلام الدفعة بنجاح وتفعيل حجزك.
        </p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>رقم المرجع:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $booking->batch_id }}</td>
            </tr>

            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>المبلغ الإجمالي المدفوع:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 18px;">
                    {{ $totalPrice }} </td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>الحالة:</strong></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd; color: green; font-weight: bold;">مؤكد
                    (Confirmed)</td>
            </tr>
        </table>

        <p style="margin-top: 30px; color: #718096; font-size: 14px;">
            شكراً لثقتك بنا، نتمنى لك تدريباً ممتعاً! 💪
        </p>
    </div>

</body>

</html>
