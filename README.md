# Mah Budget

A budget tool for your finances.

## Installation

```
../bin/drush si --db-url=sqlite://../private/.db.sqlite -y
; Do not use drush runserver, due to autoloading issues.
php -S 127.0.0.1:8888
```


## Importing transactions

* Download as OFX (QFX/Quicken sometimes works. Needs different parser)
* Place in local filesystem (ex: project's private dir)
* Import using `cd web; ../../bin/drupal ofx:import ../private/FILENAME.ofx`
