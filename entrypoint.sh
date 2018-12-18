#!/bin/bash
set -e

echo "[Entrypoint] v2ray one-click script"

v2ray start
v2ray info
v2ray log