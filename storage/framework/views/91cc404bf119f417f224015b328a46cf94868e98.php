<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get($title); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $base_currency = config('basic.currency_symbol');
    ?>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('Property'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Investment Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Invested User'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Total Invested Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $investments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('Property'); ?>">
                                <a href="<?php echo e(route('propertyDetails',[@slug(optional($invest->property->details)->property_title), optional($invest->property)->id])); ?>"
                                   target="_blank">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="<?php echo e(getFile(config('location.propertyThumbnail.path').optional($invest->property)->thumbnail)); ?>"
                                                alt="<?php echo app('translator')->get('property_thumbnail'); ?>" class="rounded-circle" width="45"
                                                height="45">
                                        </div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                <?php echo app('translator')->get(\Illuminate\Support\Str::limit(optional($invest->property->details)->property_title, 30)); ?>
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Expire time'); ?>">
                                <?php echo e(optional($invest->property)->investmentAmount); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Invested User'); ?>">
                                <a href="<?php echo e(route('admin.seeInvestedUser',['property_id' => optional($invest->property)->id, 'type' => 'running'])); ?>">
                                    <span
                                        class="custom-badge bg-success badge-pill"><?php echo e(optional($invest->property)->totalRunningInvestUserAndAmount()['totalInvestedUser']); ?></span></a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Invested Amount'); ?>">
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e(optional($invest->property)->totalRunningInvestUserAndAmount()['totalInvestedAmount']); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <a href="<?php echo e(route('admin.seeInvestedUser', ['property_id' => optional($invest->property)->id, 'type' => 'running'])); ?>"
                                   class="btn btn-sm btn-outline-primary btn-rounded btn-rounded edit-button">
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="100%" class="text-center text-na"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script>
        "use strict";
        $(document).on('change', '#disbursement_type', function () {

            var isCheck = $(this).prop('checked');
            let dataId = $(this).data('id');
            let isVal = null;
            if (isCheck == true) {
                isVal = 'on'
            } else {
                isVal = 'off';
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.disbursementType')); ?>",
                type: "POST",
                data: {
                    dataid: dataId,
                    isval: isVal,
                },
                success: function (data) {
                },
            });
        });

    </script>

    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_custom\cc\resources\views/admin/property/runningInvestmentList.blade.php ENDPATH**/ ?>