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

$cakeDescription = 'CPI : Clear Power Indicator ';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <!-- using bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- using datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

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
                        __('Home'),
                        ['controller' => 'Pages', 'action' => 'display'],
                        ['class' => 'nav-link'])
                    ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        __('User'),
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
            </ul>
            <ul class="navbar-nav">
                <?php if($isLoggedIn): ?>
                    <!-- ログイン中 -->
                    <li class="nav-item dropdown">
                        <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $identity->username ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
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
                            __('Register'),
                            ['controller' => 'Users', 'action' => 'add'],
                            ['class' => 'nav-link'])
                        ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Login'),
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
    <footer>
    </footer>

    <!-- using bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- using datatable js -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <?php if(isset($dtables)): ?>
        <?php foreach ($dtables as $dtable): ?>
            <?= $this->Html->script('dtable/'.$dtable.'.js') ?>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
