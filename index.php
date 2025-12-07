<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEasy - Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 680px;
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #334155;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
        }

        .form-group input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .form-group input.success {
            border-color: #22c55e;
            background: #f0fdf4;
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-text.show {
            display: block;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 12px;
            padding: 4px 8px;
        }

        .password-toggle:hover {
            color: #1e40af;
        }

        .register-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .register-button.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .error-message {
            background: #fef2f2;
            border: 2px solid #fca5a5;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .success-message {
            background: #f0fdf4;
            border: 2px solid #86efac;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .success-message.show {
            display: block;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .login-container {
                margin: 20px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-body {
                padding: 30px 20px;
            }
            
            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">SE</div>
            <h1>SHOPEASY - REGISTRATION</h1>
        </div>
        
        <div class="login-body">
            <?php
            // Display success message if registration was successful
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<div class="success-message show" id="successMessage">
                        Registration successful! Redirecting to homepage...
                      </div>';
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "index.php";
                        }, 2000);
                      </script>';
            }
            
            // Display error message if there was an error
            if (isset($_GET['error'])) {
                $errorMsg = '';
                switch ($_GET['error']) {
                    case 'email_exists':
                        $errorMsg = 'Email already exists. Please use a different email.';
                        break;
                    case 'db_error':
                        $errorMsg = 'Database error. Please try again later.';
                        break;
                    case 'validation_error':
                        $errorMsg = 'Please fill all fields correctly.';
                        break;
                    case 'invalid_email':
                        $errorMsg = 'Please enter a valid email address.';
                        break;
                    case 'invalid_age':
                        $errorMsg = 'Age must be between 1 and 120.';
                        break;
                    case 'invalid_phone':
                        $errorMsg = 'Please enter a valid phone number.';
                        break;
                    case 'password_mismatch':
                        $errorMsg = 'Passwords do not match.';
                        break;
                    case 'password_length':
                        $errorMsg = 'Password must be at least 6 characters long.';
                        break;
                    default:
                        $errorMsg = 'An error occurred. Please try again.';
                }
                echo '<div class="error-message show" id="errorMessage">' . $errorMsg . '</div>';
            }
            ?>
            
            <form id="registerForm" action="process_register.php" method="POST" novalidate>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input 
                            type="text" 
                            id="first_name" 
                            name="first_name" 
                            placeholder="Enter your first name"
                            autocomplete="given-name"
                            value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>"
                            required
                        >
                        <div class="error-text" id="first_name_error">First name is required and must be at least 2 characters</div>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                placeholder="Enter your Last name"
                                value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="last_name_error">Last name is required and must be at least 2 characters</div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <div class="input-wrapper">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="Enter your Email"
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="email_error">Please enter a valid email address</div>
                    </div>

                    <div class="form-group">
                        <label for="age">Age *</label>
                        <div class="input-wrapper">
                            <input 
                                type="number" 
                                id="age" 
                                name="age" 
                                placeholder="Enter your Age"
                                min="1"
                                max="120"
                                value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="age_error">Age must be between 1 and 120</div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="number">Mobile Number *</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="number" 
                                name="number" 
                                placeholder="Enter your Mobile Number"
                                value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="number_error">Please enter a valid phone number</div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address *</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="address" 
                                name="address" 
                                placeholder="Enter your Address"
                                value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="address_error">Address is required</div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="country">Country *</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="country" 
                                name="country" 
                                placeholder="Enter your Country"
                                value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="country_error">Country is required</div>
                    </div>

                    <div class="form-group">
                        <label for="region">State/Region *</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="region" 
                                name="region" 
                                placeholder="Enter your State/Region"
                                value="<?php echo isset($_POST['region']) ? htmlspecialchars($_POST['region']) : ''; ?>"
                                required
                            >
                        </div>
                        <div class="error-text" id="region_error">State/Region is required</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="school">School *</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="school" 
                            name="school" 
                            placeholder="Enter your School"
                            value="<?php echo isset($_POST['school']) ? htmlspecialchars($_POST['school']) : ''; ?>"
                            required
                        >
                    </div>
                    <div class="error-text" id="school_error">School is required</div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password"
                                autocomplete="new-password"
                                required
                            >
                            <button type="button" class="password-toggle" id="togglePassword">
                                Show
                            </button>
                        </div>
                        <div class="error-text" id="password_error">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password *</label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                id="confirm_password" 
                                name="confirm_password" 
                                placeholder="Confirm your password"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                        <div class="error-text" id="confirm_password_error">Passwords must match</div>
                    </div>
                </div>

                <button type="submit" class="register-button" id="registerButton">
                    Register
                </button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>

    <script>
        // Password toggle functionality
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            confirmPasswordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });

        // Validation functions
        function validateFirstName() {
            const firstName = document.getElementById('first_name');
            const error = document.getElementById('first_name_error');
            const value = firstName.value.trim();
            
            if (value.length < 2) {
                firstName.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                firstName.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateLastName() {
            const lastName = document.getElementById('last_name');
            const error = document.getElementById('last_name_error');
            const value = lastName.value.trim();
            
            if (value.length < 2) {
                lastName.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                lastName.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateEmail() {
            const email = document.getElementById('email');
            const error = document.getElementById('email_error');
            const value = email.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailRegex.test(value)) {
                email.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                email.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateAge() {
            const age = document.getElementById('age');
            const error = document.getElementById('age_error');
            const value = parseInt(age.value);
            
            if (isNaN(value) || value < 1 || value > 120) {
                age.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                age.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validatePhone() {
            const phone = document.getElementById('number');
            const error = document.getElementById('number_error');
            const value = phone.value.trim();
            const phoneRegex = /^[\+]?[0-9][\d]{0,15}$/;
            
            // Remove any non-digit characters except leading +
            const cleaned = value.replace(/[^\d+]/g, '');
            
            if (!phoneRegex.test(cleaned) || cleaned.length < 10) {
                phone.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                phone.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateAddress() {
            const address = document.getElementById('address');
            const error = document.getElementById('address_error');
            const value = address.value.trim();
            
            if (value.length < 5) {
                address.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                address.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateCountry() {
            const country = document.getElementById('country');
            const error = document.getElementById('country_error');
            const value = country.value.trim();
            
            if (value.length < 2) {
                country.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                country.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateRegion() {
            const region = document.getElementById('region');
            const error = document.getElementById('region_error');
            const value = region.value.trim();
            
            if (value.length < 2) {
                region.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                region.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateSchool() {
            const school = document.getElementById('school');
            const error = document.getElementById('school_error');
            const value = school.value.trim();
            
            if (value.length < 2) {
                school.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                school.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validatePassword() {
            const password = document.getElementById('password');
            const error = document.getElementById('password_error');
            const value = password.value;
            
            if (value.length < 6) {
                password.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                password.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        function validateConfirmPassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password');
            const error = document.getElementById('confirm_password_error');
            const value = confirmPassword.value;
            
            if (value !== password) {
                confirmPassword.classList.add('error');
                error.classList.add('show');
                return false;
            } else {
                confirmPassword.classList.remove('error');
                error.classList.remove('show');
                return true;
            }
        }

        // Add event listeners for real-time validation
        document.getElementById('first_name').addEventListener('blur', validateFirstName);
        document.getElementById('last_name').addEventListener('blur', validateLastName);
        document.getElementById('email').addEventListener('blur', validateEmail);
        document.getElementById('age').addEventListener('blur', validateAge);
        document.getElementById('number').addEventListener('blur', validatePhone);
        document.getElementById('address').addEventListener('blur', validateAddress);
        document.getElementById('country').addEventListener('blur', validateCountry);
        document.getElementById('region').addEventListener('blur', validateRegion);
        document.getElementById('school').addEventListener('blur', validateSchool);
        document.getElementById('password').addEventListener('blur', validatePassword);
        document.getElementById('password').addEventListener('input', validateConfirmPassword);
        document.getElementById('confirm_password').addEventListener('blur', validateConfirmPassword);
        document.getElementById('confirm_password').addEventListener('input', validateConfirmPassword);

        // Form validation on submit
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all fields
            const isFirstNameValid = validateFirstName();
            const isLastNameValid = validateLastName();
            const isEmailValid = validateEmail();
            const isAgeValid = validateAge();
            const isPhoneValid = validatePhone();
            const isAddressValid = validateAddress();
            const isCountryValid = validateCountry();
            const isRegionValid = validateRegion();
            const isSchoolValid = validateSchool();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();
            
            // Check if all validations passed
            if (isFirstNameValid && isLastNameValid && isEmailValid && 
                isAgeValid && isPhoneValid && isAddressValid && 
                isCountryValid && isRegionValid && isSchoolValid && 
                isPasswordValid && isConfirmPasswordValid) {
                
                // Show loading state
                const button = document.getElementById('registerButton');
                button.classList.add('loading');
                button.innerHTML = 'Registering...';
                
                // Submit the form after a brief delay to show loading state
                setTimeout(() => {
                    form.submit();
                }, 500);
            } else {
                // Scroll to first error
                const firstError = document.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Add focus effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>