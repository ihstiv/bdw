<?php
class overloadTopicMetaTagsHtmlOutput extends htmlOutput implements interface_output {
  private $meta = array();

  public function addMetaTag($tag, $content, $encode = true, $trimLen = 500) {
    $tag = trim(strtolower($tag)); // 'ROBOTS' should overwrite 'robots'

    if(isset($this->meta[$tag])) {
      return;
    }

    $this->meta[$tag] = $content;

    return parent::addMetaTag($tag, $content, $encode, $trimLen);
  }
}