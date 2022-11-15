# Automate Infrastructure With IaC using Terraform – Terraform Cloud

### [Link to Code](https://github.com/Micah-Shallom/RCR-PACKER-TERRAFORM-SETUP.git)
#
#

[In the previous project](https://github.com/Micah-Shallom/RCR-MODULAR-TERRAFORM-ARCHITECTURE.git), we refactored our terraform codes into modules and as a result the introduction of modules into our codebase helped save time and reduce costly errors by re-using configuration written either by yourself, other members of your team, or other Terraform practitioners who have published modules for you to use.

[In project 15](https://github.com/Micah-Shallom/DevOps_Projects/tree/main/15.AWS_CLOUD_SOLUTION_FOR_2_COMPANY_WEBSITES_USING_A_REVERSE_PROXY_TECHNOLOGY), we can recall that to setup a Launch Template in our architecture, we require AMIs that are preconfigured with necessary packages for our applications to run on specific servers.

![](../15.AWS_CLOUD_SOLUTION_FOR_2_COMPANY_WEBSITES_USING_A_REVERSE_PROXY_TECHNOLOGY/img/architecture.png)

In this project, we will be introducing two new concepts 
- **Packer**
- **Terraform Cloud**
#
## What is Packer? 
#
Packer is an open source tool for creating identical machine images for multiple platforms from a single source configuration. Packer is lightweight, runs on every major operating system, and is highly performant, creating machine images for multiple platforms in parallel.
#

## Step 1. Creating Bastion, Nginx, Tooling and Wordpress AMIs 
#
We write packer code which helps us create AMIs for each of the following mentioned servers. A sample of the code can be found here: [packer code setup](https://github.com/Micah-Shallom/RCR-PACKER-TERRAFORM-SETUP/tree/main/AMI)

For each of the following `.pkr.hcl` files, we run the following commands
```
- packer fmt <name>.pkr.hcl
- packer validate <name>.pkr.hcl
- packer build <name>.pkr.hcl
```

![](./img/1.get_amis.jpg)
![](./img/2.packer%20build%20bastion.jpg)
![](./img/3.created_ami.jpg)
![](./img/4.all_amis.jpg)
#

## Step 2. Setting Up Infrastructures using Terraform Cloud
#
In this project, we changed the backend from S3 to a remote backend using Terraform Cloud. TF Cloud manages all state in our applications and carries out tf plan , tf validate and applies our infrastructures as required.

To do this, we setup an organization on terraform cloud and a workspace and link our workspace to our repository. On every commit, a webhook is triggered on terraform cloud and plans or applies our terrraform code based on need.


![](./img/5.plan.jpg)
![](./img/6.debug.jpg)

## Step 3. Ansible Dynamic Inventory
#
A dynamic inventory is a script written in Python, PHP, or any other programming language. It comes in handy in cloud environments such as AWS where IP addresses change once a virtual server is stopped and started again.

We make use of dynamic inventory to get Ip address of our servers created based on their tag names and hence we are able to run the required role on each server.
![](./img/7.ansible_inventory.jpg)
![](./img/8.ansible_pb_1.jpg)
#


## Step 4. Validating Application Setup
#

## Checking tooling was properly setup
![](./img/9.tooling_valid.jpg)
#

## Checking wordpress was properly setup
![](./img/10.wp_valid.jpg)
![](./img/11.db_setup.jpg)
![](./img/12.localhost_success.jpg)
#

## Checking All HealthCheck Status for  all Target groups
![](./img/13.healthcheck_nginx.jpg)
![](./img/14.healthcheck_tooling.jpg)
![](./img/15.healthcheck_wp.jpg)
#

##  Step 5. Checking Successful 
#
![](./img/16.tooling_success.jpg)
![](./img/17.wordpress_success.jpg)
#

## Step 6. Destroying Resources
#
![](./img/18.destroy_resources.jpg)
#