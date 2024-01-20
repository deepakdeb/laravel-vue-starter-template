<?php $__env->startSection('content'); ?>
<?php if(auth()->guard()->guest()): ?>
<div class="container h-100 px-0 login-container">
    <div class="row justify-content-center h-100 no-margin">
        <div class="col-md-4 login-left d-flex align-items-center h-100">
            <div class="login-inner-wrapper">
                <div class="logo-area">
                    <span>Smarter HR</span>
                </div>
                <div class="logo-content-area">
                    <p>A comprehensive cloud based Saas software for Bangladesh capable of carrying out all your HR and payroll processing functions at one place</p>
                    <p>Go to <a class="" target="_blank" href="http://www.atlhr.com/">ATL HR</a> website</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 login-right d-flex align-items-center h-100">
            <div class="users-style">
                <p class="text-center mb-5" style="color: #001C38; font-weight: 700;"><?php echo e(__('Reset Password')); ?></p>

                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('password.email')); ?>">
                    <?php echo csrf_field(); ?>
                    <p class="" style="font-size: 16px; color: rgba(0, 28, 56, 1); margin-bottom: 20px;">Please enter your account email in the box below to get the password reset link.</p>
                    <div class="form-group row no-margin">
                        <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                        <div class="col-md-12 px-0">
                            <input id="email" type="email" placeholder="Email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-0 no-margin">
                        <div class="col-md-12 px-0">
                            <button type="submit" class="btn btn-primary login-btn w-100">
                                <?php echo e(__('Send Password Reset Link')); ?>

                            </button>
                        </div>
                    </div>
                </form>
                <div class="signup-link-container clearfix">
                    <a class="btn btn-link float-right forget-pass-link mt-3 p-0" href="<?php echo e(url('/')); ?>/login">
                        Go Back to Login Page
                    </a>                                   
                </div>
            </div>
        </div>
    </div>
    <div class="social-icons">
        <ul class="p-0 m-0">
            <li class="mr-2"><a target="_blank" href="https://www.facebook.com/atlhrbd"><b-icon icon="facebook" font-scale="3" style="color: #fff;"></b-icon></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/company/atlhr/"><b-icon icon="linkedin" font-scale="3" style="color: #fff;"></b-icon></a></li>
        </ul>
    </div>
</div>
<?php else: ?>
    <script type="text/javascript">
        window.location = "<?php echo e(route('home')); ?>";//here double curly bracket
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/buildmaxshop/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>