<?php

use App\Connection;
use App\Helpers\Text;
use App\Model\Post;
use App\URL;

$title = "Mon blog";

$pdo = Connection::getPDO();

$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];

$perPages = 12;
$pages = ceil($count / $perPages);


$currentPage = URL::getPositiveInt('page', 1);

if ($currentPage > $pages) throw new Exception('La page demandée n\'existe pas');

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT ' . $perPages . ' OFFSET ' . ($currentPage-1) * $perPages);

$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<h1>Mon blog</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php' ?>
        </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php
            $link = $router->url('home');
            if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
    <?php endif ?>
</div>