

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: beige !important;
    }

    .card {
        transition: transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); 
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title a {
        transition: color 0.3s;
        color: #5e5e5e;
        text-decoration: none; /* odstrani underline */
    }

    .card:hover .card-title a {
        color: #e89443;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
        list-style-type: none;
    }

    .pagination .page-link {
        display: inline-block;
        padding: 10px 16px;
        font-size: 16px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #e89443;
    }

    .pagination .page-item.active .page-link {
        background-color: #e89443;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
        background-color: #f2f2f2;
    }
</style>

<div id="content-books">

<div class="d-flex justify-content-center">
        <div class="pagination" id="pages">
            <ul class="pagination">
                <li class="page-item<?php echo e(($members->currentPage() === 1) ? ' disabled' : ''); ?>">
                    <a class="page-link" href="<?php echo e($members->previousPageUrl()); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <?php
                $currentPage = $members->currentPage();
                $lastPage = $members->lastPage();
                $range = 2; // Number of pages to show before and after the current page
                $startPage = max($currentPage - $range, 1);
                $endPage = min($currentPage + $range, $lastPage);
                ?>

                <?php if($startPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($members->url(1)); ?>">1</a>
                </li>
                <?php if($startPage > 2): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>
                <?php endif; ?>

                <?php $__currentLoopData = $members->getUrlRange($startPage, $endPage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="page-item<?php echo e(($members->currentPage() === $page) ? ' active' : ''); ?>">
                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($endPage < $lastPage): ?>
                <?php if($endPage < ($lastPage - 1)): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($members->url($lastPage)); ?>"><?php echo e($lastPage); ?></a>
                </li>
                <?php endif; ?>

                <li class="page-item<?php echo e(($members->currentPage() === $members->lastPage()) ? ' disabled' : ''); ?>">
                    <a class="page-link" href="<?php echo e($members->nextPageUrl()); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <br>

<div class="container">
        <div class="form-control" style="position: relative;">
            <div class="input-group" style="display: flex; align-items: stretch;">
                <input type="text" id="search" placeholder="Search" style="flex-grow: 1; padding: 10px; border: 1px solid #ccc; border-right: none; outline: none;">
                <select class="custom-select" id="selectType" style="border: 1px solid #ccc; border-left: none; padding: 10px; width: auto; outline: none;">
                    <option selected>Išči po</option>
                    <option value="Naslov">Imenu knjige</option>
                    <option value="Zbornik_st">Številki zbornika</option>
                </select>
                <button class="btn btn-primary" style="border: 1px solid #ccc; padding: 10px; margin-left: 5px;" id="searchButton">Iskanje</button>
            </div>
        </div>
        <div class="clearData mt-3" style="align-items: center">
            <button class="btn btn-secondary" style="margin-left: 5px;display: none" id="clearButton">Briši filter</button>
        </div>
    </div>
   
    <br>
    <br>
    <div class="container">
        <div class="row" id="membersContainer">
            <!-- Members will be dynamically populated here -->
        </div>
    </div>
    <div class="container" id="container_maincard">
        <div class="row">
            <?php $__currentLoopData = $members->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4">
            <a href="knjiga/<?php echo e($item['id']); ?>">
                <div class="card text-center">
                    <?php if(isset($item['attributes']['Slika_platnice']['data']['attributes']['url'])): ?>
                    <img src="<?php echo e(config('likusConfig.likus_api_urlMain')); ?><?php echo e($item['attributes']['Slika_platnice']['data']['attributes']['url']); ?>" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important">
                    <?php else: ?>
                    <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3 card-img" style="height:300px !important">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="knjiga/<?php echo e($item['id']); ?>">
                                <?php echo e($item['attributes']['Naslov']); ?> (<?php echo e($item['attributes']['Leto']); ?>) <br />
                                Zbornik: <?php echo e($item['attributes']['Zbornik_st']); ?>

                            </a>
                        </h5>
                    </div>
                </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<script>
function generateMemberCards(responseData) {
  var members = responseData.data;
  var container = document.getElementById("membersContainer");
  container.innerHTML = "";

  if (!Array.isArray(members)) {
    console.log("Invalid data format received");
    console.log(members);
    return;
  }

  members.forEach(function(member) {
    var item = member.attributes;

    if (!item) {
      console.error('Member does not have attributes:', member);
      return;
    }

    var col = document.createElement("div");
    col.className = "col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4";

    var card = document.createElement("div");
    card.className = "card text-center";
    card.onclick = function() {
      location.href = "knjiga/" + member.id;
    };

    var img = document.createElement("img");
    img.className = "card-img-top mx-auto d-block mt-3 card-img";
    img.style.height = "300px";

    var profileImageUrl = "https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg";

    if (
      item.Slika_platnice &&
      item.Slika_platnice.data &&
      item.Slika_platnice.data.attributes &&
      item.Slika_platnice.data.attributes.url
    ) {
      profileImageUrl = "<?php echo e(config('likusConfig.likus_api_urlMain')); ?>" + item.Slika_platnice.data.attributes.url;
    }

    img.src = profileImageUrl;
    card.appendChild(img);

    var cardBody = document.createElement("div");
    cardBody.className = "card-body";

    var cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    var cardTitleLink = document.createElement("a");
    cardTitleLink.href = "knjiga/" + member.id;
    cardTitleLink.innerHTML = item.Naslov+" ("+item.Leto+")" + "<br>Zbornik: " + item.Zbornik_st;

    cardTitle.appendChild(cardTitleLink);
    cardBody.appendChild(cardTitle);
    card.appendChild(cardBody);
    col.appendChild(card);
    container.appendChild(col);
  });

  document.getElementById("container_maincard").style.display = "none";
  document.getElementById("pages").style.display = "none";
  document.getElementById("clearButton").style.display = "block";
}

document.getElementById("clearButton").addEventListener("click", function () {
  document.getElementById("search").value = "";
  document.getElementById("membersContainer").innerHTML = "";
  document.getElementById("pages").style.display = "block";
  document.getElementById("clearButton").style.display = "none";
  document.getElementById("container_maincard").style.display = "block";
});

function fetchMembers() {
  var search = document.getElementById("search").value;
  var selectType = document.getElementById("selectType").value;
  if (search && selectType) {
    fetch(`<?php echo e(config('likusConfig.likus_api_url')); ?>/knjige?filters[${selectType}][$contains]=${search}&populate=*`)
      .then(response => {
        if (!response.ok) {
          alert('Prosim izberite tip iskanja!');
        }
        return response.json();
      })
      .then(data => {
        generateMemberCards(data);
      })
      .catch(error => {
        console.log(error);
      });
  } else {
    alert('Prosim vpišite znake za iskanje!');
  }
}

document.getElementById("searchButton").addEventListener("click", fetchMembers);
</script>


<br>
<br>
<br>
<br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\resources\views/books.blade.php ENDPATH**/ ?>