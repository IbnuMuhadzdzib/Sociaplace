<?php
    session_start();
    if(isset($_SESSION['btn'])) {
        header('location: ../rules.php');
        exit;
    }
    include('function.php');

    if(isset($_POST['btn'])) {
        login($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sociaplace</title>

    <link rel="stylesheet" href="../Style/auth.css  ">
    <link rel="stylesheet" href="../Style/Responsive/loginRes.css ">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">

    <style>
        section form {
            position: absolute;
            top: 3.5%;
        }
    </style>

</head>
<body>
    
   <section>
   <form action="" method="POST">
        <div class="title">
            <h1 class="main__title" >Sign In</h1>
            <h4 class="sub__title" >Buyer/Seller</h4>
        </div>

        <a href="" class="google__btn" >
            <img src="https://storage.sociabuzz.com/storage/img/Google__G__Logo.svg" alt="">
            <span>Sign in with google</span>
        </a>

        <div class="line">
            <span></span>
        </div>

        <div class="input" >
            <label for="">Email</label>
            <input type="text" name="nama" required >
        </div>
        <div class="input" >
            <label for="">Password</label>
            <input type="password" name="pw" required >
        </div> <br>
        
        <div class="forgot">
            <span>Not have an account?</span> <a href="register.php">Sign up</a>
        </div>

        <div class="btn">
            <button type="submit" name="btn" >Sign in</button>
        </div>
    </form>
   </section>

    <footer>

    </footer>

    <script>
    // Fungsi untuk menyimpan nilai input ke local storage
    function saveToLocalStorage() {
        const formData = {
            nama: document.querySelector('[name="nama"]').value,
            pw: document.querySelector('[name="pw"]').value,
        };
        localStorage.setItem('loginFormData', JSON.stringify(formData));
    }

    // Fungsi untuk memuat data dari local storage ke input
    function loadFromLocalStorage() {
        const savedData = JSON.parse(localStorage.getItem('loginFormData'));
        if (savedData) {
            document.querySelector('[name="nama"]').value = savedData.nama || '';
            document.querySelector('[name="pw"]').value = savedData.pw || '';
        }
    }

    // Fungsi untuk menghapus data dari local storage setelah berhasil
    function clearLocalStorage() {
        localStorage.removeItem('loginFormData');
    }

    // Muat data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadFromLocalStorage);

    // Tambahkan event listener ke input
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', saveToLocalStorage);
    });
</script>

</body>
</html>