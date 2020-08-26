<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Routing\Router;

$cakeDescription = 'CPI : Clear Power Indicator ';
$source_version = "?ver=1.005";
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175924766-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-175924766-1');
    </script>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@IIDX_CPI">
    <meta property="og:title" content="Clear Power Indicator">
    <meta property="og:description" content="CPIは、BeatmaniaIIDXのSP☆12のクリア力や、曲やクリアオプションごとの達成確率を推定する非公式ファンサイトです">
    <meta property="og:image" content="<?= Router::url('/img/cpi_144_144.png',true)?>">
    
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">
    
    <?= $this->Html->css('style.css'.$source_version) ?>

    <!-- using bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- using datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

    <!-- using icon css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header class="navbar navbar-expand-sm navbar-dark bg-dark mb-5">
        <?= $this->Html->link(
                'CPI',
                ['controller' => 'Pages', 'action' => 'display'],
                ['class' => 'navbar-brand'])
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
           <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?= $this->Html->link(
                        __('Users'),
                        ['controller' => 'Users', 'action' => 'index'],
                        ['class' => 'nav-link'])
                    ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        __('About'),
                        ['controller' => 'Pages', 'action' => 'about'],
                        ['class' => 'nav-link'])
                    ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        __('Donate'),
                        ['controller' => 'Pages', 'action' => 'donate'],
                        ['class' => 'nav-link'])
                    ?>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if($isLoggedIn): ?>
                    <!-- ログイン中 -->
                    <li class="nav-item dropdown">
                        <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-cur-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $identity->username ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-cur-user">
                            <?= $this->Html->link(
                                __('My page'),
                                ['controller' => 'Users', 'action' => 'view', $identity->id],
                                ['class' => 'dropdown-item'])
                            ?>
                            <?= $this->Html->link(
                                __('Setting'),
                                ['controller' => 'Users', 'action' => 'setting', $identity->id],
                                ['class' => 'dropdown-item'])
                            ?>
                            <?= $this->Html->link(
                                __('Logout'),
                                ['controller' => 'Users', 'action' => 'logout'],
                                ['class' => 'dropdown-item'])
                            ?>
                        </div>
                    </li>
                <?php else: ?>
                    <!-- 非ログイン中 -->
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Sign Up'),
                            ['controller' => 'Users', 'action' => 'add'],
                            ['class' => 'nav-link'])
                        ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Sign In'),
                            ['controller' => 'Users', 'action' => 'login'],
                            ['class' => 'nav-link'])
                        ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer class="mt-5 mb-3">
        <div class="container" style="text-align:center">
            <div class="text-muted" style="font-size: 12px;">
                </br>
                <p>
                beatmaniaⅡDXは、株式会社コナミデジタルエンタテインメントの商標または登録商標です。</br>
                本サービスは、株式会社コナミデジタルエンタテインメントとは一切関係の無い個人が製作した非公式ファンサイトです。
                </p>
                </br>
            </div>
        </div>
    </footer>

    <!-- using bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- using datatable js -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <?php if(isset($dtables)): ?>
        <?php foreach ($dtables as $dtable): ?>
            <?= $this->Html->script('dtable/'.$dtable.'.js'.$source_version) ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>

    <!-- using basic js -->
    <?= $this->Html->script('basic.js'.$source_version) ?>
    <?= $this->Html->script('garlic.js') ?>
</body>
</html>
