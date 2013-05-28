<?php

/*
* jQuery cycle plugin widget for Yii
* based on jQuery cycle plugin - http://www.malsup.com/jquery/cycle/
* @author Zhussupov Zhassulan <zhzhussupovkz@gmail.com>
* @version: 1.0
* MADE IN KAZAKHSTAN
*/
class yiiCycle extends CWidget {

	//id
	public $id = 'slideshow';

	//array of slides
	public $slides = array();

	//options - see http://www.malsup.com/jquery/cycle/options.html
	public $options = array();

	//width
	public $width = '400';

	//height
	public $height = '600';

	//run the widget
	public function run() {
		$this->allScripts();

		echo '<div id="'.$this->id.'">';

		foreach ($this->slides as $item) {
			echo CHtml::image($item['src'], $item['alt'], array('width' => $this->width, 'height' => $this->height));
		}

		echo '</div>';
		$script = '$(document).ready(function(){
			$("#'.$this->id.'").cycle('.CJavaScript::encode($this->options, false).');
		});';

		Yii::app()->clientScript->registerScript('yiiCycle', $script, CClientScript::POS_END);
	}

	//access Horinaja 
	protected function allScripts() {
		$assets=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)) {
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/jquery.cycle.lite.js');
			Yii::app()->clientScript->registerCssFile($baseUrl.'/cycle.css');
		}
		else
		{
			throw new Exception('Error in yiiCycle widget! Cannot access assets folder');
		}
	}
}