<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Rating and reviews</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <div id="reply_review" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Reply review</h4>
                    </div>  

                    <?php echo $this->Form->create('Review', array('action' => 'update_reply'), array('class' => 'cmxform form-horizontal')); ?>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <?php echo $this->Form->input('id', array('id' => 'reply_on_review_id')); ?>
                                    <label class="control-label col-lg-2">Review</label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('reply_desc', array('id' => 'reply_on_review', 'class' => 'ckeditor form-control', 'label' => false)); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group modal-footer">
                            <?php echo $this->Form->submit(__('Send Reply'), array('class' => 'btn btn-primary btn-outlined')); ?>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Services</strong>
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
                                    <?php if (!empty($review['Review']['reply_desc'])) { ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Reply</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo $review['Review']['reply_desc']; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                                    <th><?php echo $this->Paginator->sort('service_id', 'Given By User'); ?></th>
                                    <th><?php echo $this->Paginator->sort('rating'); ?></th>
                                    <th><?php echo $this->Paginator->sort('Options'); ?></th>
                                </tr>
                            <?php } ?>
                            <?php if (count($reviews) > 0) {
                            foreach ($reviews as $review):
                                if (in_array($review['Service']['title'], $serviceArr)) {
                                    ?>
                                    <tr>
                                        <td><?php echo h($i); ?>&nbsp;</td>
                                        <td>
                                            <?php echo h($salutations[$review['User']['salutation'] + 1] . ". " . $review['User']['first_name'] . " " . $review['User']['last_name']); ?>
                                        </td>
                                        <td>
                                            <div data-rating="<?php echo $review['Review']['rating']; ?>" id="ratings_<?php echo $review['Review']['id']; ?>" class="ratings"></div>
                                        </td>
                                        <td class="actions">
                                            <?php echo $this->Form->button(('View'), array('data-toggle' => 'modal', 'href' => '#reviews_' . $review['Review']['id'], 'data-content' => 'View', 'data-placement' => 'top', 'data-trigger' => 'hover', 'class' => 'btn btn-xs btn-success popovers')); ?>&nbsp;
                                            <?php echo $this->Form->button(('Reply'), array('row_id' => $review['Review']['id'], 'data-toggle' => 'modal', 'data-target' => '#reply_review', 'data-trigger' => 'hover', 'data-content' => 'reply', 'data-placement' => 'top', 'class' => 'popovers btn btn-xs btn-info reply_review_btn')); ?>
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
                        <?php }  ?>
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
                    return 'images/';
                else if(url_len == 2)
                    return '../images/';
                else if(url_len == 3)
                    return '../../images/';
                else if(url_len == 4)
                    return '../../../images/';
            }
        });
    });

    function publish_unpublish(id, status)
    {
        bootbox.confirm("Are you sure about to change status to " + status + "?", function (result) {
            if (result === true)
            {
                $.ajax({
                    method: "POST",
                    url: "<?php echo Router::url(array('controller' => 'reviews', 'action' => 'publish_unpublish')); ?>",
                    data: {id: id, is_published: status},
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });
    }

    $('.reply_review_btn').on('click', function () {
        $this = $(this);
        var id = $this.attr('row_id');
        $('#reply_on_review_id').val(id);
        $.ajax({
            method: "POST",
            url: "<?php echo Router::url(array('controller' => 'reviews', 'action' => 'get_reply_data')); ?>",
            data: {id: id},
            success: function (data) {
                var obj = $.parseJSON(data);
                $('#reply_on_review_id').val(obj.id);
                CKEDITOR.instances['reply_on_review'].setData(obj.reply_desc);
            }
        });
    });

</script>