<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->startSection(config('LaravelLogger.bladePlacementCss')); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->startPush(config('LaravelLogger.bladePlacementCss')); ?>
<?php endif; ?>

        <?php echo $__env->make('LaravelLogger::partials.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->stopSection(); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->startSection(config('LaravelLogger.bladePlacementJs')); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->startPush(config('LaravelLogger.bladePlacementJs')); ?>
<?php endif; ?>

        <?php echo $__env->make('LaravelLogger::partials.scripts', ['activities' => $activities], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('LaravelLogger::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('LaravelLogger::scripts.confirm-modal', ['formTrigger' => '#confirmRestore'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if(config('LaravelLogger.enableDrillDown')): ?>
            <?php echo $__env->make('LaravelLogger::scripts.clickable-row', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('LaravelLogger::scripts.tooltip', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->stopSection(); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>


<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('LaravelLogger::laravel-logger.dashboardCleared.title')); ?>

<?php $__env->stopSection(); ?>

<?php
    switch (config('LaravelLogger.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('LaravelLogger.bootstrapCardClasses')) ? '' : config('LaravelLogger.bootstrapCardClasses'));
?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <?php if(config('LaravelLogger.enablePackageFlashMessageBlade')): ?>
            <?php echo $__env->make('LaravelLogger::partials.form-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="<?php echo e($containerClass); ?> <?php echo e($bootstrapCardClasses); ?>">
                    <div class="<?php echo e($containerHeaderClass); ?>">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>
                                <?php echo trans('LaravelLogger::laravel-logger.dashboardCleared.title'); ?>

                                <sup class="label">
                                    <?php echo e($totalActivities); ?> <?php echo trans('LaravelLogger::laravel-logger.dashboardCleared.subtitle'); ?>

                                </sup>
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        <?php echo trans('LaravelLogger::laravel-logger.dashboard.menu.alt'); ?>

                                    </span>
                                </button>
                                <?php if(config('LaravelLogger.bootstapVersion') == '4'): ?>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?php echo e(route('activity')); ?>" class="dropdown-item">
                                            <span class="text-primary">
                                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                                <?php echo trans('LaravelLogger::laravel-logger.dashboard.menu.back'); ?>

                                            </span>
                                        </a>
                                        <?php if($totalActivities): ?>
                                            <?php echo $__env->make('LaravelLogger::forms.delete-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            <?php echo $__env->make('LaravelLogger::forms.restore-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo e(route('activity')); ?>">
                                                <span class="text-primary">
                                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                                    <?php echo trans('LaravelLogger::laravel-logger.dashboard.menu.back'); ?>

                                                </span>
                                            </a>
                                        </li>
                                        <?php if($totalActivities): ?>
                                            <li>
                                                <?php echo $__env->make('LaravelLogger::forms.delete-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </li>
                                            <li>
                                                <?php echo $__env->make('LaravelLogger::forms.restore-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo $__env->make('LaravelLogger::logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmRestore', 'modalClass' => 'success', 'actionBtnIcon' => 'fa-check'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(config('LaravelLogger.loggerBladeExtended'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>