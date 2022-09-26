    <div class="container">
        <div class="row">
            <?php foreach ($row as $r) : ?>
                <div class="col-lg-4">
                    <div class="card m-3" style="width: 18rem;">
                        <img src="./uploads/<?= $r['img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $r['title'] ?></h5>
                            <p class="card-text"><?= $r['content'] ?></p>
                            <a href="official_post.php?sid=<?= $r['sid'] ?>" class="btn btn-primary">閱讀完整文章</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>