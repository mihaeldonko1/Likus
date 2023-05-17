<?php print_r($data); ?>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informacije o članu</h5>
                <dl class="row">
                    <dt class="col-sm-3">Ime</dt>
                    <dd class="col-sm-9"><?php echo e($data['data']['attributes']['Ime']); ?></dd>
                    <dt class="col-sm-3">Priimek</dt>
                    <dd class="col-sm-9"><?php echo e($data['data']['attributes']['Priimek']); ?></dd>
                    <dt class="col-sm-3">Spol</dt>
                    <dd class="col-sm-9"><?php echo e($data['data']['attributes']['Spol']); ?></dd>
                    <dt class="col-sm-3">Naslov</dt>
                    <dd class="col-sm-9"><?php echo e($data['data']['attributes']['Naslov']); ?></dd>
                </dl>
            </div>
        </div>
    </div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Likus\Likus\Frontend\resources\views/singlemember.blade.php ENDPATH**/ ?>