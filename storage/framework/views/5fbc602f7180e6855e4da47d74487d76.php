
<?php $__env->startSection('content'); ?>
<h2><?php echo e($post->title); ?></h2>
<article><?php echo e($post->content); ?></article>
<a style="margin-top: 30px;" href="<?php echo e(route('posts.index')); ?>" class="btn btn-secondary">Back</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\blog\resources\views/posts/show.blade.php ENDPATH**/ ?>