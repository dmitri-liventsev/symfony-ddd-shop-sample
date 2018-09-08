Not implemented ObjectValues:
 - Product.name
 - Product.type
 
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
  
  My daughter, asked to help me, so here is her comment: ";it5l3jjjjjttt7r;2fm"