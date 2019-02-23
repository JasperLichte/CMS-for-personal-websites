<?php

namespace database;

use mysqli;

class QueryHelper
{

    /**
     * @param mysqli $link
     * @param string $query
     * @return array|null
     */
    public static function query(mysqli $link, $query) {
        $res = mysqli_query($link, $query);

        if (!$res) {
            die("Database query failed: " . mysqli_error($link));
        }

        $results = [];
        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }

    /**
     * @param mysqli $link
     * @param string $table
     * @param array $fields
     * @param string $condition
     * @param string $order
     * @param int $limit
     * @return array|null
     */
    public static function getTableFields(
        mysqli $link,
        $table,
        $fields = [],
        $condition = '',
        $order = '',
        $limit = null
    ) {
        $query = 'SELECT ' .
            (is_array($fields) && count($fields) ? implode(", ", $fields) : '*')
            . ' FROM ' . $table;

        if ($condition) {
            $query .= ' WHERE ' . $condition;
        }
        if ($order) {
            $query .= ' ORDER BY ' . $order;
        }
        if ((int)$limit) {
            $query .= ' LIMIT ' . (int)$limit;
        }

        return self::query($link, $query);
    }

}