#!/bin/bash
set -e

echo "[Entrypoint] v2ray one-click script"

v2ray start
v2ray info
tail -f /var/log/v2ray/access.log