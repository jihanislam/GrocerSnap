<!-- Footer Section -->
<footer class="footer">
    <div class="footer-logo">
        <a href="#" class="logo">GrocerSnap <i class="fa-solid fa-bag-shopping"></i></a>
    </div>
    <div class="footer-content">
        <div class="footer-column">
            <h3>Contact</h3>
            <ul>
                <li><a href="#">123 Mohakhali , Dhaka</a></li>
                <li><a href="#">Email: grocersnap@gmail.com</a></li>
                <li><a href="#">Phone: 01307527651</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Newsletter</h3>
            <form action="#" method="POST">
                <input type="email" placeholder="Enter your email" class="newsletter-input" required>
                <input type="submit" value="Subscribe" class="btn">
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-payment">
            <i class="fa fa-cc-visa"></i>
            <i class="fa fa-cc-mastercard"></i>
            <i class="fa fa-cc-amex"></i>
        </div>
        <p>&copy; 2024 GrocerSnap. All Rights Reserved.</p>
    </div>
</footer>
<!--    Footer Section   -->


</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.swiper-wrapper').slick({        
        lazyLoad: 'ondemand',        
        centerMode: true,
        centerPadding: '60px',
        infinite: true,
        slidesToShow: 2,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToScroll: 1
    });
</script>
<script src="admin/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    
<script src="assets/js/script.js"></script>
<?php
    if (isset($_GET['error']) || isset($_GET['success'])) {
        // Handle the message
        if (isset($_GET['error'])) {
            $message = $_GET['error'];
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: '$message',
                    type: 'error',
                    showConfirmButton: '!1',
                    position: 'top-end',
                    timer: '1000'
                });
            </script>";
        }

        if (isset($_GET['success'])) {
            $message = $_GET['success'];
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '$message',
                    type: 'success',
                    showConfirmButton: '!1',
                    position: 'top-end',
                    timer: '1000'
                });
            </script>";
        }
    }
?>


</body>
</html>