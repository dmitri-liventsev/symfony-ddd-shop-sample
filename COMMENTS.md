Not implemented ObjectValues:
 - Product.name
 - Product.type
 - Product.price - should extend some Money class, there are few in open source.
 
 - Product.Address.City
 - Product.Address.Street
 - Product.Address.HouseNumber
 
 - Product.Contact.Email
 - Product.Contact.Phone
  
ORM assumptions
  Product type should be entity, not a string
  Foreign keys between Order_item - Product, Order_Customer - User was excluded, to avoid any cascade deletion. Orders should stay on the system
  
 Not implemented features:
  Order should contain collection of OrderItems.
  Order should contain worked statuses, and handle in async mode.
  Order could be canceled, it means at we should return OrderItem products to the Store
  
Migrations.
  On the live project should be realized migrations instead of using doctrine:schema:create command, but for dev its ok.
  
#Not realized requirements:
 - Logs
 - Tests
    - It just should be! But 8 hours limit not enough, to work in TDD mode.
 
My daughter, asked to help me, so here is her comment: ";it5l3jjjjjttt7r;2fm"
  