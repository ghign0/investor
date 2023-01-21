FROM nginx:1.19.6

ARG NGINX_SYMFONY_SERVER_NAME
ARG PHP_UPSTREAM_CONTAINER
ARG PHP_UPSTREAM_PORT

ARG PROJECT_ROOT_DIRECTORY
ARG PROJECT_DATA_DIRECTORY

RUN mkdir -p /etc/nginx/templates
RUN mkdir -p /tmp/nginx
RUN mkdir -p ${PROJECT_DATA_DIRECTORY}log/${NGINX_SYMFONY_SERVER_NAME}/nginx

RUN touch ${PROJECT_DATA_DIRECTORY}log/${NGINX_SYMFONY_SERVER_NAME}/nginx/error.log
RUN touch ${PROJECT_DATA_DIRECTORY}log/${NGINX_SYMFONY_SERVER_NAME}/nginx/access.log

COPY nginx.conf /etc/nginx/
COPY templates/* /etc/nginx/templates/
COPY html/index.html.template /tmp/nginx/

RUN envsubst < /tmp/nginx/index.html.template > /usr/share/nginx/html/index.html; \
    rm -fR /tmp/nginx

CMD ["nginx"]

EXPOSE 80
EXPOSE 443

WORKDIR /etc/nginx/conf.d