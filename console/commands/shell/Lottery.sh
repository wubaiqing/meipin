#!/bin/bash
shell_dir=$(cd "$(dirname "$0")"; pwd)
shell_name=$(basename "$0")
echo $shell_dir;
cd "$shell_dir/../../../"
s=`ps aux | grep "yiic.php DataTask Lottery"`;
mark=`echo $s | grep "php yiic.php"`
d=`date +%Y-%m-%d' '%H:%M:%S`
if [[ $mark == "" ]]; then
	mkdir -p "runtime/shell"
	echo "$d run $shell_name" >> "runtime/shell/$shell_name.log"
	php yiic.php DataTask Lottery --pidFile=$PID_FILE >> "runtime/shell/Lottery.log"
	else
	echo "$d run $shell_name. It's runing now. skip..." >> "runtime/shell/$shell_name.log"
fi