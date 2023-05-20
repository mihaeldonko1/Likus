<?php
if (isset($data['data']['attributes']['Zivljenjepis']['data']) && $data['data']['attributes']['Zivljenjepis']['data'] != null) {
    $zivljenjepisId = $data['data']['attributes']['Zivljenjepis']['data'][0]['attributes']['url'];
} else {
    $zivljenjepisId = 0;
}
?>

<div class="container mt-4">
    <div class="row">
        <h5>Informacije o članu</h5>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <?php if(isset($data['data']['attributes']['Profilna_slika']['data'][0]['attributes']['url'])): ?>
                <img src="http://localhost:1337<?php echo e($data['data']['attributes']['Profilna_slika']['data'][0]['attributes']['url']); ?>">
                <?php else: ?>
                <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="transform: scale(0.5);">
                <?php endif; ?>
            </div>
            <div class="row">
                <span><?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></span><br>
                <span>Spol: <?php echo e($data['data']['attributes']['Spol']); ?></span>
                <span>Datum rojstva: <?php echo e(date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan']))); ?></span>
            </div>
        </div>
        <?php if(isset($data['data']['attributes']['Zivljenjepis']['data'])): ?>
        <div class="col-md-8">
            <h5>Življenjepis <?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></h5>
            <div id="outputZivljenjepis"></div>
        </div>
        <?php endif; ?>
    </div>
    <?php if(isset($data['data']['attributes']['Rokopis']['data'])): ?>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Rokopis</h3>
            <div id="rokopisContainer">
                <img src="http://localhost:1337<?php echo e($data['data']['attributes']['Rokopis']['data'][0]['attributes']['url']); ?>" style="width: 50%;">
            </div>
        </div>
    </div>
    <hr>
    <?php endif; ?>
    <?php if(isset($data['data']['attributes']['clanki']['data'][0])): ?>
        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
            <div class="col-md-12">
                <h3>Članki</h3>
            </div>
            <?php $__currentLoopData = $data['data']['attributes']['clanki']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Identifikacijska št. članka:<?php echo e($val['id']); ?></h5>
                        <p class="card-text">Letnica knjige: <?php echo e($val['attributes']['Letnica_zbornika']); ?></p>
                        <p class="card-text">Številka knjige: <?php echo e($val['attributes']['Stevilka_knjige']); ?></p>
                        <p class="card-text">Strani v knjigi: <?php echo e($val['attributes']['Strani_od_do']); ?></p>
                        <button data-book="<?php echo e($val['id']); ?>" class="btn btn-primary bookLoader" data-bs-toggle="modal" data-bs-target="#bookModal">Preberi članek</button>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

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


<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Likus\Likus\Frontend\resources\views/singlemember.blade.php ENDPATH**/ ?>