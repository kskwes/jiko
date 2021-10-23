<nav class="d-flex justify-content-center">
  <ul class="pagination">
    <?php if($now > 1): ?>
      <li class="page-item">
        <a href="?page_id=<?php echo $now-1 ?>" class="page-link text-dark">&laquo;</a>
      </li>
    <?php else: ?>
      <li class="page-item disabled">
        <span href="?page_id=<?php echo $now-1 ?>" class="page-link">&laquo;</span>
      </li>
    <?php endif ?>
    <?php for($n = 1; $n <= $pages; $n ++): ?>
      <?php if($n == $now): ?>
        <li class="page-item">
          <span class="page-current page-link">
            <?php echo $now ?>
          </span>
        </li>
      <?php else: ?>
        <li class="page-item">
          <a href="?page_id=<?php echo $n ?>" class="page-link text-dark"><?php echo $n ?></a>
        </li>
      <?php endif ?>
    <?php endfor ?>
    <?php if($now != $pages): ?>
      <li class="page-item">
        <a href="?page_id=<?php echo $now+1 ?>" class="page-link text-dark">&raquo;</a>
      </li>
    <?php else: ?>
      <li class="page-item disabled">
        <span href="?page_id=<?php echo $now+1 ?>" class="page-link">&raquo;</span>
      </li>
    <?php endif ?>
  </ul>
</nav>