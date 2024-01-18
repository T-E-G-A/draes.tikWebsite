<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Contact Page</title>

    <!-- Include your existing CSS and animations -->
    <?php include('partials-front/menu.php')?>
    <style>
        /* Add your existing CSS and animations here */
    </style>

    <!-- Contact Section Styles -->
    <style>
        #contact-section {
            padding: 80px 0;
            background-color: #f8f8f8; /* Adjust background color as needed */
        }

        #contact-section h2 {
            color: #333; /* Adjust text color as needed */
            font-size: 2rem;
            margin-bottom: 40px;
        }

        #contact-section p {
            color: #555; /* Adjust text color as needed */
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        #contact-section a {
            color: #007bff; /* Adjust link color as needed */
            text-decoration: none;
            margin-right: 10px;
        }

        #contact-section a:hover {
            text-decoration: underline;
        }

        /* Add this style block for additional animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Apply fadeIn animation to the specified elements */
        #contact-section p {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
</head>
<body>

    <!-- Your existing HTML content -->

    <!-- Contact Section Starts Here -->
    <section class="contact-section" id="contact-section">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>

            <!-- Follow Us on Social Media -->
            <div class="text-center">
                <p>Follow/message us on:
                <a href="https://www.facebook.com/yourpage" target="_blank">Facebook</a>
                <a href="https://www.instagram.com/draes.tk/" target="_blank">Instagram</a>
                <a href="https://twitter.com/yourpage" target="_blank">Twitter</a>
                </p>

            </div>

            <!-- Call Us Section -->
            <div class="text-center">
                <p>Call us: <a href="tel:+2348160256626">+234 816 025 6626</a></p>
            </div>

            <!-- Email Us Section -->
            <div class="text-center">
                <p>Email us: <a href="mailto:demo@example.com">demo@example.com</a></p>
            </div>
        </div>
    </section>
    <!-- Contact Section Ends Here -->

    <!-- Your existing HTML content -->

    <!-- Include your existing CSS and animations -->
    <?php include('partials-front/footer.php')?>

</body>
</html>
