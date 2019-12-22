<?php $__env->startSection('htmlheader_title'); ?>
Comprobante
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
Comprobante de venta
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
<!-- Css Extras -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid spark-screen">
    <div class="row">
        
        <div class="col-xs-12 col-md-4">
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>