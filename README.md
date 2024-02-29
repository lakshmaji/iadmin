# iadmin  

Simple admin panel for developers.


Manage backend database table records without have to building application from scratch. This application was written when I was grad. Reccently made few updates still this is not yet ready for production.


### Using Docker (development only)

```bash
# Build and launch
docker-compose up --build && docker-compose up

# To rebuild and launch
docker volume prune  && docker-compose up --build && docker-compose up

# Generate sample data 
cd scripts
docker-compose -f docker-compose.seeds.yml up --build
```

# Note :

 -  Any new features or suggestion.
     - We will add new features / improvements (just make a PR regarding feature or improvement)
 -  Any PR's would welcome :hatching_chick:  
 
 - Todo
     - Update missing documentation
     - Admin Change Password 
     - Profile Update

## Availble version 
 - iadmin v 3.0.0 ~~[iadmin v 3.0.0](http://v3.iadmin.ga/)~~
  
Manage backend panel of your application.

Advantages:
- Ready bootstrap designed template.
- Super simple to use, and works with MySQL database, so if you already use it, that will be very fast to setup.
- Easy to integrate encryption techniques while loggin or signup.
- Easy to perform read,update,create and delete operations on any table that you want!.


### LIVE DEMO 
 - ~~[iadmin v 3.0.0](http://v3.iadmin.ga)~~



## Documentation ~~[AVAILABLE HERE](http://iadmin.ga)~~

### Dependencies
- [Bootstrap](https://github.com/twbs/bootstrap)


```bash
docker volume prune -y && docker-compose up --build && docker-compose up
`` `
