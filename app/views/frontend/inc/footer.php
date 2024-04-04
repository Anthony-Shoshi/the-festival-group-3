<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Signup</title>
</head>
<body>
<footer>
    <div class="content">
        <a href="" class="logo">
            <img src="/assets/images/Logo.png" alt="Visit Haarlem Logo">
        </a>
        <div class="sign-up">
            <p>Sign up for our newsletter to read about all our events, exhibitions and other recommendations.</p>
            <form id="signupForm">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Send</button>
            </form>
        </div>
        <div class="follow-us">
            <h2>Follow us</h2>
            <ul>
                <li>
                    <a href="" class="facebook-link">
                        <img src="/images/Facebook.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="" class="twitter-link">
                        <img src="/images/Twitter.png" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<link rel="stylesheet" href="/frontend/css/footer.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        axios.post('/api/sendmail/sendemail', { email: email })
            .then(function (response) {
                alert('Success: ' + response.data);
                window.location.reload(); // Reload the current page
            })
            .catch(function (error) {
                alert('An error occurred while sending the email.');
                console.error(error);
            });
    });
</script>
</body>
</html>
