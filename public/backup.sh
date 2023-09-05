#for file in `ls /var/www/vhosts/spinstatz.net/production/public/records -t -r` 
for file in `find /home/ubuntu/musicApp/public/records/ -type f -mtime 0`

do
	echo $file
	curl -F "fileToUpload"=@"$file" http://spinstatz.org/upload.php
	rm $file
done

