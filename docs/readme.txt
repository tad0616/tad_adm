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

Downloading and extracting packages always require the PHP process to be able
to write to uploads and uploads/tad_adm, including when SSH is used to copy
the files. SSH does not automatically change ownership or recursively relax
permissions. A copy can still fail after the check (for example, if permissions
change); inspect the reported errors and repair any partially updated files.