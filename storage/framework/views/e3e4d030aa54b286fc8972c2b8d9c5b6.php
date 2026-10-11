
<?php $__env->startSection('content'); ?>
<h2>User's Dashboard</h2>
<p>Hello <?php echo e($user?->name); ?>!</p>
<p>Email: <?php echo e($user?->email); ?> </p>
<p> Birthday: <?php echo e($user?->birthdate); ?></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\blog\resources\views/dashboard.blade.php ENDPATH**/ ?>