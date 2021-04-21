<?php
/**
 * Created by PhpStorm.
 * User: peremyshlennikovvs
 * Date: 09.10.2020
 * Time: 17:27
 */
?>
<div style="border: 1px solid #32a1ce; padding: 10px;">
    <div>
        <label class="control-label">Эксперт:</label>
        <p><?=$model['fio']?></p>
    </div>
    <div>
        <label class="control-label">Оценка:</label>
        <p><?=$model['sum_ratings']?></p>
    </div>
    <div>
        <label class="control-label">Комментарий:</label>
        <p><?=$model['evaluate_work_comment']?></p>
    </div>
</div>

