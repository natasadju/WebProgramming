<div class="container">
    <h3>Uredi novico</h3>
    <form action="/articles/update" method="POST">
        <input type="hidden" name="id" value="<?php echo $article->id; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article->title; ?>">
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Povzetek</label>
            <textarea id="abstract" class="form-control" name="abstract" rows="2"><?php echo $article->abstract; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Vsebina</label>
            <textarea id="text" class="form-control" name="text" rows="4"><?php echo $article->text; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Shrani</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>