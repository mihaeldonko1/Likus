<?php echo $posts->scripts(); ?>


<section class="section container-fluid">
    <div class="row pt-5">
        <div class="col-lg-3">
            <div class="card border-0 text-dark bg-white">

                <?php echo $posts->filtersActive(); ?>


                <?php echo $posts->search(); ?>


                <?php echo $posts->categories(); ?>


                <?php echo $posts->tags(); ?>


                <?php echo $posts->filters(); ?>


             </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-xl-6 col-lg-5 col-lg-7 col-lg-2 col-lg-5 py-lg-0 py-4">
                    <p> <?php _e("Displaying"); ?> <?php echo e($posts->count()); ?> <?php _e("of"); ?> <?php echo e($posts->total()); ?>  <?php _e("result(s)"); ?>.</p>
                </div>
                <div class="col-xl-6 col-lg-7 col-lg-5 d-block d-sm-flex justify-content-end ms-auto">
                    <div class="col-md-6 col-12 col-sm px-1 ms-auto"><?php echo $posts->limit(); ?></div>
                    <div class="col-md-6 col-12 col-sm px-1 ms-auto"><?php echo $posts->sort(); ?></div>
                </div>
            </div>
            <div class="row">
            <?php $__currentLoopData = $posts->results(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-5">
                    <a href="<?php echo e(content_link($post->id)); ?>">

                        <?php
                        /*<img src="{{$post->thumbnail(800,500, true)}}" alt="">*/
                        ?>

                        <img src="<?php echo e(app()->content_repository->getThumbnail($post->id,800,500, true)); ?>" alt="">

                        <h4 class="mt-3"><?php echo e($post->title); ?></h4>
                    </a>
                    <p> <?php echo $post->shortDescription(220); ?></p>

                    <small><?php echo e($post->created_at); ?></small>
                    

                    
                       
                    
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $posts->pagination(); ?>

        </div>
    </div>
</section>




<?php /**PATH C:\Users\Asus\OneDrive\Desktop\LIKUS_mapa\LikusProjekt_plus_Microweber\Likus\Likus\Frontend\src\MicroweberPackages\Blog\resources\views\/index.blade.php ENDPATH**/ ?>