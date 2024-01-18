<?php include ('partials-front/menu.php');?> 

    <!-- clothes sEARCH Section Starts Here -->
    <section class="clothes-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend style="color: lightcyan; font-family:'Bebas Neue', sans-serif;">Selected item</legend>

                    <div class="clothes-menu-img">
                        <img src="images/WB.jpg"  class="img-responsive img-curve">
                    </div>
    
                    <div class="clothes-menu-desc">
                        <h3 style="color: white;">Title</h3>
                        <p class="clothes-price" style="color: white;">₦9,000</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <div class="order-label">Size</div>
                        <input type="text" name="size" placeholder="E.g. Small" class="input-responsive" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend style="color: lightcyan; font-family: 'Bebas Neue', sans-serif;">Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 08043xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. JD@JohnDoe.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- clothes sEARCH Section Ends Here -->
    <?php include ('partials-front/footer.php');?> 
</body>
</html>