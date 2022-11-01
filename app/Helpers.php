<?php

    namespace CMP4103;
    /**
     *
     */
    class Helpers
    {

        /**
         * @param string $username
         *
         * @return array
         */
        public static function validateUserName(string $username)
        : array
        {
            $errors = [];
            if (empty($username)) {
                $errors['empty'] = 'Username is required';
            }
            if (strlen($username) < 8) {
                $errors['less'] = 'Username must be at least 8 characters';
            }
            if (strlen($username) > 10) {
                $errors['greater'] = 'Username must be at most 10 characters';
            }
            if (!preg_match('/\d/', $username)) $errors['numeric'] = 'Username must contain numeric characters ';
            return $errors;
        }

        public static function validatePassword(string $password, string $confirm_password)
        : array
        {
            $errors = [];
            if (empty($password)) {
                $errors['empty'] = 'Password is required';
            } else {
                if (strlen($password) < 10) {
                    $errors['less'] = 'Password must be at least 10 characters';
                }
                if (strlen($password) > 15) {
                    $errors['greater'] = 'Password must be at most 15 characters';
                }
                if ($password !== $confirm_password) {
                    $errors['match'] = 'Passwords do not match';
                }
                if (!preg_match('/\d/', $password)) $errors['numeric'] = 'Password must contain numeric characters ';
                if (!preg_match('/[A-Z]/', $password)) $errors['uppercase'] = 'Password must contain at least one uppercase character';

            }
            return $errors;
        }

    }