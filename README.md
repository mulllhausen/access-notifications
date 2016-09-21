# access-notifications

- `ssh_notifications.php` sends an email when users access the machine via ssh
- `smtp_notifications.php` sends an email when one of the machines in the cluster becomes unable to send emails

### Warnings

This project is a work in progress.

### Setup

Update `/etc/pam.d/sshd` to include the following line:

```
# run ssh notification script upon successful login
session    optional     pam_exec.so /path/to/ssh_notifications.php
```

Update `/etc/crontab` to include the following line:

```
*/1 *  * * *   root    /path/to/smtp_notifications.php
```
