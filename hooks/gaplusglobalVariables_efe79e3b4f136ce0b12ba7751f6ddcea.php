<?php
class gaplusglobalVariables extends output
{
public function sendOutput( $return=false )
	{
if(IPSLib::appIsInstalled('gaplus'))
{
//what app?... hrmm, maybe core ;)?
$app = $this->request['app']?$this->request['app']:$this->registry->getCurrentApplication();
//grab my shizzle
if( !$this->registry->isClassLoaded( 'gaplusVariables' ) )
{
	$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'gaplus' ) . "/sources/variables.php", 'gaplusVariables', 'gaplus' );
	$this->registry->setClass( 'gaplusVariables', new $classToLoad( $this->registry ) );
}
//append js :)
	$this->_documentHeadItems[ 'raw' ][] .= $this->registry->gaplusVariables->variablesHtml($app, $this->request);
//INIT non-js hickery-do

$gaPlusMobileCode = '';

if($this->settings['gaplus_ua_code'] && (!$this->settings['gaplus_ignored_g'] || IPSMember::isIngroup($this->memberData, explode(',', $this->settings['gaplus_ignored_g']))))
{

$ga_account = str_replace('UA-', 'MO-', $this->settings['gaplus_ua_code']);

  $ga_image_url =  $this->registry->output->buildUrl('app=gaplus&module=track&section=view', 'public') . "&utmac=" . $ga_account."&utmn=" . rand(0, 0x7fffffff);

    $referer = $_SERVER["HTTP_REFERER"];

   $path = @parse_url($this->settings['this_url'], PHP_URL_PATH);

    if (empty($referer) || strstr($referer, $this->settings['base_acp_url'])) {

      $referer = "-";

    }

   $ga_image_url .= "&utmr=" . urlencode($referer);

    if (!empty($path)) {

     $ga_image_url .= "&utmp=" . urlencode($path);

    }

   $ga_image_url .= "&guid=ON";

$gaPlusMobileCode .= '<noscript><img src="' . $ga_image_url . '" style="border: 0px;height:1px;width:1px;" ></noscript>';
}
//append html
$this->_html .= $gaPlusMobileCode;
}
//we done 0.0
return parent::sendOutput( $return );
	}
}
?>
