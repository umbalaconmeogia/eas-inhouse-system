# Setup developing environment

This document describe setup steps on Ubuntu.

## Setup database

1. Create database
```shell
sudo -u postgres createdb -E UTF8 easinhouse
```

1. Delete database
```shell
sudo -u postgres dropdb easinhouse
```

1. Create db user
```shell
sudo -u postgres psql
```

```sql
CREATE USER easinhouse WITH PASSWORD 'easinhouse';
GRANT ALL PRIVILEGES ON DATABASE easinhouse TO easinhouse;
```


