
<?php $__env->startSection('content'); ?>
<h2>All Posts</h2>
<p><a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary">+ Add new post</a></p>

<?php if($posts->isEmpty()): ?>
<p>No posts available yet</p>
<?php else: ?>
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card">
    <h3><?php echo e($post->title); ?></h3>
    <small>— <?php echo e($post->created_at->diffForHumans()); ?> </small>
    <p><?php echo e(Str::limit($post->content, 120)); ?></p>
    <div>
        <a href="<?php echo e(route('posts.show', $post)); ?>" class="btn btn-secondary">Show</a>
        <?php if(session('user_id') === $post->user_id): ?>
        <a href="<?php echo e(route('posts.edit', $post)); ?>" class="btn btn-primary">Edit</a>
        <form action="<?php echo e(route('posts.destroy', $post)); ?>" method="post" style="display:inline" onsubmit="return confirm('Are you sure you want to delete the post?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\blog\resources\views/posts/index.blade.php ENDPATH**/ ?>