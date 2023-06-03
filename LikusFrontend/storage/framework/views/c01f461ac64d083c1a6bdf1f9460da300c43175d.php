<?php
if (isset($data['data']['attributes']['Zivljenjepis']['data']) && $data['data']['attributes']['Zivljenjepis']['data'] != null) {
    $zivljenjepisId = $data['data']['attributes']['Zivljenjepis']['data'][0]['attributes']['url'];
} else {
    $zivljenjepisId = 0;
}
?>
<?php
    use Carbon\Carbon;
    $birthday = Carbon::createFromFormat('Y-m-d', $data['data']['attributes']['Rojstni_dan']);
    $currentDate = Carbon::now();
    $yearsDifference = $birthday->diffInYears($currentDate);
?>

<?php $__env->startSection('content'); ?>

<style>
    body {
        background-color: beige !important;
    }
    .custom-title {
        color:  #e89443;
        text-align: center;
        font-size: 30px;
    }

    .btn-close {
        font-size: 24px;
        padding: 10px 15px;
        background-color: #c24a64; 
        color: #fff; 
        border: none; 
    }

    .btn {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    background-color: #e89443;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn:hover .button-hover {
    opacity: 1;
    background-color: #fff;
}

.button-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    background-color: #fff;
    transition: opacity 0.3s;
    z-index: -1;
}

.button-text {
    position: relative;
    z-index: 1;
}

h1, h3 {
color: #e89443;
} 

</style>


<br>


<div class="container mt-4">
    <div class="row text-center mb-5">
      <h1 style="font-size: 3.5em;">Informacije o članu:</h1>
    </div>

    <div class="row">


    <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center align-items-center">
                    <?php if(isset($data['data']['attributes']['Profilna_slika']['data']['attributes']['url'])): ?>
                        <img src="http://localhost:1337<?php echo e($data['data']['attributes']['Profilna_slika']['data']['attributes']['url']); ?>" style="width: 80%;">
                    <?php else: ?>
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="width: 80%;">
                    <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="row">
                        <span style="font-size: 2.0em;"><?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></span><br>
                        <span style="font-size: 1.2em;">Datum rojstva: <?php echo e(date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan']))); ?></span>
                        <span style="font-size: 1.2em;">Spol: <?php echo e($data['data']['attributes']['Spol']); ?></span><br>
                        <span style="font-size: 1.2em;">Starost: <?php echo e($yearsDifference); ?></span><br>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-7">
     <?php if(isset($data['data']['attributes']['Zivljenjepis']['data'])): ?>
        <div class="col-md-12">
            <div class="rounded p-3" style="background-color: white">
                <h3>Življenjepis <?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></h3>
                <div id="outputZivljenjepis"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    </div>
    <?php if(isset($data['data']['attributes']['Rokopis']['data'])): ?>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Rokopis:</h1>
            <br>
            <div id="rokopisContainer">
                <img src="http://localhost:1337<?php echo e($data['data']['attributes']['Rokopis']['data'][0]['attributes']['url']); ?>" style="width: 50%;">
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <hr>
    <?php endif; ?>
    <?php if(isset($data['data']['attributes']['clanki']['data'][0])): ?>
        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                <div class="modal-header" style="display: flex; justify-content: center; align-items: center;">
                    <h5 class="modal-title custom-title" id="exampleModalLabel">
                        <?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?><br />
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="container-bookify">
                            <div class="book-body">
                                <button class="button-book" id="prev-btn">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </button>
                                <div id="book" class="book"></div>
                                <button class="button-book" id="next-btn">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <br>
                <h1>Članki:</h1>
                <br>
                <br>
            </div>
            <?php $__currentLoopData = $data['data']['attributes']['clanki']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <h5 class="card-title">Identifikacijska št. članka:<?php echo e($val['id']); ?></h5>
                        <p class="card-text">Letnica knjige: <?php echo e($val['attributes']['Letnica_zbornika']); ?></p>
                        <p class="card-text">Številka knjige: <?php echo e($val['attributes']['Stevilka_knjige']); ?></p>
                        <p class="card-text">Strani v knjigi: <?php echo e($val['attributes']['Strani_od']); ?>-<?php echo e($val['attributes']['Strani_do']); ?></p>
                        <button data-book="<?php echo e($val['id']); ?>" class="btn btn-primary bookLoader" data-bs-toggle="modal" data-bs-target="#bookModal">
                        <span class="button-text">Preberi članek</span>
                        <span class="button-hover"></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if(isset($data['data']['attributes']['Dodatni_clanki']['data'])): ?>
    <hr>
    <div class="row">
    <h3>Dodatne objave člana</h3>
        <?php $__currentLoopData = $data['data']['attributes']['Dodatni_clanki']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
                <div class="card d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                        <p class="card-text">Ime članka: <br /> <?php echo e(str_replace('.pdf', '', $val['attributes']['name'])); ?></p>
                        <a class="btn btn-primary" href="http://localhost:1337<?php echo e($val['attributes']['url']); ?>" target="_blank">Preberi več</a>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>  
    <?php endif; ?>
    </div>

<script src="../resources/js/main.js"></script>
<script src="../resources/js/bookifyPDF.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    var defaultContent = $('.container-bookify').html();

    $(".bookLoader").click(function() {
    $('.container-bookify').html(defaultContent);
    var bookValue = $(this).data("book");
    fetch(`http://localhost:1337/api/clanki/${bookValue}?populate=*`)
        .then(response => response.json())
        .then(data => {
            let uri = data.data.attributes.Clanek.data.attributes.url;
            let url = "http://localhost:1337"+uri;        
            readPDFasBook(url,"prev-btn","next-btn","book",1);
        })
        .catch(error => {
            console.error(error);
        });
    });

    let zivljenjepisId = "http://localhost:1337<?php echo $zivljenjepisId; ?>";
    if (zivljenjepisId!=0) {
        odtConverter(zivljenjepisId);
    } else {
        document.getElementById('outputZivljenjepis').textContent = "Član žal še ni objavil svojega življenjepisa";
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Miha\Desktop\Praktikum2\Likus\LikusFrontend\resources\views/singlemember.blade.php ENDPATH**/ ?>