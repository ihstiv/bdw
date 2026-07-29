#!/bin/bash
while true; do
    /opt/cpanel/ea-php70/root/usr/bin/php -d memory_limit=-1 -d max_execution_time=0 /home/bdwforum/public_html/applications/core/interface/task/task.php 977155d5748ba2c116b5b70c0e9cd442 65
    echo "Running..."
    sleep .5
done