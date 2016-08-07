<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Rating and reviews</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>

        <div class="panel panel-default">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Ratings and Reviews</strong>
                </header>
                <div class="reviews index">

                    <?php foreach ($reviews as $review): ?>
                        <!--modal for view-->
                        <div class="modal fade in" id="reviews_<?php echo $review['Review']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Review</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $review['Review']['review']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade in" id="reviews_reply_<?php echo $review['Review']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Review</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $review['Review']['reply_desc']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--view modal - end-->
                        <?php
                    endforeach;
                    $i = 1;
                    ?>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped dataTable display" id="review_table_<?php echo $i; ?>">
                            <?php if (count($reviews) > 0) { ?>
                                <tr>
                                    <th><?php echo $this->Paginator->sort($i, '#'); ?></th>
                                    <th><?php echo $this->Paginator->sort('Given By User'); ?></th>
                                    <th><?php echo $this->Paginator->sort('rating'); ?></th>
                                    <th><?php echo $this->Paginator->sort('is_verified', 'Options'); ?></th>
                                </tr>
                            <?php } ?>

                            <?php
                            if (count($reviews) > 0) {
                                foreach ($reviews as $review):
                                    if (in_array($review['Service']['title'], $serviceArr)) {
                                        ?>
                                        <tr>
                                            <td><?php echo h($i); ?>&nbsp;</td>
                                            <td>
                                                <?php echo h($salutations[$review['User']['salutation']] . ". " . $review['User']['first_name'] . " " . $review['User']['last_name']); ?>
                                            </td>
                                            <td>
                                                <div data-rating="<?php echo $review['Review']['rating']; ?>" id="ratings_<?php echo $review['Review']['id']; ?>" class="ratings"></div>
                                            </td>
                                            <td class="actions">
                                                <?php echo $this->Form->button(('View'), array('data-toggle' => 'modal', 'href' => '#reviews_' . $review['Review']['id'], 'data-content' => 'View', 'data-placement' => 'top', 'data-trigger' => 'hover', 'class' => 'btn btn-xs btn-success popovers')); ?>&nbsp;
                                                <?php echo $this->Form->button((($review['Review']['is_verified'] == 1 ? 'Disapprove' : 'Approve')), array('onclick' => "approve_disapprove(" . $review['Review']['id'] . ", " . $review['Review']['user_id'] . ", " . $review['Review']['service_id'] . ", " . ($review['Review']['is_verified'] == 1 ? '0' : '1') . ");", 'data-trigger' => 'hover', 'data-content' => ($review['Review']['is_verified'] == 1 ? 'Disapprove' : 'Approve'), 'data-placement' => 'top', 'class' => 'popovers btn btn-xs ' . ($review['Review']['is_verified'] == 1 ? 'btn-danger' : 'btn-info'))); ?>
                                                <?php echo $this->Form->button(('View Reply'), array('data-toggle' => 'modal', 'href' => '#reviews_reply_' . $review['Review']['id'], 'data-content' => 'View', 'data-placement' => 'top', 'data-trigger' => 'hover', 'class' => 'btn btn-xs btn-success popovers ' . ($review['Review']['is_reply'] == 1 ? '' : 'hidden'))); ?>&nbsp;
                                                <?php echo $this->Form->button((($review['Review']['reply_approve'] == 1 ? 'Disapprove reply' : 'Approve Reply')), array('onclick' => "approve_disapprove_reply(" . $review['Review']['id'] . ", " . ($review['Review']['reply_approve'] == 1 ? '0' : '1') . ");", 'data-trigger' => 'hover', 'data-content' => ($review['Review']['reply_approve'] == 1 ? 'Disapprove reply' : 'Approve Reply'), 'data-placement' => 'top', 'class' => 'popovers btn ' . ($review['Review']['reply_approve'] == 1 ? 'btn-danger' : 'btn-primary') . ' btn-xs ' . ($review['Review']['is_reply'] == 1 ? '' : 'hidden'))); ?>
                                                <?php // echo $this->Html->link(('Edit'), array('action' => 'edit', $review['Review']['id']), array('data-trigger' => 'hover', 'data-content' => 'Edit', 'data-placement' => 'top', 'class' => 'popovers btn btn-xs btn-warning'));   ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                endforeach;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                                </div>
                            <?php } ?>    
                        </table>
                        
                        <?php if (count($reviews) > 0) { ?>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info" id="dynamic-table_info">
                                    <?php
                                    echo $this->Paginator->counter(array(
                                        'format' => __(' Showing {:current} records out of {:count}.')
                                    ));
                                    ?>

                                </div>
                                <div class="span6">
                                    <div class="">
                                        <ul class="pagination pagination-sm  pull-right">
                                            <?php
                                            echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                            ?>                                                                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.ratings').raty({
            readOnly: true,
            half: true,
            halfShow: true,
            number: 5,
            score: function () {
                return $(this).attr('data-rating');
            },
            path: function () {
                url_len = window.location.pathname.split( 'admin_index/' ).length;
                if(url_len == 1)
                    return '../img/raty/';
                else if(url_len == 2)
                    return '../../img/raty/';
                else if(url_len == 3)
                    return '../../../img/raty/';
            }
        });
    });

    function approve_disapprove_reply(id, status)
    {
        bootbox.confirm("Are you sure about to change approve review?", function (result) {
            if (result === true)
            {
                $.ajax({
                    method: "POST",
                    url: "<?php echo Router::url(array('controller' => 'reviews', 'action' => 'approve_disapprove_reply')); ?>",
                    data: {id: id, reply_approve: status},
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });
    }

    function approve_disapprove(id, user, service, status)
    {
        bootbox.confirm("Are you sure about to change approve reply?", function (result) {
            if (result === true)
            {
                $.ajax({
                    method: "POST",
                    url: "<?php echo Router::url(array('controller' => 'reviews', 'action' => 'approve_disapprove')); ?>",
                    data: {id: id, is_verified: status, user_id: user, service_id: service},
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });
    }
</script>
