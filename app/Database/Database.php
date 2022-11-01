<?php

    namespace CMP4103\Database;
    require 'vendor/autoload.php';

    use Medoo\Medoo;
    use PDOStatement;

    class Database
    {
        /**
         * Database configuration
         */
        private string $type = 'mysql';
        private string $host = 'localhost';
        private string $database = 'cmp4103';
        private string $username = 'root';
        private string $password = '';


        /**
         * Selecting data from database
         *
         * @param string $table
         * @param $data
         *
         * @return null|array
         */
        public function select(string $table, $data)
        : ?array
        {
            return $this->medoo()->select($table, $data);
        }


        /**
         * Here I return an instance of Medoo a database library
         *
         * @return \Medoo\Medoo
         */
        public function medoo()
        : Medoo
        {
            return new Medoo(
                [
                    'type'     => $this->type,
                    'host'     => $this->host,
                    'Database' => $this->database,
                    'username' => $this->username,
                    'password' => $this->password
                ]);
        }


        /**
         * Here I create a users table in the database.
         *
         * @return \PDOStatement
         */
        public function createUsersTable()
        : PDOStatement
        {
            return $this->medoo()->create('users',
                [
                    'id'       => [
                        'INT',
                        'NOT NULL',
                        'AUTO_INCREMENT',
                        'PRIMARY KEY'
                    ],
                    'username' => [
                        'VARCHAR(255)',
                        'NOT NULL',
                        'UNIQUE'
                    ],
                    'password' => [
                        'VARCHAR(255)',
                        'NOT NULL'
                    ]
                ]
            );
        }
    }