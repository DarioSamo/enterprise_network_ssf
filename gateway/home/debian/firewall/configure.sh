#!/bin/bash#!/bin/bash
echo "Agregando reglas al Firewall..."
export PATH=$PATH:/usr/sbin

# Borrar reglas existentes
iptables -F
iptables -t nat -F

# Agregar reglas de NAT
iptables -t nat -A POSTROUTING -o enp0s3 -j MASQUERADE

# Agregar reglas de logging
iptables -A INPUT -j LOG --log-prefix '* FW LOG *'

# Agregar bloqueo de sitios web
iptables -A FORWARD -m string --string "facebook.com" --algo bm -j REJECT
iptables -A FORWARD -m string --string "youtube.com" --algo bm -j REJECT

# Filtrar puertos de DMZ
#iptables -A FORWARD -s 10.1.0.0/24 -p tcp --dport 25 -j REJECT # SMTP
#iptables -A FORWARD -s 10.1.0.0/24 -p tcp --dport 143 -j REJECT # IMAP
iptables -A FORWARD -s 10.1.0.0/24 -p tcp --dport 3306 -j REJECT # DB
iptables -A FORWARD -s 10.1.0.0/24 -d 10.0.0.14 -p tcp --dport 22 -j ACCEPT # SFTP
iptables -A FORWARD -s 10.1.0.0/24 -p tcp --dport 22 -j REJECT # SSH

iptables-save > /etc/iptables/rules.v4
echo 1 > /proc/sys/net/ipv4/ip_forward
echo "Reglas agregadas."
