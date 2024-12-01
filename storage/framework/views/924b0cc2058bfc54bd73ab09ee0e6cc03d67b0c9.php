<?php $__env->startSection('title'); ?>
<?php echo e(__('Privacy Policy')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:title" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:image" content="<?php echo e(asset('image_web/').'/'.$setting->favicon); ?>"/>
<meta property="og:image:width" content="250px"/>
<meta property="og:image:height" content="250px"/>
<meta property="og:site_name" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:description" content="<?php echo e(__('message.meta_description')); ?>"/>
<meta property="og:keyword" content="<?php echo e(__('message.Meta Keyword')); ?>"/>
<link rel="shortcut icon" href="<?php echo e(asset('image_web/').'/'.$setting->favicon); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <section class="page-title centred bg-color-1">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-70.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-71.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1><?php echo e(__('Privacy Policy')); ?></h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
                        <li><?php echo e(__('Privacy Policy')); ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="about-style-two">
            <div class="auto-container">
                <div class="row align-items-center clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_1">
                            <div class="content-box mr-50">
                                <div class="sec-title">
                                    <p>Privacy Policy</p>
                                    <h2>Bring care to your home with one click</h2>
                                </div>
                                <!--<div class="text">-->
                                <!--    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation ullamco laboris.</p>-->
                                <!--</div>-->
                                <!--<ul class="list-style-one clearfix">-->
                                <!--    <li>Associates Insurance</li>-->
                                <!--    <li>Pina & Insurance</li>-->
                                <!--</ul>-->

                                 <?php echo $data->privacy; ?>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_3">
                            <div class="image-box">
                                <div class="pattern">
                                    <div class="pattern-1" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-49.png')); ?>');"></div>
                                    <div class="pattern-2" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-50.png')); ?>');"></div>
                                    <div class="pattern-3"></div>
                                </div>
                                <figure class="image image-1 paroller"><img src="<?php echo e(asset('front_pro/assets/images/resource/about-4.jpg')); ?>" alt=""></figure>
                                <figure class="image image-2 paroller-2"><img src="<?php echo e(asset('front_pro/assets/images/resource/about-3.jpg')); ?>" alt=""></figure>
                                <div class="image-content">
                                    <figure class="icon-box"><img src="<?php echo e(asset('front_pro/assets/images/icons/icon-8.png')); ?>" alt=""></figure>
                                    <span>Appointment With</span>
                                    <h4>Specialist</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

     <section class="process-style-two bg-color-3 centred">
   <div class="pattern-layer">
      <div class="pattern-1" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-39.png')); ?>');"></div>
      <div class="pattern-2" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-40.png')); ?>');"></div>
      <div class="pattern-3" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-41.png')); ?>');"></div>
      <div class="pattern-4" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-42.png')); ?>');"></div>
   </div>
   <div class="auto-container">
      <div class="sec-title centred">
         <p><?php echo e(__('message.Process')); ?></p>
         <h2><?php echo e(__('message.Appointment Process')); ?></h2>
      </div>
      <div class="inner-content">
         <div class="arrow" style="background-image: url('<?php echo e(asset('front_pro/assets/images/icons/arrow-1.png')); ?>');"></div>
         <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
               <div class="processing-block-two">
                  <div class="inner-box">
                     <figure class="icon-box"><img src="<?php echo e(asset('image_web/').'/'.$setting->icon1); ?>" alt=""></figure>
                     <h3><?php echo e(__('message.Search Best Online Doctors')); ?></h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
               <div class="processing-block-two">
                  <div class="inner-box">
                     <figure class="icon-box"><img src="<?php echo e(asset('image_web/').'/'.$setting->icon2); ?>" alt=""></figure>
                     <h3><?php echo e(__('message.View Doctor Profile')); ?></h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
               <div class="processing-block-two">
                  <div class="inner-box">
                     <figure class="icon-box"><img src="<?php echo e(asset('image_web/').'/'.$setting->icon3); ?>" alt=""></figure>
                     <h3><?php echo e(__('message.Get Instant Doctor Appoinment')); ?></h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

        <section class="faq-section pt-125">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_4">
                            <div class="image-box">
                                <div class="pattern" style="background-image: url('<?php echo e(asset('front_pro/assets/images/shape/shape-54.png')); ?>');"></div>
                                <figure class="image"><img src="<?php echo e(asset('front_pro/assets/images/resource/faq-1.png')); ?>" alt=""></figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_5">
                            <div class="content-box">
                                <div class="sec-title">
                                    <p>Faq’s</p>
                                    <h2>Frequently Asked Questions.</h2>
                                </div>
                                <ul class="accordion-box">
                                    <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-outer"></div>
                                            <h4>How do I contact customer service?</h4>
                                        </div>
                                        <div class="acc-content">
                                            <div class="text">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit eiusmod tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation ullamco laboris.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block active-block">
                                        <div class="acc-btn active">
                                            <div class="icon-outer"></div>
                                            <h4>Do doctors pay for good reviews?</h4>
                                        </div>
                                        <div class="acc-content current">
                                            <div class="text">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit eiusmod tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation ullamco laboris.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                         <div class="acc-btn">
                                            <div class="icon-outer"></div>
                                            <h4>Why didn't my review get posted?</h4>
                                        </div>
                                        <div class="acc-content">
                                            <div class="text">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit eiusmod tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation ullamco laboris.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <section class="agent-section" style="background: aliceblue;">
            <div class="auto-container">
                <div class="inner-container bg-color-2">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                            <div class="content_block_3">
                                <div class="content-box">
                                    <h3><?php echo e(__('message.Emergency call')); ?></h3>
                                    <div class="support-box">
                                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                                        <span><?php echo e(__('message.Telephone')); ?></span>
                                        <h3><a href="tel:<?php echo e($setting->phone); ?>"><?php echo e($setting->phone); ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                            <div class="content_block_4">
                                <div class="content-box">
                                    <h3><?php echo e(__('message.Sign up for Newsletter today')); ?></h3>
                                    <form action="#" method="post" class="subscribe-form">
                                        <div class="form-group">
                                            <input type="email" name="email" id="emailnews" placeholder="<?php echo e(__('message.Your email')); ?>" required="">
                                            <button type="button" onclick="addnewsletter()" class="theme-btn-one"><?php echo e(__('message.Submit now')); ?><i class="icon-Arrow-Right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/privacypolicy.blade.php ENDPATH**/ ?>
