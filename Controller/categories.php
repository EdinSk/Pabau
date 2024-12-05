<?php 
require_once "DB/DB.php";

function getCategoriesAndVotes($conn) {
    // SQL query to get categories, total votes, and the employee with the most votes in each category
    $sql = "
        SELECT 
            c.name AS category_name,
            COUNT(v.id) AS total_votes,
            e.name AS top_nominee_name,
            e.id AS top_nominee_id,
            MAX(votes_count) AS most_votes
        FROM categories c
        LEFT JOIN votes v ON v.category_id = c.id
        LEFT JOIN employees e ON e.id = v.nominee_id
        LEFT JOIN (
            SELECT nominee_id, category_id, COUNT(*) AS votes_count
            FROM votes
            GROUP BY nominee_id, category_id
        ) AS subquery ON subquery.nominee_id = v.nominee_id AND subquery.category_id = v.category_id
        GROUP BY c.id
        ORDER BY total_votes DESC
    ";

    // Execute the query
    $stmt = $conn->query($sql);
    
    // Return the results as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch categories and their votes
$categories = getCategoriesAndVotes($conn);

// Display the results

?>
