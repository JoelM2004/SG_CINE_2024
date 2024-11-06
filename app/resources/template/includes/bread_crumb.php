<nav style="--bs-breadcrumb-divider: '>'; margin-top: 2cm;" aria-label="breadcrumb">
    <ol class="breadcrumb bg-white rounded-pill shadow-lg p-3">
        <li class="breadcrumb-item">
            <a href="<?= $breadcrumbLink ?>" class="text-decoration-none text-primary fw-bold"><?= htmlspecialchars($breadcrumbPasada) ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <span class="text-secondary fw-bold"><?= htmlspecialchars($breadcrumbActual) ?></span>
        </li>
    </ol>
</nav>

