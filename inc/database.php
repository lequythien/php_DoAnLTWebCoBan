<?php
    session_start();
    class Database{
        static $con;
        public static function getConnection(){
            if(self::$con == null)
                return new mysqli("localhost:3307","root","","shopping");
            return null;
        }
        public static function query($s){
            return self::getConnection()->query($s);
        }
    }
    
    class Cart{
        public $id, $name, $image, $price, $quantity;
        function __construct($id, $name, $image, $price, $quantity){
            $this->id=$id; $this->name=$name; $this->image=$image; $this->price=$price; $this->quantity=$quantity;
        }
    }

    function _header($title){
        $s = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$title.'</title>
            <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            <script src="./assets/js/bootstrap.bundle.min.js"></script>

                <style>
                    .nav-link{
                        color: black;
                        font-weight: 600;
                    }

                    .nav-link:hover{
                        color: blue;
                    }

                    .dropdown-menu li a{
                        font-weight: 500;
                    }

                    .dropdown-menu li a:hover{
                        background-color: beige;
                        color: blue;
                    }

                    .card img{
                        transform: scale(0.85);
                        transition: 0.8s;
                    }
                    
                    .card img:hover{
                        transform: translateY(10px) rotate(10deg); // rotate: độ nghiêng của sản phẩm | // translateY độ cao lên của sp
                        transition: 0.5s;
                    }

                    .contact {
                        padding: 20px 0;
                    }
                    
                    .contact .heading h2 {
                        font-size: 30px;
                        font-weight: 700;
                        margin: 0;
                        padding: 0;
                    }
                    
                    .contact .heading h2 span {
                        color: #ff9100;
                    }
                    
                    .contact .heading p {
                        font-size: 15px;
                        font-weight: 400;
                        line-height: 1.7;
                        color: #999999;
                        margin: 20px 0 60px;
                        padding: 0;
                    }
                    
                    .contact .form-control {
                        padding: 25px;
                        font-size: 13px;
                        margin-bottom: 10px;
                        background: #f9f9f9;
                        border: 0;
                        border-radius: 10px;
                    }
                    
                    .contact button.btn {
                        padding: 10px;
                        border-radius: 10px;
                        font-size: 15px;
                        background: #ff9100;
                        color: #ffffff;
                    }
                    
                    .contact .title h3 {
                        font-size: 18px;
                        font-weight: 600;
                    }
                    
                    .contact .title p {
                        font-size: 14px;
                        font-weight: 400;
                        color: #999;
                        line-height: 1.6;
                        margin: 0 0 40px;
                    }
                    
                    .contact .content .info {
                        margin-top: 30px;
                    }

                    .contact .content .info i {
                        font-size: 30px;
                        padding: 0;
                        margin: 0;
                        color: #02434b;
                        margin-right: 20px;
                        text-align: center;
                        width: 20px;
                    }
                    
                    .contact .content .info h4 {
                        font-size: 13px;
                        line-height: 1.4;
                    }
                    
                    .contact .content .info h4 span {
                        font-size: 13px;
                        font-weight: 300;
                        color: #999999;
                    }


                    ul {
                        margin: 0px;
                        padding: 0px;
                    }
                    .footer-section {
                      background: gray;
                      position: relative;
                    }
                    .footer-cta {
                      border-bottom: 1px solid #373636;
                    }
                    .single-cta i {
                      color: #ff5e14;
                      font-size: 30px;
                      float: left;
                      margin-top: 8px;
                    }
                    .cta-text {
                      padding-left: 15px;
                      display: inline-block;
                    }
                    .cta-text h4 {
                      color: #fff;
                      font-size: 20px;
                      font-weight: 600;
                      margin-bottom: 2px;
                    }
                    .cta-text span {
                      color: white;
                      font-size: 15px;
                    }
                    .footer-content {
                      position: relative;
                      z-index: 2;
                    }
                    .footer-pattern img {
                      position: absolute;
                      top: 0;
                      left: 0;
                      height: 330px;
                      background-size: cover;
                      background-position: 100% 100%;
                    }
                    .footer-logo {
                      margin-bottom: 30px;
                    }
                    .footer-logo img {
                        max-width: 200px;
                    }
                    .footer-text p {
                      margin-bottom: 14px;
                      font-size: 14px;
                        color: white;
                      line-height: 28px;
                    }
                    .footer-social-icon span {
                      color: #fff;
                      display: block;
                      font-size: 20px;
                      font-weight: 700;
                      margin-bottom: 20px;
                    }
                    .footer-social-icon a {
                      color: #fff;
                      font-size: 16px;
                      margin-right: 15px;
                    }
                    .footer-social-icon i {
                      height: 40px;
                      width: 40px;
                      text-align: center;
                      line-height: 38px;
                      border-radius: 50%;
                    }
                    .facebook-bg{
                      background: #3B5998;
                    }
                    .twitter-bg{
                      background: #55ACEE;
                    }
                    .google-bg{
                      background: #DD4B39;
                    }
                    .footer-widget-heading h3 {
                      color: #fff;
                      font-size: 20px;
                      font-weight: 600;
                      margin-bottom: 40px;
                      position: relative;
                    }
                    .footer-widget-heading h3::before {
                      content: "";
                      position: absolute;
                      left: 0;
                      bottom: -15px;
                      height: 2px;
                      width: 50px;
                      background: #ff5e14;
                    }
                    .footer-widget ul li {
                      display: inline-block;
                      float: left;
                      width: 50%;
                      margin-bottom: 12px;
                    }
                    .footer-widget ul li a:hover{
                      color: #ff5e14;
                    }
                    .footer-widget ul li a {
                      color: white;
                      text-transform: capitalize;
                    }
                    .subscribe-form {
                      position: relative;
                      overflow: hidden;
                    }
                    .subscribe-form input {
                      width: 100%;
                      padding: 14px 28px;
                      background: white;
                      border: 1px solid #2E2E2E;
                      color: #fff;
                    }
                    .subscribe-form button {
                        position: absolute;
                        right: 0;
                        background: #ff5e14;
                        padding: 14px 20px;
                        border: 1px solid #ff5e14;
                        top: 0;
                    }
                    .subscribe-form button i {
                      color: #fff;
                      font-size: 22px;
                    }
                    .copyright-area{
                      background: #202020;
                      padding: 25px 0;
                    }
                    .copyright-text p {
                      margin: 0;
                      font-size: 14px;
                      color: #878787;
                    }
                    .copyright-text p a{
                      color: #ff5e14;
                    }
                    .footer-menu li {
                      display: inline-block;
                      margin-left: 20px;
                    }
                    .footer-menu li:hover a{
                      color: #ff5e14;
                    }
                    .footer-menu li a {
                      font-size: 14px;
                      color: #878787;
                    }

                    .text{
                        text-decoration: none;
                        font-weight: bold;
                    }
                    
                    .card-footer .btn-1{
                        text-decoration: none;
                        background: green;
                        color: white;
                        padding: 10px 15px;
                        border-radius: 5px;
                        font-weight: bold;
                        margin-right: 10px;
                        transition: 0.25s;
                        cursor: pointer;
                    }

                    .card-footer .btn-1:hover{
                        transform: scale(0.9);
                        transition: 0.25s;
                    }

                    .card-footer .btn-2{
                        text-decoration: none;
                        background: red;
                        color:aliceblue;
                        padding: 10px 20px;
                        border-radius: 5px;
                        font-weight: bold;
                        margin-right: 10px;
                        transition: 0.25s;
                        cursor: pointer;
                    }

                    .card-footer .btn-2:hover{
                        transform: scale(0.9);
                        transition: 0.25s;
                    }
                </style>
        </head>     
        <body>
        </html>
        ';
        echo $s;
    }

    function _footer(){
        $s ='
        <style>
            .subscribe-form input{
                color: black;
            }
        </style>

        <footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Find Us</h4>
                                <span>HueIC - 70 Nguyễn Huệ, TT - Huế</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call Us</h4>
                                <span>+84 123 456 789</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Mail Us</h4>
                                <span>lequythien1@gamil.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a class="navbar-brand" href="#">
                                    <img src="./assets/icon/logo.png" width="200" height="50">
                                </a>
                            </div>
                            <div class="footer-text">
                                <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor incididuntut consec tetur adipisicing
                                elit,Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a href="https://www.facebook.com/quythien.le.50"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="#" class="text">Home</a></li>
                                <li><a href="#" class="text">about</a></li>
                                <li><a href="#" class="text">services</a></li>
                                <li><a href="#" class="text">portfolio</a></li>
                                <li><a href="#" class="text">Contact</a></li>
                                <li><a href="#" class="text">About us</a></li>
                                <li><a href="#" class="text">Our Services</a></li>
                                <li><a href="#" class="text">Expert Team</a></li>
                                <li><a href="#" class="text">Contact us</a></li>
                                <li><a href="#" class="text">Latest News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Subscribe</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                            </div>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="text" placeholder="Email Address">
                                    <button><i class="fab fa-telegram-plane"></i></button>
                                </form>
                            </div >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p class="test">Copyright &copy; 2023, Đồ án Lập trình Website cơ bản 22CDTH41</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#" class="text">Trang Phục Nam</a></li>
                                <li><a href="#" class="text">Trang Phục Nữ</a></li>
                                <li><a href="#" class="text">Trang Sức</a></li>
                                <li><a href="#" class="text">Nước Hoa</a></li>
                                <li><a href="#" class="text">Mỹ Phẩm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </footer>

        </body>
        ';
        echo $s;
    }

    function search(){
        $search_query = $_GET['search_query'];
    
        $sql = "SELECT * FROM products WHERE name LIKE '%$search_query%'";
        $conn = new mysqli("localhost:3307","root","","shopping");
        $result = $conn->query($sql);
        if($conn->errno) {
            throw new Exception($conn->connect_error, $conn->connect_errno);
        }
    
        if ($result->num_rows > 0) {
            echo '
            <style>
                @keyframes my {
                    0% {color: Magenta;}
                    33.33% {color: yellow;}  
                    66.66% {color: lime;} 
                    100% {color: Magenta;} 
                }

                .test {
                    font-size: 17px;
                    font-weight: bold;
                    animation: my 1s infinite;
                }
            </style>
            <p class="test" style="text-align: center; font-size: 23px; margin: 10px;">Sản phẩm đã tìm kiếm</p>';
            
            // Sản phẩm tìm thấy, hiển thị kết quả tìm kiếm
            echo '<style>
                    .card {
                        border: 1px solid black;
                        border-radius: 10px;
                        margin: 10px;
                        background-image: url(https://img3.thuthuatphanmem.vn/uploads/2019/10/01/background-quang-cao-san-pham_104804376.jpg);
                    }
                  </style>';
    
            echo '<section>
                    <div class="container my-3">
                        <div class="row">';
    
            while ($row = $result->fetch_assoc()) {
                // Hiển thị chi tiết sản phẩm hoặc dữ liệu liên quan khác nếu cần
                echo '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="card w-100 my-2 shadow-2-strong">
                            <a href="detail.php?id_product_detail='.$row['id'].'"><img src="assets/images/'.$row['image'].'" class="card-img-top" style="aspect-ratio: 1 / 1" /></a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">'.$row['name'].'</h5>
                                <p class="card-text">$'.$row['price'].'</p>
                                <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                    <a href="';
                                        if(!isset($_SESSION['user'])){
                                            echo 'login.php';
                                        }else{
                                            echo 'cart.php?id_product='.$row['id'];
                                        }
                                    echo '" class="btn-1 btn-primary shadow-0 me-auto m-2" style="font-weight: 600;"><i class="fa-solid fa-truck-fast" style="padding-right: 5px;"></i>Buy Now</a>
                                    <a href="#!" class="btn-2 btn-light border px-2 pt-2 icon-hover m-2"><i class="fa-solid fa-cart-arrow-down" style="font-size: 20px; padding: 2px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
    
            echo '</div>
                  </div>
                  </section>';
        } else {
            // Không tìm thấy sản phẩm nào
            echo '
            <style>
                @keyframes my {
                    0% {color: Magenta;}
                    33.33% {color: yellow;}  
                    66.66% {color: lime;} 
                    100% {color: Magenta;} 
                }

                .test {
                    font-size: 17px;
                    font-weight: bold;
                    animation: my 1s infinite;
                }
            </style>
            <p class="test" style="text-align: center; font-size: 23px; margin: 10px;">Không tìm thấy sản phẩm nào</p>';
        }
    
        $conn->close();
    }
    
    function navbar(){
        if(isset($_GET['id_product'])) addProductToCart($_GET['id_product']);
        if(isset($_GET['clear']))unset($_SESSION['cart']);


        $s = '
        <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./assets/icon/logo.png" width="200" height="55">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-shop"></i>    
                    Category
                </a>
                <ul class="dropdown-menu">';

                $q = Database::query("select * from categories");
                while($r = $q->fetch_array()){
                    $s .= '<li><a class="dropdown-item" href="index.php?id_category='.$r['id'].'">'.$r['name'].'</a></li>';
                }

                $s .= '</ul>


                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="contact.php">
                        <i class="fa-solid fa-envelope"></i>
                        Contact
                    </a>
                </li>
                </li>';

                if(!isset($_SESSION['user']))
                    $s .= '<li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <img src="./assets/icon/admin.png" width="25" height="25">
                    </a>
                    </li>';
                else{
                    $s.='
                    <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.splitName($_SESSION['user']['name']).'
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout</a></li>
                </ul>
                </li>    
                ';
                }

                $s .= '<li class="nav-item">
                <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-bag-shopping mx-1">
                </i>';
                    if(!isset($_SESSION['cart'])) $s.=' 0';
                    else $s.=count($_SESSION['cart']);
                $s .='
                </li>
                </a>
            </ul>
            <form class="d-flex" role="search" method="GET" action="search.php">
                <input class="form-control me-2" style="border-radius: 50px; padding-left: 15px;" type="search" placeholder="Search..." aria-label="Search" name="search_query">
                <button class="btn btn-outline-success" style="border-radius: 50px;" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        
            </div>
        </div>
        </nav>
        ';
        echo $s;
    }

    function junbotron(){
        $s ='
        <style>
            @keyframes my {
                0% {color: Magenta;}
                33.33% {color: yellow;}  
                66.66% {color: lime;} 
                100% {color: Magenta;} 
            }

            .test {
                font-size: 17px;
                font-weight: bold;
                animation: my 1s infinite;
            }
        </style>


        <div class="bg-primary text-white py-4">
            <div class="container py-5">
            <h1>';
            if(!isset($_GET['id_category']))
                $s .='Best category & products <br />
                in our store';
            else{
                $q= Database :: query("select * from categories where id=".$_GET['id_category']);
                $s .='Best '.$q->fetch_array()['name'].'<br />
                in our store';
            }
            $s .= '</h1>
            <p class="test">
                Trendy Products, Factory Prices, Excellent Service
            </p>
            <button type="button" class="btn btn-outline-light">
                Learn more
            </button>
            <button type="button" class="btn btn-light shadow-0 text-primary pt-2 border border-white">
                <span class="pt-1">Purchase now</span>
            </button>
            </div>
        </div>
                ';
        echo $s;
    }

    function body(){
        $s ='';
            if(!isset($_GET['id_category'])){
                $q = Database::query("select * from categories");
            }else 
                $q = Database::query("select * from categories where id=".$_GET['id_category']);
            while($r = $q->fetch_array()){
            $s .= '

            <style>
                .card {
                    border: 1px solid black;
                    border-radius: 10px;
                    margin: 10px;
                    background-image: url(https://img3.thuthuatphanmem.vn/uploads/2019/10/01/background-quang-cao-san-pham_104804376.jpg);
                }
            </style>
                
            <section>
            <div class="container my-5">
                <header class="mb-4">
                    <h3>'.$r['name'].'</h3>
                </header>

                <div class="row">';

                if(!isset($_GET['id_category'])){
                    $q1 = Database::query("select * from products where status and id_category=".$r['id']);
                }else
                    $q1 = Database::query("select * from products where id_category=".$r['id']);
                while($r1 = $q1->fetch_array()){

                $s .= '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="card w-100 my-2 shadow-2-strong">
                        <a href="detail.php?id_product_detail='.$r1['id'].'"><img src="assets/images/'.$r1['image'].'" class="card-img-top" style="aspect-ratio: 1 / 1" /></a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">'.$r1['name'].'</h5>
                        <p class="card-text">$'.$r1['price'].'</p>
                        <div class="card-footer d-flex align-items-end pt-0 px-0 pb-0 mt-auto">
                        <a href="';
                            if(!isset($_SESSION['user'])){
                                $s.='login.php';
                            }else
                                $s.='index.php?id_product='.$r1['id'];
                        $s.='" class="btn-1 btn-primary shadow-0 me-auto m-2" style="font-weight: 600;"><i class="fa-solid fa-truck-fast" style="padding-right: 5px;"></i>Buy Now</a>
                        <a href="#!" class="btn-2 btn-light border px-2 pt-2 icon-hover m-2"><i class="fa-solid fa-cart-arrow-down" style="font-size: 20px; padding: 2px;"></i></a>
                        </div>
                    </div>
                    </div>
                </div>';
                }
                $s .= '</div>
            </div>
            </section>
            ';
            }
        echo $s;
    }
    
    function login(){
        if(isset($_POST['emailphone']) && isset($_POST['password'])){
            if(is_numeric($_POST['emailphone']))
                $x='phone';
            else $x='email';
            $q= Database::query("select * from users where ".$x."='".$_POST['emailphone']."' and password='".$_POST['password']."'");
            if($r=$q->fetch_array()){
                if($r['role'] == 'admin'){
                    header("location: admin.php"); exit();
                }else{
                    $_SESSION['user']=$r;
                    header("location: index.php"); exit();
                }
            }else{
                $_SESSION['login_fail'] = 'Dữ liệu nhập không chính xác!!!';
                header("location: login.php"); exit();
            }
        }

        $s='
        <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="" method="post">
                
                <h2 style="padding: 40px 0 25px 0">Login Information</h2>';

                if(isset($_SESSION['login_fail'])){
                    $s.='<div style="color: red;">'.$_SESSION['login_fail'].'</div>';
                }

                $s .= '<!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" name="emailphone" class="form-control form-control-lg"
                    placeholder="Enter a valid email or phone number" />
                    
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" name="password" class="form-control form-control-lg"
                    placeholder="Enter password" />
        
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                        Remember me
                    </label>
                    </div>
                    <a href="#!" class="text-body" style="text-decoration: none;">Forgot password?</a>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don\'t have an account? <a href="register.php"
                        class="link-danger" style="text-decoration: none;">Register</a></p>
                </div>

                </form>
            </div>
            </div>
        </div>
        </section>
        ';
        echo $s;
    }

    function splitName($str) { // từ cuối cùng của chuỗi họ tên
        $rs = NULL; // cái này cũng giúp kiểm tra chuỗi có ít nhất 2 từ hay không
        //nếu chỉ có một từ, nó sẽ trả về kết quả NULL
        $word = mb_split(' ', $str); // tách từ
        $n = count($word) - 1; // lấy vị trí mảng của từ cuối cùng
        if ($n > 0) {
            $rs = $word[$n-1].' '.$word[$n]; // Lấy 2 từ cuối cùng của tên
        }
        return $rs;
    } 

    function register(){
        $errName = $errEmail = $errPhone = $errPass = $errRepass = '';
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['name']))$errName="Name is not empty!";
            if(empty($_POST['email']))$errEmail="Email is not empty!";
            else 
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                    $errEmail = "Invalid email format";
            if(empty($_POST['phone']))$errPhone="Phone is not empty!";
            else
                if(!preg_match('/^[0-9]{10}+$/', $_POST['phone']))
                    $errPhone = "Phone number have 10 digits!";
            if(empty($_POST['pass']))$errPass="Pass is not empty!";
            if(empty($_POST['repass']))$errRepass="Repass is not empty!";
            else
                if($_POST['pass']!=$_POST['repass'])
                    $errRepass = "Not match password!";
    
            if($errName=='' && $errEmail=='' && $errPhone=='' && $errPass=='' && $errRepass== ''){
                // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
                $q = Database::query("SELECT * FROM users WHERE email='".$_POST['email']."'");
                if($q->num_rows > 0){
                    $errEmail = "Email already exists!";
                } else {
                    // Chèn người dùng mới vào cơ sở dữ liệu
                    $q = Database::query("INSERT INTO users(name, email, phone, password, role) VALUES('".$_POST['name']."',
                    '".$_POST['email']."','".$_POST['phone']."','".$_POST['pass']."','')");
                    
                    $q = Database::query("SELECT * FROM users WHERE name='".$_POST['name']."' AND password='".$_POST['pass']."'");
                    $_SESSION['user'] = $q->fetch_array();
                    header("location: index.php");
                    exit();
                }
            }
        }
        
        $s = '
        <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-3">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                        <form class="mx-1 mx-md-4" action="" method="post">

                        <div class="d-flex flex-row align-items-center mb-3">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example1c">Your Name</label>
                            <input type="text" name="name" class="form-control" />
                            <span style ="color: red;">'.$errName.'</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example3c">Your Email</label>
                            <input type="text" name="email" class="form-control" />
                            <span style ="color: red;">'.$errEmail.'</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example3c">Your Phone</label>
                            <input type="text" name="phone" class="form-control" />
                            <span style ="color: red;">'.$errPhone.'</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4c">Password</label>
                            <input type="password" name="pass" class="form-control" />
                            <span style ="color: red;">'.$errPass.'</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4cd">Retype password</label>
                            <input type="password" name="repass" class="form-control" />
                            <span style ="color: red;">'.$errRepass.'</span>
                            </div>
                        </div>

                        <div class="form-check d-flex justify-content-center mb-3">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                            <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!" style="text-decoration: none;">Terms of service</a>
                            </label>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>

                        </form>

                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                        <img src="./assets/icon/logo.png" class="img-fluid" alt="Sample image">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        ';
        echo $s;
    }

    function addProductToCart($id_product){
        $q = Database::query("select * from products where id=".$id_product);
        $r=$q->fetch_array();
        if(isset($_SESSION['cart'])){
            $a= $_SESSION['cart'];
            for($i=0; $i<count($a); $i++)
                if($r['id']==$a[$i]->id) break;
            if($i<count($a))$a[$i]->quantity++;
            else $a[count($a)] = new Cart($r['id'], $r['name'], $r['image'], $r['price'], 1);
    
        }else{
            $a=array();
            $a[0]= new Cart($r['id'], $r['name'], $r['image'], $r['price'], 1);
        }
        $_SESSION['cart'] = $a;
    }

    function cart(){
        $total = 0;
        
        $s='
            <section class="h-100 h-custom" style="background-color: #eee;">
            <div class="container py-2 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="index.php" class="text-body" style="text-decoration: none;">
                                <i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua sắm</a>
                                <a href="cart.php?clear=OK" class="text-body" style="text-decoration: none; margin-left: 20px;">
                                <i class="fa-solid fa-trash"></i>
                                Xóa tất cả</a>
                            </h5>
                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <p class="mb-1">Giỏ hàng</p>
                                <p class="mb-0">Bạn hiện đang có ';
                                if(isset($_SESSION['cart']))
                                    $s.=count($_SESSION['cart']);
                                else $s.='0';
                                $s.=' sản phẩm trong giỏ hàng</p>
                            </div>
                            <button type="button" class="btn btn-primary">
                                Cập nhật lại giỏ hàng
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>
                            </div>';

                            if(isset($_SESSION['cart'])){
                                $a = $_SESSION['cart'];
                                for($i=0; $i<count($a); $i++){
                                    $s.='
                                    <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center"><div>
                                            <img src="assets/images/'.$a[$i]->image.'"class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                        </div>
                                        <div class="ms-3">
                                            <h5>'.$a[$i]->name.'</h5>
                                        </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div style="width: 60px; margin-right: 10px;">
                                                <h5 class="fw-normal mb-2">
                                                    <input id="quantity'.$i.'" type="number" value ="'.$a[$i]->quantity.'" min="1" class="form-control quantity-input">
                                                </h5>
                                            </div>
                                            <div style="width: 80px;">
                                                <h5 class="mb-0">$'.$a[$i]->price.'</h5>
                                            </div>
                                            <a href="cart.php?delete='.$i.'" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    ';

                                    $total += $a[$i]->quantity * $a[$i]->price;
                                }
                            }
                            
                        $s.= '</div>
                        <div class="col-lg-5">

                            <div class="card bg-primary text-white rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Chi tiết thẻ</h5>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                    class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                </div>

                                <p class="small mb-2">Loại thẻ</p>
                                <a href="#!" type="submit" class="text-white">
                                    <img src="assets/icon/mastercard.png" width="35" height="35">
                                </a>
                                <a href="#!" type="submit" class="text-white">
                                    <img src="assets/icon/donga.png" width="35" height="35">
                                </a>
                                <a href="#!" type="submit" class="text-white">
                                    <img src="assets/icon/vietcombank.png" width="35" height="35">
                                </a>
                                <a href="#!" type="submit" class="text-white">
                                    <img src="assets/icon/vietinbank.png" width="35" height="35">
                                </a>

                                <form class="mt-4">
                                <div class="form-outline form-white mb-2">
                                    <label class="form-label" for="typeName">Tên thẻ</label>
                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                    placeholder="Nhập tên chủ thẻ" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeText">Số thẻ</label>
                                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                    <div class="form-outline form-white">
                                        <input type="text" id="typeExp" class="form-control form-control-lg"
                                        placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                        <label class="form-label" for="typeExp">Hết hạn</label>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-outline form-white">
                                        <input type="password" id="typeText" class="form-control form-control-lg"
                                        placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                        <label class="form-label" for="typeText">Cvv</label>
                                    </div>
                                    </div>
                                </div>

                                </form>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between">
                                <p class="mb-2">Tổng tiền sản phẩm</p>
                                <p class="mb-2">$'.$total.'</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                <p class="mb-2">Thuế</p>
                                <p class="mb-2">$'.($total*0.1).'</p>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                <p class="mb-2">Tổng tiền (Đã bao gồm thuế)</p>
                                <p class="mb-2">$'.($total*1.1).'</p>
                                </div>

                                <button type="button" class="btn btn-info btn-block btn-lg">
                                <div class="d-flex justify-content-between">
                                <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                <span>$'.($total*1.1).'</span>
                                </div>
                                </button>

                            </div>
                            </div>

                        </div>

                        </div>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </section>
            ';
            echo $s;
        }

        if(isset($_GET['delete'])){
            $index = $_GET['delete'];
            if(isset($_SESSION['cart'])){
                $a = $_SESSION['cart'];
                if(isset($a[$index])){
                    unset($a[$index]);
                    $_SESSION['cart'] = array_values($a);
                }
            }
    }
        
    function detail(){
        $s ='';
        $q = Database::query("select * from products where id=".$_GET['id_product_detail']);
        if($r = $q->fetch_array()){

        $s='
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <style>
            .card{
                border: 1px solid black;
                border-radius: 20px;
                margin: 10px;
                background-image: url(https://img3.thuthuatphanmem.vn/uploads/2019/10/01/background-quang-cao-san-pham_104804376.jpg);
            }

            .btn-1{
                text-decoration: none;
                background: green;
                color: aliceblue;
                padding: 10px 20px;
                border-radius: 5px;
                font-weight: bold;
            }

        </style>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3"><a href="index.php" class="text-body" style="text-decoration: none;">
                        <i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua sắm</a>
                    </h4>
                    <div class="row">';
                    $s .= '<div class="col-lg-5 col-md-5 col-sm-6">
                            <div class="white-box text-center"><img src="assets/images/'.$r['image'].'" class="card-img-top" style="aspect-ratio: 1 / 1" /></div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-6">
                            <h2 class="box-title mt-5">'.$r['name'].'</h2>
                            <p>Chi tiết sản phẩm: .....</p>
                            <h2 class="mt-5">$'.$r['price'].'</h2>

                            <div class="col-md-4">
                                <label for="quantity" style="font-weight: 500;">Số lượng sản phẩm:</label>
                                <input id="quantity" type="number" value ="1" min ="1" class="form-control quantity-input" style="border: 1px solid gray;">
                            </div>

                            <br>

                            <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                                <i class="fa-solid fa-cart-arrow-down" style="font-size: 20px;"></i>
                            </button>
                            <a href="';
                                if(!isset($_SESSION['user']))
                                    $s.='login.php';
                                else
                                $s.='cart.php?id_product='.$r['id'];
                            $s.='" class="btn-1 btn-primary shadow-0 me-auto m-2" style="font-weight: 600;"><i class="fa-solid fa-truck-fast" style="padding-right: 5px;"></i>Buy Now</a>
                        </div>
                    </div>
                    ';
                }
                $s .= '</div>
            </div>
        </div>
        ';
        echo $s;
    }
    
    function contact(){
        $s='

        <style>
            .container{
                border: 1px solid black;
                border-radius: 20px;
                padding: 20px;  
            }
        </style>

        <section class="contact" id="contact">
            <div class="container">
                <div class="heading text-center">
                    <h2>Contact
                        <span> Us </span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        <br>incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="title">
                            <h3>Contact detail</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
                        </div>
                        <div class="content">
                            <!-- Info-1 -->
                            <div class="info">
                                <i class="fas fa-mobile-alt"></i>
                                <h4 class="d-inline-block">PHONE :
                                    <br>
                                    <span>+12457836913 , +12457836913</span></h4>
                            </div>
                            <!-- Info-2 -->
                            <div class="info">
                                <i class="far fa-envelope"></i>
                                <h4 class="d-inline-block">EMAIL :
                                    <br>
                                    <span>lequythien1@gmail.com</span></h4>
                            </div>
                            <!-- Info-3 -->
                            <div class="info">
                                <i class="fas fa-map-marker-alt"></i>
                                <h4 class="d-inline-block">ADDRESS :<br>
                                    <span>HueIC - 70 Nguyễn Huệ, TT - Huế</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">

                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="comment" placeholder="Message"></textarea>
                            </div>
                            <button class="btn btn-block" type="submit">Send Now!</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        ';
        echo $s;
    }

    
?>
