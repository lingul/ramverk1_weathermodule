#!/usr/bin/env bash
#
# anax/remserver
#
# Integrate the REM server onto an existing anax installation.
#

# Copy the configuration files
rsync -av vendor/anax/remserver/config ./

# Copy the documentation
rsync -av vendor/anax/remserver/content/index.md ./content/remserver-api.md
