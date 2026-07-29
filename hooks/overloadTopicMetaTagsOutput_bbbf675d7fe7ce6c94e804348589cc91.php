<?php
class overloadTopicMetaTagsOutput extends sidebarReplace {
  private $title = null;

  public function setTitle($title) {
    if($this->title !== null) {
      return;
    }

	$this->title = $title;


    return parent::setTitle($title);
  }
}