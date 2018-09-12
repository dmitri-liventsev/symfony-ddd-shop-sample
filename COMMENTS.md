Not implemented ObjectValues:
 - Product.name
 - Product.type
 - Product.price - should extend some Money class, there are few in open source.
 
 - Profile.Address.City
 - Profile.Address.Street
 - Profile.Address.HouseNumber
 
 - Profile.Contact.Email
 - Profile.Contact.Phone
  
ORM assumptions:

  Product type should be entity, not a string
  Foreign keys between Order_item - Product, Order_Customer - User was excluded, to avoid any cascade deletion. Orders should stay on the system
  
 Not implemented features:
 
  Order should contain collection of OrderItems.
  Order should contain worked statuses, and handle in async mode.
  Order could be canceled, it means at we should return OrderItem products to the Store
  Entity timestamps (updated_at, created_at)
  
Migrations:

  On the live project should be realized migrations instead of using doctrine:schema:create command, but for dev its ok.
  
#Not realized requirements:
 - Logs
   - Symfony already has PSR 3 log system, just added event logging there!
 - Tests
    - Was added only functional tests, its enough to be sure at all endpoints works, but need full code coverage by unit tests

My daughter, asked to help me, so here is her comment: ";it5l3jjjjjttt7r;2fm"
  
