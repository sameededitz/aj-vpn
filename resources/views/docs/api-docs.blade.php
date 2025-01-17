<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">API Documentation</h1>

        <!-- API Login -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Login API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /login</h5>
                <p class="card-text">Authenticate a user with a username or email and password.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Request Parameters</h6>
                <ul>
                    <li><strong>name:</strong> (string, required) The username or email of the user.</li>
                    <li><strong>password:</strong> (string, required) The password of the user. Minimum 8 characters.
                    </li>
                    <li><strong>remember:</strong> (boolean, optional) Whether to remember the user.</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true, a message, user details, access token,
                    and token type.</p>
                <pre><code>{
    "status": true,
    "message": "User logged in successfully!",
    "user": { ... },
    "access_token": "token_string",
    "token_type": "Bearer"
}</code></pre>

                <p>If unsuccessful, returns a JSON response with a status of false and an error message.</p>
            </div>
        </div>

        <!-- API Signup -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Signup API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /signup</h5>
                <p class="card-text">Register a new user with the provided details.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Request Parameters</h6>
                <ul>
                    <li><strong>name:</strong> (string, required) The username of the new user. Must be unique and at
                        least 3 characters.</li>
                    <li><strong>email:</strong> (string, required) The email of the new user. Must be unique.</li>
                    <li><strong>password:</strong> (string, required) The password of the new user. Minimum 8
                        characters. Must be confirmed.</li>
                    <li><strong>password_confirmation:</strong> (string, required) The password confirmation.</li>
                    <li><strong>referral_code:</strong> (string, optional) A referral code, if any.</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true, a message to verify email, and user
                    details.</p>
                <pre><code>{
    "status": true,
    "message": "User created successfully! Verify your Email",
    "user": { ... }
}</code></pre>

                <p>If unsuccessful, returns a JSON response with a status of false and an array of error messages.</p>
            </div>
        </div>

        <!-- API Logout -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Logout API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /logout</h5>
                <p class="card-text">Logs out the authenticated user by deleting all their tokens.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true and a message.</p>
                <pre><code>{
    "status": true,
    "message": "User logged out successfully!"
}</code></pre>
            </div>
        </div>

        <!-- API Add Purchase -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Add Purchase API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /purchase</h5>
                <p class="card-text">Creates a new purchase for the authenticated user.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Request Parameters</h6>
                <ul>
                    <li><strong>plan_id:</strong> (integer, required) The ID of the plan to purchase. Must exist in the
                        `plans` table.</li>
                    <li><strong>expires_at:</strong> (string, required) The expiration date of the purchase. Must be a
                        future date.</li>
                    <li><strong>is_active:</strong> (boolean, required) Whether the purchase is active.</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true, a message, and the purchase details.
                </p>
                <pre><code>{
    "status": true,
    "message": "Purchase created successfully!",
    "purchase": { ... }
}</code></pre>

                <p>If unsuccessful, returns a JSON response with a status of false and an array of error messages.</p>
            </div>
        </div>

        <!-- API Purchase Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Purchase Status API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /purchase/status</h5>
                <p class="card-text">Retrieves all purchase records for the authenticated user.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true and the purchase records.</p>
                <pre><code>{
    "status": true,
    "purchases": [ ... ]
}</code></pre>
            </div>
        </div>

        <!-- API Redeem Promo Code -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Redeem Promo Code API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /redeem/promo-code</h5>
                <p class="card-text">Redeems a promo code for the authenticated user and activates the associated plan.
                </p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Request Parameters</h6>
                <ul>
                    <li><strong>promo_code:</strong> (string, required) The promo code to redeem. Must exist in the
                        `promo_codes` table and not be used.</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true, a message, and the activation details.
                </p>
                <pre><code>{
    "status": true,
    "message": "Promo code redeemed successfully, and the plan has been activated."
}</code></pre>

                <p>If unsuccessful, returns a JSON response with a status of false and an error message.</p>
            </div>
        </div>

        <!-- API Resend Email Verification -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Resend Email Verification API</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">POST /email/resend-verification</h5>
                <p class="card-text">Resends the email verification link to the specified email address.</p>

                <h6>Headers</h6>
                <ul>
                    <li><strong>Content-Type:</strong> application/json</li>
                </ul>

                <h6>Request Parameters</h6>
                <ul>
                    <li><strong>email:</strong> (string, required) The email address of the user who needs to verify
                        their email.</li>
                </ul>

                <h6>Response</h6>
                <p>If successful, returns a JSON response with a status of true and a message.</p>
                <pre><code>{
    "status": true,
    "message": "A new verification link has been sent to the email address you provided during registration."
}</code></pre>

                <p>If unsuccessful, returns a JSON response with a status of false and an error message.</p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
