<?php $__env->startSection('title'); ?>
    Mail Box
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Compose Mail</h3>
            <div class="card-options">
            </div>
        </div>
        <div class="card-body">
            <form method="post">
                <?php echo csrf_field(); ?>
                <?php if(!isset($recipients)): ?>
                    <div class="form-group">
                        <h3>Select Clubs</h3>
                        <div class="selectgroup selectgroup-pills">
                            <?php $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value[]" value="<?php echo e($club); ?>"
                                           class="selectgroup-input"
                                           checked="">
                                    <span class="selectgroup-button"><?php echo e($club); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="">Start Composing</button>
                <?php else: ?>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject"
                               placeholder="Well, she turned me into a newt.">
                    </div>
                    <label>Body</label>
                    <textarea rows="30" id="mail" name="body"></textarea>
                    <div class="mt-6">
                        <button class="btn btn-primary float-right ml-2">Send</button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
    <script>
        $(document).on('turbolinks:load', function () {
            var baseConfig = {
                selector: "textarea#mail",
                convert_urls: false,
                autosave_ask_before_unload: false,
                powerpaste_allow_local_images: true,
                plugins: [
                    "anchor autolink codesample colorpicker fullscreen help image imagetools",
                    " lists link media noneditable preview",
                    " searchreplace table template textcolor visualblocks wordcount"
                ],
                toolbar:
                    "insertfile a11ycheck undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
                content_css: [
                    "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
                    "//www.tiny.cloud/css/content-standard.min.css"
                ]
            };
            let editor = tinymce.init(baseConfig);
        })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/percen25/public_html/resources/views/admin/mailbox.blade.php ENDPATH**/ ?>