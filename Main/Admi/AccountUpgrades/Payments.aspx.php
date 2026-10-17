<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$keyword  = trim($_POST['keyword'] ?? '');
$sortBy   = $_POST['sort'] ?? 'date';
$results  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $keyword !== '') {
    $orderMap = ['date' => 'p.created DESC', 'username' => 'u.username ASC', 'price' => 'p.unit_price DESC', 'status' => 'p.payment_status_type_id ASC'];
    $order = $orderMap[$sortBy] ?? 'p.created DESC';

    $stmt = $conn->prepare("
        SELECT u.id, u.username, u.email, p.id as payment_id,
               p.unit_price, p.currency_type_id, p.payment_status_type_id, p.payment_date
        FROM payments p
        JOIN users u ON u.id = p.sale_id
        WHERE u.username ILIKE :kw OR u.email ILIKE :kw OR CAST(u.id AS TEXT) = :exact
        ORDER BY $order
        LIMIT 50
    ");
    $stmt->execute([':kw' => '%' . $keyword . '%', ':exact' => $keyword]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
echo Header::render();
?>
<div class="adminContent" style="margin-top:0;padding-top:1.6em;">
    Find Payment<br>
    <div class="spacer"></div>

    <form method="post">
        <p style="display:inline;">Username/ID:</p>
        <input name="keyword" value="<?= htmlspecialchars($keyword) ?>" style="display:inline;">
        <br><br>
        <p style="display:inline;">Sort By:</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="sort_date" name="sort" value="date" <?= $sortBy==='date'?'checked':'' ?>>
        <label for="sort_date">Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="sort_username" name="sort" value="username" <?= $sortBy==='username'?'checked':'' ?>>
        <label for="sort_username">Username</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="sort_price" name="sort" value="price" <?= $sortBy==='price'?'checked':'' ?>>
        <label for="sort_price">Price</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="sort_status" name="sort" value="status" <?= $sortBy==='status'?'checked':'' ?>>
        <label for="sort_status">Order Status</label>
        <br><br>
        <button type="submit">Search</button>
    </form>

    <hr>

    <?php if (!empty($results)): ?>
    <table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;margin-top:10px;">
        <tr style="background:#507CD1;color:#fff;font-weight:bold;">
            <th>User ID</th><th>Username</th><th>Email</th>
            <th>Payment ID</th><th>Price</th><th>Status</th><th>Date</th>
        </tr>
        <?php foreach ($results as $i => $r):
            $bg = $i % 2 === 0 ? '#EFF3FB' : '#fff'; ?>
        <tr style="background:<?= $bg ?>;">
            <td><a href="/Admi/Users/UserAdmin.aspx?ID=<?= $r['id'] ?>"><?= $r['id'] ?></a></td>
            <td><?= htmlspecialchars($r['username']) ?></td>
            <td><?= htmlspecialchars($r['email'] ?? '') ?></td>
            <td><?= $r['payment_id'] ?></td>
            <td><?= number_format($r['unit_price'] / 100, 2) ?></td>
            <td><?= $r['payment_status_type_id'] ?></td>
            <td><?= htmlspecialchars($r['payment_date'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>
<?= Footer::render() ?>