# Deploying a MEAN Stack Application on AWS Cloud

We create an aws EC2 instance, named `project mean`. This will serve as the backbone of our application deployment.

![instance_creation](./img/1.ec2_creation.png)

We then update and upgrade core dependencies on our linux backbone

![sudo_upgrade](./img/2.sudo%20update.png)
![sudo_upgrade](./img/3.sudo%20upgrade.png)

Applying certificates and installing nodejs
```
sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates

curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
```
![node_installation](./img/4.node_installation.png)

We then proceed to install mongodb which is a non-relational database which we will use to store our applications data.
```
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6

echo "deb [ arch=amd64 ] https://repo.mongodb.org/apt/ubuntu trusty/mongodb-org/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.4.list
```
```
sudo apt install -y mongodb

sudo systemctl start mongodb
sudo systemctl enable mongodb
sudo systemctl status mongodb

```
![mongodb_status](./img/5.mongodb_status.png)

Install npm which is the default package manager for JavaScript's runtime Node.js.
![npm_installation](./img/6.npm_installation.png)

Install body-parser
![body_parser](./img/7.body_parser_install.png)

We create a `Books` directory and we initialize it as a npm project using `npm init`. Then create a `server.js` file and setup the server.
![server_setup](./img/8.server_setup.png)

Installing express and mongoose which is a package which provides a straight-forward, schema-based solution to model your application data. We will use Mongoose to establish a schema for the database to store data of our book register.
![express_mongodb_installation](./img/9.express_mongoose_installation.png)

In the books directory create a directory `apps` and create a `routes.js` file then append the code to it
![created_routes](./img/10.created_routes.png)

Create a direcotry `models` in the boos directory and add a file `books.js` and append the code which contains the schema model
![creaated_models](./img/11.created_models_schema.png)

In the book directory create a `public` directory and create a `script.js` file which will contain our angular frontend code 
![controller_configuration](./img/12.controller_config.png)

Create a `index.html` in the `public` directory and append the code
![index.html_file](./img/13.htmlfile_creation.png)

We move into the books directory and spin up the express server using `node server.js`

![spinning_server](./img/14.server_spinned.png)

Configure security group inbound rules to allow our application to be accessible via the internet via our server port
![inbound_rules](./img/15.security_group_inbound.png)

On a browser, paste the public ip address of our instance to view the site
![success](./img/16.success.png)