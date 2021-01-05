<?php $__env->startSection('title'); ?>
    Support Center
    <?php if(request('trashed') != 'true'): ?>
        <a data-turbolinks="false" href="<?php echo e(route('support.resolution', ['action' => 'listing','trashed' => "true"])); ?>"
           class="btn btn-outline-primary float-right">Closed Tickets</a>
    <?php else: ?>
        <a data-turbolinks="false" href="<?php echo e(route('support.resolution', ['action' => 'listing'])); ?>"
           class="btn btn-outline-primary float-right">Open Tickets</a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <?php if(request('trashed') != 'true'): ?> Open Tickets <?php else: ?> Closed Tickets <?php endif; ?></h3>
            <div class="card-options">
            </div>
        </div>
        <?php if($tickets->count() >0): ?>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Subject</th>
                        <th>Client</th>
                        <th>Last Updated</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e($ticket->id); ?></span></td>
                            <td class="wrap">
                                <a href="<?php echo e(route('support.resolution',['action'=>'view','ticket' => $ticket])); ?>"><?php echo e($ticket->subject); ?></a>
                            </td>
                            <td>
                                <a href="<?php echo e(route("client",['client' => $ticket->client])); ?>"><?php echo e($ticket->client->name); ?></a>
                            </td>
                            <td>
                                <?php echo e($ticket->updated_at->format('jS M Y')); ?>

                            </td>
                            <td>
                                <span
                                    class="status-icon <?php if($ticket->status == 'pending'): ?> bg-success <?php else: ?> bg-secondary <?php endif; ?>"></span> <?php echo e(ucfirst( $ticket->status)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty text-center">
                <div class="empty-icon mt-5" style="font-size: 32px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                </div>
                <p class="empty-title h3">None as yet.</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paulsclub/public_html/arbitrage-trading.io/resources/views/admin/ticket/listing.blade.php ENDPATH**/ ?>