<?php 
/**
 * @package    Sql Query Builder
 * @author     Davison Pro <davisonpro.coder@gmail.com | https://davisonpro.dev>
 * @copyright  2019 Sql Query Builder
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

require_once dirname(__FILE__) . '/db-query.php';

define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'password' );
define( 'DB_NAME', 'sql-query-builder' );

/** Must include this constant in your script since it's required by the DbQuery class */
define( 'DB_PREFIX', '' );

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/***********************************/
$sql = new DbQuery();
$sql->select('*');
$sql->from('product', 'p');
$sql->orderBy('p.product_id');

echo $sql;

// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//     }
// }

/***********************************/
$sql = new DbQuery();
$sql->select('COUNT(category_id) AS cat_sum, category_id');
$sql->from('product');
$sql->groupBy('category_id');

echo $sql;

// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//     }
// }


/***********************************/
/** 
 * Sql Joins
 * INNER JOIN: returns rows when there is a match in both tables.
 * LEFT JOIN: returns all rows from the left table, even if there are no matches in the right table.
 * RIGHT JOIN: returns all rows from the right table, even if there are no matches in the left table.
 **/
  
$sql = new DbQuery();
$sql->select('p.product_id, p.name AS product_name, c.name');
$sql->from('product', 'p');
$sql->innerJoin('category', 'c', 'p.category_id = c.category_id');

echo $sql;

// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//     }
// }

/***********************************/
$sql = new DbQuery();
$sql->select('COUNT(p.product_id) AS prod_sum, p.category_id');
$sql->from('product', 'p');
$sql->having('COUNT(p.category_id) > 5');
$sql->groupBy('category_id');

echo $sql;

// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//     }
// }
