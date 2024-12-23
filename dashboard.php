<?php
$username = isset($_GET['username']) ? $_GET['username']: '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Tours</title>
    <link rel="stylesheet" href="style.css">

    
    <style>
         header nav ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            text-align: right;
        }

        header nav ul li {
            display: inline-block;
            margin-left: 10px;
        }

        header nav ul li a {
            color: #eee;
            text-decoration: none;
        }
        .package {
            margin: 20px;
            display: inline-block;
        }
        img {
            width: 300px;
            height: 200px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html"> Log Out</a></li>
                
            </ul>
            <h1>Welcome, <?php echo $username; ?>!</h1>

        </nav>
    </header>
    
    <div class="package">
    <a href="pack1.php?username=<?php echo urlencode($username); ?>">
            <img src="images/3.jpg" >
        </a>
        <p>Hill Stations of Kerala</p>
        
    </div>
    <div class="package">
    <a href="pack2.php?username=<?php echo urlencode($username); ?>">
            <img src="images/ker.jpg">
        </a>
        <p>Backwaters of Kerala</p>
    </div>
    <div class="package">
    <a href="pack3.php?username=<?php echo urlencode($username); ?>">
            <img src="images/2.jpg">
        </a>
        <p>Temple Tour of Tamil Nadu</p>
    </div>
</body>
</html>
