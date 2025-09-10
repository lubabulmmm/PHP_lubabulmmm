<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal A - SOAL 1</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .border { border: 1px solid #aaa; padding: 20px; width: fit-content; margin-bottom: 20px; }
        .input-row { margin-bottom: 10px; }
        label { display: inline-block; width: 180px; }
        input[type="text"], input[type="number"] { width: 50px; }
        .result { font-size: 1.2em; }
        button { padding: 5px 15px; font-size: 1em; }
    </style>
</head>
<body>
    <h1>Soal A</h1>
    <h2>SOAL 1</h2>
    <?php
    // Step 1: Input jumlah baris & kolom
    if (!isset($_POST['step'])) {
    ?>
        <form method="post">
            <div class="border">
                <div class="input-row">
                    <label>Inputkan Jumlah Baris:</label>
                    <input type="number" name="baris" min="1" required>
                </div>
                <div class="input-row">
                    <label>Inputkan Jumlah Kolom:</label>
                    <input type="number" name="kolom" min="1" required>
                </div>
                <input type="hidden" name="step" value="2">
                <button type="submit">SUBMIT</button>
            </div>
        </form>
    <?php
    // Step 2: Input data per kolom
    } elseif ($_POST['step'] == 2) {
        $baris = intval($_POST['baris']);
        $kolom = intval($_POST['kolom']);
    ?>
        <form method="post">
            <div class="border">
                <?php
                for ($i = 1; $i <= $kolom; $i++) {
                    echo '<label>' . $baris . ':' . $i . ':</label>';
                    echo '<input type="text" name="data[' . $i . ']" required> ';
                }
                ?>
                <input type="hidden" name="baris" value="<?php echo $baris; ?>">
                <input type="hidden" name="kolom" value="<?php echo $kolom; ?>">
                <input type="hidden" name="step" value="3">
                <br><br>
                <button type="submit">SUBMIT</button>
            </div>
        </form>
    <?php
    // Step 3: Tampilkan hasil inputan no 2
    } elseif ($_POST['step'] == 3) {
        $baris = intval($_POST['baris']);
        $kolom = intval($_POST['kolom']);
        $data = $_POST['data'];
        echo '<div class="border result">';
        for ($i = 1; $i <= $kolom; $i++) {
            $val = htmlspecialchars($data[$i]);
            echo "{$baris}:{$i}: {$val}<br>";
        }
        // echo "<i>dst</i>";
        echo '</div>';
    }
    ?>
</body>
</html>