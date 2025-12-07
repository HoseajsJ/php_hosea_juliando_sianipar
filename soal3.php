<?php

$host = 'localhost';
$dbname = 'testdb';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

$searchNama = isset($_GET['nama']) ? $_GET['nama'] : '';
$searchAlamat = isset($_GET['alamat']) ? $_GET['alamat'] : '';

$sql = "SELECT p.nama, p.alamat, h.hobi 
        FROM person p
        JOIN hobi h ON p.id = h.person_id
        WHERE 1=1";

$params = [];

if (!empty($searchNama)) {
    $sql .= " AND p.nama LIKE :nama";
    $params[':nama'] = "%" . $searchNama . "%";
}

if (!empty($searchAlamat)) {
    $sql .= " AND p.alamat LIKE :alamat";
    $params[':alamat'] = "%" . $searchAlamat . "%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Soal 3: Person dan Hobi</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 50%; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .search-box { border: 1px solid black; padding: 15px; width: fit-content; }
        .form-group { margin-bottom: 10px; }
	label { display: inline-block; width: 80px; font-weight: bold; text-decoration: underline wavy blue; }
        input[type="text"] { padding: 5px; }
        button { padding: 5px 15px; cursor: pointer; font-weight: bold; margin-left: 85px; }
	th span { text-decoration: underline wavy red; }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th><span>Nama</span></th>
                <th><span>Alamat</span></th>
                <th><span>Hobi</span></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($results) > 0): ?>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= htmlspecialchars($row['hobi']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center">Data tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="search-box">
        <form method="GET" action="">
            <div class="form-group">
                <label>Nama :</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($searchNama) ?>">
            </div>
            <div class="form-group">
                <label>Alamat :</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($searchAlamat) ?>">
            </div>
            <button type="submit">SEARCH</button>
        </form>
    </div>

</body>
</html>

