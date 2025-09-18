<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook - Sign Up</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 10px;
    }

    .signup-container {
      background: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
    }

    .signup-container h1 {
      font-size: 32px;
      color: #1877f2;
      text-align: center;
      margin-bottom: 10px;
    }

    .signup-container p {
      text-align: center;
      margin-bottom: 20px;
      color: #606770;
      font-size: 14px;
    }

    .signup-container input, select {
      width: 100%;
      padding: 12px;
      margin: 6px 0;
      border: 1px solid #ccd0d5;
      border-radius: 6px;
      font-size: 14px;
    }

    .name-fields {
      display: flex;
      gap: 10px;
    }

    .dob, .gender {
      margin: 12px 0;
      font-size: 14px;
      color: #606770;
    }

    .dob select {
      width: 32%;
    }

    .gender-options {
      display: flex;
      justify-content: space-between;
      margin-top: 5px;
      gap: 8px;
    }

    .gender-options label {
      display: flex;
      align-items: center;
      gap: 6px;
      border: 1px solid #ccd0d5;
      padding: 6px 10px;
      border-radius: 6px;
      flex: 1;
      justify-content: center;
      font-size: 14px;
    }

    .signup-btn {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border: none;
      background: #42b72a;
      color: #fff;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s;
    }

    .signup-btn:hover {
      background: #36a420;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: #1877f2;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    /* ✅ Responsive */
    @media (max-width: 480px) {
      .name-fields {
        flex-direction: column;
      }
      .dob select {
        width: 100%;
        margin-bottom: 8px;
      }
      .gender-options {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h1>facebook</h1>
    <p>Create a new account</p>
    
    <form>
      <div class="name-fields">
        <input type="text" placeholder="First name" required>
        <input type="text" placeholder="Surname" required>
      </div>
      <input type="email" placeholder="Mobile number or email" required>
      <input type="password" placeholder="New password" required>
      
      <div class="dob">
        <label>Date of birth</label>
        <div>
          <!-- Day -->
          <select required>
            <option value="">Day</option>
            <script>
              for (let d = 1; d <= 31; d++) {
                document.write(`<option value="${d}">${d}</option>`);
              }
            </script>
          </select>

          <!-- Month -->
          <select required>
            <option value="">Month</option>
            <option>Jan</option>
            <option>Feb</option>
            <option>Mar</option>
            <option>Apr</option>
            <option>May</option>
            <option>Jun</option>
            <option>Jul</option>
            <option>Aug</option>
            <option>Sep</option>
            <option>Oct</option>
            <option>Nov</option>
            <option>Dec</option>
          </select>

          <!-- Year -->
          <select required>
            <option value="">Year</option>
            <script>
              for (let y = 2025; y >= 1900; y--) {
                document.write(`<option value="${y}">${y}</option>`);
              }
            </script>
          </select>
        </div>
      </div>

      <div class="gender">
        <label>Gender</label>
        <div class="gender-options">
          <label><input type="radio" name="gender"> Female</label>
          <label><input type="radio" name="gender"> Male</label>
          <label><input type="radio" name="gender"> Custom</label>
        </div>
      </div>

      <button type="submit" class="signup-btn">Sign Up</button>
    </form>

    <div class="login-link">
      <p>Already have an account? <a href="#">Log in</a></p>
    </div>
  </div>
</body>
</html>
