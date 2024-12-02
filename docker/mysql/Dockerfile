FROM mysql:8

#COPY prepare-image.sh /
#RUN chmod +x /prepare-image.sh
#RUN /prepare-image.sh && rm -f /prepare-image.sh
#RUN mkdir /var/lib/mysql-files

COPY init/init-grant-access.sql /docker-entrypoint-initdb.d/


EXPOSE 3306
CMD ["mysqld"]