#!/bin/bash
/usr/sbin/adduser --quiet --disabled-password --gecos "${1}" --ingroup clients ${1}
echo "${1}:${2}" | /usr/sbin/chpasswd