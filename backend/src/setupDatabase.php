<?php   

//to run this file in the command line: php ./backend/src/setupDatabase.php

$dbPath = './backend/db/bitcoin_quotes.db';
//Check if path is correct
echo "db path: " . realpath($dbPath) . "\n";

//check if file exists
if (file_exists($dbPath)) {

    echo "Database file already exists. No further action required \n";
    exit;
}

//create new db file if one doesn't exist
try {
    $db = new SQLite3($dbPath);
    echo "database file created \n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . " \n";
    exit;
}


//Build db
///Create table
$tableSQL = '
CREATE TABLE quotes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    text TEXT NOT NULL,
    author TEXT NOT NULL,
    votes INTEGER DEFAULT 0
)';

if (!$db->exec ($tableSQL)) {
    echo "Error creating table \n";
} 

///Insert into table - NOTE THE SYNTAX
$insertSQL = '
INSERT INTO quotes (text, author) VALUES 
    ("Bitcoin will do to banks what email did to the postal industry.", "Rick Falkvinge"),
    ("Bitcoin is the most important invention in the history of the world since the Internet.", "Roger Ver"),
    ("Bitcoin is not a company, it\'s not a product, and it\'s not a service. It\'s an idea.", "Andreas Antonopoulos"),
    ("Bitcoin is not a currency for a government, it is a currency for the people.", "Wences Casares"),
    ("In the long term, Bitcoin moves us to a global economy where trust is entirely in math.", "Naval Ravikant"),
    ("Bitcoin is the currency of resistance.", "Max Keiser"),
    ("Bitcoin will end all bank robberies, and all robberies by banks.", "Robert Breedlove")
';

if (!$db->exec ($insertSQL)) {
    echo "Error inserting data \n";
};
   

echo "Database setup complete \n";

?>