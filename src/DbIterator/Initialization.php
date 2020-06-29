<?php
namespace DbIterator;

class Initialization
{
    public static function getConnection()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION);

        $pdo->exec("CREATE TABLE books (
                      id INTEGER PRIMARY KEY, 
                      author TEXT, 
                      title TEXT, 
                      pages SMALLINT)");

        self::setFixtures($pdo);

        return $pdo;
    }

    private function setFixtures(\PDO $pdo)
    {
        $messages = [
            [
                'author' => 'Józef Ignacy Kraszewski',
                'title' => 'Jak się dawniej listy pisały',
                'pages' => 23
            ],
            [
                'author' => 'Eliza Orzeszkowa',
                'title' => 'Nad brzegiem Renu stali...',
                'pages' => 4
            ],
        ];

        $stmt = $pdo->prepare("INSERT INTO books(author, title, pages) VALUES (:author, :title, :pages)");
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':pages', $pages);

        foreach ($messages as $message) {
            $author = $message['author'];
            $title = $message['title'];
            $pages = $message['pages'];

            $stmt->execute();
        }
    }
}