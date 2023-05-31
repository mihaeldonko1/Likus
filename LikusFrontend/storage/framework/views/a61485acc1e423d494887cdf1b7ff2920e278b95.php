

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: beige !important;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .platnica-container {
        text-align: center;
    }

    .opis-knjige {
        text-align: justify;
    }

    .custom-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #6ca7cc;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #4f81a1;;
    color: #fff; 
    
}

</style>

<div class="container">
    <div class="row">
        <div class="col-md-4 platnica-container">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url'])): ?>
                        <img src="http://localhost:1337<?php echo e($item['attributes']['Slika_platnice']['data'][0]['attributes']['url']); ?>" class="card-img-top mx-auto d-block mt-3">
                    <?php else: ?>
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3">
                    <?php endif; ?>
                </div>
            
                <div class="col-md-12">
                    <span>Naslov: <?php echo e($data['data']['attributes']['Naslov']); ?></span><br />
                    <span>Letnica izdaje: <?php echo e($data['data']['attributes']['Leto']); ?></span><br />
                    <span>Številka zbornika: <?php echo e($data['data']['attributes']['Zbornik_st']); ?></span><br />
                    <span>Urednik: <?php echo e($data['data']['attributes']['Urednik']); ?></span><br />
                    <br>
                    <a href="/preberi/<?php echo e($data['data']['attributes']['Stevilka_knjige']); ?>" class="custom-button">Začni z branjem</a>


                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo e($data['data']['attributes']['Naslov']); ?> (<?php echo e($data['data']['attributes']['Leto']); ?>)</h1>
                    <hr>
                </div>
                <?php if(isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url'])): ?>
                    <div class="col-md-12">
                        <h5>Opis knjige</h5>
                        <div class="opis-knjige">
                            <?php echo e($data['data']['attributes']['Opis_knjige']); ?>

                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-md-12">
                        <h5>Opis knjige</h5>
                        <div class="opis-knjige">
                            <h6>Žal trenutno ni opisa za izbrano knjigo v spletni čitalnici Likus-a.</h6>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\LikusFrontend\resources\views/singlebook.blade.php ENDPATH**/ ?>