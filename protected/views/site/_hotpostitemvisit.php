<div class="view">	    
   <h2><?php echo CHtml::encode($data->subject); ?></h2>
   <span>Creado por: <?php echo CHtml::encode($data->username);?> en la fecha <?php echo CHtml::encode(date('d-m-Y h:i:s', $data->dateline));?></span>
   <p>Cantidad de Respuestas: <?php echo CHtml::encode($data->length - 1); ?></p>  
   <p><?php echo CHtml::encode(substr($data->posts[0]->message, 0, 350)); ?></p>   
   <a href="http://localhost/mybb/Upload/showthread.php?tid=<?php echo CHtml::encode($data->tid)?>" alt="leer mas">Leer mas</a>
</div>
