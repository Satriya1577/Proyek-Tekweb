<?php
session_start();
include 'db_conn.php';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $memberId = $user['member_id'];
    $stmt3 = $pdo->prepare("SELECT saldo FROM users WHERE member_id = :member_id");
    $stmt3->bindParam(":member_id", $memberId);
    $stmt3->execute();
    $rows3 = $stmt3->fetch(PDO::FETCH_ASSOC);


    $userEmail = $user['email'];
    $userName = $user['username'];
    $userTelp = $user['no_telepon'];
    $saldo = $rows3['saldo'];

    $stmt = $pdo->prepare(
        "SELECT invoice.invoice_id, game.game_name, invoice.uid_game, item.nominal_topup, item.harga_satuan, invoice.tanggal_transaksi, invoice.status_transaksi FROM users
                INNER JOIN invoice
                    ON users.member_id = invoice.member_id
                INNER JOIN item
                    ON invoice.item_id = item.item_id
                INNER JOIN game
                    ON item.game_id = game.game_id WHERE invoice.member_id=:member_id;"
    );
    $stmt->bindParam(":member_id", $memberId);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="assets\Web Logo\pay-2-win-full.png" />

    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Mono:300,500');

        html,
        body {
            width: 100%;
            height: 100%;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .container,
        .container>.row,
        .container>.row>div {
            height: 100%;
        }

        #countUp {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;

            .number {
                font-size: 5rem;
                font-weight: 500;

                +.text {
                    margin: 0 0 1rem;
                }
            }

            .text {
                font-weight: 350 !important;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="blob-c">
        <div class="shape-blob one"></div>
        <div class="shape-blob two"></div>
        <div class="shape-blob three"></div>
        <div class="shape-blob four"></div>
        <div class="shape-blob five"></div>
        <div class="shape-blob six"></div>
    </div>


    <?php
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $memberId = $user['member_id'];
        $userEmail = $user['email'];
        $userName = $user['username'];
        echo "
            <nav class='py-4 navbar navbar-expand-lg navbar-dark fixed-top' style='background: rgba(0, 0, 0, 0.6) !important; backdrop-filter: blur(10px) saturate(125%); z-index: 2; -webkit-backdrop-filter: blur(10px) saturate(125%);'>
                <div class='container px-4 px-lg-5 text-white'>
                    <a class='navbar-brand' style='height: 52px;' href='home.php'>
                        <img src='assets\Web Logo\pay-2-win-full.png' alt='PAY2WIN Logo' class='img-fluid'
                            style='max-height: 50px;margin-top: -2px;height: 100%;object-fit: cover;'>
                    </a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse'
                        data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false'
                        aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>

                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 align-items-center'>
                            <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' aria-current='page' href='home.php'>HOME</a></li>
                            <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' href='about.php'>ABOUT</a></li>
                            <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' href='history_transaction.php'>HISTORY TRANSACTION</a></li>
                            <li class='nav-item me-lg-4 d-lg-block'><a href='home.php' class='nav-link'><button type='button' class='balance-info-btn btn btn-outline-light'>BALANCE & TOP UP</button></li></a>
                        </ul>

                        <ul class='navbar-nav align-items-center'>
                            <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' href='#'><p class='mb-0'>Welcome, $userName</p></a></li>
                            <li class='nav-item me-lg-4 d-lg-block'><a href='#'><button type='button' class='btn btn-outline-light' data-bs-toggle='modal' data-bs-target='#logoutModal'>Log Out</button></a></li>
                        </ul>
                    </div>
                </div>
            </nav>";     
    } else {
        echo "<nav class='py-4 navbar navbar-expand-lg navbar-dark bg-dark fixed-top'style='background: rgba(0, 0, 0, 0.6) !important; backdrop-filter: blur(10px) saturate(125%); z-index: 2; -webkit-backdrop-filter: blur(10px) saturate(125%);'>
            <div class='container px-4 px-lg-5 text-white'>
                <a class='navbar-brand' style='height: 52px;' href='index.php'>
                    <img src='assets\Web Logo\pay-2-win-full.png' alt='PAY2WIN Logo' class='img-fluid'
                        style='max-height: 50px;margin-top: -2px;height: 100%;object-fit: cover;'>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent'aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 align-items-center'>
                        <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' aria-current='page' href='index.php'>HOME</a></li>
                        <li class='nav-item me-lg-4 d-lg-block'><a class='nav-link' href='about.php'>ABOUT</a></li>
                    </ul>
                    <ul class='navbar-nav align-items-center'>
                        <li class='nav-item me-lg-4 d-lg-block'><a href='login.php' class='nav-link'><button class='btn btn-outline-light'type='submit'>Login</button></a></li>
                        <li class='nav-item me-lg-4 d-lg-block'><a href='signup.php' class='nav-link'><button class='btn btn-outline-light'type='submit'>Sign up</button></a></li>
                    </ul>
                </div>
            </div>
        </nav>";
    }
    ?>

    <div class="container" style="margin: 0;min-height: 100vh;min-width: 100vw;font-family: 'Roboto Mono', 'Liberation Mono', Consolas, monospace;color: rgba(255, 255, 255, .87);">
        <div class="row">
            <div class="xs-12 md-6 mx-auto">
                <div id="countUp">
                    <div class="number" data-count="404">0</div>
                    <div class="text">Page not found. </div>
                    <div class="text">Gapenting sih, tapi mau bagaimana lagi.</div>
                    <div class="text">Turu Turu Turu 😴😴😴💤.</div><br>
                    <button class="btn btn-outline-light" type="submit" onclick="window.location.href='index.php'">sini,
                        Balik Home Ajah</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const countUp = document.querySelector('#countUp .number');
        const countUpText = document.querySelector('#countUp .text');
        const countUpNum = parseInt(countUp.dataset.count, 10);
        const delay = 10;
        const speed = 1000 / countUpNum;

        let counter = 0;

        const countUpTick = () => {
            if (counter < countUpNum) {
                counter++;
                countUp.innerText = counter;
                setTimeout(countUpTick, speed);
            } else {
                countUpText.innerText = 'Page not found';
            }
        }

        setTimeout(countUpTick, delay);
    </script>
</body>

</html>