<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">order_sid</th>
                        <th scope="col">created_at</th>
                        <th scope="col">total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($rows as $r) : ?>
                            <td>
                                <a href="#"><?= $r['order_sid'] ?></a>
                            </td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['total'] ?></td>
                        <? endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>