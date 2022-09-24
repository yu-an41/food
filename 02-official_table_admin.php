<table class="table table-striped table-bordered">
  <thead>
    <tr>

      <th scope="col">刪除</th>
      <th scope="col">編號</th>
      <th scope="col">標題</th>
      <th scope="col">圖片</th>
      <!-- <th scope="col">影片</th> -->
      <th scope="col">內文</th>
      <th scope="col">標籤</th>
      <th scope="col">建立時間</th>
      <th scope="col">編輯</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($row as $r) : ?>
      <tr>
        <!--新增垃圾桶icon  -->
        <td>
          <a href="02-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為<?= $r['sid'] ?>的資料嗎?')">
            <i class="fa-solid fa-trash-can"></i>
          </a>
        </td>
        <td><?= $r['sid'] ?></td>
        <td><?= $r['title'] ?></td>
        <td><img src="./uploads/<?= $r['img'] ?>" style="width: 150px;"></td>

        <td><?= $r['content'] ?></td>
        <td><?= $r['hashtag'] ?></td>
        <td><?= $r['created_at'] ?></td>
        <!--新增編輯icon  -->
        <td>
          <a href="02-edit_forms.php?sid=<?= $r['sid'] ?>">
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
        </td>

      </tr>
    <?php endforeach; ?>
  </tbody>

</table>