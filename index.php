
<?php
require_once __DIR__ . '/books.php';

$kerkimi = trim($_GET['kerkimi'] ?? '');

$rezultatet = array_filter($librat, function ($libri) use ($kerkimi) {
    return $kerkimi === ''
        || stripos($libri['titulli'], $kerkimi) !== false
        || stripos($libri['autori'], $kerkimi) !== false
        || stripos($libri['kategoria'], $kerkimi) !== false;
});

function e($teksti) {
    return htmlspecialchars((string)$teksti, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka | Zbulo botën e librave</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <a href="index.php" class="logo">
        <span class="logo-icon">▤</span> Biblioteka
    </a>

    <nav class="nav">
        <a href="index.php" class="active">Kryefaqja</a>
        <a href="#librat">Librat</a>
        <a href="#rreth-nesh">Rreth nesh</a>
        <a href="#kontakti">Kontakti</a>
    </nav>

    <a href="#librat" class="login-btn">Eksploro librat</a>
</header>

<main>
    <section class="hero">
        <div class="hero-content">
            <span class="eyebrow">MIRË SE VINI NË</span>
            <h1>Bibliotekën</h1>
            <p>
                Një vend ku librat sjellin ide, njohuri
                dhe botë të reja në jetë.
            </p>

            <form action="index.php" method="GET" class="search-form">
                <input
                    type="search"
                    name="kerkimi"
                    placeholder="Kërko sipas titullit ose autorit..."
                    value="<?= e($kerkimi) ?>"
                    aria-label="Kërko libra"
                >
                <button type="submit">Kërko →</button>
            </form>
        </div>

        <div class="hero-image" role="img"
             aria-label="Brendësia e një biblioteke me rafte librash"></div>
    </section>

    <section class="features" id="rreth-nesh">
        <article class="feature">
            <div class="feature-icon">▤</div>
            <h3>Shumëllojshmëri librash</h3>
            <p>Eksploro romane, shkencë, histori dhe shumë më tepër.</p>
        </article>

        <article class="feature">
            <div class="feature-icon">⌕</div>
            <h3>Kërkim i lehtë</h3>
            <p>Gjej shpejt librin që të intereson.</p>
        </article>

        <article class="feature">
            <div class="feature-icon">♡</div>
            <h3>Për çdo lexues</h3>
            <p>Gjej libra që përputhen me interesat e tua.</p>
        </article>

        <article class="feature">
            <div class="feature-icon">☆</div>
            <h3>Dashuri për leximin</h3>
            <p>Zbulo ide të reja dhe pasuro njohuritë e tua.</p>
        </article>
    </section>

    <section class="books-section" id="librat">
        <div class="section-heading">
            <div>
                <span class="eyebrow dark">KATALOGU YNË</span>
                <h2><?= $kerkimi !== '' ? 'Rezultatet e kërkimit' : 'Zgjedhjet tona për ty' ?></h2>
            </div>

            <?php if ($kerkimi !== ''): ?>
                <a href="index.php" class="outline-btn">Të gjithë librat</a>
            <?php endif; ?>
        </div>

        <div class="books-grid">
            <?php if (count($rezultatet) > 0): ?>
                <?php foreach ($rezultatet as $libri): ?>
                    <article class="book-card">
                        <div class="book-cover">
                            <img
                                src="<?= e($libri['foto']) ?>"
                                alt="Kopertina e librit <?= e($libri['titulli']) ?>"
                                loading="lazy"
                            >
                        </div>

                        <div class="book-info">
                            <h3><?= e($libri['titulli']) ?></h3>
                            <p class="author"><?= e($libri['autori']) ?></p>
                            <span class="category"><?= e($libri['kategoria']) ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">
                    Nuk u gjet asnjë libër. Provo një kërkim tjetër.
                </p>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer class="footer" id="kontakti">
    <a href="index.php" class="footer-logo">▤ Biblioteka</a>
    <p>Një botë e tërë njohurish, në çdo libër.</p>
    <p class="copyright">
        &copy; <?= date('Y') ?> Biblioteka. Të gjitha të drejtat e rezervuara.
    </p>
</footer>

</body>
</html>
