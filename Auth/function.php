<?php
include('../Main/connect.php');

function register($req) {
    global $connect;

    $role = $req['role'];
    $username = $req['nama'];
    $email = strtolower(trim($req['email'])); 

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Email Address Format Incorrect!')
        </script>";
        return;
    }

    $resultCheckEmail = mysqli_query($connect,
     "SELECT email FROM users WHERE email = '$email'");

     if(mysqli_num_rows($resultCheckEmail) > 0) {
        echo "<script>
            alert('Email Address Already Used!')
        </script>";
        return;
     }

     $pw1 = mysqli_real_escape_string($connect,$req['pw1']);
     $pw2 = mysqli_real_escape_string($connect,$req['pw2']);

     if($pw1 !== $pw2) {
        echo "<script>
        alert('Password Different, Try Again!')
        window.location.replace('register.php')
    </script>";
    return;
     }

     $pw1 = password_hash($pw1, PASSWORD_DEFAULT);
     $pw2 = password_hash($pw1, PASSWORD_DEFAULT);

     $result = mysqli_query($connect,
      "INSERT INTO users VALUES('','$username', '$email', '$pw1', '$role')");

      if($result) {
        echo "<script>
        alert('Account Created Successfully');
        localStorage.removeItem('registerFormData');
        window.location.replace('login.php');
    </script>";
        
        header('location: login.php');
      } else {
        mysqli_error($connect);
      }
}
function login($req) {
    global $connect; 

    $username = $req['nama'];
    $pw = $req['pw'];
    
    // Ambil data user berdasarkan username
    $result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");

    // Cek apakah ada user yang ditemukan
    if (mysqli_num_rows($result) === 1) {
        $dataFetch = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($pw, $dataFetch['pw'])) {
            // Set session data untuk login dan role
            $_SESSION['login'] = true;
            $_SESSION['id'] = $dataFetch['id'];
            $_SESSION['role'] = $dataFetch['role']; // Simpan role ke session

            // Redirect berdasarkan role
            if ($_SESSION['role'] === 'seller') {
                echo "<script>
                localStorage.removeItem('loginFormData');
                </script>";
                header('Location: ../rules.php');  // Jika seller, arahkan ke index-seller.php
            } else {
                echo "<script>
                localStorage.removeItem('loginFormData');
                </script>";
                header('Location: ../rules.php');  // Jika buyer, arahkan ke index.php
            }
            exit;
        } else {
            // Jika password salah
            echo "<script>
                    alert('Password is Incorrect!');
                    window.location.replace('login.php');
                  </script>"; 
            return;
        }
    } else {
        // Jika username tidak ditemukan
        echo "<script>
                alert('Username Not Found!');
                window.location.replace('login.php');
              </script>";
        return;
    }
}


function logout() {

}
