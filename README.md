##DDD Book Shop
###Platform: PHP 7.1  Mysql
###Framework: Symfony 4
##Architecture

Main patterns: DDD, CQRS, Event Sourcing

**CQRS** command bus was taken from Tactican http://tactician.thephpleague.com

**Event Sourcing** implementation based on Broadway https://github.com/broadway/broadway

Booth Symfony bundles was spotted from https://github.com/jorge07/symfony-4-es-cqrs-boilerplate one of the best skeleton 
for DDD which i have ever seen. In real project i will just  fork it, but to study i will implement it self.


###Domain layer

The domain layer will be divided to next domains: 
- **User** SignUp, SignUp, Unregister, Authorization, Inentification
- **Product** Keep information of available products and them types(Book is one of the type) on the store, and reduce/increase that amount
- **Order** The "heart" of the project, here should initialize main events what should initialize "Purchase" and "Delivery" proccess, here it is necessary implement own Customer entity, what should stay even at user will be removed.
- **Profile**  Just profile information, update and remove it when user unregister self, or ask it by GDPR reason



## Local app setup
1. $ git clone
2. $ composer install
3. Setup DB in the .env file required ENV params:
  - DATABASE_HOST=127.0.0.1
  - DATABASE_PORT=3306
  - DATABASE_NAME=ddd-shop
  - DATABASE_USER=root
  - DATABASE_PASS=Test1234
4. Create database and tables
	- $ php ./bin/console d:d:c
	- $ php ./bin/console d:s:c
	- $ php ./bin/console d:m:e --up 20180908190647
	
	**NB!** Do not use that solution on live servers. Only migrations is available there!
5. Run serve
	- php ./bin/console s:r
	
	**NB!** Do not use that solution on live servers. You have to setup normal web server. Ngix or Apache
	
	
#CLI commands:
Create new user
$ php ./bin/console app:create-user email@email.ru password

Create new product
$ php ./bin/console app:create-product NAME {product_on_stock} {price}

# Endpoints:

###Create new user
$ curl -d "email=email@gmail.com&password=password" -X POST http://localhost:8000/api/users

##Remove user

$ curl -X DELETE http://localhost:8000/api/user/{_USER_UUID_}

###Get products(books)
$ curl -X GET http://127.0.0.1:8000/api/products/{_PAGE_}

##Purchase a product(book)
$ curl -d "user_uuid={_USER_UUID_}&product_uuid={_PRODUCT_UUID_}&amount={_AMOUNT_}" -X POST http://127.0.0.1:8000/api/purchase


##Get purchase history
$ curl -X GET http://127.0.0.1:8000/api/orders/{_USER_UUID_}/{_PAGE_}

##Update profile
curl -X PUT http://127.0.0.1:8000/api/profile/{_USER_UUID_} -d "address_city=City&address_street=Street&address_house_number=1&contact_email=email@email.ru&contact_phone=123123"





The goal seems unattainable until it is achieved
