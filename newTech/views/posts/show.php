 <h2> Liste des posts <h2>
         <?php
            foreach ($posts as $post) : ?>
             <h3> <a href="/posts/find_by_slug/<?= $post->slug ?>"><?= $post->title ?> </a></h3>
         <?php endforeach; ?>