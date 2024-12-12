<?php
    include('function.php');

    if(isset($_POST['btn'])) {
        register($_POST);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Sociaplace</title>

    <link rel="stylesheet" href="../Style/auth.css  ">
    <link rel="stylesheet" href="../Style/Responsive/registerRes.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">

</head>
<body>
    
    <section>
    <form action="" method="POST">
    <div class="title">
            <h1 class="main__title" >Sign up</h1>
            <h4 class="sub__title" >Buyer/Seller</h4>
        </div>

        <a href="" class="google__btn" >
            <img src="https://storage.sociabuzz.com/storage/img/Google__G__Logo.svg" alt="">
            <span>Sign up with google</span>
        </a>

        <div class="line">
            <span></span>
        </div>

        <div class="input" >
            <label for="">Username</label>
            <input type="text" name="nama" required >
        </div>
        <div class="input" >
            <label for="">Email</label>
            <input type="email" name="email" required >
        </div>
        <div class="input" >
            <label for="">Password</label>
            <input type="password" name="pw1"  required >
        </div>
        <div class="input" >
            <label for="">Confirm Password</label>
            <input type="password" name="pw2"  required >
        </div>

        <div class="input" >
        <label for="">Register As:</label>
            <select name="role" class="role" >
                <option value="Buyer">Buyer</option>
                <option value="Seller">Seller</option>
            </select>
        </div>

        <div class="forgot">
            <span>Already have an account?</span> <a href="login.php">Sign in</a>
        </div>

        <div class="btn">
        <button type="submit" name="btn" >Sign up</button>
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
            email: document.querySelector('[name="email"]').value,
            pw1: document.querySelector('[name="pw1"]').value,
            pw2: document.querySelector('[name="pw2"]').value,
            role: document.querySelector('[name="role"]').value,
        };
        localStorage.setItem('registerFormData', JSON.stringify(formData));
    }

    // Fungsi untuk memuat data dari local storage ke input
    function loadFromLocalStorage() {
        const savedData = JSON.parse(localStorage.getItem('registerFormData'));
        if (savedData) {
            document.querySelector('[name="nama"]').value = savedData.nama || '';
            document.querySelector('[name="email"]').value = savedData.email || '';
            document.querySelector('[name="pw1"]').value = savedData.pw1 || '';
            document.querySelector('[name="pw2"]').value = savedData.pw2 || '';
            document.querySelector('[name="role"]').value = savedData.role || '';
        }
    }

    // Fungsi untuk menghapus data dari local storage setelah berhasil
    function clearLocalStorage() {
        localStorage.removeItem('registerFormData');
    }

    // Muat data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadFromLocalStorage);

    // Tambahkan event listener ke input
    document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', saveToLocalStorage);
    });
</script>

</body>
</html>