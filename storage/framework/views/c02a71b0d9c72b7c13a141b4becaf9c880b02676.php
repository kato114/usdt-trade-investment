<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name')); ?> <?php echo $__env->yieldContent('heading'); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" integrity="sha384-3ziFidFTgxJXHMDttyPJKDuTlmxJlwbSkojudK/CkRqKDOmeSbN6KLrGdrBQnT2n" crossorigin="anonymous"></script>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"
            integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/png"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>"/>
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.up.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('head'); ?>
    <style>
        .c3-grid line {
            stroke: #a8a8a8;
        }
        tspan{
            font-weight: bolder;
            font-size: larger;
        }
        
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #3995f4;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #000;
}
    </style>
    <script>
        document.addEventListener("turbolinks:load", function (e) {
            var baseConfig = {
                height: 335,
                selector: "textarea.editor",
                autosave_ask_before_unload: false,
                powerpaste_allow_local_images: true,
                plugins: [
                    "anchor autolink codesample fullscreen help image imagetools",
                    " lists link media noneditable preview",
                    " searchreplace table template textcolor visualblocks wordcount"
                ],
                toolbar:
                    "insertfile a11ycheck undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
                content_css: [
                    "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
                ]
            };
            tinymce.init(baseConfig);

            $('.datetimepicker-input').datetimepicker({
                showToday: true,
                showClear: true,
                showClose: true,
                keepOpen: false
            });
            $('.date').datetimepicker({
                showToday: true,
                showClear: true,
                showClose: true,
                keepOpen: false
            });

          var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
        });
    </script>
</head>
<body>
    <?php $__env->startSection('scripts'); ?>
    <script>
 var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
    </script>
<?php $__env->appendSection(); ?>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<?php echo $__env->yieldContent('body'); ?>
<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH E:\xampp\htdocs\25-percent\resources\views/layouts/app.blade.php ENDPATH**/ ?>