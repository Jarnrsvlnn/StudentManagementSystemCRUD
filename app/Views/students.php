<h1>Student List</h1>

<table class="table table-striped-columns">
    <tr>
        <th class="table-dark">Student ID</th>
        <th class="table-dark">Full Name</th>
        <th class="table-dark">Email</th>
        <th class="table-dark">Gender</th>
        <th class="table-dark">Address</th>
        <th class="table-dark">Section</th>
        <th class="table-dark">Grade Level</th>
        <th class="table-dark">Status</th>
    </tr>
    <?php foreach($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['student_id']) ?></td>
            <td><?= htmlspecialchars($student['full_name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['gender']) ?></td>
            <td><?= htmlspecialchars($student['address']) ?></td>
            <td><?= htmlspecialchars($student['section']) ?></td>
            <td><?= htmlspecialchars($student['grade_level']) ?></td>
            <td><?= htmlspecialchars($student['status']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<ul>

</ul>