

<?php


?>






<!DOCTYPE html>
<html>
<head>
  <title>Hostel Dashboard</title>
  <style>
    /* CSS Styling */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .room {
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }

    .room h2 {
      margin-top: 0;
    }

    .room img {
      width: 100%;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .features {
      margin-bottom: 10px;
    }

    .booking-form {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    .form-group button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Brothers Hostel</h1>

    <div class="room">
      <h2>Room 1</h2>
      <img src="images/room1" alt="Room 1">
      <p>Price: $50 per night</p>
      <p class="features">Features: Wi-Fi, Air conditioning, TV</p>
    </div>

    <div class="room">
      <h2>Room 2</h2>
      <img src="images/room2.jpg" alt="Room 2">
      <p>Price: $40 per night</p>
      <p class="features">Features: Wi-Fi, Shared bathroom</p>
    </div>

    <div class="room">
      <h2>Room 3</h2>
      <img src="images/room3.jpg" alt="Room 3">
      <p>Price: $60 per night</p>
      <p class="features">Features: Wi-Fi, Air conditioning, Private bathroom</p>
    </div>

    <div class="booking-form">
      <h2>Booking Form</h2>
      <form>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" required>
        </div>

        <div class="form-group">
          <label for="room">Room:</label>
          <select id="room" required>
            <option value="">Select a room</option>
            <option value="Room 1">Room 1</option>
            <option value="Room 2">Room 2</option>
            <option value="Room 3">Room 3</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit">Book Now</button>
        </div>
      </form>
    </div>
  </div>
  <div style="text-align: left; font-size: 12px; color: #ff5733; background-color: #f1f1f1; padding: 12px; border-radius: 8px;">
    <a href="index.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 8px 16px; border-radius: 5px; font-weight: bold;">  Go to Home</a>
</div>
</body>
</html>

