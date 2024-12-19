<?php

$dbPath = './backend/db/bitcoin_quotes.db';

$db = new SQLite3($dbPath);

$result = $db->query('SELECT * FROM quotes');
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: " . $row['id'] . " | Quote: " . $row['text'] . " | Author: " . $row['author'] . " | Votes: " . $row['votes'] . "\n";
};

?>