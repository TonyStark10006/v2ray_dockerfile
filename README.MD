## Usage
### 1. clone repo
```
git clone https://github.com/TonyStark10006/v2ray_dockerfile.git && cd v2ray_dockerfile
```

### 2. install Docker if without it
```sudo ./installDocker.sh```

### 3. specific the .env file
```cp env.example .env```
and then modify the port, transport protocol etc

### 4. run container with docker-compose
```docker-compose up```

### 5.copy uuid and other message into v2ray client