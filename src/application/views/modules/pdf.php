
    <div 
        <?php if($isBackend):?>module_id=<?= $i?><?php endif;?> 
        class="module module_pdf"
        <?php if($isBackend):?>db_id=<?= $module['id']?><?php endif;?> 
        ordering="<?= $module['ordering']?>"
        
    >
        <?php if($isBackend):?>
            <div class="module_tools">
                <div class="module_tool move"></div>
                <div class="module_tool edit"></div>
            </div>
            <div class="module_content has_placeholder" data-text="PDF module - Doubleclick to edit" style="text-align: <?= $module['align']?>" ><?= $module['text'] ?></div>
            
        <?php else:?>
           
            <?php if($module['text'] != ''):?>
                <div class="module_content has_placeholder" data-text="PDF module - Doubleclick to edit" style="text-align: <?= $module['align']?>" ><?= $module['text'] ?></div>
            <?php endif;?>
        <?php endif;?>
    </div>    