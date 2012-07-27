<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<h2>Temas más Visitados</h2>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProviderVisitPost,
    'itemView'=>'_hotpostitem', 
));?>

<h2>Con mayor numero de respuesta</h2>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProviderMostAnswerdPost,
    'itemView'=>'_hotpostitemvisit',   
));?>

