<?php $__env->startSection('title'); ?>
<?php echo e(__("Medicines")); ?> | <?php echo e(__("Admin Dashboard")); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="main-content">
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?php echo e(__("Medicines")); ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e(__('System Name')); ?> / </a></li>
                            <li class="active"> <?php echo e(__("Medicines")); ?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php if(Session::has('message')): ?>
            <div class="col-sm-12">
                <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert">
                    <i class="uil uil-check me-2"></i>
                    <?php echo e(Session::get('message')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
         <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div>
                                <a href="<?php echo e(url('admin/medicinesadd')); ?>" type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="fas fa-user-plus"></i>Add Medicines</a> 
                            </div>

                            <div class="table-responsive mb-4">
                               <table class="table table-centered datatable dt-responsive nowrap table-card-list" id="medicine" style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                        <tr>

                                            <th style="width: 120px;"><?php echo e(__("ID")); ?> </th>
                                            <th>name</th>
                                            <th>Dosage</th>
                                            <th>Description</th>
                                            <th>Medicine Type</th>
                                            <th style="width: 120px;"><?php echo e(__("Action")); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-reset  fw-bold"><?php echo e($user->id); ?></a> </td>

                                            
                                            <td>
                                                <span><?php echo e($user->name); ?></span>
                                            </td>
                                            <td><?php echo e($user->dosage); ?></td>
                                            <td><?php echo e($user->description); ?></td>
                                            <td><?php echo e($user->medicine_type); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('editmedicines', $user->id)); ?>" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                
                                                <a href="<?php echo e(route('deletemedicines', $user->id)); ?>" class="px-3 px-3 text-danger"><i class="uil uil-trash-alt font-size-18">
                                                        </i></a>
                                            </td>
                                           
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div
</div>

 


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/medicines/default.blade.php ENDPATH**/ ?>