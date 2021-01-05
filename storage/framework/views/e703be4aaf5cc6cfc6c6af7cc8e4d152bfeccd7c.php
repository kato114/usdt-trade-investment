<div class="card">
    <div class="card-header">
        <p class="card-title">
            Showing Daily Profits
        </p>
    </div>







    <div class="my-4">
        <?php echo $__env->make('client.line_chart',['account' => $client], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/client/history.blade.php ENDPATH**/ ?>