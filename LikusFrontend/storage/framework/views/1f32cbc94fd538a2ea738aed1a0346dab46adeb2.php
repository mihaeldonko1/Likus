
<?php $__env->startSection('content'); ?>

<style>
    body {
        background-color: beige;
    }

    .card {
        transition: transform 0.3s;
        cursor: pointer;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title a {
        transition: color 0.3s;
        color: #5e5e5e;
        text-decoration: none;
    }

    .card:hover .card-title a {
        color: #6ca7cc;
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
        background-color: #6ca7cc;
    }

    .pagination .page-item.active .page-link {
        background-color: #6ca7cc;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
        background-color: #f2f2f2;
    }
</style>

<div id="loader" style="background-color: beige;">
    <h1 id="loader-text" style="font-size: 32px; font-family: 'Lato', sans-serif;">Dobrodošli v spletni čitalnici Likusa</h1>
</div>

<div id="content" style="display: none;">
    <div class="d-flex justify-content-center">
        <div class="pagination">
        
        </div>
    </div>

    <br>
    <br>
    <?php 
        $user = get_user_by_id(user_id()); 
        print_r($user);
     ?>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $members->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4">
                    <div class="card text-center" onclick="location.href='clan/<?php echo e($item['id']); ?>';">
                        <?php if(isset($item['attributes']['Profilna_slika']['data'][0]['attributes']['url'])): ?>
                            <img src="http://localhost:1337<?php echo e($item['attributes']['Profilna_slika']['data']['attributes']['url']); ?>" class="card-img-top mx-auto d-block mt-3 card-img">
                        <?php else: ?>
                            <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3 card-img">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="clan/<?php echo e($item['id']); ?>">
                                    <?php echo e($item['attributes']['Ime']); ?> <br /> <?php echo e($item['attributes']['Priimek']); ?>

                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function () {
        if (window.location.href === "http://127.0.0.1:8000/clani") {
            const loaderText = document.getElementById("loader-text");
            const textContent = loaderText.textContent;
            loaderText.textContent = "";
            let counter = 0;
            const timer = setInterval(function () {
                loaderText.textContent += textContent[counter];
                counter++;
                if (counter >= textContent.length) {
                    clearInterval(timer);
                    setTimeout(function () { 
                        document.getElementById("loader").style.display = "none";
                        document.getElementById("content").style.display = "block";
                    }, 1500); 
                }
            }, 50); 
        } else {
            document.getElementById("loader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Praktikum3\Likus\LikusFrontend\resources\views/members.blade.php ENDPATH**/ ?>