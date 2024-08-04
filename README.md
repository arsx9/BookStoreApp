# Book List CRUD App Backend

This project was generated through slim PHP with version V4.

## Development server

- Intall WAMP Server (https://www.youtube.com/watch?v=M2at7D-lciw&ab_channel=GeekyScript)
- Make a Virtual Host with any name e.g. "bookapp.local" and path is [YourFolderPath]/app/public
- After adding Virtual Host Restart DNS.

## Setting up Database

- Download the Database file and import in your localhost Database
- Congigure the database in [YourFolderPath]/app/src/config.php

## Endpointd

- http://[Virtual_Host_Name]/api/books/ (for Retriving all the books)
- http://[Virtual_Host_Name]/api/books/ (for Retriving the single Book)
- http://[Virtual_Host_Name]/api/book/add (for Adding a new Book)
- http://[Virtual_Host_Name]/api/book/{id} (for Updating a Book With PUT Request)
- http://[Virtual_Host_Name]/api/book/{id} (for Deleting a Book With DELETE Request)

## Possible Outputs for All books End Point

- on Success: Array of JS objects with book Data
- on Failed: massage "No Books Available"
- Codes: 200, 400, 404, 500

## Possible Outputs for Single books End Point

- on Success: JS objects with book Data
- on Failed: massage "No Book Found"
- Codes: 200, 400, 404, 500

## Possible Outputs for Adding a new book End Point

- on Success: massage "Book added successfully"
- on Failed: error "Invalid input data"
- on Failed: error "A book with the same name already exists"
- on Failed: error "Failed to add book"
- Codes: 200, 400, 404, 500

## Possible Outputs for Updating a book End Point

- on Success: massage "Book updated successfully"
- on Failed: error "Invalid input data"
- on Failed: error "Book not found"
- on Failed: error "A book with the same name already exists"
- on Failed: error "Failed to update book"
- Codes: 200, 400, 404, 500

## Possible Outputs for Deleting a book End Point

- on Success: massage "Book deleted successfully"
- on Failed: error "Book not found"
- on Failed: error "Failed to delete book"
- Codes: 200, 400, 404, 500

## Testing the Endpoints

- each end point can be easily tested with the help of post man
