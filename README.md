
System "Fale Mais"
===========

This project uses docker and docker-compose

Follow the instructions to access the web system

### Requirements :
- Install Docker.
- Docker Compose.


Run (Recommended)
---

```
docker-compose up -d
```

or

```
docker-compose up
```

> Param `-d` runs container in background (detach)


### Web access

http://localhost:8080/

### phpMyAdmin access

http://localhost:8282/


```
Host internal: db
Port internal: 3306

Host external/remote: localhost
Port external/remote: 8181

User: user
Password: password
Database: falemaisdb

Root Password: root
```

Stop
----

```
docker-compose down
```

> To stop all containers AND kill all volumes `docker-compose down --volumes`