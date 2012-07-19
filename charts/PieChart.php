<?php
/*
 * @author Asif Ali M <asif@reloadtheweb.com>
 * @package ext.widgets
 * 
 * 
 * Example Use
 * $this->widget('ext.widgets.charts.PieChart',
 *		array( 'title'=> 'Country', 'data' =>  array('India' => 230, 'US' => 250, 'UK' => 120, 'Singapore' => 65, 'Australia' => 99),
 *				'html_options' => array( 'id' => 'div1', 'style' =>'border: 1px solid;width: 150px; height: 100px;float:left')
 *				));
 */

require_once "GoogleChart.php";

class PieChart extends GoogleChart
{
	
  public function init()
  {
	  parent::init();
  }
	
  public function run()
  {
    $script = $this->getJavascript();
    $cs = Yii::app()->getClientScript();
    $cs->registerScript($this->getId(), $script,CClientScript::POS_END);
        
   	echo CHtml::tag('div', $this->html_options, true, true);
  }
	
  public function getJavascript()
  {
    // TODO need to find a better way to do the below logic
	$script = "
					
      google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
      google.setOnLoadCallback(drawChart".$this->getId().");
      function drawChart".$this->getId()."() {
        var data = google.visualization.arrayToDataTable([".$this->getEncodedData()."]);
	
        var options = {
          title: '".$this->title."'
        };
        var chart = new google.visualization.PieChart(document.getElementById('".$this->getWidgetElementId()."'));
        chart.draw(data, options);
      }					";
	
	  return $script;	
	}
	
  	
		
	
	
	
	
	
	
	
}