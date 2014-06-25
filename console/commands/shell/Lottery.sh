#!/bin/bash
shell_dir=$(cd "$(dirname "$0")"; pwd)
shell_name=$(basename "$0")
cd "$shell_dir/../../../"
s=`ps aux | grep "yiic datatask lottery"`;
mark=`echo $s | grep "php"`
d=`date +%Y-%m-%d' '%H:%M:%S`
if [[ $mark == "" ]]; then
	mkdir -p "console/runtime/shell"
	echo "$d run $shell_name" >> "console/runtime/shell/$shell_name.log"
	./yiic datatask lottery  >> "console/runtime/shell/Lottery.log"
	else
	echo "$d run $shell_name. It's runing now. skip..." >> "console/runtime/shell/$shell_name.log"
fi
