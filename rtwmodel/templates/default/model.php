<?php
/**
 * 
 * 
* Yii::import('<?php echo "{$this->baseModelPath}.{$this->baseModelClass}"; ?>');
*/
?>
<?php echo "<?php\n"; ?>

/**
 * @author Asif Ali M <asif@reloadtheweb.com>
 * @package application.models
 * 
 * The class defination is autogenerate by RtwModel generator
 */

Yii::import('<?php echo "{$this->baseModelPath}.{$this->baseModelClass}"; ?>');

class <?php echo $modelClass; ?> extends <?php echo $this->baseModelClass."\n"; ?>
{
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }
}