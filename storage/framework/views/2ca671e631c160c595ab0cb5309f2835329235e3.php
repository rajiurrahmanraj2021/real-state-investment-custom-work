<?php $__env->startSection('title',trans($title)); ?>
<?php $__env->startSection('content'); ?>

    <?php $__env->startPush('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap-datepicker.css')); ?>" />
    <?php $__env->stopPush(); ?>

<section class="transaction-history">
    <div class="container-fluid">
        <div class="row mt-4 mb-2">
            <div class="col ms-2">
                <div class="header-text-full">
                    <h3 class="dashboard_breadcurmb_heading mb-1"><?php echo app('translator')->get('Referral Bonus'); ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e(trans($title)); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row justify-content-between g-4 mb-4">
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 box">
                <div class="dashboard-box">
                    <h5><?php echo app('translator')->get('Total Bonus'); ?></h5>
                    <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e($totalReferralTransaction['total_referral_bonous']); ?></span></h3>
                    <i class="far fa-funnel-dollar text-success " aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 box">
                <div class="dashboard-box">
                    <h5><?php echo app('translator')->get('Joining Bonus'); ?></h5>
                    <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(array_key_exists("joining_bonus",$totalReferralTransaction) ? $totalReferralTransaction['joining_bonus'] : 0); ?></span></h3>
                    <i class="far fa-sack-dollar text-info" aria-hidden="true"></i>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 box">
                <div class="dashboard-box">
                    <h5><?php echo app('translator')->get('Deposit Bonus'); ?></h5>
                    <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(array_key_exists("deposit",$totalReferralTransaction) ? $totalReferralTransaction['deposit'] : 0); ?></span></h3>
                    <i class="fal fa-usd-circle text-warning" aria-hidden="true"></i>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 box">
                <div class="dashboard-box">
                    <h5><?php echo app('translator')->get('Invest Bonus'); ?></h5>
                    <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(array_key_exists("invest",$totalReferralTransaction) ? $totalReferralTransaction['invest'] : 0); ?></span></h3>
                    <i class="far fa-badge-dollar text-orange" aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 box">
                <div class="dashboard-box">
                    <h5><?php echo app('translator')->get('Profit Bonus'); ?></h5>
                    <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(array_key_exists("profit_commission",$totalReferralTransaction) ? $totalReferralTransaction['profit_commission'] : 0); ?></span></h3>
                    <i class="far fa-sack-dollar text-info" aria-hidden="true"></i>
                </div>
            </div>

        </div>

        <!-- search area -->
        <div class="search-bar mt-4 p-0">
            <form action="<?php echo e(route('user.referral.bonus.search')); ?>" method="get">
                <div class="row g-3 align-items-end">
                    <div class="input-box col-lg-2">
                        <input
                            type="text"
                            name="search_user"
                            value="<?php echo e(@request()->search_user); ?>"
                            class="form-control"
                            placeholder="<?php echo app('translator')->get('Search User'); ?>"/>
                    </div>

                    <div class="input-box col-lg-2">
                        <input
                            type="text"
                            name="type"
                            value="<?php echo e(@request()->type); ?>"
                            class="form-control"
                            placeholder="<?php echo app('translator')->get('Bonus Type'); ?>"/>
                    </div>

                    <div class="input-box col-lg-2">
                        <input
                            type="text"
                            name="remark"
                            value="<?php echo e(@request()->remark); ?>"
                            class="form-control"
                            placeholder="<?php echo app('translator')->get('Remark'); ?>"/>
                    </div>

                    <div class="input-box col-lg-2">
                        <input
                            type="text" class="form-control datepicker from_date" name="from_date" value="<?php echo e(old('from_date',request()->from_date)); ?>" placeholder="<?php echo app('translator')->get('From date'); ?>" autocomplete="off" readonly/>
                    </div>

                    <div class="input-box col-lg-2">
                        <input
                            type="text" class="form-control datepicker to_date" name="to_date" value="<?php echo e(old('to_date',request()->to_date)); ?>" placeholder="<?php echo app('translator')->get('To date'); ?>" autocomplete="off" readonly disabled="true"/>
                    </div>

                    <div class="input-box col-lg-2">
                        <button class="btn-custom w-100" type="submit"><i class="fal fa-search"></i> <?php echo app('translator')->get('Search'); ?> </button>
                    </div>
                </div>
            </form>
        </div>

       <div class="row mt-4">
          <div class="col">
             <div class="table-parent table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('SL No.'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Bonus From'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Remarks'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Bonus Type'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e(loopIndex($transactions) + $loop->index); ?></td>
                                <td data-label="<?php echo app('translator')->get('Bonus From'); ?>"><?php echo e(optional(@$transaction->bonusBy)->fullname); ?></td>
                                <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                    <span class="font-weight-bold text-success"><?php echo e(getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))); ?></span>
                                </td>
                                <td data-label="<?php echo app('translator')->get('Remarks'); ?>"><span><?php echo app('translator')->get($transaction->remarks); ?></span></td>
                                <td data-label="<?php echo app('translator')->get('Bonus Type'); ?>"><span><?php echo app('translator')->get($transaction->type); ?></span></td>
                                <td data-label="<?php echo app('translator')->get('Time'); ?>"><?php echo e(dateTime($transaction->created_at, 'd M Y h:i A')); ?></td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr class="text-center">
                                <td colspan="100%"><?php echo e(__('No Data Found!')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?php echo e($transactions->appends($_GET)->links($theme.'partials.pagination')); ?>


             </div>
          </div>
       </div>
    </div>
 </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/bootstrap-datepicker.js')); ?>"></script>

    <script>
        'use strict'
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({
                autoclose: true,
                clearBtn: true
            });

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_custom\cc\resources\views/themes/original/user/transaction/referral-bonus.blade.php ENDPATH**/ ?>