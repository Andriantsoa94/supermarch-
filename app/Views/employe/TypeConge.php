<?php
$session = session();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>TechMada RH — Conges par type</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet" />
    <style>
        :root {
            --ink: #1c2b1e;
            --forest: #2d5a3d;
            --forest2: #3d7a52;
            --leaf: #5fa876;
            --mint: #d4ede0;
            --cream: #f8f6f1;
            --white: #ffffff;
            --border: #dde8e1;
            --muted: #7a8f80;
            --sidebar-w: 240px;
            --topbar-h: 62px;
        }

        * { box-sizing: border-box }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            margin: 0;
            font-size: 15px
        }

        h1, h2, h3, .brand-name { font-family: 'Playfair Display', serif }
        code, pre, .mono { font-family: 'DM Mono', monospace }

        .app-wrap { display: flex; min-height: 100vh }
        .sidebar {
            width: var(--sidebar-w);
            background: var(--ink);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto
        }

        .sidebar-brand {
            padding: 1.4rem 1.2rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .06)
        }

        .sidebar-logo-icon {
            width: 34px;
            height: 34px;
            background: var(--forest);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .sidebar-logo-icon i { color: var(--white); font-size: 1.1rem }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--white);
            line-height: 1.2
        }

        .sidebar-brand-name span {
            display: block;
            font-size: .65rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            color: rgba(255, 255, 255, .35);
            letter-spacing: .05em;
            text-transform: uppercase
        }

        .sidebar-section {
            padding: .75rem 1.1rem .3rem;
            font-size: .62rem;
            font-weight: 500;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .25);
            margin-top: .25rem
        }

        .sidebar-nav { list-style: none; padding: 0 .75rem; margin: 0 }
        .sidebar-nav li { margin-bottom: 2px }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 11px;
            border-radius: 7px;
            color: rgba(255, 255, 255, .55);
            text-decoration: none;
            font-size: .85rem;
            font-weight: 400;
            transition: all .15s
        }

        .sidebar-nav li a:hover { background: rgba(255, 255, 255, .06); color: rgba(255, 255, 255, .9) }
        .sidebar-nav li a.active { background: var(--forest); color: var(--white) }
        .sidebar-nav li a i { font-size: 1.05rem; flex-shrink: 0 }

        .sidebar-user {
            padding: .85rem .75rem;
            border-top: 1px solid rgba(255, 255, 255, .06);
            margin-top: auto
        }

        .s-user-row {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 11px;
            border-radius: 7px;
            cursor: pointer;
            transition: background .15s
        }

        .s-user-row:hover { background: rgba(255, 255, 255, .06) }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .7rem;
            font-weight: 500;
            color: var(--white);
            flex-shrink: 0;
            font-family: 'DM Mono', monospace
        }

        .av-green { background: var(--forest2) }
        .user-name { font-size: .825rem; font-weight: 500; color: var(--white); line-height: 1.2 }
        .user-role { font-size: .65rem; color: rgba(255, 255, 255, .35); text-transform: uppercase; letter-spacing: .06em }

        .main { flex: 1; min-width: 0; display: flex; flex-direction: column }
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 1.75rem;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 10
        }

        .topbar-title { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 600; color: var(--ink) }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 8px }
        .icon-btn {
            width: 34px;
            height: 34px;
            border: 1.5px solid var(--border);
            background: var(--white);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--muted);
            transition: all .15s;
            text-decoration: none
        }

        .icon-btn:hover { border-color: var(--forest); color: var(--forest) }
        .content { padding: 1.75rem; flex: 1 }

        .data-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden
        }

        .data-card-head {
            padding: .9rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            flex-wrap: wrap
        }

        .data-card-head h3 {
            font-family: 'Playfair Display', serif;
            font-size: .95rem;
            margin: 0;
            font-weight: 600;
            color: var(--ink)
        }

        .tbl {
            width: 100%;
            border-collapse: collapse;
            font-size: .85rem
        }

        .tbl thead th {
            padding: 9px 14px;
            font-size: .68rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            background: var(--cream);
            border-bottom: 1px solid var(--border);
            text-align: left;
            white-space: nowrap
        }

        .tbl tbody tr { border-bottom: 1px solid var(--border) }
        .tbl tbody tr:last-child { border-bottom: none }
        .tbl td { padding: 12px 14px; color: var(--ink); vertical-align: middle }
    </style>
</head>

<body>
    <div class="app-wrap">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
                <div class="sidebar-brand-name">TechMada RH<span>Espace employe</span></div>
            </div>
            <div class="sidebar-section">Menu</div>
            <ul class="sidebar-nav">
                <li><a href="<?= site_url('employe/dashboard') ?>"><i class="bi bi-grid-1x2"></i> Tableau de bord</a></li>
                <li><a href="<?= site_url('employe/nouveau-conge') ?>"><i class="bi bi-plus-circle"></i> Nouvelle demande</a></li>
                <li><a href="<?= site_url('employe/mes-conges') ?>"><i class="bi bi-calendar3"></i> Mes demandes</a></li>
                <li><a href="<?= site_url('employe/calendar') ?>"><i class="bi bi-calendar-week"></i> Calendrier</a></li>
                <li><a href="<?= site_url('employe/type-conge') ?>" class="active"><i class="bi bi-pie-chart"></i> Conges par type</a></li>
                <li><a href="<?= site_url('employe/profil') ?>"><i class="bi bi-person"></i> Mon profil</a></li>
            </ul>
            <div class="sidebar-user">
                <div class="s-user-row">
                    <div class="avatar av-green"><?= substr($session->get('nom'), 0, 1) ?></div>
                    <div>
                        <div class="user-name"><?= esc($session->get('nom')) ?></div>
                        <div class="user-role"><?= esc($session->get('role')) ?></div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="main">
            <div class="topbar">
                <div>
                    <div class="topbar-title">Conges par type</div>
                </div>
                <div class="topbar-actions">
                    <a href="<?= site_url('logout') ?>" class="icon-btn" title="Deconnexion"><i class="bi bi-box-arrow-right"></i></a>
                </div>
            </div>

            <div class="content">
                <div class="data-card">
                    <div class="data-card-head">
                        <h3>Resume</h3>
                    </div>

                    <?php if (empty($groupBy)): ?>
                        <div class="p-4 text-muted">Aucun conge trouve.</div>
                    <?php else: ?>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>Type de conge</th>
                                    <th>Total jours</th>
                                    <th>Total demandes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groupBy as $row): ?>
                                    <tr>
                                        <td><?= esc($row['libelle']) ?></td>
                                        <td><?= esc($row['total_jours']) ?></td>
                                        <td><?= esc($row['total_demandes']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>