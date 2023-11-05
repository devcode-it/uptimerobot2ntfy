# UptimeRobot2ntfy

Very simple script that read all monitors of [UptimeRobot](https://uptimerobot.com/) and send a notification to [ntfy.sh](https://ntfy.sh) when a monitor goes down.

# Configuration

Copy the `config.example.php` to `config.inc.php` and put your UptimeRobot API KEY (read-only key) and your ntfy.sh topic (authentication not yet supported).

# Run

```php
php run.php
```

Try the script and if it works you can run in cron every 5 minutes:

```bash
*/5 * * * *	www-data    cd /path/to/script && php run.php
```
