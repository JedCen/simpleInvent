
<div class="card">
    <div class="card-header <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> bg-secondary text-white <?php endif; ?>">
        <div class="float-left"> 
            <strong>
                <span class="fa fa-th"></span>
                <span><?php echo e(trans('inventario.newaddproduc')); ?></span>
            </strong>
        </div>
    </div>
    <div class="card-body">
            <div class="list-group"> 
                <?php $__currentLoopData = $product5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="list-group-item list-group-item-action" href="<?php echo e(route('producto.edit', $produc->id)); ?> ">
                            
                            <?php if(!isset($produc->image)): ?> <img class="image-prod rounded-circle" src="<?php echo e(asset('img/default-150x150.png')); ?>"> <?php else: ?> <img class="image-prod rounded-circle float-left" src="<?php echo e($produc->image); ?>" alt="<?php echo e($produc->name); ?>" /> <?php endif; ?>
                                <small class="badge badge-warning badge-pill float-right">
                                <?php echo e($simbol); ?> <?php echo e($produc->price_out); ?>

                                </small>
                            
                            <hr>
                            <?php echo e($produc->name); ?>

                            <span class="text-muted float-right">
                            <?php echo e($produc->category->name); ?>

                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
    </div>
</div>
