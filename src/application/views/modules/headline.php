
    <div 
        <?php if($isBackend):?>module_id=<?= $i?><?php endif;?> 
        id="<?= $module['section']?>" class="module module_headline <?= $module['htype']?>" htype="<?= $module['htype']?>" section = "<?= $module['section']?>" display_text= "<?= $module['display_text']?>"
        <?php if($isBackend):?>db_id=<?= $module['id']?><?php endif;?>   <?php if($isBackend):?>style="padding-top:0px;margin-top:0px;"<?php endif;?>
        ordering="<?= $module['ordering']?>" 
    >
        <?php if($isBackend):?>
            <div class="module_tools">
                <div class="module_tool move"></div>
                <div class="module_tool edit"></div>
            </div>
            <div class="module_content has_placeholder" data-text="HEADLINE module - Doubleclick to edit"><?= $module['content'] ?></div>
        <?php else:?>
            <?= $module['content'] ?>
        <?php endif;?>
    </div>

    