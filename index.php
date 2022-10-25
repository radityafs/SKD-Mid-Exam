<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./src/js/script.js"></script>

    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <title>Enkripsi - SKD</title>
</head>

<body>
    <header>
        <div class="nav-wrapper">
            <div class="logo-container">
                <img class="logo" src="https://i0.wp.com/uns.ac.id/id/wp-content/uploads/logo-uns-biru.png?fit=528%2C526&ssl=1" alt="Logo">
                <h2>Kelompok 2</h2>
            </div>
            <nav>
                <input class="hidden" type="checkbox" id="menuToggle">
                <label class="menu-btn" for="menuToggle">
                    <div class="menu"></div>
                    <div class="menu"></div>
                    <div class="menu"></div>
                </label>
                <div class="nav-container">
                    <ul class="nav-tabs">
                        <li class="nav-tab">Login</li>
                        <li class="nav-tab">Register</li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="option">
        <h1>Pilih jenis algoritma yang ingin digunakan : </h1>
        <select name="algoritma" class="algoritma">
            <?php
            foreach (openssl_get_cipher_methods(true) as $method) {
                echo "<option value='{$method}'>{$method}</option>";
            }
            ?>
        </select>
    </div>
    <div class="login-page">
        <div class="form">
            <h1 class="title">Dekripsi</h1>
            <form class="decrypt">
                <textarea class="decrypt-text" name="decrypt-text">Masukan Teks yang ingin di enkripsi.</textarea>
            </form>
        </div>

        <div class="form">
            <h1 class="title">Enkripsi</h1>
            <form class="encrypt">
                <textarea class="encrypt-text" name="encrypt-text">Masukan Teks yang ingin di dekripsi.</textarea>
            </form>
        </div>
    </div>
</body>

</html>