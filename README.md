# beanstalkd-vs-redis-queue
Comparing beanstalkd and redis (rdb and aof) perfomance

1. Start redis

```shell
docker-compose up -d redis_rdb
docker-compose up -d redis_aof
docker-compose ps
```
Result:
```shell
     Name                    Command               State            Ports         
----------------------------------------------------------------------------------
redis-queue-aof   docker-entrypoint.sh redis ...   Up      0.0.0.0:18379->6379/tcp
redis-queue-rdb   docker-entrypoint.sh redis ...   Up      0.0.0.0:16379->6379/tcp
```

2. Write to redis RDB

```shell
docker-compose up queue-writer-redis-rdb
```
Result:
```shell
Write finished 50000 values for 16 seconds
```

3. Read from redis RDB

```shell
docker-compose up queue-reader-redis-rdb
```
Result:
```shell
Write finished 50000 values for 15 seconds
```

4. Write to redis AOF

```shell
docker-compose up queue-writer-redis-aof
```
Result:
```shell
Write finished 50000 values for 15 seconds
```

5. Read from redis AOF

```shell
docker-compose up queue-reader-redis-aof
```
Result:
```shell
Write finished 50000 values for 15 seconds
```