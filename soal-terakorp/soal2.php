<?php

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fitur search by hobi
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Query laporan jumlah person per hobi
$sql = "
    SELECT hobi.hobi, COUNT(DISTINCT hobi.person_id) AS jumlah_person
    FROM hobi
    " . ($search ? "WHERE hobi.hobi LIKE ?" : "") . "
    GROUP BY hobi.hobi
    ORDER BY jumlah_person DESC
";
$stmt = $conn->prepare($sql);

if ($search) {
    $param = "%$search%";
    $stmt->bind_param("s", $param);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hobi & Jumlah Person</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #888; padding: 6px 12px; }
    </style>
</head>
<body>
    <h2>Laporan Hobi & Jumlah Person</h2>
    <form method="get">
        <label>Cari Hobi: <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"></label>
        <button type="submit">Cari</button>
        <?php if ($search): ?>
            <a href="soal2.php">Reset</a>
        <?php endif; ?>
    </form>
    <br>
    <table>
        <tr>
            <th>Hobi</th>
            <th>Jumlah Person</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['hobi']) ?></td>
                <td><?= $row['jumlah_person'] ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">Data tidak ditemukan.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();