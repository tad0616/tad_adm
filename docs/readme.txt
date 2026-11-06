Read Me First
=============

Please make sure that you download the XOOPS Icon Set, and upload it to uploads/images directory

Online package upgrades
-----------------------
For module, theme and admin-theme packages, the updater checks the extracted
files against their actual destinations before copying. If PHP cannot write
to a destination, the SSH login form is shown with the relevant paths. Fix
the ownership or permissions, or sign in with an account that can write those
files. Other packages are also
checked when their upgrade instructions are available.

For theme removal, PHP checks the parent directories needed to delete the
theme tree. If access is insufficient, the SSH login form shows the affected
paths; the theme is removed from configuration only after deletion succeeds.
Removal opens in FancyBox after confirmation; close it to refresh the list.
The default theme and themes on shared school sites cannot be deleted here.

Downloading and extracting packages always require the PHP process to be able
to write to uploads and uploads/tad_adm, including when SSH is used to copy
the files. SSH does not automatically change ownership or recursively relax
permissions. A copy can still fail after the check (for example, if permissions
change); inspect the reported errors and repair any partially updated files.

XOOPS upgrades display the current download, extraction and copy step while
the upgrade runs. For upgrade.json, PHP and SSH report each step's destination.
After SSH login, the form remains visible while the upgrade runs so these
updates can continue; its result or error is then displayed in the same window.
If the SSH request ends without the upgrade handoff, its result is uncertain:
do not rerun or open /upgrade/ until host logs and file integrity confirm the
copy has finished. A gateway error can occur even if the SSH command continues.
Legacy SSH scripts report that the script is running but cannot report their
individual commands. Live status is visible only to the same administrator
session; failure to retrieve it does not stop the upgrade.
If the core upgrade preflight finds inaccessible destinations, the SSH login
form shows the affected paths before any destination files are changed.
Other core upgrade errors use the regular redirect page, even when AJAX
redirects are enabled, so the error remains visible before returning.
After a successful core copy, the upgrade wizard opens in the top-level
browser window rather than inside FancyBox. The handoff page also provides
a link when automatic navigation is unavailable.

Back up the site files and database before a core upgrade and schedule downtime:
copying live core files is not atomic. SSH core upgrades disable phpseclib's
short command timeout and require both a successful exit status and a completion
marker. If a connection or server timeout interrupts the upgrade, the site may
be partially updated. Check whether the server-side process is still running
before restoring or repairing from a backup or package; do not retry concurrently.
Web server, proxy and PHP-FPM termination limits can still interrupt the request.