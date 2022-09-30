# Implementing a Client Server Architecture Using MySQL server and MYSQL client
#

## Project Architecture
![project_architecture](./img/1.project_architecture.jpg)

![](./img/2.create_ec2.jpg)
![create_ec2](./img/3.curling_server.jpg)

To demonstrate Client-Server architecture we will be using two Ec2 instance with mysql-server and mysql-client respectively.
- Name one instance Mysql-server the other Mysql-client
  
![create_server_client](./img/4.created_server&client.jpg)

Create and configure two Linux-based virtual servers (EC2 instances in AWS). <br/>
**Note**: <u>Make sure they are both in same subnet</u>

On mysql server Linux Server install MySQL Server software.
![](./img/5.install_mysql_server.jpg)
![](./img/6.mysql_server_running.jpg)

On mysql client Linux Server install MySQL Client software.
![](./img/7.install_mysql_client.jpg)

Open port 3306 on Mysql-server allow for connection. Both server can communicate using private IPs since they belong to the same subnet
![](./img/8.sg_inbound_client.jpg)

Change bind-address on Mysql-server to allow for connection from any IP address. Set the bind-address to 0.0.0.0 using the command below:

sudo vi /etc/mysql/mysql.conf.d/mysqld.cnf
![](./img/9.bind_port.jpg)

Configure MysQL server and create database and user
- Set up password with `sudo mysql_secure_installation` and create a user
- Create database
    
    ![](./img/11.create_db.jpg)
    ![](./img/10.server_lookup.jpg)

- grant all permission on database
    
    ![](./img/12.grant_all_permissions.jpg)

From mysql client Linux Server connect remotely to mysql server Database Engine without using SSH. You must use the mysql utility to perform this action.
    ![](./img/13.successful_connect_from.jpg)

Check that you have successfully connected to a remote MySQL server and can perform SQL queries. You should something similar to the screenshot below: