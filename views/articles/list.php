<div class="container">
    <h3>Moje novice</h3>
    <div class="articles">
        <?php
        foreach ($articles

        as $article){
        ?>
        <div class="article">
            <h4><?php echo $article->title; ?></h4>
            <p><b>Povzetek:</b> <?php echo $article->abstract; ?></p>
            <p>Objavil: <?php echo $article->user->username; ?>
                , <?php echo date_format(date_create($article->date), 'd. m. Y \ob H:i:s'); ?></p>
            <a href="/articles/show?id=<?php echo $article->id; ?>">
                <button>Prikaži</button>
            </a>
            <a href="/articles/edit?id=<?php echo $article->id; ?>">
                <button>Uredi</button>
            </a>
            <a href="/articles/delete?id=<?php echo $article->id; ?>" onclick="return confirm('Are you sure?')">
                <button>Izbriši</button>
            </a>
        </div>
<?php
}
?>