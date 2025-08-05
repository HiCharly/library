<?php

namespace App\Services\BooksApi;

use App\Models\Book;
use DateTime;
use Google\Client;
use Google\Service\Books;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Google
{
    private Client $client;
    private Books $service;

    /**
     * The Singleton's instance is stored in a static field. This field is an
     * array, because we'll allow our Singleton to have subclasses. Each item in
     * this array will be an instance of a specific Singleton's subclass. You'll
     * see how this works in a moment.
     */
    private static $instances = [];

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct() {
        $this->client = new Client();
        $this->client->setApplicationName("Client_Library_Examples");
        $this->client->setDeveloperKey(config('api.google.api_key'));

        $this->service = new Books($this->client);
    }

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone() {}

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function getInstance(): Google
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function search(string $query): Collection
    {
        $cacheKey = 'google_books_search_' . md5($query);
        $ttl = 60 * 60 * 24; // Cache for 24 hours

        $apiResponse = Cache::remember($cacheKey, $ttl, function () use ($query) {
            return $this->service->volumes->listVolumes($query);
        });

        $books = new Collection();

        foreach ($apiResponse->getItems() as $item) {
            $books->push($this->convertItemToBook($item));
        }

        return $books;
    }

    private function convertItemToBook($item): Book
    {
        $book = new Book();

        if (isset($item['volumeInfo']['industryIdentifiers'])) {
            foreach ($item['volumeInfo']['industryIdentifiers'] as $identifier) {
                if ($identifier['type'] === 'ISBN_13') {
                    $book->isbn = $identifier['identifier'];
                    break;
                }
            }
        }

        if(!empty($item['volumeInfo']['title'])) {
            $book->title = $item['volumeInfo']['title'];
        }

        if(is_array($item['volumeInfo']['authors'] ?? null)) {
            $book->author = implode(', ', $item['volumeInfo']['authors']);
        }

        if(!empty($item['volumeInfo']['description'])) {
            $book->description = $item['volumeInfo']['description'];
        }

        if(!empty($item['volumeInfo']['publisher'])) {
            $book->publisher = $item['volumeInfo']['publisher'];
        }

        if(!empty($item['volumeInfo']['publishedDate'])) {
            $book->published_at = DateTime::createFromFormat('Y-m-d', $item['volumeInfo']['publishedDate']);
        }

        if(!empty($item['volumeInfo']['imageLinks']['thumbnail'])) {
            $book->thumbnail_url = $item['volumeInfo']['imageLinks']['thumbnail'];
        }

        if(!empty($item['volumeInfo']['pageCount'])) {
            $book->page_count = $item['volumeInfo']['pageCount'];
        }

        if(!empty($item['accessInfo']['webReaderLink'])) {
            $book->web_reader_url = $item['accessInfo']['webReaderLink'];
        }

        return $book;
    }
}
