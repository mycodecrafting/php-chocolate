<div class="specs">
    <div class="specs-name"><?php echo $specs->get_name(); ?> <em>(Specifications)</em></div>
    <div class="specs-wrapper">
        <?php foreach ($specs->get_contexts() as $context): ?>
            <div class="context">
                <div class="context-name">&raquo;&nbsp;<?php echo $context->get_name(); ?> <em>(Context)</em></div>

                <?php foreach ($context->get_specs() as $spec): ?>
                    <?php
                    $class = 'spec';

                    if ($spec->is_skipped()):
                        $class .= ' skipped';
                    endif;

                    if ($spec->has_failed()):
                        $class .= ' failed';
                    endif;

                    if ($spec->is_incomplete()):
                        $class .= ' incomplete';
                    endif;
                    ?>
                    <div class="<?php echo $class; ?>">
                        &raquo;&nbsp;<?php echo $spec->get_name(); ?>

                        <?php if (sizeof($spec->get_messages())): ?>
                            <div class="message">
                                <?php foreach ($spec->get_messages() as $message): ?>
                                    &middot;&nbsp;<?php echo htmlspecialchars($message); ?><br />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <?php foreach ($specs->get_specs() as $spec): ?>
            <?php echo $this->report_on_specs($spec); ?>
        <?php endforeach; ?>
    </div>
</div>
