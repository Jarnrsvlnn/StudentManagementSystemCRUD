<h1>Student List</h1>
<ul>
<?php foreach($students as $student): ?>
    <li><?= htmlspecialchars($student['full_name']) ?> - <?= htmlspecialchars($student['email']) ?></li>
<?php endforeach; ?>
</ul>