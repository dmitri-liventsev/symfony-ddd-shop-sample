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



git clone
composer install
php ./bin/console d:d:c
php ./bin/console d:s:c
php console d:m:e --up 20180908190647