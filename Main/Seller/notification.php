<?php
session_start();
include('../connect.php');

if ($_SESSION['role'] !== 'buyer') {
    header('Location: index-seller.php');
    exit;
}

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'seller') {
    echo "<script>
            alert('Access denied.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

$sellerId = $_SESSION['id'];

// Adjusted query to join with `seller_post` to find notifications for the logged-in seller
$query = "
    SELECT n.*, sp.nama AS product_name 
    FROM notifications n
    JOIN seller_post sp ON n.product_id = sp.id
    WHERE sp.seller_id = '$sellerId'
    ORDER BY n.created_at DESC";

$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | Sociaplace</title>

    <link rel="stylesheet" href="../../Style/style.css">
      <link rel="stylesheet" href="../../Style/notif.css">

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Open Sans -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">

    <!-- AF -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

<nav class="nav__wrapper">
    <div class="nav__container">
        <div class="logo">
            <i class="fa-solid fa-link logo__symbol"></i>
            <h1 class="logo__text">SociaPlace</h1>
        </div>

        <button class="menu__button" id="menu-toggle" onclick="toggleMenu()">
            <i class="fa-solid fa-bars" id="burger"></i>
            <i class="fa-solid fa-x" style="display: none;" id="cancel"></i>
        </button>
    </div>
</nav>

<hr>

<div class="link" id="logout" style="display: none;" >
            <form action="../auth/logout.php">
                <button>Logout <i class="fa-solid fa-power-off"  ></i></button>
            </form>
            <button onclick="backButton()" >Back <i class="fa-solid fa-rotate-right"></i></button>
        </div>  

    <div class="index__title">
    <h1 class="title__text" >Buyed <span>Product</span> Notifications</h1>
    </div>

    <div class="container">
    <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($notification = mysqli_fetch_assoc($result)): ?>
        <div class="notif__item" >
            <h4>Product: <?= htmlspecialchars($notification['product_name']) ?></h4>
            <p><?= htmlspecialchars($notification['message']) ?></p>
            <p><small>Received on: <?= htmlspecialchars($notification['created_at']) ?></small></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No notifications found.</p>
<?php endif; ?>
    </div>


<script>
        function toggleMenu() {
    const burgerIcon = document.getElementById('burger');
    const cancelIcon = document.getElementById('cancel');
    const logout = document.getElementById('logout');

    if (burgerIcon.style.display === 'none') {
        burgerIcon.style.display = 'inline-block';
        cancelIcon.style.display = 'none';
        logout.style.display = 'none';
    } else {
        burgerIcon.style.display = 'none';
        cancelIcon.style.display = 'inline-block';
        logout.style.display = 'block';
    }
}

    function backButton() {
        window.location.href='../../'
    }

    </script>
</body>
</html>
