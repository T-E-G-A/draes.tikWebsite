<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">
    <style>
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

        .social,
        .footer {
            animation: fadeIn 1s ease-in-out;
        }

        .social {
            background-color: black;
            padding: 20px 0;
            text-align: center;
        }

        .social ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .social li {
            display: inline-block;
            margin: 0 15px;
        }

        .social a img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .social a:hover img {
            transform: scale(1.2);
        }

        .footer {
            background-color: black;
            color: lightcyan;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #66c2ff;
            text-decoration: none;
            font-family: 'Teko', sans-serif;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #2691d9;
        }

        /* Media Queries for Responsive Design */
        @media only screen and (max-width: 600px) {
            .social li {
                margin: 10px 0;
            }

            .social a img {
                width: 40px;
                height: 40px;
            }

            .footer {
                padding: 10px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Social Section Starts Here -->
    <section class="social">
        <div class="container">
            <ul>
                <li>
                    <a href="#"target="_blank"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" alt="Facebook" /></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/draes.tk/" target="_blank"><img
                            src="https://img.icons8.com/fluent/48/000000/instagram-new.png" alt="Instagram" /></a>
                </li>
                <li>
                    <a href="#"target="_blank"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" alt="Twitter" /></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- Social Section Ends Here -->

    <!-- Footer Section Starts Here -->
    <div class="footer">
        <div class="wrapper">
            <p style="font-family:'Teko',sans-serif">&copy; 2024 ALL RIGHTS RESERVED, dræs.tɪk. DEVELOPED BY - <a
                    href="https://github.com/T-E-G-A" target="_blank">EDWARD OVIASOGIE</a></p>
        </div>
    </div>
    <!-- Footer Section Ends Here -->

</body>

</html>
