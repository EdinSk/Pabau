<?php
// Include the controller to fetch data
require_once(__DIR__ . '/../Controller/categories.php');
?>

<h2>Voting Results by Category</h2>

<table>
    <tr>
        <th>Category</th>
        <th>Total Votes</th>
        <th>Employee with Most Votes</th>
        <th>Most Votes</th>
        <th>Generate Certificate</th>
    </tr>

    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?php echo htmlspecialchars($category['category_name']); ?></td>
            <td><?php echo $category['total_votes']; ?></td>
            <td>
                <?php
                if ($category['total_votes'] > 0) {
                    echo htmlspecialchars($category['top_nominee_name']);
                } else {
                    echo "No votes yet";
                }
                ?>
            </td>
            <td>
                <?php
                if ($category['total_votes'] > 0) {
                    echo $category['most_votes'];
                } else {
                    echo "0";
                }
                ?>
            </td>
            <td>
                <?php if ($category['total_votes'] > 0): ?>
                    <!-- Create a form to submit data via POST -->
                    <form method="POST" action="../../Pabau/Controller/generate-certificate.php">
                        <input type="hidden" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>">
                        <input type="hidden" name="winner_name" value="<?php echo htmlspecialchars($category['top_nominee_name']); ?>">
                        <input type="hidden" name="total_votes" value="<?php echo $category['most_votes']; ?>">
                        <button type="submit">Generate Certificate</button>
                    </form>

                <?php else: ?>
                    No votes yet
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>
</table>