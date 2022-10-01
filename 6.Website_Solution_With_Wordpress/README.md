# Implementing-Wordpress-Web-Solution

## STEP1 Preparing Web Server

- Create a EC2 instance server on AWS 

- On the EBS console, create 3 storage volumes for the instance. This serves as additional external storage to our EC2 machine

![created_volumes](./img/2.created_volumes.jpg)

- Attach the created volumes to the EC2 instance 

![attach](./img/3.attached_volumes.jpg)

- SSH into the instance and on the EC2 terminal, view the disks attached to the instance. This is achieved using the `lsblk` command.

![show_attached_disks](./img/4.show_attached_disks.jpg)


- To see all mounts and free spaces on our server

![displaying_mountpoints](./img/5.displaying_mountPoints.jpg)

- Create single partitions on each volume on the server using `gdisk `

![creating_partitions](./img/6.creating_partition.jpg)
![partitioned](./img/7.partitioned.jpg)


- Installing LVM2 package for creating logical volumes on a linux server.

![lvm2_installation](./img/8.lvm2_installation.jpg)

- Creating Physical Volumes on the partitioned disk volumes <br/>
`sudo pvcreate <partition_path>`

![marking_physical_volumes](./img/10.marking_physical_volumes.jpg)


- Next we add up each physical volumes into a volume group <br/>
`sudo vgcreate <grp_name> <pv_path1> ... <pv_path1000> `

![creating_volume_groups](./img/11.creating_volume_group.jpg)

- Creating Logical volumes for the volume group <br/>
`sudo lvcreate -n <lv_name> -L <lv_size> <vg_name>`

![creating_logical_volumes](./img/12.creating_logical_volumes.jpg)


- Our logical volumes are ready to be used as filesystems for storing application and log data.
- Creating filesystems on the both logical volumes

![file_systems](./img/13.creating_filesystems_for_each_logical_volumes.jpg)


- The apache webserver uses the html folder in the var directory to store web content. We create this directory and also a directory for collecting log data of our application

![required_directory_creation](./img/14.required_directory_creation.jpg)

- For our filesystem to be used by the server we mount it on the apache directory . Also we mount the logs filesystem to the log directory

![mounting_syncing](./img/15.mounting_syncing.jpg)

- Mount logs logical volume to var logs

![mounting](./img/16.mounting_2.jpg)

- Restoring back var logs data into var logs

![syncing_back to varlogs](./img/17.syncing_back_to_varlogs.jpg)

## Persisting Mount Points
- To ensure that all our mounts are not erased on restarting the server, we persist the mount points by configuring the `/etc/fstab` directory

- `sudo blkid` to get UUID of each mount points

![uuid_update](./img/18.getting_uuid_for_fstab_updates.jpg)

- `sudo vi /etc/fstab` to edit the file

![persisting_mount_config](./img/19.persisiting_mount_config.jpg)

 - testing mount point persistence

![testing config](./img/20.testing_config.jpg)

## STEP2 Preparing DataBase Server
 - Repeated all the steps taken to configure the web server on the db server. Changed the `apps-lv` logical volume to `db-lv`

![configuration on db server](./img/21.configuration_on_db_server.jpg)

## STEP3 Configuring Web Server
- Run updates and install httpd on web server
```
yum install -y update
sudo yum -y install wget httpd php php-mysqlnd php-fpm php-json
```

- Start web server

![starting_web_server](./img/22.starting_web_server.jpg)

- Installing php and its dependencies
```
sudo yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm
sudo yum install yum-utils http://rpms.remirepo.net/enterprise/remi-release-8.rpm
sudo yum module list php
sudo yum module reset php
sudo yum module enable php:remi-7.4
sudo yum install php php-opcache php-gd php-curl php-mysqlnd
sudo systemctl start php-fpm
sudo systemctl enable php-fpm
setsebool -P httpd_execmem 1
```

- Restarting Apache: 
`sudo systemctl restart httpd`

- Downloading wordpress and moving it into the web content directory
```
mkdir wordpress
cd   wordpress
sudo wget http://wordpress.org/latest.tar.gz
sudo tar xzvf latest.tar.gz
sudo rm -rf latest.tar.gz
cp wordpress/wp-config-sample.php wordpress/wp-config.php
cp -R wordpress /var/www/html/
```

- Configure SELinux Policies
```
sudo chown -R apache:apache /var/www/html/wordpress
sudo chcon -t httpd_sys_rw_content_t /var/www/html/wordpress -R
sudo setsebool -P httpd_can_network_connect=1
```
- Starting database server

![starting_db_server](./img/23.starting_db_server.jpg)

## STEP4 Installing MySQL on DB Server
```
sudo yum update
sudo yum install mysql-server
```

To ensure that database server starts automatically on reboot or system startup
```
sudo systemctl restart mysqld
sudo systemctl enable mysqld
```

## STEP5 Setting Up DB Server
![setting_up_db](./img/24.setting_up_db.jpg)

 - Ensure that we add port `3306` on our db server to allow our web server to access the database server.

![security_grp_db](./img/25.security_grp_db.jpg)

## Connecting Web Server to DB Server

Installing mySQl client on the web server so we can connect to the db server

```
sudo yum install mysql
sudo mysql -u admin -p -h <DB-Server-Private-IP-address>
```
![connecting_to_db_from_web](./img/26.connecting_to_db_from_web.jpg)

- On the web browser, access web server using the public ip address of the server 
![Connected_wordpress](./img/27.connected_wordpress.jpg)
![Successful_connection](./img/28.successful.jpg)