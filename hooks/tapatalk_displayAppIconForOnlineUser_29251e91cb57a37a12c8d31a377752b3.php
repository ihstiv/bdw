<?php

class tapatalk_displayAppIconForOnlineUser
{
    /**
     * Registry object
     *
     * @var     object
     */
    protected $registry;

    /**
     * Constructor
     *
     * @return  @e void
     */
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
    }

    public function getOutput()
    {
    }

    /**
     * Replace output
     *
     * @param   string      Output
     * @param   string      Hook key
     * @return  string      Output parsed
     */
    public function replaceOutput( $output, $key )
    {
        if (($oTpl = $this->registry->output->getTemplate('online')) && $oTpl->functionData['showOnlineList'][0]['rows']) {
            $settings = ipsRegistry::$settings;
            $board_url = $this->registry->output->isHTTPS ? str_replace('http:', 'https:', $settings['board_url']) : $settings['board_url'];
            $tapatalkdir = isset($settings['tapatalk_directory']) && !empty($settings['tapatalk_directory'])
                           ? $settings['tapatalk_directory'] : 'mobiquo';
            $iconUrl = $board_url.'/'.$tapatalkdir.'/online.png';
            //$iconUrl_byo = $board_url.'/'.$tapatalkdir.'/byo-online.png';
            
            $tag    = '<!--hook.' . $key . '-->';
            $last   = 0;

            foreach( $oTpl->functionData['showOnlineList'][0]['rows'] as $row )
            {
                $pos    = strpos( $output, $tag, $last );

                if( $pos )
                {
                    if (stripos($row['browser'], 'byo') !== false) {
                        $app_url = 'https://tapatalk.com';
                        if (stripos($row['browser'], 'byo-4') !== false) {
                            if ($settings['app_android_url'] && $settings['app_android_url'] != '-1') {
                                if (preg_match('/details\?id=([\w\.]+)/i', $settings['app_android_url'], $matches)) {
                                    $app_url = 'https://play.google.com/store/apps/details?id='.$matches[1];
                                } else {
                                    $app_url = 'https://play.google.com/store/apps/details?id='.$settings['app_android_url'];
                                }
                            }
                        } else {
                            if (intval($settings['app_ios_id']) && intval($settings['app_ios_id']) != '-1') {
                                $app_url = 'https://itunes.apple.com/us/app/id'.intval($settings['app_ios_id']);
                            }
                        }
                        
                        $prefix = '<a href="'.$app_url.'" target="_blank" title="On Forum App"><img src="'.$iconUrl.'" border="0" /></a>';
                        $output = substr_replace( $output, $prefix . $tag, $pos, strlen( $tag ) );
                        $last   = $pos + strlen( $prefix . $tag );
                    } else if (stripos($row['browser'], 'tapatalk') !== false) {
                        $prefix = '<img src="'.$iconUrl.'" border="0" />';
                        $output = substr_replace( $output, $prefix . $tag, $pos, strlen( $tag ) );
                        $last   = $pos + strlen( $prefix . $tag );
                    } else {
                        $last   = $pos + strlen( $tag );
                    }
                }
            }
        }

        return $output;
    }

}

?>