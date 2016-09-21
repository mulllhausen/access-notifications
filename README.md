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

Restart the `ssh` service:

```
# /etc/init.d/sshd restart
```

Update `/etc/crontab` to include the following line:

```
*/1 * * * * root /path/to/smtp_notifications.php
```

This will run the smtp_notifications.php script every minute.

### TODOs

- Correctly test whether a machine can send an email
- Incorporate phpmailer for greater email flexibility
- Run `smtp_notifications.php` more frequently than once per minute
- Keep a record of when machines be come able/unable to email and just send one email per up/down (rather than a status report every minute)
