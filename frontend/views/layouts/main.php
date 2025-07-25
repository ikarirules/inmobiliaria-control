<?php
/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
    $this->registerCsrfMetaTags();
    $this->registerCssFile('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/flatpickr', ['depends' => \yii\web\JqueryAsset::class]);
    ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top custom-navbar',
        ],
    ]);

    // Menú principal (navegación básica)
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
        ['label' => 'Clientes', 'url' => ['/cliente/index']],
        ['label' => 'Caja', 'url' => ['/caja/index']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    ?>
    
    <!-- Botones principales destacados -->
    <div class="navbar-nav ms-auto d-flex flex-row">
        <div class="nav-item me-2">
            <?= Html::a('💰 Ingreso', ['caja/create', 'dato' => 0], [
                'class' => 'btn btn-ingreso btn-action',
                'title' => 'Registrar Ingreso'
            ]) ?>
        </div>
        <div class="nav-item">
            <?= Html::a('💸 Egreso', ['caja/create', 'dato' => 1], [
                'class' => 'btn btn-egreso btn-action',
                'title' => 'Registrar Egreso'
            ]) ?>
        </div>
    </div>
    
    <?php NavBar::end(); ?>
</header>

<main role="main" class="flex-shrink-0 main-content">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<!-- Botones flotantes para móviles -->

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<style type="text/css">
/* === NAVBAR === */
.custom-navbar {
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
}

/* === BOTONES DE ACCIÓN === */
.btn-action {
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    min-width: 120px;
    border: none;
    text-decoration: none;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    text-decoration: none;
}

.btn-ingreso {
    background: linear-gradient(135deg, #58d68d, #2ecc71);
    color: white;
}

.btn-ingreso:hover {
    background: linear-gradient(135deg, #4fc3a5, #27ae60);
    color: white;
}

.btn-egreso {
    background: linear-gradient(135deg, #ec7063, #e74c3c);
    color: white;
}

.btn-egreso:hover {
    background: linear-gradient(135deg, #e55a4e, #c0392b);
    color: white;
}

/* === LAYOUT PRINCIPAL === */
.main-content {
    margin-top: 80px;
    min-height: calc(100vh - 140px);
    padding-top: 20px;
}

/* === NAVBAR RESPONSIVE === */
@media (max-width: 768px) {
    .navbar-nav.ms-auto {
        margin-top: 10px;
    }
    
    .navbar-nav.ms-auto .nav-item {
        margin-bottom: 10px;
    }
    
    .btn-action {
        min-width: 100px;
        padding: 8px 16px;
        font-size: 0.9rem;
    }
    
    .main-content {
        margin-top: 2px;
    }
}

@media (max-width: 576px) {
    .btn-action {
        min-width: 90px;
        padding: 6px 12px;
        font-size: 0.8rem;
    }
    
    .navbar-brand {
        font-size: 1.2rem;
    }
}

/* === BOTONES FLOTANTES (MÓVILES) === */
.floating-buttons {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-floating {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 1.5rem;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.btn-floating:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.btn-floating-ingreso {
    background: linear-gradient(135deg, #58d68d, #2ecc71);
}

.btn-floating-egreso {
    background: linear-gradient(135deg, #ec7063, #e74c3c);
}

/* === MEJORAS GENERALES === */
.navbar-nav .nav-link:hover {
    color: #adb5bd !important;
    transition: color 0.3s ease;
}

.container {
    max-width: 1200px;
    padding: 2px !important;
}

/* === FOOTER === */
.footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

/* === ACCESIBILIDAD === */
.btn:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 2px #007bff;
}

/* === ANIMACIONES === */
@keyframes slideInFromTop {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.btn-action {
    animation: slideInFromTop 0.6s ease-out;
}

/* === MEJORAS NAVBAR === */
.navbar-toggler {
    border: none;
    padding: 0.25rem 0.5rem;
}

.navbar-toggler:focus {
    box-shadow: none;
}

.navbar-collapse {
    justify-content: space-between;
}

/* === ESPACIADO MEJORADO === */
.navbar-nav.ms-auto .nav-item:not(:last-child) {
    margin-right: 10px;
}

/* === EFECTOS HOVER MEJORADOS === */
.btn-action:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* === RESPONSIVE PARA BOTONES FLOTANTES === */
@media (max-width: 576px) {
    .floating-buttons {
        bottom: 15px;
        right: 15px;
    }
    
    .btn-floating {
        width: 50px;
        height: 50px;
        font-size: 1.3rem;
    }
}
</style>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>