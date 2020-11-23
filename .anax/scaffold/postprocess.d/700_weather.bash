
#!/usr/bin/env bash
#

# Integrate the weather module onto an existing anax installation.
#

# Copy over config files
rsync -av vendor/pon18/ramverk1-weathermodule/config ./

# Copy over view files
rsync -av vendor/pon18/ramverk1-weathermodule/view ./

# Copy over test files
rsync -av vendor/pon18/ramverk1-weathermodule/test ./

# Copy over src files
rsync -av vendor/pon18/ramverk1-weathermodule/src ./
