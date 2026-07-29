<?php

class tapatalk_banner_body
{
    public function getOutput()
    {
        return '
            <!-- Tapatalk Banner body start -->
            <script type="text/javascript">if (typeof(tapatalkDetect) == "function") tapatalkDetect();</script>
            <!-- Tapatalk Banner body end -->
        ';
    }
}
