<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Luas Segitiga</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            animation: gradient 5s ease infinite;
            background-size: 400% 400%;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button.reset {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>MENGHITUNG LUAS SEGITIGA</h2>
        <form method="post" action="">
            <label for="alas">Alas:</label>
            <input type="number" name="alas[]" required><br><br>
            <label for="tinggi">Tinggi:</label>
            <input type="number" name="tinggi[]" required><br><br>
            <input type="submit" value="Tambah Data" class="button">
        </form>

        <?php
        session_start();

        if (!isset($_SESSION['data'])) {
            $_SESSION['data'] = [];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $alas = $_POST['alas'];
            $tinggi = $_POST['tinggi'];

            foreach ($alas as $key => $a) {
                if (count($_SESSION['data']) < 5) {
                    $_SESSION['data'][] = [
                        'alas' => $a,
                        'tinggi' => $tinggi[$key],
                        'luas' => 0.5 * $a * $tinggi[$key]
                    ];
                }
            }
        }

        if (isset($_POST['reset'])) {
            unset($_SESSION['data']);
        }

        if (!empty($_SESSION['data'])) {
            echo "<h3>Hasil Perhitungan</h3>";
            echo "<table>";
            echo "<tr><th>No</th><th>Alas</th><th>Tinggi</th><th>Luas</th></tr>";
            foreach ($_SESSION['data'] as $index => $data) {
                echo "<tr>";
                echo "<td>" . ($index + 1) . "</td>";
                echo "<td>" . $data['alas'] . "</td>";
                echo "<td>" . $data['tinggi'] . "</td>";
                echo "<td>" . $data['luas'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo '<form method="post" action="">
                    <input type="hidden" name="reset" value="true">
                    <input type="submit" value="Reset" class="button reset">
                  </form>';
        }
        ?>
    </div>
</body>
</html>