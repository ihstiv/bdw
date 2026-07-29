<?php
class sodChangeTopicTitles_output extends tapatalk_output {
	//if set true, you can't change title any more!
	private $sodCloseSetTitle = false;
	
	public function __sodTogglesSetTitle() {
		return $this->sodCloseSetTitle = $this->__sodCloseSetTitle?false:true;
	}
	
	public function setTitle( $title ) {
		if($this->sodCloseSetTitle) {
			return;
		}
		return parent::setTitle($title);
	}
}