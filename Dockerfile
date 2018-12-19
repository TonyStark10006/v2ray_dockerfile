FROM ubuntu:18.04

SHELL ["/bin/bash", "-c"]

ARG TERM=xterm
ARG PROTOCOL
ARG PORT
ARG ADBLOCK

RUN apt-get update && apt-get install wget -y \
    && wget https://raw.githubusercontent.com/233boy/v2ray/master/install.sh && chmod +x install.sh \
    # 默认使用TCP传输协议
    && echo -e "1\n${PROTOCOL}\n${PORT}\n${ADBLOCK}\nN\n\n" | ./install.sh

# COPY ./config.json /etc/v2ray/config.json
# COPY ./233blog_v2ray_backup.conf /etc/v2ray/233blog_v2ray_backup.conf

RUN v2ray start && v2ray info

# RUN ln -sf /dev/stdout /var/log/v2ray/access.log \
# 	&& ln -sf /dev/stderr /var/log/v2ray/error.log

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

# ENTRYPOINT [ "/usr/local/sbin/v2ray", "start" ]

# CMD [ "tail", "-f", "/var/log/v2ray/access.log" ]