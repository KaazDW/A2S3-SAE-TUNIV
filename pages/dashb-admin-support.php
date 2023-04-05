<?php 
    if (empty($_SESSION["type"])) {
        $_SESSION["type"] = false;
    }

    if ($_SESSION["type"] != "administrateur") {
        header("Location: /index");
    }

    $sql = "SELECT * FROM support ORDER BY id DESC;";
    $support = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="support-admin-main-dashboard">
        <h2 class="title">Support Dashboard</h2>
        <section class="dashadmin-section">
            <div class="grid">
                <div href="#" class="support-line">
                    <span>id</span>
                    <span>Email</span>
                    <span>Nom</span>
                    <span>Prénom</span>
                    <span>Description</span>
                    <span>Screen</span>
                </div>
                <?php 
                    $supps = $support->fetchAll();
                    foreach($supps as $supp):
                ?>
                    <div href="#" class="support-line">
                        <span><?php echo(htmlspecialchars($supp['id'])); ?></span>
                        <a href=mailto:<?php echo(htmlspecialchars($supp['email'])); ?> type="email"><?php echo(htmlspecialchars($supp['email'])); ?></a>
                        <span><?php echo(htmlspecialchars($supp['firstname'])); ?></span>
                        <span><?php echo(htmlspecialchars($supp['lastname'])); ?></span>
                        <span><?php echo(htmlspecialchars($supp['descr'])); ?></span>
                        <a href="<?php echo("/uploadsupport/". htmlspecialchars($supp['screen'])) ?>" target="_blank"><?php echo(htmlspecialchars($supp['screen'])); ?></span></a>
                        <a href="/config-supp-support?id=<?= $supp['id'] ?>">supprimer</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>