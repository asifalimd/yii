<?php
/**
 * RtwModel class file.
 *
 * @author Asif Ali M <asif@reloadtheweb.com>
 * @package application.gii
 * 
 * 
 * RtwModel is to extend the model creation functionality. We are only ovverride the method to generate a class 
 * name with prefix 'Base' added to it.This is the best practice to avoid ovewriting of the files when updating 
 * the model files.
 * 
 */

Yii::import('system.gii.generators.model.ModelCode');

class RtwmodelCode extends ModelCode
{

	public $baseModelPath;
	
	public $baseModelClass;
	
	public function prepare()
	{
		if(($pos=strrpos($this->tableName,'.'))!==false)
		{
			$schema=substr($this->tableName,0,$pos);
			$tableName=substr($this->tableName,$pos+1);
		}
		else
		{
			$schema='';
			$tableName=$this->tableName;
		}
		if($tableName[strlen($tableName)-1]==='*')
		{
			$tables=Yii::app()->db->schema->getTables($schema);
			if($this->tablePrefix!='')
			{
				foreach($tables as $i=>$table)
				{
					if(strpos($table->name,$this->tablePrefix)!==0)
						unset($tables[$i]);
				}
			}
		}
		else
			$tables=array($this->getTableSchema($this->tableName));
	
		$this->files=array();
		$templatePath=$this->templatePath;
		$this->relations=$this->generateRelations();
	
		foreach($tables as $table)
		{
			$tableName=$this->removePrefix($table->name);
			$className=$this->generateClassName($table->name);
			$this->baseModelClass = 'Base'.$className;
			$this->baseModelPath = $this->modelPath.'.base';
			 
			$params=array(
					'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,
					'modelClass'=>$className,
					'columns'=>$table->columns,
					'labels'=>$this->generateLabels($table),
					'rules'=>$this->generateRules($table),
					'relations'=>isset($this->relations[$className]) ? $this->relations[$className] : array(),
			);
			$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->baseModelPath).'/'.$this->baseModelClass.'.php',
					$this->render($templatePath.'/basemodel.php', $params)
			);
			
			$this->files[]=new CCodeFile(
					Yii::getPathOfAlias($this->modelPath).'/'.$className.'.php',
					$this->render($templatePath.'/model.php', $params)
			);
		}
	}
	

	
}
	