## 📚 API Documentation

### 🔐 Authentication

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Register a new user |
| `POST` | `/api/login` | User login |
| `POST` | `/api/logout` | Logout (Token required) |

### 📅 Bookings

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/bookings/single` | Book a single session |
| `POST` | `/api/bookings/course` | Book a full course (Bulk) |

### ✅ Attendance

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/attendance/mark` | Mark member attendance |

### 🥗 Meal Plans

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/meals` | List all available meal plans |
| `GET` | `/api/meals/my-plans` | List my assigned meal plans |

### 🏋️ Courses & Sessions

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/courses` | List all available courses |
| `GET` | `/api/courses/{id}` | Get details of a specific course |
| `GET` | `/api/gymsessions` | List all sessions (**Supports Filtering**) |
| `GET` | `/api/gymsessions/{id}` | Get details of a specific session |

#### 🔍 Filtering Sessions 

You can filter the **Gym Sessions** list by adding query parameters to the URL:

| Parameter | Example Usage | Description |
| :--- | :--- | :--- |
| `trainer_id` | `/api/gymsessions?trainer_id=1` | Filter by specific **Trainer** |
| `course_id` | `/api/gymsessions?course_id=5` | Filter by specific **Course** |
| `category_id` | `/api/gymsessions?category_id=3` | Filter by specific **Category** |

### ⭐ Reviews & Ratings

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/course/{id}/review` | Submit a review for a **Course** |
| `POST` | `/api/trainer/{id}/review` | Submit a review for a **Trainer** |
| `POST` | `/api/mealplan/{id}/review` | Submit a review for a **Meal Plan** |
| `POST` | `/api/gymsession/{id}/review` | Submit a review for a **Gym Session** |


## 📄 Sample Responses 

### Single Session Booking Response:
```json
{
    "message": "تم استلام طلب الحجز. يرجى التوجه للاستقبال للدفع لتفعيل الحجز.",
    "booking_reference": "a1b2c3d4-e5f6-7890-1234-567890abcdef",
    "data": {
        "id": 102,
        "user_id": 15,
        "session_id": 5,
        "price": "50.00",
        "status": "pending",
        "payment_status": "unpaid",
        "created_at": "2026-01-17T10:30:00.000000Z"
    }
}
```

### Get Gym Sessions List Response:

```json
{
    "data": [
        {
            "id": 1,
            "name": "Morning Yoga",
            "start_time": "2026-01-18 08:00:00",
            "end_time": "2026-01-18 09:30:00",
            "capacity": 20,
            "current_bookings": 5,
            "trainer": {
                "id": 3,
                "name": "Coach Sarah",
                "specialization": "Yoga & Pilates"
            },
            "category": {
                "id": 2,
                "name": "Flexibility"
            }
        },
        {
            "id": 2,
            "name": "Heavy Lifting",
            "start_time": "2026-01-18 18:00:00",
            "end_time": "2026-01-18 19:30:00",
            "capacity": 15,
            "current_bookings": 15,
            "is_full": true,
            "trainer": {
                "id": 5,
                "name": "Captain Ali",
                "specialization": "Bodybuilding"
            }
        }
    ]
}
```
