#!/bin/bash
/usr/sbin/adduser --quiet --disabled-password --gecos "${1}" --ingroup sftp_users ${1}
echo "${1}:${2}" | /usr/sbin/chpasswd
chown root /home/${1}
mkdir /home/${1}/upload
chown ${1} /home/${1}/upload