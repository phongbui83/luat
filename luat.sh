#!/bin/bash
scp phongbt@10.42.69.80:/root/INBOX/*.eml /var/www/html/eml/
for f in *.eml; do cat $f | /usr/bin/ruby /var/www/html/rdm-mailhandler.rb  --url=http://lv-skms.chip1stop.com/redmine/ --key-file /etc/postfix/redmine-api.key --unknown-user=accept --no-permission-check --no-check-certificate  -p Unyou --tracker=MailAlert --status=報告済・対応不要 --assigned-to=admin  --priority=normal ; done
rm -rf /var/www/html/eml/*.eml
