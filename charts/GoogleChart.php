<?php
/*
 * @author Asif Ali M <asif@reloadtheweb.com>
 * @package ext.widgets
 * 
 */

class GoogleChart extends CWidget
{
	
  public $data = array();
  
  public $title;
  
  public $html_options = array();
	
  public function init()
  {
	Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/jsapi');
	parent::init();
  }
	
  public function run()
  {


  }
	
  public function getEncodedData()
  {
	$data;
		
	foreach($this->data as $key => $val)
	{
	  $data .= "['".$key."', ".$val."],";
	}

	return $data;
  }
		
		
  public function getWidgetElementId()
  {
  	 if($this->html_options['id'])
  	 {
  	 	return $this->html_options['id'];
  	 }
  	 else
  	 {
  	 	return $this->getId();
  	 }	
  }
	
	
	
	
	
	
}