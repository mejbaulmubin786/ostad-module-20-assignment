### product management

Submission Guidelines:

1. Please do not try to be oversmart. Unnecessary or extra code like route, method and comment are not allowed. Your task-related files should only contain the task related code.
2. Must Submit Github link.
3. Must Create a Fresh New Repository and this repository should have only Laravels folders and files.
4. Don't push the folder where your project is created. So that we don't need to go inside that folder.
5. Must see this Demo image before submitting:

https://drive.google.com/file/d/1HNlQr9zixCLHealyqQLbftPg88G18Suu/view?usp=sharing
Task:
Develop a Product Management System in Laravel that allows users to perform the following operations:

1. Create a new product
2. Read (view) all products
3. Update an existing product
4. Delete a product
   Requirements
   Product Table Structure:
   • id: Integer, Primary Key
   • product_id: String, Required, Unique
   • name: String, Required
   • description: Text, Optional
   • price: Decimal, Required
   • stock: Integer, Optional
   • image: string, Optional
   • created_at: Timestamp
   • updated_at: Timestamp
   Routes:
5. GET /products: List all products
6. GET /products/create: Show the form to create a new product
7. POST /products: Store a new product
8. GET /products/{id}: Show a specific product
9. GET /products/{id}/edit: Show the form to edit a product
10. PUT /products/{id}: Update a product
11. DELETE /products/{id}: Delete a product
    Controllers:
    • ProductController: Handle all product-related operations using Eloquent ORM for querying the database.
    Views:
12. index.blade.php: Display all products with pagination
13. create.blade.php: Form to create a new product
14. edit.blade.php: Form to edit an existing product
15. show.blade.php: View a specific product's details
    Sorting:
16. Allow sorting by name and price.
17. Implement sorting links on the index.blade.php page.

Search:
Implement search functionality by product_id or description on the index.blade.php page.
সাবমিশনের গাইডলাইন
Please do not try to be oversmart. Unnecessary or extra code like route, method and comment are not allowed. Your task-related files should only contain the task related code. 2. Must Submit Github link. 3. Must Create a Fresh New Repository and this repository should have only Laravels folders and files. 4. Don't push the folder where your project is created. So that we don't need to go inside that folder. 5. Must see this Demo image before submitting:
