<h1>Liste des Articles</h1>
<ol>
    <?php foreach($articles as $article) : ?>
    <li> <a href="/articles/searchBySlug/<?= article['slug'] ?>"><?= $article['title']?> </a> </li>
    <?php endforeach ?>
</ol>