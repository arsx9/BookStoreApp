<?php

use psr\Http\Message\ServerRequestInterface as Request;
use psr\Http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../middlewares/jsonBodyParser.php';
$config = new Config();
$db = new DB($config);
$queryBuilder = $db->getQueryBuilder();
/** 
 * Home
 * 
 */
$app->get('/', function (Request $request, Response $response) {
    $response_array = [
        'message' => 'Welcome to Book Store'
    ];
    $response_str = json_encode($response_array);
    $response->getBody()->write($response_str);
    return $response->withHeader('Content-Type', 'application/json');
});
/** 
 * Get All Books 
 * 
 */
$app->get('/api/books', function (Request $request, Response $response) use ($queryBuilder) {
    try {
        $queryBuilder->select('id', 'name', 'author_name', 'book_info')->from('books');
        $result = $queryBuilder->executeQuery()->fetchAllAssociative();

        //check if Book Data is available in db or not
        if (!empty($result)) {
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $responseData = ['message' => 'No books available'];
            $response->getBody()->write(json_encode($responseData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
    } catch (\Exception $e) {
        $errorData = ['error' => 'An error occurred while fetching the books'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});
/** 
 * Get single Books 
 * 
 */
$app->get('/api/book/{id}', function (Request $request, Response $response, array $args) use ($queryBuilder) {
    try {
        $queryBuilder->select('id', 'name', 'author_name', 'book_info')
            ->from('books')
            ->where('id = ?')
            ->setParameter(1, $args['id']);
        $result = $queryBuilder->executeQuery()->fetchAssociative();

        //Check if book with specific id is avaiable or not
        if ($result) {
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $errorData = ['message' => 'Book not found'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    } catch (\Exception $e) {
        $errorData = ['error' => 'An error occurred while fetching the book'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});
/** 
 * Add a new Book 
 * 
 */
$app->post('/api/book/add', function (Request $request, Response $response) use ($queryBuilder) {
    $parsedBody = $request->getParsedBody();
    // Validate the input data
    if (!isset($parsedBody['name']) || !isset($parsedBody['author_name']) || !isset($parsedBody['book_info'])) {
        $errorData = ['error' => 'Invalid input data'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $name = $parsedBody['name'];
    $authorName = $parsedBody['author_name'];
    $bookInfo = $parsedBody['book_info'];

    try {

        // Check if a book with the same name already exists
        $queryBuilder->select('COUNT(*)')
            ->from('books')
            ->where('name = ?')
            ->setParameter(1, $name);
        $count = $queryBuilder->fetchOne();

        if ($count > 0) {
            $errorData = ['error' => 'A book with the same name already exists'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        // insert data in db
        $queryBuilder->insert('books')
            ->setValue('name', '?')
            ->setValue('author_name', '?')
            ->setValue('book_info', '?')
            ->setParameter(1, $name)
            ->setParameter(2, $authorName)
            ->setParameter(3, $bookInfo);
        $result = $queryBuilder->executeStatement();
        if ($result > 0) {
            $responseData = ['message' => 'Book added successfully'];
            $response->getBody()->write(json_encode($responseData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } else {
            $errorData = ['error' => 'Failed to add book'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    } catch (\Exception $e) {
        $errorData = ['error' => 'An error occurred while adding the book'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
})->add($jsonBodyParser);
/** 
 * Update Book Data 
 * 
 */
$app->put('/api/book/{id}', function (Request $request, Response $response, array $args) use ($queryBuilder) {
    $parsedBody = $request->getParsedBody();
    $bookId = $args['id'];

    // Validate the input data
    if (!isset($parsedBody['name']) || !isset($parsedBody['author_name']) || !isset($parsedBody['book_info'])) {
        $errorData = ['error' => 'Invalid input data'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }
    $name = $parsedBody['name'];
    $authorName = $parsedBody['author_name'];
    $bookInfo = $parsedBody['book_info'];

    try {

        // Check if the book exists
        $queryBuilder->select('COUNT(*)')
            ->from('books')
            ->where('id = ?')
            ->setParameter(1, $bookId);
        $bookCount = $queryBuilder->fetchOne();
        if ($bookCount == 0) {
            $errorData = ['error' => 'Book not found'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        // Check if another book with the same name exists
        $queryBuilder->select('COUNT(*)')
            ->from('books')
            ->where('name = ? AND id != ?')
            ->setParameter(1, $name)
            ->setParameter(2, $bookId);
        $nameCount = $queryBuilder->fetchOne();
        if ($nameCount > 0) {
            $errorData = ['error' => 'A book with the same name already exists'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        //Update Book
        $queryBuilder->update('books')
            ->set('name', '?')
            ->set('author_name', '?')
            ->set('book_info', '?')
            ->where('id = ?')
            ->setParameter(1, $name)
            ->setParameter(2, $authorName)
            ->setParameter(3, $bookInfo)
            ->setParameter(4, $bookId);
        $result = $queryBuilder->executeStatement();

        if ($result > 0) {
            $responseData = ['message' => 'Book updated successfully'];
            $response->getBody()->write(json_encode($responseData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $errorData = ['error' => 'Failed to update book'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    } catch (\Exception $e) {
        $errorData = ['error' => 'An error occurred while updating the book'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
})->add($jsonBodyParser);
/** 
 * Delete a Book 
 * 
 */
$app->delete('/api/book/{id}', function (Request $request, Response $response, array $args) use ($queryBuilder) {
    try {
        // Check if the book exists
        $queryBuilder->select('COUNT(*)')
            ->from('books')
            ->where('id = ?')
            ->setParameter(1, $args['id']);
        $bookCount = $queryBuilder->fetchOne();
        if ($bookCount == 0) {
            $errorData = ['message' => 'Book not found'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        // delete the book
        $queryBuilder->delete('books')
            ->where('id = ?')
            ->setParameter(1, $args['id']);
        $result = $queryBuilder->executeStatement();
        if ($result > 0) {
            $responseData = ['message' => 'Book deleted successfully'];
            $response->getBody()->write(json_encode($responseData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $errorData = ['error' => 'Failed to delete book'];
            $response->getBody()->write(json_encode($errorData));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    } catch (\Exception $e) {
        $errorData = ['error' => 'An error occurred while deleting the book'];
        $response->getBody()->write(json_encode($errorData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }


    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});
