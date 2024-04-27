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
  
Manage backend panel of your application.


### LIVE DEMO 
 - ~~[iadmin v 3.0.0](http://v3.iadmin.ga)~~


## Documentation ~~[AVAILABLE HERE](http://iadmin.ga)~~


### Using Docker (development only)

```bash
docker volume prune  && docker-compose up --build && docker-compose up
```


### Thanks
- [FreeDash lite](https://github.com/adminmart/FreeDash-lite/)

