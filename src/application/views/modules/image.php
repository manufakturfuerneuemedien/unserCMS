
    <div 
        <?php if($isBackend):?>module_id=<?= $i?><?php endif;?> 
        class="module module_image"
        <?php if($isBackend):?>db_id=<?= $module['id']?><?php endif;?> 
        ordering="<?= $module['ordering']?>"
        style="text-align: <?= $module['align']?>" 
    >
        <?php if($isBackend):?>
            <div class="module_tools">
                <div class="module_tool move"></div>
                <div class="module_tool edit"></div>
            </div>
            <img class="module_content_image" style="width: <?= $module['stretch'] == 1 ? '100%' : 'auto'?>;" src="<?= $module['filepath'] ?>" />
            <div class="module_image_caption"><?= $module['caption'] ?></div>
        <?php else:?>
            <img style="width: <?= $module['stretch'] == 1 ? '100%' : 'auto'?>;" src="<?= $module['filepath'] ?>" />
            <?php if($module['caption'] != ''):?>
                <div class="module_image_caption" ><?= $module['caption'] ?></div>
            <?php endif;?>
        <?php endif;?>
    </div>
    