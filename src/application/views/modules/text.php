
    <div 
        <?php if($isBackend):?>module_id=<?= $i?><?php endif;?> 
        class="module module_text"
        <?php if($isBackend):?>db_id=<?= $module['id']?><?php endif;?> 
        ordering="<?= $module['ordering']?>" 
    >
        <?php if($isBackend):?>
            <div class="module_tools">
                <div class="module_tool move"></div>
                <div class="module_tool edit"></div>
            </div>
            <div class="module_content has_placeholder" data-text="TEXT module - Doubleclick to edit"><?= $module['content'] ?></div>
        <?php else:?>
            <?= $module['content'] ?>
        <?php endif;?>
    </div>

    